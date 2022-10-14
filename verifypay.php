<?php

require "action.php"; $action = new Action();
require "class_edeposit.php"; $edeposit = new edeposit();

echo $edeposit->verifyPay("4745248610581066");

die();

$loadPayment = $action->query("select * from transaction where status=2"); $loadPayment->execute();

if($loadPayment->rowCount() > 0) {
	
	while($loadPay = $loadPayment->fetch(PDO::FETCH_ASSOC)) {
		$id = $loadPay["id"];
		$txID = $loadPay["reference_id"];
		$amount = $loadPay["amount"];
		$userid = $loadPay["userid"];
		
		//How much does user has in wallet ?
		$currWallet = $action->userWallet($userid);
		$usd_amnt = $currWallet["usd"];
		
		$newAmnt = $usd_amnt + $amount;
		
		$verifyPay = $edeposit->verifyPay($txID);
		
		$verifyPay_decode = json_decode($verifyPay);
		
		if($verifyPay_decode->status != true) {
			
			$action->updateBlc($userid, $newAmnt, "usd");
			
			$updtTran = $action->query("update transaction set status=1 where reference_id='$txID'"); $updtTran->execute();
			
			$response[] = ["status" => "Approved", "reference_id" => $txID, "amount" => $amount, "new_blc" => $newAmnt ]; 
			
		} else {
			$updtTran = $action->query("update transaction set status=3 where reference_id='$txID'"); $updtTran->execute();
			
			$response[] = ["status" => "Approved", "reference_id" => $txID, "amount" => $amount ];
		}
		
	}
	
	echo json_encode($response);
	
}