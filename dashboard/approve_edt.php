<?php

require "../action.php"; $action = new Action();
require "../class_edeposit.php"; $edeposit = new edeposit();

$userid = $_SESSION["username"];
$timed = date("D j F, Y; h:i a");

//Does reference_id exists ???
$srchTran = $action->query("select * from transaction where reference_id='".$_REQUEST["txid"]."'"); $srchTran->execute();

if($srchTran->rowCount() == 0 ) {
	
	$plan_id = $_REQUEST["pid"]; //Plan ID...
	$verifyPay = $edeposit->verifyPay($_REQUEST["txid"]);

	$verifyPay_decode = json_decode($verifyPay);
			
	$txid = mt_rand(11111, 90903).mt_rand(11111, 90903); 

	$srchPlan = $action->query("select * from plans where id='$plan_id'"); $srchPlan->execute();
	$srchPlans = $srchPlan->fetch(PDO::FETCH_ASSOC);
	$amount = $srchPlans["price"];
	$refComm = $srchPlans["refComm"];
	
	//Has referral earns his commission... ?
	$chkRef = $action->query("select * FROM `referral` where clientReferred='$userid' and pointRcv='NO'"); $chkRef->execute();
	
	
	
	if($verifyPay_decode->status != true) {
		$updtTran = $action->query("insert into transaction (userid, amount, transaction_id, reference_id, response, status, dateCreated, dateUpdated) values ('$userid', '$amount', '$txid', '".$_REQUEST["txid"]."', '".addslashes($verifyPay)."', '1', '$timed', '$timed')"); 
		if($updtTran->execute()) {
			$updtUsr = $action->query("update users set planID='$plan_id' where id='$userid'"); $updtUsr->execute();
		}
		
		//Referral Commission...
		if($chkRef->rowCount() > 0) { // Referral is yet to be paid...
			$chkRefs = $chkRef->fetch(PDO::FETCH_ASSOC);
			$IRefer = $chkRefs["userID"];
			
			if($refComm > 0) {
				$refPercent = (($amount * $refComm)/100);
			} else {
				$refPercent = (($amount * $action->search_setting("refComm"))/100);
			}
			
			$updtRef = $action->query("insert into transaction (userid, amount, transaction_id, reference_id, response, status, type, dateCreated, dateUpdated) values ('$IRefer', '$refPercent', '$txid', '".$_REQUEST["txid"]."', 'Referral bonus credited', '1', 'referral', '$timed', '$timed')"); 
			$updtRef->execute();
			
			//We need to credit the Referral wallet...
			$currWallet = $action->userWallet($IRefer);
			$usd_amnt = $currWallet["usd"];
			
			$newAmnt = $usd_amnt + $refPercent;
			
			$action->updateBlc($IRefer, $newAmnt, "usd");
			
		}
		
		
		$response[] = ["msg"=>"Payment approved successfully and plan activated for user", "status" => true];
		
	} else {
		$response[] = ["msg"=>"Payment is under processing or failed", "status" => true];
	}
	
} else {
	$response[] = ["msg"=>"Payment already approved and plan activated for user", "status" => false];
}

echo json_encode($response);
?>

<script>
	setTimeout(function() {
		window.location = "index";
	}, 5000);
</script>