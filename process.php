<?php

require "action.php"; $action = new Action();
require "class_edeposit.php"; $edeposit = new edeposit();

$timed = date("D j F, Y; h:i a");

//Fund wallet...
if(isset($_POST["fundwallet"])) {
	
	$amount = $_POST["amount"];
	$amount = mt_rand(111, 920);
	$txID = $_POST["txID"];
	
	// unset($_SESSION["msg"]);
	$edeposit->makepayment($amount, $txID); //Initialize the payment and send email message...
	
	echo $_SESSION["msg"];
	
}

//Delete Level...
if(isset($_POST["deleteLeveL"])) {
	$level_id = $_POST["id"];
	
	$delPlan = $action->query("delete from plans where id='$level_id'");
	if($delPlan->execute()) {
		echo "success";
	} else {
		echo "failed";
	}
}
	
//Edit Level...
if(isset($_POST["updateLevel"])) {
	
	$userid = $_SESSION["username"];
	
	$level_name = addslashes($_POST["level_name"]);
	$price = $_POST["price"];
	$bus_no = $_POST["bus_no"];
	$bus_review = $_POST["bus_review"];
	$refComm = $_POST["refComm"];
	$level_id = $_POST["id"];
	
	$srchLevel = $action->query("select * from plans where name='$level_name'"); $srchLevel->execute();
	$srchLevels = $srchLevel->fetch(PDO::FETCH_ASSOC);
		
	if(!isset($userid) || empty($userid)) {
		echo "login_needed";
	} else if($srchLevels["id"] != $level_id && $srchLevel->rowCount() > 0) {
		echo "level_exists";
	} else {
		
		$updtLevel = $action->query("update plans set name='$level_name', price='$price', bus_no='$bus_no', bus_review='$bus_review', refComm='$refComm' where id='$level_id'"); 
		if($updtLevel->execute()) {
			echo "success";
		} else { echo "failed"; }
	}
	
}
	
//Edit Category...
if(isset($_POST["updateCategory"])) {
	
	$userid = $_SESSION["username"];
	
	$category_name = addslashes($_POST["category_name"]);
	$category_id = $_POST["id"];
	
	$srchLevel = $action->query("select * from category where category_name='$category_name'"); $srchLevel->execute();
	$srchLevels = $srchLevel->fetch(PDO::FETCH_ASSOC);
		
	if(!isset($userid) || empty($userid)) {
		echo "login_needed";
	} else if($srchLevels["id"] != $category_id && $srchLevel->rowCount() > 0) {
		echo "category_exists";
	} else {
		$updtCat = $action->query("update category set category_name='$category_name' where id='$category_id'"); 
		if($updtCat->execute()) {
			echo "success";
		} else { echo "failed"; }
	}
	
}

//Delete Category...
if(isset($_POST["deleteCategory"])) {
	$category_id = $_POST["id"];
	
	$delPlan = $action->query("delete from category where id='$category_id'");
	if($delPlan->execute()) {
		echo "success";
	} else {
		echo "failed";
	}
}

//Buy plan...
if(isset($_POST["buyPlan"])) {
	$plan_id = $_POST["id"];
	$payType = $_POST["payType"];
	$_SESSION["plan_id"] = $plan_id; //Created as a session cos of edt...
	
	$userid = $_SESSION["username"];
	
	$srchLevel = $action->query("select * from plans where id='$plan_id'"); $srchLevel->execute();
	$srchLevels = $srchLevel->fetch(PDO::FETCH_ASSOC);
	$planfee = $srchLevels["price"];
	
	if($payType == "btc") {
		$searchVal = "btcWallet";
	} else if($payType == "paypal") {
		$searchVal = "paypalAddr";
	} else if($payType == "tron") {
		$searchVal = "tronWallet";
	} else if($payType == "eth") {
		$searchVal = "ethAddr";
	} 
	
	if(!isset($userid) || empty($userid)) {
		echo "login_needed";
	} else if($planfee == 0) {
		echo "price_low";
	} else if($plan_id == $action->clientInfo($userid)["planID"]) {
		echo "curr_plan";
	} else {
		
		$amount = $srchLevels["price"];
		$txID = mt_rand(111111, 920920).mt_rand(111111, 920920);
		
		if($payType == "edt") { //Process payment...
			$edeposit->makepayment($amount, $txID); //Initialize the payment...
			
			if(str_replace(" ", '', $_SESSION["msg"]) == "sent") { //Activate the member plan immediately...
				$updtUsr = $action->query("update users set planID='$id' where id='$userid'"); 
				$updtUsr->execute();
			}
			
			echo $_SESSION["msg"];
		} else if($payType == "earnings") { //Process payment...
			$earnWallet = $action->userWallet($userid)["usd"];
			if($planfee > $earnWallet) {
				echo "insufficient_blc";
			} else {
				
				$newBlc = $earnWallet - $planfee;
				
				$response = json_encode(["msg" => "Plan activated with earnings wallet", 
					"type" => "earning",
					"plan_name" => $srchLevels["name"],
					"bfrAmnt" => $earnWallet,
					"aftAmnt" => $newBlc,
				]);
				
				$saveTran = $action->query("insert into transaction (userid, amount, transaction_id, response, status, dateCreated, dateUpdated) values ('$userid', '$amount', '$txid', '".addslashes($response)."', '1', '$timed', '$timed')");
				if($saveTran->execute()) {
					
					$action->updateBlc($userid, $newBlc, "usd");
					
					$updtUsr = $action->query("update users set planID='$plan_id' where id='$userid'"); $updtUsr->execute();
					
					$message = "<html>
            <head>
                <title>Successful Activation of Plan (".$srchLevels["name"].")</title>
            </head>
			<body style='background-color: #030f4f;'>
  <table border='0' cellpadding='0' cellspacing='0' width='100%' style='margin-top: 2%'>
    <tr>
      <td align='center' bgcolor='#030f4f'>
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
          <tr>
            <td align='left' bgcolor='#ffffff' style='padding: 36px 24px 0; font-family: Helvetica, Arial, sans-serif; border-top: 3px solid #264762;'>
              <h1 style='text-align: center; margin: 0; font-size: 36px; font-weight: 700; letter-spacing: -1px; line-height: 48px;'>9ja Business</h1>
              <h4 style='text-align: center; margin: 0; font-size: 20px; font-weight: 700; letter-spacing: -1px; line-height: 48px;'>Activation of ".$srchLevels["name"]." Plan!</h4>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td align='center' bgcolor='#030f4f'>
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
          <tr>
            <td align='left' bgcolor='#f5a21b' style='padding: 24px; font-family: Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;'>
              <p style='margin: 0;'>
				Hey <b>".$action->clientInfo($_SESSION["username"])["fullname"]."</b>  <br> 
					Your plan (".$srchLevels["name"].") has been activated successfully and ".number_format($planfee, 2)."USD has been deducted from your wallet <br><br>
					Best Regard <br> 9ja Business
			  </p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
	
    <tr>
      <td align='center' bgcolor='#030f4f' style='padding: 24px;'>
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
          <tr>
            <td align='center' bgcolor='#030f4f' style='padding: 12px 24px; font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;'>
              <p style='color: #fff; margin: 0;'>You received this email you have an account with 9ja Business and also activated a plan on your account, you can safely delete this email if this message is strange.</p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>";

$action->sendmail("Activation of Plan", "no-reply@9jabusiness.online", $action->clientInfo($userid)["email"], $message);
					
					echo "success";
				} else {
					echo "error";
				}
			}
			
		} else { //Upload proof of payment...
			
			$wallet_addr = $action->search_setting($searchVal);
			
			//Since they are to pay with other currency, then we save the transaction and direct them to pay to the specified admin wallet...
			$response = json_encode(["msg"=>"Plan activation with Crypto", "plan_name" => $srchLevels["name"], "wallet_addr" => $wallet_addr, "type" => $payType ]);
		
			$savetransaction = $action->query("insert into transaction (userid, amount, transaction_id, response, dateCreated, dateUpdated) values ('".$_SESSION["username"]."', '$amount', '$txID', '".addslashes($response)."', '$timed', '$timed')");
			$savetransaction->execute();
		
			$savepay = $action->query("insert into payment (userid, amount, transaction_id, walletID, planID, currency, dateCreated, dateUpdated) values ('".$_SESSION["username"]."', '$amount', '$txID', '$wallet_addr', '$plan_id', '$payType', '$timed', '$timed')");
			$savepay->execute();
			
					$message = "<html>
            <head>
                <title>Successful Activation of Plan (".$srchLevels["name"].")</title>
            </head>
			<body style='background-color: #030f4f;'>
  <table border='0' cellpadding='0' cellspacing='0' width='100%' style='margin-top: 2%'>
    <tr>
      <td align='center' bgcolor='#030f4f'>
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
          <tr>
            <td align='left' bgcolor='#ffffff' style='padding: 36px 24px 0; font-family: Helvetica, Arial, sans-serif; border-top: 3px solid #264762;'>
              <h1 style='text-align: center; margin: 0; font-size: 36px; font-weight: 700; letter-spacing: -1px; line-height: 48px;'>9ja Business</h1>
              <h4 style='text-align: center; margin: 0; font-size: 20px; font-weight: 700; letter-spacing: -1px; line-height: 48px;'>Payment Notification!</h4>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td align='center' bgcolor='#030f4f'>
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
          <tr>
            <td align='left' bgcolor='#f5a21b' style='padding: 24px; font-family: Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;'>
              <p style='margin: 0;'>
				Hey <b>".$action->clientInfo($_SESSION["username"])["fullname"]."</b>  <br> 
					We have received your plan purchase request. Kindly proceed to upload your proof of payment for instant activation of your plan by our Admins<br><br>
					Best Regard <br> 9ja Business
			  </p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
	
    <tr>
      <td align='center' bgcolor='#030f4f' style='padding: 24px;'>
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
          <tr>
            <td align='center' bgcolor='#030f4f' style='padding: 12px 24px; font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;'>
              <p style='color: #fff; margin: 0;'>You received this email you have an account with 9ja Business and also initiated a plan purchase, you can safely delete this email if this message is strange.</p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>";

$action->sendmail("Activation of Plan", "no-reply@9jabusiness.online", $action->clientInfo($userid)["email"], $message);

			echo "created";
		
		}
	}
	
}

if(isset($_POST["postReview"])) {
	$message = filter_var($_POST["review"], FILTER_SANITIZE_MAGIC_QUOTES );
	$id = $_POST["id"];
	
	$userid = $_SESSION["username"];
	
	$loadBus = $action->query("select * from businesscreation where id='$id'"); $loadBus->execute();
	$loadBuss = $loadBus->fetch(PDO::FETCH_ASSOC);
	
	//User has a pending review...
	$chkRev = $action->query("select * from businessreview where userid='$userid' and bus_id='$id' and status=0"); $chkRev->execute();
	
	if(!isset($userid) || empty($userid)) {
		echo "login_needed";
	} else if($chkRev->rowCount() == 0) { //Single review
		
		$savepay = $action->query("insert into businessreview (userid, bus_id, message, dateCreated) values ('".$_SESSION["username"]."', '$id', '".addslashes($message)."', '$timed')");
		if($savepay->execute()) { 
			
					$message = "<html>
            <head>
                <title>Business Review Submitted</title>
            </head>
			<body style='background-color: #030f4f;'>
  <table border='0' cellpadding='0' cellspacing='0' width='100%' style='margin-top: 2%'>
    <tr>
      <td align='center' bgcolor='#030f4f'>
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
          <tr>
            <td align='left' bgcolor='#ffffff' style='padding: 36px 24px 0; font-family: Helvetica, Arial, sans-serif; border-top: 3px solid #264762;'>
              <h1 style='text-align: center; margin: 0; font-size: 36px; font-weight: 700; letter-spacing: -1px; line-height: 48px;'>9ja Business</h1>
              <h4 style='text-align: center; margin: 0; font-size: 20px; font-weight: 700; letter-spacing: -1px; line-height: 48px;'>Business Review Submitted!</h4>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td align='center' bgcolor='#030f4f'>
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
          <tr>
            <td align='left' bgcolor='#f5a21b' style='padding: 24px; font-family: Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;'>
              <p style='margin: 0;'>
				Hey <b>".$action->clientInfo($_SESSION["username"])["fullname"]."</b>  <br> 
					Your review for ".$loadBuss["businessname"]." has been submitted and awaits admin approval<br><br>
					Best Regard <br> 9ja Business
			  </p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
	
    <tr>
      <td align='center' bgcolor='#030f4f' style='padding: 24px;'>
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
          <tr>
            <td align='center' bgcolor='#030f4f' style='padding: 12px 24px; font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;'>
              <p style='color: #fff; margin: 0;'>You received this email you have an account with 9ja Business and also initiated a plan purchase, you can safely delete this email if this message is strange.</p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>";

$action->sendmail("Business Review Submitted", "no-reply@9jabusiness.online", $action->clientInfo($userid)["email"], $message);
			
		
			echo "success";
			
		} else {
			echo "error";
		}
	}
}


if(isset($_POST["adminupdtsettingBtn"])) {
	
	$defPlan = filter_var($_POST["defPlan"], FILTER_VALIDATE_INT);
	$refComm = filter_var($_POST["refComm"], FILTER_VALIDATE_FLOAT);
	$btcWallet = filter_var($_POST["btcWallet"], FILTER_SANITIZE_STRIPPED);
	$paypalAddr = filter_var($_POST["paypalAddr"], FILTER_SANITIZE_STRIPPED);
	$tronWallet = filter_var($_POST["tronWallet"], FILTER_SANITIZE_STRIPPED);
	$ethAddr = filter_var($_POST["ethAddr"], FILTER_SANITIZE_STRIPPED);
	$minWithdraw = filter_var($_POST["min_withdraw"], FILTER_VALIDATE_FLOAT);
	$maxWithdraw = filter_var($_POST["max_withdraw"], FILTER_VALIDATE_FLOAT);
	$wdrDay = implode(",", filter_var_array($_POST["wdrDays"]));
	
	$creation = filter_var($_POST["creation_point"], FILTER_VALIDATE_FLOAT);
	$review = filter_var($_POST["review_point"], FILTER_VALIDATE_FLOAT);
	
	$business = json_encode(["creation" => $creation, "review" => $review ]); 
	
	$wdrDays = json_encode(["wdrDay" => $wdrDay, "min_withdrawal" => $minWithdraw, "max_withdrawal" => $maxWithdraw ]); 
	$edtMerchant = filter_var($_POST["edtMerchant"], FILTER_SANITIZE_STRIPPED);
	$dollarNaira = filter_var($_POST["dollarNaira"], FILTER_SANITIZE_STRIPPED);
	
	if($action->updateSettings($defPlan, $refComm, $btcWallet, $paypalAddr, $tronWallet, $ethAddr, $business, $wdrDays, $edtMerchant, $dollarNaira) == "success") {
		echo "success";
	} else { echo "error"; }
}

//Make withdrawal, select payment method...
if(isset($_POST["payType"])) {
	
	$userid = $_SESSION["username"];
	if(!isset($userid) || empty($userid)) {
		echo "login_needed";
	} else {
		
		if($_POST["type"] == "edt") { ?>
			<label><b>Wallet Address</b></label> <br>
			<input class="form-control" type="text" value="<?php echo $action->client_edt_walletAddress($userid);?>" disabled> <br/>
		<?php } elseif($_POST["type"] == "btc") { ?>
			<label><b>Wallet Address</b></label> <br>
			<input class="form-control" type="text" value="<?php echo $action->client_btc_walletAddress($userid);?>" disabled> <br/>
		<?php } else if($_POST["type"] == "eth") { ?>
			<label><b>Wallet Address</b></label> <br>
			<input class="form-control" type="text" value="<?php echo $action->client_eth_walletAddress($userid);?>" disabled> <br/>
		<?php } else if($_POST["type"] == "paypal") { ?>
			<label><b>Wallet Address</b></label> <br>
			<input class="form-control" type="text" value="<?php echo $action->client_paypal_walletAddress($userid);?>" disabled> <br/>
		<?php } else if($_POST["type"] == "tron") { ?>
			<label><b>Wallet Address</b></label> <br>
			<input class="form-control" type="text" value="<?php echo $action->client_trx_walletAddress($userid);?>" disabled> <br/>
		<?php } else if($_POST["type"] == "bank") { ?>
		
			<div class="row" style="margin-bottom: 10px">
				<div class="col-md-6">
					<label><b>Amount in Naira</b></label> <br>
					<input class="form-control" type="text" value="&#8358;<?php echo number_format(($action->search_setting("dollarNaira") * $_POST["amount"]), 2);?>" disabled>
				</div>
				<div class="col-md-6">
					<label><b>Bank Name</b></label> <br>
					<input class="form-control" type="text" value="<?php echo ucfirst($action->client_bank_name($userid));?>" disabled>
				</div>
			</div>
		
			<div class="row" style="margin-bottom: 20px">
				<div class="col-md-6">
					<label><b>Account Name</b></label> <br>
					<input class="form-control" type="text" value="<?php echo ucfirst($action->client_account_name($userid));?>" disabled>
				</div>
				<div class="col-md-6">
					<label><b>Account Number</b></label> <br>
					<input class="form-control" type="text" value="<?php echo $action->client_account_no($userid);?>" disabled>
				</div>
			</div>
		<?php } else { }
	}
}

//Make withdrawal now...
if(isset($_POST["mkWdr"])) {
	
	$userid = $_SESSION["username"];
	
	$amount = filter_var($_POST["amount"], FILTER_VALIDATE_FLOAT);
	$payMethod = $_POST["payMethod"];
	$pwd = md5(strtolower($_POST["pwd"]));
	$currWallet = $action->userWallet($userid)["usd"];
	
	if(!isset($userid) || empty($userid)) {
		echo "login_needed";
	} else if($pwd != $action->clientPass($userid)) {
		echo "error_pass";
	} else if($amount > $currWallet) {
		echo "insufficient_blc";
	} else if($amount === FALSE) {
		echo "invalid_amount";
	} else if($amount < $action->withdrawSettings()->min_withdrawal) {
		echo "min_withdrawal_not_met";
	} else if($amount > $action->withdrawSettings()->max_withdrawal) {
		echo "max_withdrawal_exceed";
	} else {
		
		if($_POST["payMethod"] == "edt") {
			$wallet = json_encode(["wallet" => $action->client_edt_walletAddress($userid) ]);
		} else if($_POST["payMethod"] == "btc") {
			$wallet = json_encode(["wallet" => $action->client_btc_walletAddress($userid) ]);
		} else if($_POST["payMethod"] == "eth") {
			$wallet = json_encode(["wallet" => $action->client_eth_walletAddress($userid) ]);
		} else if($_POST["payMethod"] == "paypal") {
			$wallet = json_encode(["wallet" => $action->client_paypal_walletAddress($userid) ]);
		} else if($_POST["payMethod"] == "tron") {
			$wallet = json_encode(["wallet" => $action->client_trx_walletAddress($userid) ]);
		} else if($_POST["payMethod"] == "bank") {
				$wallet = json_encode(["amountNaira" => $amount * $action->search_setting("dollarNaira"),
						"bankName" => ucfirst($action->client_bank_name($userid)),
						"accName" => ucfirst($action->client_account_name($userid)),
						"accNo" => $action->client_account_no($userid)
				]);
		}
		
		$newBlc = $currWallet - $amount;
		
		$response = json_encode(["msg" => "Withdrawal of Earnings", 
			"method" => $_POST["payMethod"],
			"bfrAmnt" => $currWallet,
			"aftAmnt" => $newBlc,
		]);
		
		$txID = mt_rand(111111, 920920).mt_rand(111111, 920920);
		
		
		if($action->updateBlc($userid, $newBlc, "usd")) {
			
			$saveWith = $action->query("insert into withdrawal (userid, amount, transaction_id, type, address, dateCreated) values ('$userid', '$amount', '$txID', '$payMethod', '$wallet', '$timed')");
			$saveWith->execute();
			$saveTx = $action->query("insert into transaction (userid, amount, transaction_id, response, type, status, dateCreated, reference_id, dateUpdated) values ('$userid', '$amount', '$txID', '".addslashes($response)."', 'withdraw', '0', '$timed', '', '')");
			$saveTx->execute();
			
			echo "success";
			
		} else { echo "error"; }
		
	}	
	
}

//Send OTP Code...
if(isset($_POST["sendOtp"])) {
	$userid = $_SESSION["username"];
	if(!isset($userid) || empty($userid)) {
		echo "login_needed";
	} else {
		
		if(!isset($_SESSION["user_otp"])) {
			$_SESSION["user_otp"] = mt_rand(1111, 9903).mt_rand(1111, 9903);
			$user_otp = $_SESSION["user_otp"];
		} else {
			$user_otp = $_SESSION["user_otp"];
		}
		
		$message = "<html>
            <head>
                <title>Change of password OTP</title>
            </head>
			<body style='background-color: #030f4f;'>
  <table border='0' cellpadding='0' cellspacing='0' width='100%' style='margin-top: 2%'>
    <tr>
      <td align='center' bgcolor='#030f4f'>
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
          <tr>
            <td align='left' bgcolor='#ffffff' style='padding: 36px 24px 0; font-family: Helvetica, Arial, sans-serif; border-top: 3px solid #264762;'>
              <h1 style='text-align: center; margin: 0; font-size: 36px; font-weight: 700; letter-spacing: -1px; line-height: 48px;'>ONE TIME PASSWORD</h1>
              <h4 style='text-align: center; margin: 0; font-size: 20px; font-weight: 700; letter-spacing: -1px; line-height: 48px;'>Change of password OTP!</h4>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td align='center' bgcolor='#030f4f'>
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
          <tr>
            <td align='left' bgcolor='#f5a21b' style='padding: 24px; font-family: Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;'>
              <p style='margin: 0;'>
				Hey <b>".$action->clientInfo($userid)['username'].", </b> <br/> <b>".strtoupper($user_otp)."</b> is your One Time Password for your Password change request
				
				<br><br>
				<div style='background: #030f4f; color: #fff; padding: 15px; font-size: 25px'>
					<b>".$user_otp."</b>
				</div>
				<br>
				
			  </p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
	
    <tr>
      <td align='center' bgcolor='#030f4f' style='padding: 24px;'>
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
          <tr>
            <td align='center' bgcolor='#030f4f' style='padding: 12px 24px; font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;'>
              <p style='color: #fff; margin: 0;'>You received this email because you requested for it in-order to change your password</p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>";
	
		if($action->sendmail("One Time Password", "no-reply@9jabusiness.com", $action->clientInfo($userid)['email'], $message)){
			echo "sent";
		} else {
			echo "error";
		}
	}
}


/*

//Buy plan...
if(isset($_POST["buyPlan"])) {
	
	$userid = $_SESSION["username"];
	
	$id = $_POST["id"];
	$srchLevel = $action->query("select * from plans where id='$id'"); $srchLevel->execute();
	$srchLevels = $srchLevel->fetch(PDO::FETCH_ASSOC);
	
	//How much does user has in wallet ?
	$currWallet = $action->userWallet($userid);
	$usd_amnt = $currWallet["usd"];
	
	$planfee = $srchLevels["price"];
	
	if(!isset($userid) || empty($userid)) {
		echo "login_needed";
	} else if($planfee == 0) {
		echo "price_low";
	} else if($usd_amnt < $planfee) {
		echo "insufficient";
	} else {
		$newBlc = $usd_amnt - $planfee;
		$txID = mt_rand(11111, 99909).mt_rand(11111, 99909);
		$response = json_encode(["msg" => "Plan activated successfully", "panic"=>null]);
		if($action->updateBlc($userid, $newBlc, "usd")) {
			$savetransaction = $action->query("insert into transaction (userid, amount, transaction_id, reference_id, response, status, dateCreated, dateUpdated) values ('$userid', '$planfee', '$txID', '$txID', '".addslashes($response)."', '1', '$timed', '$timed')");
			
			if($savetransaction->execute()) {
				$updtUsr = $action->query("update users set planID='$id' where id='$userid'"); 
				$updtUsr->execute();
				echo "success";
			} else { echo "error_save_tx"; }
			
		} else {
			echo "error";
		}
		
		
	}
}

*/

?>