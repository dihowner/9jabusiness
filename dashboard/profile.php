<?php
require "../action.php"; $action = new Action();
$userid = $_SESSION["username"];
$userWallet = $action->userWallet($userid);

if(empty($action->clientID($userid)) || !isset($userid)) {
    session_destroy();
    $action->redirect_to("../login");
} else {
	$userInfo = $action->clientInfo($userid);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>9jaBusiness - My Account</title>
  <!-- loader--
  <link href="assets/css/pace.min.css" rel="stylesheet"/>
  <script src="assets/js/pace.min.js"></script>
  <!--favicon-->
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
  <!-- simplebar CSS-->
  <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="assets/css/sidebar-menu.css" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="assets/css/app-style.css" rel="stylesheet"/>
  <script src="assets/js/jquery-2.1.4.min.js"></script>
  <script src="survey.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.0/dist/sweetalert2.all.min.js"></script>
  
</head>

<body class="bg-theme bg-theme1">

<!-- start loader -->
   <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
   <!-- end loader -->

<!-- Start wrapper-->
 <div id="wrapper">

  <!--Start sidebar-wrapper-->
   <?php echo $action->sideMenu($userid); ?>
   <!--End sidebar-wrapper-->

<!--Start topbar header-->
<header class="topbar-nav">
 <nav class="navbar navbar-expand fixed-top">
  <ul class="navbar-nav mr-auto align-items-center">
    <li class="nav-item">
      <a class="nav-link toggle-menu" href="javascript:void();">
       <i class="icon-menu menu-icon"></i>
     </a>
    </li>
    <li class="nav-item">
      <form class="search-bar">
        <input type="text" class="form-control" placeholder="Enter keywords">
         <a href="javascript:void();"><i class="icon-magnifier"></i></a>
      </form>
    </li>
  </ul>
     
  <ul class="navbar-nav align-items-center right-nav-link">
   
    <li class="nav-item language">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();"><i class="fa fa-money"></i></a>
      <ul class="dropdown-menu dropdown-menu-right">
          <li class="dropdown-item"> <?php echo $userWallet["eDT"];?>  eDT</li>
          <li class="dropdown-item"> <?php echo $userWallet["usd"];?>  Dollars</li>
        </ul>
    </li>
    <li class="nav-item">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
        <span class="user-profile"><img src="../img/avatar/<?php echo $action->clientInfo($userid)['avatar'];?>" class="img-circle" alt="user avatar"></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-right">
       <li class="dropdown-item user-details">
        <a href="javaScript:void();">
           <div class="media">
             <div class="avatar"><img class="align-self-start mr-3" src="../img/avatar/<?php echo $action->clientInfo($userid)['avatar'];?>" alt="user avatar"></div>
            <div class="media-body">
            <h6 class="mt-2 user-title"><?php echo ucfirst($action->loggedusername($userid));?></h6>
            <p class="user-subtitle"><?php echo ucwords($action->clientemail($userid));?></p>
            </div>
           </div>
          </a>
        </li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><a href="profile"><i class="icon-user mr-2"></i> Account</a></li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><a href="buyplan"><i class="fa fa-money mr-2"></i> Buy Level Plan</a></li>
        <li class="dropdown-divider"></li>
		<li class="dropdown-item"><a href="makeWithdrawal"><i class="icon-wallet mr-2"></i> Withdraw</a></li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><a href="signout"><i class="icon-power mr-2"></i> Logout</a></li>
      </ul>
    </li>
  </ul>
</nav>
</header>
<!--End topbar header-->

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">

      <div class="row mt-3">
        <div class="col-lg-3">
           <div class="card profile-card-2">
            <div class="card-img-block">
                <img class="img-fluid" width="340" src="../img/avatar/<?php echo $action->clientInfo($userid)['avatar'];?>" alt="Profile Picture">
            </div>
            <div class="card-body pt-5">
                <img src="../img/avatar/<?php echo $action->clientInfo($userid)['avatar'];?>" alt="Profile Picture" class="profile img-circle" style="height:70px;max-height:100%;">
                <h5 class="card-title"><?php echo ucfirst($action->clientname($userid));?></h5>
                <p class="card-text">Kindly update your wallet address and contact details.</p>
               
            </div>

            <div class="card-body border-top border-light">
                 <div class="media align-items-center">
                   <a data-target="#profile" data-toggle="pill">
                       Edit Profile
                   </a>
                    
                  </div>
                  <hr>
                  <div class="media align-items-center">
 <a data-target="#messages" data-toggle="pill">
                     Edit Account Details
                   </a>
                  </div>
                   <hr>
                  <div class="media align-items-center">
                    <a data-target="#edit" data-toggle="pill">
                       Change Password
                   </a>
                  </div>
                  
                  
              </div>
        </div>

        </div>

        <div class="col-lg-9">
           <div class="card">
            <div class="card-body">
				
				<?php if(empty($action->clientInfo($userid)["edt_address"])) { ?>
					<div class='alert alert-danger' style="padding: 15px"><b>Kindly update your wallet address!</b></div>
				<?php } ?>
				
            <ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
                <li class="nav-item">
                    <a href="javascript:void();" data-target="#profile" data-toggle="pill" class="nav-link active"><i class="icon-user"></i> <span class="hidden-xs">Profile</span></a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void();" data-target="#messages" data-toggle="pill" class="nav-link"><i class="icon-wallet"></i> <span class="hidden-xs">Account Details</span></a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void();" data-target="#edit" data-toggle="pill" class="nav-link"><i class="icon-note"></i> <span class="hidden-xs">Password Settings</span></a>
                </li>
            </ul>
            <div class="tab-content p-3">
                <div class="tab-pane active" id="profile">
					   <form method="post" enctype="multipart/form-data">
					   <?php
				if(isset($_REQUEST["updateprofile"])) {
					$phone = addslashes($_POST["phone"]);
					$address = addslashes($_POST["street_address"]);
					$city = addslashes($_POST["city"]);
					$state = addslashes($_POST["state"]);
					
					if(!empty($_FILES["avatar"]["name"])) {
						$avatar = $_FILES["avatar"]["name"];
						$avatartmp = $_FILES["avatar"]["tmp_name"];
						$avatarsize = $_FILES["avatar"]["size"];
						$extension = strtolower(pathinfo($avatar)["extension"]);
						
						if(empty($avatartmp)) {
							echo "<div class='alert alert-danger'><b>Invalid file selected as profile picture!</b></div>";
						} else if(!in_array($extension, array("jpg", "bmp", "png", "jpeg"))) {
							echo "<div class='alert alert-danger'><b>File extension is not allowed. Only <b>png, jpeg, jpg and bmp</b> are allowed</b></div>";
						} else if($avatarsize > 204800) {
							echo "<div class='alert alert-danger'><b>Profile picture is too big. Maximum of 200KB per upload</b></div>";
						} else {
							$newFile = date("Ymd").mt_rand(1111, 9039).".jpg";
							$path = "../img/avatar/".$newFile;
							$movefile = move_uploaded_file($avatartmp, $path);
							
							if(!$movefile) {
								echo "<div class='alert alert-danger'><b>Error: Unable to upload file</b></div>";
							} else {
								$updateprofile = $action->query("update users set avatar='$newFile', phone='$phone', address='$address', city='$city', state='$state' where id='$userid'");
							}
						}
					
					} else {
						$updateprofile = $action->query("update users set phone='$phone', address='$address', city='$city', state='$state' where id='$userid'");
					}
					
					if($updateprofile->execute()) { ?>
						<script>
							swal.fire({
								icon: "success",
								title: "Profile Updated",
								text: "Your profile has been updated successfully"
							}).then((isRedirect) => {
								if(isRedirect.isConfirmed) {
									window.location = "profile"
								}
							});
						</script>
					<?php } else {
						echo "<div class='alert alert-danger' style='padding:15px;'>Error in Updating Profile</div>";
					}
				}
							
				//Update Account...
				if(isset($_REQUEST["update_account"])) {
					
					if(!empty($action->client_edt_walletAddress($userid))) { 
						$edt_wallet_addr = addslashes($action->client_edt_walletAddress($userid));
					} else {
						$edt_wallet_addr = addslashes($_POST["edt_wallet_addr"]);
					}
					
					if(!empty($action->client_btc_walletAddress($userid))) { 
						$btc_wallet_addr = addslashes($action->client_btc_walletAddress($userid));
					} else {
						$btc_wallet_addr = addslashes($_POST["btc_wallet_addr"]);
					}
					
					if(!empty($action->client_eth_walletAddress($userid))) { 
						$eth_wallet_addr = addslashes($action->client_eth_walletAddress($userid));
					} else {
						$eth_wallet_addr = addslashes($_POST["eth_wallet_addr"]);
					}
					
					if(!empty($action->client_trx_walletAddress($userid))) { 
						$trx_wallet_addr = addslashes($action->client_trx_walletAddress($userid));
					} else {
						$trx_wallet_addr = addslashes($_POST["trx_wallet_addr"]);
					}
					
					if(!empty($action->client_paypal_walletAddress($userid))) { 
						$paypal_wallet_addr = addslashes($action->client_paypal_walletAddress($userid));
					} else {
						$paypal_wallet_addr = addslashes($_POST["paypal_wallet_addr"]);
					}
					
					if(!empty($action->client_account_no($userid))) { 
						$account_no = addslashes($action->client_edt_walletAddress($userid));
					} else {
						$account_no = addslashes($_POST["account_no"]);
					}
					
					if(!empty($action->client_account_name($userid))) { 
						$account_name = addslashes($action->client_account_name($userid));
					} else {
						$account_name = addslashes($_POST["account_name"]);
					}
					
					if(!empty($action->client_bank_name($userid))) { 
						$edt_wallet_addr = addslashes($action->client_bank_name($userid));
					} else {
						$bank_name = addslashes($_POST["bank_name"]);
					}
					
					$update_account = $action->query("update users set edt_address='$edt_wallet_addr', btc_address='$btc_wallet_addr', eth_address='$eth_wallet_addr', trx_address='$trx_wallet_addr', paypal_address='$paypal_wallet_addr', account_name='$account_name', account_no='$account_no', bank_name='$bank_name' where id='$userid'");
					if($update_account->execute()) { ?>
						<script>
							swal.fire({
								icon: "success",
								title: "Profile Updated",
								text: "Your wallet address has been updated successfully"
							}).then((isRedirect) => {
								if(isRedirect.isConfirmed) {
									window.location = "profile"
								}
							});
						</script>
					<?php } else {
						echo "<div style='padding:15px;' class='alert alert-danger'>Error in Updating Wallet Address</div>";
					}
				}
				
				if(isset($_REQUEST["changepassbtn"])) {
					$old_pass = $_POST["old_pass"];
					$new_pass = $_POST["new_pass"];
					$con_pass = $_POST["con_pass"];
					$otpcode = $_POST["otpcode"];

					if(empty($old_pass) || empty($new_pass) || empty($con_pass) || empty($otpcode)) {
						echo "<div style='padding:15px;' class='alert alert-danger'>Please fill all field</div>";
					} else if($otpcode != $_SESSION["user_otp"]) {
						echo "<div style='padding:15px;' class='alert alert-danger'>Invalid OTP Code supplied</div>";
					} else {

						$old_pass = md5(strtolower($old_pass));
						$new_pass = md5(strtolower($new_pass));
						$con_pass = md5(strtolower($con_pass));
						$clientPass = $action->clientPass($userid);

						if($old_pass != $clientPass) {
							echo "<div class='alert alert-danger'>Incorrect Current Password</div>";
						} else if($new_pass != $con_pass) {
							echo "<div class='alert alert-danger'>Passwords do not match</div>";
						} else {

							$updtAccnt = $action->query("update users set password='$new_pass' where id='$userid'");
							if ($updtAccnt->execute()) {
								session_destroy(); 
								setcookie("username", "", time() - 3600); //Destroy the cookies
							?>
								<script>
									swal.fire({
										icon: "success",
										title: "Password Modified",
										text: "Your password has been changed successfully, Kindly login to proceed"
									}).then((isRedirect) => {
										if(isRedirect.isConfirmed) {
											window.location = "profile"
										}
									});
								</script>
							<?php } else {
								echo "Update Error";
							}
						}
					}
				}
				
							?>
							
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Full name</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="fname" id="fname" disabled value="<?php echo $action->clientname($userid);?>">
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Email</label>
                            <div class="col-lg-9">
                                <input class="form-control" name="email" id="email" type="email" disabled value="<?php echo $action->clientemail($userid);?>">
                            </div>
                        </div>
						 <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Username</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="username" id="username" disabled value="<?php echo $action->loggedusername($userid);?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Change profile picture(Maximum of 200KB)</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="file" name="avatar" id="avatar">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Contact Number</label>
                            <div class="col-lg-9">
                                <input class="form-control" placeholder="Enter Phone Number" name="phone" id="phone" type="text" value="<?php echo $action->clientnumber($userid);?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Address</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="street_address" id="street_address" value="<?php echo $action->clientaddress($userid);?>" placeholder="Street">
                            </div>
                        </div>
						<div class="form-group row">
								<div class="col-lg-3"></div>
								<div class="col-lg-4">
									<input class="form-control" type="text" name="city" id="city" value="<?php echo $action->clientcity($userid);?>" placeholder="City">
								</div>
								<div class="col-lg-1"></div>
								<div class="col-lg-4">
									<select name="state" id="state" class="form-control">
										<option><?php echo $action->clientstate($userid);?></option>
										<option value="Abia">Abia</option>
										<option value="Adamawa">Adamawa</option>
										<option value="Akwa Ibom">Akwa Ibom</option>
										<option value="Anambra">Anambra</option>
										<option value="Bauchi">Bauchi</option>
										<option value="Bayelsa">Bayelsa</option>
										<option value="Benue">Benue</option>
										<option value="Borno">Borno</option>
										<option value="Cross River">Cross River</option>
										<option value="Delta">Delta</option>
										<option value="Ebonyi">Ebonyi</option>
										<option value="Edo">Edo</option>
										<option value="Ekiti">Ekiti</option>
										<option value="Enugu">Enugu</option>
										<option value="Gombe">Gombe</option>
										<option value="Imo">Imo</option>
										<option value="Jigawa">Jigawa</option>
										<option value="Kaduna">Kaduna</option>
										<option value="Kano">Kano</option>
										<option value="Katsina">Katsina</option>
										<option value="Kebbi">Kebbi</option>
										<option value="Kogi">Kogi</option>
										<option value="Kwara">Kwara</option>
										<option value="Lagos">Lagos</option>
										<option value="Nassarawa">Nassarawa</option>
										<option value="Niger">Niger</option>
										<option value="Ogun">Ogun</option>
										<option value="Ondo">Ondo</option>
										<option value="Osun">Osun</option>
										<option value="Oyo">Oyo</option>
										<option value="Plateau">Plateau</option>
										<option value="Rivers">Rivers</option>
										<option value="Sokoto">Sokoto</option>
										<option value="Taraba">Taraba</option>
										<option value="Yobe">Yobe</option>
										<option value="Zamfara">Zamfara</option>
										<option value="FCT">FCT</option>
									</select>
								</div> <br><br>
						</div>
                       
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"></label>
                            <div class="col-lg-9">
                                <input type="reset" class="btn btn-secondary" value="Cancel">
                                <input type="submit" name="updateprofile" id="updateprofile" class="btn btn-primary" value="Save Changes">
                            </div>
                        </div>
                    </form>
                 
                    <!--/row-->
                </div>
                <div class="tab-pane" id="messages">
				<form method="post">
				
           <div class="form-group">
            <label for="input-6">EDT Wallet Address</label>
            <input type="text" class="form-control form-control-rounded" maxlength="34 " value="<?php echo $action->client_edt_walletAddress($userid);?>" <?php if(!empty($action->client_edt_walletAddress($userid))) { echo "disabled"; } ?> id="edt_wallet_addr" name="edt_wallet_addr" placeholder="Enter Edt Wallet Address">
           </div>
		    <div class="form-group">
            <label for="input-6">Bitcoin Wallet Address</label>
            <input type="text" class="form-control form-control-rounded" maxlength="34 " value="<?php echo $action->client_btc_walletAddress($userid);?>" <?php if(!empty($action->client_btc_walletAddress($userid))) { echo "disabled"; } ?> id="btc_wallet_addr" name="btc_wallet_addr" placeholder="Enter Btc Wallet Address">
           </div>
		    <div class="form-group">
            <label for="input-6">Ethereum Wallet Address</label>
            <input type="text" class="form-control form-control-rounded" maxlength="34 " value="<?php echo $action->client_eth_walletAddress($userid);?>" <?php if(!empty($action->client_eth_walletAddress($userid))) { echo "disabled"; } ?> id="eth_wallet_addr" name="eth_wallet_addr" placeholder="Enter Eth Wallet Address">
           </div>
		    <div class="form-group">
            <label for="input-6">Tron Wallet Address</label>
            <input type="text" class="form-control form-control-rounded" maxlength="34 " value="<?php echo $action->client_trx_walletAddress($userid);?>" <?php if(!empty($action->client_trx_walletAddress($userid))) { echo "disabled"; } ?> id="trx_wallet_addr" name="trx_wallet_addr" placeholder="Enter Trx Wallet Address">
           </div>
		    <div class="form-group">
            <label for="input-6">Paypal Wallet Email</label>
            <input type="text" class="form-control form-control-rounded" maxlength="34 " value="<?php echo $action->client_paypal_walletAddress($userid);?>" <?php if(!empty($action->client_paypal_walletAddress($userid))) { echo "disabled"; } ?> id="paypal_wallet_addr" name="paypal_wallet_addr" placeholder="Enter Paypal Wallet Email">
           </div>
		   <h4>Bank Details</h4>
		    <div class="form-group">
            <label for="input-6">Account Number</label>
            <input type="text" class="form-control form-control-rounded" value="<?php echo $action->client_account_no($userid);?>" <?php if(!empty($action->client_account_no($userid))) { echo "disabled"; } ?> id="account_no" name="account_no" placeholder="Enter Account No.">
           </div>
		    <div class="form-group">
            <label for="input-6">Account Name</label>
            <input type="text" class="form-control form-control-rounded" value="<?php echo $action->client_account_name($userid);?>" <?php if(!empty($action->client_account_name($userid))) { echo "disabled"; } ?> id="account_name" name="account_name" placeholder="Enter Account Name">
           </div>
		    <div class="form-group">
            <label for="input-6">Bank Name</label>
            <input type="text" class="form-control form-control-rounded" value="<?php echo $action->client_bank_name($userid);?>" <?php if(!empty($action->client_bank_name($userid))) { echo "disabled"; } ?> id="bank_name" name="bank_name" placeholder="Enter Bank Name">
           </div>
         
           <div class="form-group">
            <button type="submit" name="update_account" class="btn btn-light btn-round px-5"><i class="icon-lock"></i> Update Account Details</button>
          </div>
          </form>
               
                </div>
                <div class="tab-pane" id="edit">
                    <form method="post">
					
                         <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Current Password</label>
                            <div class="col-lg-9">
                                <input class="form-control" required name="old_pass" id="old_pass" type="password" placeholder="Enter current password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">New Password</label>
                            <div class="col-lg-9">
                                <input class="form-control" required type="password" name="new_pass" id="new_pass" placeholder="Enter New Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Confirm password</label>
                            <div class="col-lg-9">
                                <input class="form-control" required type="password" name="con_pass" id="con_pass" placeholder="Confirm Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">OTP Code</label>
                            <div class="col-lg-9">
                                <input class="form-control" required type="text" name="otpcode" id="otpcode" placeholder="Enter OTP Code">
                            </div>
							
							<div class="col-lg-12" style="margin-top: 2%">
								<b style="color: gold">NOTE : </b> Request for OTP Code 
								<button type="button" class="btn btn-light" id="sendOtp"><b>Request OTP Code</b></button>
								
							</div>
                        </div>
			 <div class="alert alert-warning alert-dismissible" role="alert">
				   <button type="button" class="close" data-dismiss="alert">&times;</button>
				    <div class="alert-icon">
					 <i class="icon-info"></i>
				    </div>
				    <div class="alert-message">
				      <span><strong>Info!</strong> Combination of lowercase, uppercase, special character (%,*, !, #) are adivsable to form a strong password string.</span>
				    </div>
                  </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"></label>
                            <div class="col-lg-9">
                                <input type="reset" class="btn btn-secondary" value="Cancel">
                                <input type="submit" name="changepassbtn" id="changepassbtn" class="btn btn-primary" value="Save Changes">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
      </div>
        
    </div>

	<!--start overlay-->
		  <div class="overlay toggle-menu"></div>
		<!--end overlay-->
	
    </div>
    <!-- End container-fluid-->
   </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	<!--Start footer-->
	<footer class="footer">
      <div class="container">
        <div class="text-center">
          Copyright © 2021 Cizar Consult.
        </div>
      </div>
    </footer>
	<!--End footer-->
   
  </div><!--End wrapper-->


  <!-- Bootstrap core JavaScript-->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
	
  <!-- simplebar js -->
  <script src="assets/plugins/simplebar/js/simplebar.js"></script>
  <!-- sidebar-menu js -->
  <script src="assets/js/sidebar-menu.js"></script>
  
  <!-- Custom scripts -->
  <script src="assets/js/app-script.js"></script>
	
</body>
</html>
