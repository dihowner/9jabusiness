<?php

class edeposit extends Action {
	
	#3 means failed
	#1 means successful
	#2 means awaiting verification to know the status of the order
	#5 means proof of payment uploaded
	
	private function userInfo() {
		global $action;
		$uid = $_SESSION["username"];
		return $action->clientInfo($uid);
	}
	
	private function edtMerchant() {
		global $action;
		return $action->search_setting("edtMerchant");
	}
	
	
	//Send request to API...
	public function makepayment($amount, $txID) {
		
		$curl = curl_init();
    
		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.edeposite.info/make-user-payment?sender_address=". $this->userInfo()["edt_address"]."&sender_private_key=".$this->userInfo()["privatekey"]."&token=".$amount."&recipient_address=cvLMx5g0NnVk8trmrfiPwqsuQZArbMx8&merchant_address=".$this->edtMerchant()."&merchant_transaction_charge=0.04",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"Content-Type: application/json"
			),
		));
				
		$feedback = curl_exec($curl);
		$feedbacks = curl_error($curl); //Failed...
		
		if(curl_exec($curl) === false) { $response = $feedbacks; } else { $response = $feedback; }
		 
		// $response = '{ "transaction_token": 2, "total_transaction_charge": 0.04999999701976776, "total_transaction_token_charge": 9.999999310821295e-4, "from": "cyZ2L2wtZlOx9bW0wLHvTMlC5JtQfT3B", "to": "cvLMx5g0NnVk8trmrfiPwqsuQZArbMx8", "transaction_id": "4218151042680901", "sender_initial_token": 10, "sender_final_token": 7.999000072479248, "recipient_initial_token": 2.4207632541656496, "receipient_final_token": 4.42076301574707, "panic": null }';
		
		$this->decodeResponse($response);
		
		$decode_response = json_decode($response); //Decode the message...
		
		if($_SESSION["msg"] == "failed" || $_SESSION["msg"] == "greater" || $_SESSION["msg"] == "connection_problem" || $_SESSION["msg"] == "invalid" || strpos(strtolower($decode_response->panic), "failed") !== FALSE) {
			$this->savetransaction($response, $txID, $amount, '3');
		} else {
			$this->savetransaction($response, $txID, $amount, '2');
		}			
		
		return $response;
	}
	
	//decode API response...
	private function decodeResponse($response) {
		$decode_response = json_decode($response);
		$_SESSION["response"] = $response;
		if(strpos(strtolower($decode_response->panic), "greater") !== FALSE) {
			$result = false;
			$_SESSION["msg"] = "greater";
		} else if(strpos(strtolower($response), "failed to") !== FALSE) {
			$result = false;
			$_SESSION["msg"] = "connection_problem";
		} else if(strpos(strtolower($decode_response->panic), "invalid") !== FALSE) {
			$result = false;
			$_SESSION["msg"] = "invalid";
		}  else if(strtolower($decode_response->panic) == null) {
			$result = true;
			$_SESSION["msg"] = "sent";
		} else {
			$result = false;
			$_SESSION["msg"] = $response;
		}
		
		return $result;
		
	}
	
	//Save transaction...
	private function savetransaction($response, $txID, $amount, $status) {
		global $action;
		$timed = date("D j F, Y; h:i a");
		$decode_response = json_decode($response);
		
		$savetransaction = $action->query("insert into transaction (userid, amount, transaction_id, reference_id, response, status, dateCreated, dateUpdated) values ('".$_SESSION["username"]."', '$amount', '$txID', '".$decode_response->transaction_id."', '".addslashes($response)."', '$status', '$timed', '$timed')");
		$savetransaction->execute();
		
		$savepay = $action->query("insert into payment (userid, amount, transaction_id, planID, status, dateCreated, dateUpdated) values ('".$_SESSION["username"]."', '$amount', '$txID', '".$_SESSION["plan_id"]."', '$status', '$timed', '$timed')");
		
		$message = "<html>
            <head>
                <title>Payment Notification</title>
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
					We have received your deposit request of ".number_format($amount, 2)."EDT . Kindly proceed to make payment to complete your transaction <br> <br>
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
              <p style='color: #fff; margin: 0;'>You received this email you have an account with 9ja Business and also initiate a deposit request, you can safely delete this email if this message is strange.</p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>";
		
		$action->sendmail("Payment Request Received", "no-reply@9jabusiness.online", $action->clientInfo($_SESSION["username"])["email"], $message);
		
		return $savepay->execute();
		
		
	}
	
	//Verify transaction...
	public function verifyPay($tx_no) {
		$curl = curl_init();
    
		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.edeposite.info/transaction?transaction_number=".$tx_no,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"Content-Type: application/json"
			),
		));
				
		$response = curl_exec($curl);
		
		return $response;
		
	}
	
}

$run = new edeposit();
?>