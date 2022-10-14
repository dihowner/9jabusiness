<?php
session_start();
set_time_limit(0);
date_default_timezone_set("Africa/Lagos");
// if(is_file("config.php")){
require_once "config.php";
error_reporting(0);
$config = new Config();

$per_page = 20;
if(isset($_GET["currentpage"]))
{
    $page = $_GET["currentpage"];
}
else
{
    $page = 1;
}
$start_page = ($page-1) * $per_page;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mailer/src/Exception.php';
require 'mailer/src/PHPMailer.php';
require 'mailer/src/SMTP.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Class below

class Action extends Config  {

    public function emailExist($email) {
        $srchMail = $this->con->prepare("select * from users where email='$email'");
        $srchMail->execute();
        return $srchMail->rowCount();
    }

    public function usernameExist($username) {
        $srchMail = $this->con->prepare("select * from users where username='$username'");
        $srchMail->execute();
        return $srchMail->rowCount();
    }

    public function referralID($referral) {
        $srchReferral = $this->con->prepare("select * from users where usercode ='$referral'");
        $srchReferral->execute();
        $srchReferral_Info = $srchReferral->fetch(PDO::FETCH_ASSOC);
        $id = $srchReferral_Info["id"];
        return $id;
    }

    public function user_stat($type, $uid) {
        switch($type) {
            case 'total_ref':
                # code...
                $countRef = $this->con->prepare("select * from referral where userID='$uid'"); $countRef->execute();
                return $countRef->rowCount();
            break;

            case 'bus_create':
                # code...
                $countRef = $this->con->prepare("select * from businesscreation where userid='$uid' and status=1"); $countRef->execute();
                return $countRef->rowCount();
            break;

            case 'bus_review':
                # code...
                $countRef = $this->con->prepare("select * from businessreview where userid='$uid' and status=1"); $countRef->execute();
                return $countRef->rowCount();
            break;

            case 'earn_spent':
                # code...
                $countRef = $this->con->prepare("SELECT sum(amount) as totalSpent FROM `transaction` WHERE userid='$uid' and type='plan' and response LIKE '%earn%'"); 
                $countRef->execute();
                $countRefs = $countRef->fetch(PDO::FETCH_ASSOC);
                return $countRefs["totalSpent"];
            break;

            case 'ref_comm':
                # code...
                $countRef = $this->con->prepare("SELECT sum(amount) as totalSpent FROM `transaction` WHERE userid='$uid' and type='referral'"); 
                $countRef->execute();
                $countRefs = $countRef->fetch(PDO::FETCH_ASSOC);
                return $countRefs["totalSpent"];
            break;

            case 'total_withdraw':
                # code...
                $countRef = $this->con->prepare("SELECT sum(amount) as totalSpent FROM `transaction` WHERE userid='$uid' and type='withdraw' and status=1"); 
                $countRef->execute();
                $countRefs = $countRef->fetch(PDO::FETCH_ASSOC);
                return $countRefs["totalSpent"];
            break;

        }
    }

    public function saveAccount($fullname, $username, $email, $password, $referral, $photo) {

        $usercode = $this->randID(6);
        $verificationCode = $this->randID(12);

        $saveUser = $this->con->prepare("insert into users (fullname, username, email, password, usercode, avatar, planID) values ('$fullname', '$username', '$email', '$password', '$usercode', '$photo', '".$this->search_setting("defPlan")."')");
        
        if($saveUser->execute()) {
                $lastInsert = $this->lastInsertId();
                
                //Since user has been created, then we need
                $saveWallet = $this->con->prepare("insert into wallet (clientID, usd, eDT) values ('$lastInsert', '0', '0')");
                $saveWallet->execute();

                //Get referral ID...
                $referralID = $this->referralID($referral);

                //Since registration was successful and referral is valid...
                if(!empty($referralID)) {
                    $saveReferral =  $this->con->prepare("insert into referral (userID, clientReferred) values ('$referralID', '$lastInsert')");
                    $saveReferral->execute();
                }
                
                //Since server was unable to send mail, then we need to activate the account automatically...
                $updateUsr = $this->con->prepare("update users set activation='YES' where id='$lastInsert'");$updateUsr->execute();
        

                                // set content type header for html email
                                $headers  = 'MIME-Version: 1.0' . "\r\n";
                                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                                // set additional headers
                                $headers .= 'From: Survey Company <no-reply@survey.com>' . "\r\n".'X-Mailer: PHP/' . phpversion();
                                $subject = "Registration Successful";
                                $body= "<html>
        <head>
            <title>".$subject."</title>
        </head>
        <body>
            <div style='width:80%;margin:0px auto;padding:10px;background:#fff;'>
                
                    <p style='font-size:22px; color: #000'><em>Welcome (".ucfirst($username).") to 9ja Business</em></p>

                    <p style='font-size:20px;color:#000;font-family:georgia;'>
                        You have successfully registered your account. Kindly sign in to your dashboard with your account details and make an investment.
                        <br><br>
                        <a href='https://survey.com/login' target='_blank' style='text-decoration: none; color: orange;font-size:20px;font-family:georgia;'>Sign In
                        </a><br>
                        <br>
                        Regards,<br>
                        Survey
                    </p>
                <div style='background:#000; color:#fff; padding:5px;'>&copy; ". date('Y') ." Survey All Rights Reserved </div>
            </div>
    </body>
    </html>";
        
            mail($email, $subject, $body, $headers);
            
            return true;
            
        }
    }
    
    private function randID($length) { 
        $vowels = 'aeiou'; 
        $consonants = '0123456789bcdfghjklmnpqrstvwxyz'; 
        $idnumber = ''; 
        $alt = time() % 2; 
        for ($i = 0; $i < $length; $i++) { 
            if ($alt == 1) { 
                $idnumber.= $consonants[(rand() % strlen($consonants)) ]; 
                $alt = 0; 
            } else { 
                $idnumber.= $vowels[(rand() % strlen($vowels)) ]; 
                $alt = 1; 
            } 
        } 
         
        return $idnumber; 
    }
    
    public function search_setting($vals) {
        $usrInfo =  $this->con->prepare("SELECT * FROM `settings` where name='$vals'");
        $usrInfo->execute();
        $redirectInfo = $usrInfo->fetch(PDO::FETCH_ASSOC);
        $value = $redirectInfo["value"];
        return $value;
    }
    

    public function userLogin($username, $password) {
        $password = md5($password);

        if($this->is_email($username)) {
            $runQuery = $this->con->prepare("select * from users where email='$username' and password='$password'");
        } else {
            $runQuery = $this->con->prepare("select * from users where username='$username' and password='$password'");
        }
        $runQuery->execute();
        
        if($runQuery->rowCount() == 0) {
            return $this->error("<b>Username and password do not match</b>");
        } else {

            //Since detail is valid... has client activate his or her account...
            $runQueryInfo = $runQuery->fetch(PDO::FETCH_ASSOC);
            $activation = $runQueryInfo["activation"];
            $clientID = $runQueryInfo["id"];

            if($activation == "NO") {
                return "<div class='alert alert-danger'><b> Your account is pending activation.  <a href='actionHandler?resendActivation&clientID=".$clientID."' target='_blank' style='color: red'>Resend Activation Code</a></b></div>";
            } else {
                
                // Get Current date, time
                $current_time = time();
                $current_date = date("Y-m-d H:i:s", $current_time);

                // Set Cookie expiration for 1 month
                $cookie_expiration_time = $current_time + (30 * 24 * 60 * 60);  // for 1 month
                $expiry_date = date("Y-m-d H:i:s", $cookie_expiration_time);
                setcookie("username", $clientID, $cookie_expiration_time);
                
                $_SESSION["username"] = $clientID;
                return "logged";
            }
        }
        
    }
    
    public function compressImage($source, $destination, $quality) {

      $info = getimagesize($source);

      if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);

      elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source);

      elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);

      imagejpeg($image, $destination, $quality);
        
        return true;
    
    }

    public function clientID($userid) {
        $usrInfo =  $this->con->prepare("SELECT * FROM `users` where id='$userid' or username='$userid'");
        $usrInfo->execute();
        $redirectInfo = $usrInfo->fetch(PDO::FETCH_ASSOC);
        $id = $redirectInfo["id"];
        return $id;
    }

    //All wallet user has, get the coin...
    public function userWallet($userid) {
        $usrInfo =  $this->con->prepare("SELECT * FROM `wallet` where clientID='$userid'");
        $usrInfo->execute();
        return $usrInfo->fetch(PDO::FETCH_BOTH);
    }

    //All wallet user has, get the coin...
    public function totalUser() {
        $usrInfo =  $this->con->prepare("SELECT * FROM `users`");
        $usrInfo->execute();
        return $usrInfo->rowCount();
    }

    //All wallet user has, get the coin...
    public function updateBlc($userid, $amount, $cols) {
        $usrInfo =  $this->con->prepare("update `wallet` set $cols='$amount' where clientID='$userid'");
        $usrInfo->execute();
        return $usrInfo;
    }

    //All wallet user has, get the coin...
    public function updateSettings($defPlan, $refComm, $btcWallet, $paypalAddr, $tronWallet, $ethAddr, $business, $withdrawinfo, $edtMerchant, $dollarNaira) {
        $usrInfo[] =  $this->con->prepare("update `settings` set value='$defPlan' where name='defPlan'");
        $usrInfo[] =  $this->con->prepare("update `settings` set value='$refComm' where name='refComm'");
        $usrInfo[] =  $this->con->prepare("update `settings` set value='$btcWallet' where name='btcWallet'");
        $usrInfo[] =  $this->con->prepare("update `settings` set value='$paypalAddr' where name='paypalAddr'");
        $usrInfo[] =  $this->con->prepare("update `settings` set value='$tronWallet' where name='tronWallet'");
        $usrInfo[] =  $this->con->prepare("update `settings` set value='$ethAddr' where name='ethAddr'");
        $usrInfo[] =  $this->con->prepare("update `settings` set value='".addslashes($business)."' where name='businesspoint'");
        $usrInfo[] =  $this->con->prepare("update `settings` set value='".addslashes($withdrawinfo)."' where name='withdrawSettings'");
        $usrInfo[] =  $this->con->prepare("update `settings` set value='$edtMerchant' where name='edtMerchant'");
        $usrInfo[] =  $this->con->prepare("update `settings` set value='$dollarNaira' where name='dollarNaira'");

        foreach ($usrInfo as $flow) {
            if($flow->execute()) {
                $msg = "success";
            } else {
                $msg = "error";
            }
        }

        return $msg;
    }
    
    public function loggedusername($userid) {
        $usrInfo = $this->con->prepare("SELECT * FROM `users` where id='$userid' or email='$userid'");
        $usrInfo->execute();
        $redirectInfo = $usrInfo->fetch(PDO::FETCH_ASSOC);
        $name = $redirectInfo["username"];
        return $name;
    }

    public function is_email($val) {
        $validate = filter_var(strtolower($val), FILTER_VALIDATE_EMAIL);
        if($validate) {
            return true;
        } else {
            return false;
        }
    }

    public function clientInfo($userid) {
        $usr = $this->con->prepare("SELECT * FROM `users` where id='$userid'");
        $usr->execute();
        $usrInfo = $usr->fetch(PDO::FETCH_ASSOC);
        return $usrInfo;
    }

    public function client_edt_walletAddress($userid) {
        $usr = $this->con->prepare("SELECT * FROM `users` where id='$userid'");
        $usr->execute();
        $usrInfo = $usr->fetch(PDO::FETCH_ASSOC);
        $usertype = $usrInfo["edt_address"];
        return $usertype;
    }
    public function client_btc_walletAddress($userid) {
        $usr = $this->con->prepare("SELECT * FROM `users` where id='$userid'");
        $usr->execute();
        $usrInfo = $usr->fetch(PDO::FETCH_ASSOC);
        $usertype = $usrInfo["btc_address"];
        return $usertype;
    }
    public function client_eth_walletAddress($userid) {
        $usr = $this->con->prepare("SELECT * FROM `users` where id='$userid'");
        $usr->execute();
        $usrInfo = $usr->fetch(PDO::FETCH_ASSOC);
        $usertype = $usrInfo["eth_address"];
        return $usertype;
    }
    public function client_trx_walletAddress($userid) {
        $usr = $this->con->prepare("SELECT * FROM `users` where id='$userid'");
        $usr->execute();
        $usrInfo = $usr->fetch(PDO::FETCH_ASSOC);
        $usertype = $usrInfo["trx_address"];
        return $usertype;
    }
    public function client_paypal_walletAddress($userid) {
        $usr = $this->con->prepare("SELECT * FROM `users` where id='$userid'");
        $usr->execute();
        $usrInfo = $usr->fetch(PDO::FETCH_ASSOC);
        $usertype = $usrInfo["paypal_address"];
        return $usertype;
    }
    public function Client_account_name($userid) {
        $usr = $this->con->prepare("SELECT * FROM `users` where id='$userid'");
        $usr->execute();
        $usrInfo = $usr->fetch(PDO::FETCH_ASSOC);
        $usertype = $usrInfo["account_name"];
        return $usertype;
    }
    public function client_account_no($userid) {
        $usr = $this->con->prepare("SELECT * FROM `users` where id='$userid'");
        $usr->execute();
        $usrInfo = $usr->fetch(PDO::FETCH_ASSOC);
        $usertype = $usrInfo["account_no"];
        return $usertype;
    }
    public function client_bank_name($userid) {
        $usr = $this->con->prepare("SELECT * FROM `users` where id='$userid'");
        $usr->execute();
        $usrInfo = $usr->fetch(PDO::FETCH_ASSOC);
        $usertype = $usrInfo["bank_name"];
        return $usertype;
    }

    public function clientemail($userid) {
        $usr = $this->con->prepare("SELECT * FROM `users` where id='$userid'");
        $usr->execute();
        $usrInfo = $usr->fetch(PDO::FETCH_ASSOC);
        $usertype = $usrInfo["email"];
        return $usertype;
    }


    public function userLevel($userid) {
        $usr = $this->con->prepare("SELECT * FROM `users` where id='$userid'");
        $usr->execute();
        $usrInfo = $usr->fetch(PDO::FETCH_ASSOC);
        $usertype = $usrInfo["usertype"];
        return $usertype;
    }

    public function clientPass($userid) {
        $usr = $this->con->prepare("SELECT * FROM `users` where id='$userid'");
        $usr->execute();
        $usrInfo = $usr->fetch(PDO::FETCH_ASSOC);
        $password = $usrInfo["password"];
        return $password;
    }

    public function clientname($userid) {
        $usr = $this->con->prepare("SELECT * FROM `users` where id='$userid'");
        $usr->execute();
        $usrInfo = $usr->fetch(PDO::FETCH_ASSOC);
        $name = $usrInfo["fullname"];
        return $name;
    }

  public function clientnumber($userid) {
        $usr = $this->con->prepare("SELECT * FROM `users` where id='$userid'");
        $usr->execute();
        $usrInfo = $usr->fetch(PDO::FETCH_ASSOC);
        $number = $usrInfo["phone"];
        return $number;
    }
      public function clientaddress($userid) {
        $usr = $this->con->prepare("SELECT * FROM `users` where id='$userid'");
        $usr->execute();
        $usrInfo = $usr->fetch(PDO::FETCH_ASSOC);
        $address = $usrInfo["address"];
        return $address;
    }
    public function clientcity($userid) {
        $usr = $this->con->prepare("SELECT * FROM `users` where id='$userid'");
        $usr->execute();
        $usrInfo = $usr->fetch(PDO::FETCH_ASSOC);
        $city = $usrInfo["city"];
        return $city;
    }
    public function clientpostalcode($userid) {
        $usr = $this->con->prepare("SELECT * FROM `users` where id='$userid'");
        $usr->execute();
        $usrInfo = $usr->fetch(PDO::FETCH_ASSOC);
        $postal_code = $usrInfo["postal_code"];
        return $postal_code;
    }
      public function clientstate($userid) {
        $usr = $this->con->prepare("SELECT * FROM `users` where id='$userid'");
        $usr->execute();
        $usrInfo = $usr->fetch(PDO::FETCH_ASSOC);
        $state = $usrInfo["state"];
        return $state;
    }
      public function clientcountry($userid) {
        $usr = $this->con->prepare("SELECT * FROM `users` where id='$userid'");
        $usr->execute();
        $usrInfo = $usr->fetch(PDO::FETCH_ASSOC);
        $country = $usrInfo["country"];
        return $country;
    }
     
    public function planInfo($ID) {
        $usr = $this->con->prepare("SELECT * FROM `plans` where id='$ID'");
        $usr->execute();
        $usrInfo = $usr->fetch(PDO::FETCH_ASSOC);
        return $usrInfo;
    }

    
    public function getBank($bankCode) {
        $bankName = array(
            "044" => "Access Bank",
            "323" => "Access Money",
            "401" => "ASO Savings and & Loans",
            "317" => "Cellulant",
            "303" => "ChamsMobile",
            "023" => "CitiBank",
            "551" => "Covenant Microfinance Bank",
            "559" => "Coronation Merchant Bank",
            "063" => "Diamond Bank",
            "302" => "Eartholeum",
            "050" => "Ecobank Plc",
            "307" => "EcoMobile",
            "084" => "Enterprise Bank",
            "306" => "eTranzact",
            "314" => "FET",
            "070" => "Fidelity Bank",
            "318" => "Fidelity Mobile",
            "011" => "First Bank of Nigeria",
            "214" => "First City Monument Bank",
            "501" => "Fortis Microfinance Bank",
            "308" => "FortisMobile",
            "309" => "FBNMobile",
            "601" => "FSDH",
            "058" => "GTBank Plc",
            "315" => "GTMobile",
            "324" => "Hedonmark",
            "030" => "Heritage",
            "415" => "Imperial Homes Mortgage Bank",
            "301" => "JAIZ Bank",
            "402" => "Jubilee Life Mortgage Bank",
            "082" => "Keystone Bank",
            "325" => "MoneyBox",
            "313" => "Mkudi",
            "999" => "NIP Virtual Bank",
            "552" => "NPF MicroFinance Bank",
            "990" => "Omoluabi Mortgage Bank",
            "327" => "Pagatech",
            "560" => "Page MFBank",
            "526" => "Parralex",
            "329" => "PayAttitude Online",
            "305" => "Paycom",
            "311" => "ReadyCash (Parkway)",
            "403" => "SafeTrust Mortgage Bank",
            "076" => "Skye Bank",
            "221" => "Stanbic IBTC Bank",
            "304" => "Stanbic Mobile Money",
            "068" => "Standard Chartered Bank",
            "232" => "Sterling Bank",
            "326" => "Sterling Mobile",
            "100" => "SunTrust Bank",
            "328" => "TagPay",
            "90115" => "TCF MFB",
            "319" => "TeasyMobile",
            "523" => "Trustbond",
            "033" => "United Bank for Africa",
            "032" => "Union Bank",
            "215" => "Unity Bank",
            "320" => "VTNetworks",
            "035" => "Wema Bank",
            "057" => "Zenith Bank",
        );
        return $bankName[$bankCode];
    }
     
    public function businesspoint() {
        $usr = $this->con->prepare("SELECT * FROM `settings` where name='businesspoint'");
        $usr->execute();
        $usrInfo = $usr->fetch(PDO::FETCH_ASSOC);
        $setValue = $usrInfo["value"];
        return json_decode($setValue);
    }
     
    public function business_category($cid) {
        $usr = $this->con->prepare("SELECT * FROM `category` where id='$cid'");
        $usr->execute();
        $usrInfo = $usr->fetch(PDO::FETCH_ASSOC);
        $catName = $usrInfo["category_name"];
        return $catName;
    }
    
    public function withdrawSettings() {
        $usr = $this->con->prepare("SELECT * FROM `settings` where name='withdrawSettings'");
        $usr->execute();
        $usrInfo = $usr->fetch(PDO::FETCH_ASSOC);
        $setValue = $usrInfo["value"];
        return json_decode($setValue);
    }


    //Who referred Me , I need id of who referred you
    public function clientReffered($clientID) {
        try {
            $queryRun = $this->con->prepare("select * from referral where clientReferred='$clientID'");
            $queryRun->execute();
            $queryInfo = $queryRun->fetch(PDO::FETCH_ASSOC);
            $who_InvitedMe = $queryInfo["userID"];
            return $who_InvitedMe;
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
  
   public function sideMenu($userid) {
        ?>
        
           <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
     <div class="brand-logo">
      <a href="index.html">
       <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
       <h5 class="logo-text">Dashtreme Admin</h5>
     </a>
   </div>
   <ul class="sidebar-menu do-nicescrol">
      <li class="sidebar-header">MAIN NAVIGATION</li>
      <li>
        <a href="index">
          <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
        <li>
            <a href="profile">
                <i class="zmdi zmdi-face"></i> <span>Profile</span>
            </a>
        </li>
      
      
        <li>
        <a href="buyplan">
          <i class="zmdi zmdi-money"></i> <span>Buy Level Plans</span>
        </a>
      </li>
      
      <li>
        <a href="uploadbusiness">
          <i class="zmdi zmdi-format-list-bulleted"></i> <span>Upload Business</span>
        </a>
      </li>

      <li>
        <a href="reviewbusiness">
          <i class="zmdi zmdi-grid"></i> <span>Review Business</span>
        </a>
      </li>

      <li>
        <a href="creationSummary">
          <i class="fa fa-list"></i> <span>Business Summary</span>
        </a>
      </li>

      <li>
        <a href="reviewSummary">
          <i class="fa fa-list"></i> <span>Review Summary</span>
        </a>
      </li>

        <li>
            <a href="makeWithdrawal">
                <i class="zmdi zmdi-money"></i> <span>Withdrawal</span>
            </a>
        </li>

      <li>
        <a href="transact">
          <i class="zmdi zmdi-refresh"></i> <span>Transaction History</span>
        </a>
      </li>     

      <li>
        <a href="../contact" target="_blank">
          <i class="icon-envelope mr-2"></i> <span>Contact Us</span>
        </a>
      </li>

                    <?php
                    if($this->userLevel($userid) == 2) { //Super Admin...
                        ?>

      <li class="sidebar-header">ADMIN MENU</li>
      <li><a href="adminMenu"><i class="zmdi zmdi-format-list-bulleted"></i> <span>Main Menu</span></a></li>
      <li><a href="general_settings"><i class="zmdi zmdi-settings text-info"></i> <span>General Settings</span></a></li>
      <li><a href="userList"><i class="zmdi zmdi-accounts text-success"></i> <span>Our Users</span></a></li>
      <li><a href="pendpayments"><i class="zmdi zmdi-format-list-bulleted text-warning"></i> <span>Pending Payments</span></a></li>  
      <li><a href="pendbusupload"><i class="zmdi zmdi-format-list-bulleted text-warning"></i> <span>Pending Uploads</span></a></li>
       <li><a href="pendingreviews"><i class="zmdi zmdi-format-list-bulleted text-warning"></i> <span>Pending Reviews</span></a></li>
      <li><a href="planMgt"><i class="zmdi zmdi-format-list-bulleted text-info"></i> <span> Plans Management</span></a></li>
      <li><a href="withdrawalRequest"><i class="fa fa-money text-warning"></i> <span>Withdrawal Requests</span></a></li>
      <li><a href="addAdmin"><i class="zmdi zmdi-plus text-info"></i> <span>Assign Admin</span></a></li>
             <?php
                    }
                    else if($this->userLevel($userid) == 1) { //Moderator...
                        ?>
                        <li class="sidebar-header">ADMIN MENU</li>
      <li><a href="adminMenu"><i class="zmdi zmdi-format-list-bulleted"></i> <span>Main Menu</span></a></li>
      <li><a href="general_settings"><i class="zmdi zmdi-settings text-info"></i> <span>General Settings</span></a></li>
      <li><a href="userList"><i class="zmdi zmdi-accounts text-success"></i> <span>Our Users</span></a></li>
      <li><a href="pendpayments"><i class="zmdi zmdi-format-list-bulleted text-warning"></i> <span>Pending Payments</span></a></li>  
      <li><a href="pendbusupload"><i class="zmdi zmdi-format-list-bulleted text-warning"></i> <span>Pending Uploads</span></a></li>
       <li><a href="pendingreviews"><i class="zmdi zmdi-format-list-bulleted text-warning"></i> <span>Pending Reviews</span></a></li>
      <li><a href="planMgt"><i class="zmdi zmdi-format-list-bulleted text-info"></i> <span>Plans Management</span></a></li>
      <li><a href="withdrawalRequest"><i class="fa fa-money text-warning"></i> <span>Withdrawal Requests</span></a></li>
       <?php
                    }
                    ?>
         <li>
        <a href="signout">
          <i class="zmdi zmdi-power-off"></i> <span>Log Out</span>
        </a>
      </li>
    </ul>
   
   </div>
        
        
           <?php
    }
    
   public function sendmail($subject, $sender, $receiver, $message) {
        global $mail;
        //Set who the message is to be sent from
        $mail->setFrom($sender, $sender);
        //Set an alternative reply-to address
        $mail->addReplyTo($sender, '');
        //Set who the message is to be sent to
        $mail->addAddress($receiver, '9ja Business');
        //Set the subject line
        $mail->Subject = $subject;
        //convert HTML into a basic plain-text alternative body
        $mail->msgHTML($message);
        //Attach an image file
        // $mail->addAttachment('images/phpmailer_mini.png');
        //send the message, check for errors
        if (!$mail->send()) {
            return false;
            // echo 'Mailer Error: '. $mail->ErrorInfo;
        } else {
            return true;
        }
    }
    
   public function userbusiness($userid) {
        $usr = $this->con->prepare("SELECT * FROM `businesscreation` where userid='$userid' order by id desc limit 10");
        $usr->execute();
        ?>


       
                <div class="col-md-12">
                    <div class="card ">
                     <div class="card-header">Uploaded Businesses
          </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                          <thead>
                           
                            <tr>
                              <th>Business Info</th>
                              <th>Business Address / Earnings</th>
                              <th>Status </th> 
                               <th> </th> 
                            </tr>
                          </thead>
                <tbody class="white">
                <tr>
                    <?php
                    while ($usrInfo = $usr->fetch(PDO::FETCH_ASSOC)) {
                   // $amntearned = $usrInfo["amount"].' '."dollars";
                    $address = $usrInfo["address"];
                    $id= $usrInfo["id"];
                    $businessname = $usrInfo["businessname"];
                    $business_category = $usrInfo["business_category"];
                    $dateCreated = $usrInfo["dateCreated"];
                    $txStatus = $usrInfo["status"];
                     $earnings = $usrInfo["earnings"];
                    $url = $usrInfo["url"];
                    $founder = $usrInfo["founder"];
                    $mobile = $usrInfo["mobile"];
                    $establishment_date = $usrInfo["datefounded"];
                    $workhours = $usrInfo["workhours"];
                    $description = $usrInfo["description"];
                    $attachment = json_decode($loadBuss["attachment"], true);
                    $logo = $attachment["logo"];
                    $office_pic = $attachment["office"];
                 

                    if($txStatus == 0) {
                        $status = "<span class='text-info'><b>Pending</b></span>";
                    } else if($txStatus == 1) {
                        $status = "<span class='text-success'><b>Approved</b></span>";
                    }  else if($txStatus == 2) {
                        $status = "<span class='text-danger'><b>Declined</b></span>";
                    }   else {
                        $status = "";
                    }

                    ?>
                    <td><?php echo $businessname;?> <br/>
                        <?php if(!empty($business_category)) { ?>
                            <b style="color: #f5a21b">Category : </b><?php echo $this->business_category($business_category);?><br/>
                        <?php } ?>
                        <b style="color: gold">Website : </b><?php echo $url;?>
                    </td>
                    <td><?php echo $address;
                        if($txStatus == 1) { ?>
                            <br/>
                            <b style="color: #f5a21b">Earnings : </b> &dollar;<?php echo number_format($usrInfo["earnings"], 2);?>
                        <?php } ?>
                        <br/>
                        <b style="color: #E4CD05">Date Created : </b> <?php echo $dateCreated;?>
                        
                    </td>
                    <td class="font-bold text-muted">
                        <?php echo $status;?>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-info pl-4 pr-4" data-toggle="modal" data-target="#userid<?php echo $id;?>">
                            View <i class="fa fa-th ml-1"></i>
                        </button>
                    </td>


                    <div class="modal fade" id="userid<?php echo $id;?>" style='margin-top: 40px;'>
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title"> Business Information</h4>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div id="modalContent">
                                      <?php
                                        if($txStatus == 0) {
                                            ?>
                            
                                        
                                            <p style="color:black;text-align: center; font-size: 16px;">Business Name: <b><?php echo $businessname;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Address: <b><?php echo $address;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Website: <b><?php echo $url;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Founder: <b><?php echo $founder;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Working Hour: <b><?php echo $workhours;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Establishment Date: <b><?php echo $establishment_date;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Phone Contact: <b><?php echo $mobile;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Other Description: <b><?php echo $description;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Logo: <img src="uploads/<?php echo $logo;?>" style="width: 200px; height: 150px;" class="img img-responsive"/></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Office Building:    <img src="uploads/<?php echo $office_pic;?>" style="width: 280px; height: 200px;" class="img img-responsive"/></p><br>
                                           
                                            <br><br>
                                            <div align="center">
                                               
                                            </div>
                                            <br>

                                            <center>
                                                <a href="index" class="btn btn-default">Close Window</a>
                                            </center>
                                            <?php
                                        } else if($txStatus == 1) {
                                            ?>
                                          
                                            <p style="color:black;text-align: center; font-size: 16px;">Business Name: <b><?php echo $businessname;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Address: <b><?php echo $address;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Website: <b><?php echo $url;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Founder: <b><?php echo $founder;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Working Hour: <b><?php echo $workhours;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Establishment Date: <b><?php echo $establishment_date;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Phone Contact: <b><?php echo $mobile;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Other Description: <b><?php echo $description;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Logo: <img src="uploads/<?php echo $logo;?>" style="width: 200px; height: 150px;" class="img img-responsive"/></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Office Building:    <img src="uploads/<?php echo $office_pic;?>" style="width: 280px; height: 200px;" class="img img-responsive"/></p><br>
                                           
                                         

                                            <center>
                                                <a href="index" class="btn btn-default">Close Window</a>
                                            </center>
                                            <?php
                                        } else if($txStatus == 2) {
                                            ?>

                                            <p style="color:black;text-align: center; font-size: 16px;"> 
												<?php echo nl2br($usrInfo["msg"]);?>
											</p><br>
                                            

                                            <center>
                                                <a href="index" class="btn btn-default">Close Window</a>
                                            </center>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </tr>
                <?php
                }
                ?>

                </tbody>
            </table>
                   
                </div>
                </div>
               
            </div>
        <?php
    }
    
   public function userreview($userid) {
        $usr = $this->con->prepare("SELECT * FROM `businessreview` where userid='$userid' order by id desc limit 10");
        $usr->execute();
        ?>


       
                <div class="col-md-12">
                    <div class="card ">
                     <div class="card-header">Business Reviews
          </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                          <thead>
                           
                            <tr>
                              <th>Business Info</th>
                              <th>Business Address</th>
                              <th>Status </th> 
                               <th> </th> 
                            </tr>
                          </thead>
                <tbody class="white">
                <tr>
                    <?php
                    while ($usrInfo = $usr->fetch(PDO::FETCH_ASSOC)) {
                    $userid= $usrInfo["id"];
                    $bus_id = $usrInfo["bus_id"];
                    $date_Created = $usrInfo["dateCreated"];
                    $rev_Status = $usrInfo["status"];
                     $review_earnings = $usrInfo["earnings"];
                    $message = $usrInfo["message"];

                    if($rev_Status == 0) {
                        $review_status = "<span class='text-info'><b>Pending</b></span>";
                    } else if($rev_Status == 1) {
                        $review_status = "<span class='text-success'><b>Approved</b></span>";
                    }  else if($rev_Status == 2) {
                        $review_status = "<span class='text-danger'><b>Declined</b></span>";
                    }   else {
                        $review_status = "";
                    }
                    
                    //Search business creation...
                    $srchBus2 = $this->con->prepare("select * from businesscreation where id='$bus_id'"); $srchBus2->execute();
                    $srchBus2s = $srchBus2->fetch(PDO::FETCH_ASSOC);
                    $businessname = $srchBus2s["businessname"];
                    $address = $srchBus2s["address"];
                    $dateCreated = $srchBus2s["datefounded"];
                    $url = $srchBus2s["url"];
                    
                    ?>
                    <td><?php echo $businessname;?> <br/>
                        <?php if(!empty($business_category)) { ?>
                            <b style="color: #f5a21b">Category : </b><?php echo $this->business_category($business_category);?><br/>
                        <?php } ?>
                        <b style="color: gold">Website : </b><?php echo $url;?>
                    </td>
                    <td><?php echo $address;
                        if($rev_Status == 1) { ?>
                            <br/>
                            <b style="color: #f5a21b">Earnings : </b> &dollar;<?php echo number_format($usrInfo["earnings"], 2);?>
                        <?php } ?>
                        <br/>
                        <b style="color: #E4CD05">Date Created : </b> <?php echo $dateCreated;?>
                        
                    </td>
                    <td class="font-bold text-muted">
                        <?php echo $review_status;?>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-info pl-4 pr-4" data-toggle="modal" data-target="#userid<?php echo $userid;?>">
                            View <i class="fa fa-th ml-1"></i>
                        </button>
                    </td>


                    <div class="modal fade" id="userid<?php echo $userid;?>" style='margin-top: 40px;'>
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title"> Business Information</h4>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div id="modalContent">
                                      <?php
                                        if($rev_Status == 0) {
                                            ?>
                            
                                        
                                            <p style="color:black;text-align: center; font-size: 16px;">Business Name: <b><?php echo $businessname;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Address: <b><?php echo $address;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Review: <b><?php echo $message;?></b></p><br> 
                                            <br><br>
                                            <div align="center">
                                               
                                            </div>
                                            <br>

                                            <center>
                                                <a href="index" class="btn btn-default">Close Window</a>
                                            </center>
                                            <?php
                                        } else if($rev_Status == 1) {
                                            ?>
                                          
                                             <p style="color:black;text-align: center; font-size: 16px;">Business Name: <b><?php echo $businessname;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Address: <b><?php echo $address;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Review: <b><?php echo $message;?></b></p><br> 

                                            <center>
                                                <a href="index" class="btn btn-default">Close Window</a>
                                            </center>
                                            <?php
                                        } else if($rev_Status == 2) {
                                            ?>

                                            <p style="color:black;text-align: center; font-size: 16px;"> 
												<?php echo nl2br($usrInfo["msg"]);?>
											</p><br>
                                            

                                            <center>
                                                <a href="index" class="btn btn-default">Close Window</a>
                                            </center>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </tr>
                <?php
                }
                ?>

                </tbody>
            </table>
                   
                </div>
                </div>
               
            </div>
        <?php
    }
    
    
    
    public function getDay($day) {
        $days = array("Mon" => "Monday",
                        "Tue" => "Tuesday",
                        "Wed" => "Wednesday",
                        "Thur" => "Thursday",
                        "Fri" => "Friday",
                        "Sat" => "Saturday",
                        "Sun" => "Sunday"
                    );
                    
        if(!is_array($day)) { //Is the value an array or string...
            $rDay = explode(",", $day);
        } else { $rDay = $day; }
        
        foreach($rDay as $Day) {
            $returnDay[] = $days[$Day];
        }
        
        return implode(" / ", $returnDay);
    }
    
    public function userCode($userid) {
        $usr = $this->con->prepare("select * from users where id='$userid'");
        $usr->execute();
        $usrInfo = $usr->fetch(PDO::FETCH_ASSOC);
        $usercode = $usrInfo["usercode"];
        return $usercode;
    }

    //Functions
    public function lastInsertId() {
        $lastInsertId = $this->con->lastInsertId();
        return $lastInsertId;
    }


    public function redirect_to($link) {
        $redirect = header("Location:".$link);
        return $redirect;
    }


    public function is_loggedIN() {

        if(isset($_SESSION["username"])) {
            return true;
        }
        else {
            return false;
        }
    }


    public function query($query) {
        $query = $this->con->prepare($query);
        return $query;
    }


    public function rows($query) {
        $q = $this->con->prepare($query);
        $q->execute();
        $count = $q->rowCount();
        return $count;
    }


    public function success($statement) {
        $success=  '<div class="alert alert-success alert-dismissable" style="color: black; font-size: 16px; text-transform: uppercase;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <b>'. $statement .'</b>
                            </div>';

        return $success;
    }


    public function error($statement) {
        $error=  '<div class="alert alert-danger alert-dismissable" style="margin-right: 15px; color: black; font-size: 16px; text-transform: uppercase;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <b>'. $statement .'</b>
                            </div>';

        return $error;
    }

    public function getURL_path() {
        $pageURL = 'http';
        if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80")
        {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        }
        else
        {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        return substr($pageURL, 0 ,-23);
    }

	
	public function paginate($href, $sql) {
		$PERPAGE_LIMIT = 20;
		$result =  $this->con->prepare($sql); $result->execute();
		$count = $result->rowCount();
		$output = '';
		if(!empty($href)) {
			$href = "?$href";
		} else { $href = "?"; }
		
		if(!isset($_REQUEST["currentpage"])){
			$_REQUEST["currentpage"] = 1;
			$page = $_REQUEST["currentpage"];
		} else {
			$page = $_REQUEST["currentpage"];
		}
    
		if($PERPAGE_LIMIT != 0)
			$pages  = ceil($count/$PERPAGE_LIMIT);
				
		//if pages exists after loop's lower limit
		if($pages>1) {
			
			if(($_REQUEST["currentpage"]-3)>0) {
				$output = $output . '<a href="' . $href . 'currentpage=1" class="btn btn-primary btn-sm">1</a>';
			}
			if(($_REQUEST["currentpage"]-3)>1) {
				$output = $output . ' ... ';
			}
			
			
			// Page: 1 - 20 out of 364
			//Loop for provides links for 2 pages before and after current page
			for($i=($_REQUEST["currentpage"]-2); $i<=($_REQUEST["currentpage"]+2); $i++)	{
				if($i<1) continue;
				if($i>$pages) break;
				if($_REQUEST["currentpage"] == $i)
					$output = $output . '<span id='.$i.' class="btn btn-primary btn-sm">'.$i.'</span>';
				else
					$output = $output . '<a href="' . $href . "currentpage=".$i . '" class="btn btn-primary btn-sm" style="margin-left: 5px; margin-right: 5px">'.$i.'</a>';
			}

			//if pages exists after loop's upper limit
			if(($pages-($_REQUEST["currentpage"]+2))>1) {
				$output = $output . ' ... ';
			}
			if(($pages-($_REQUEST["currentpage"]+2))>0) {
				if($_REQUEST["currentpage"] == $pages)
					$output = $output . '<span id=' . ($pages) .' class="btn btn-primary btn-sm">' . ($pages) .'</span>';
				else
					$output =  $output . '<a href="' . $href .  "currentpage=" .($pages) .'" class="btn btn-primary btn-sm">' . ($pages) .'</a>';
			}
		
		}
    
		echo "Page:   $page  - ";  if($PERPAGE_LIMIT * $page > $count) { echo $count; } else { echo $PERPAGE_LIMIT * $page; } ?> 
		<?php echo ' out of '. $count  . ' ' . $output;
		
	}


}
$obj = new Action();
// }

?>