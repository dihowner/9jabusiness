<?php
require "../action.php";
$action = new Action();
$userid = $_SESSION["username"];
$userWallet = $action->userWallet($userid);

if(empty($action->clientID($userid)) || !isset($userid)) {
    session_destroy();
    $action->redirect_to("../login");
} else if ($action->userLevel($userid) == 0) {
    $action->redirect_to("index");
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
  <title>9jaBusiness - General Settings</title>
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
      <div class="col-lg-12">
         <div class="card">
           <div class="card-body">
				
				<div class="card-header">General Settings</div>
			
				<form method="post" style="margin-top: 2%" id="adminSettingsInfo">
					<div class="form-group row">
						<div class="col-lg-6">
							<label for="refComm">Default Plan Level</label>
							<select class="form-control" id="defPlan" name="defPlan">
								<option value="">-- Select --</option>
								<?php
								$srchPlan = $action->query("select * from plans where price=0"); $srchPlan->execute();
								while($srchPlans = $srchPlan->fetch(PDO::FETCH_ASSOC)) { ?>
									<option value="<?php echo $srchPlans["id"];?>"<?php echo ($action->search_setting("defPlan")==$srchPlans["id"])?"selected='selected'":"";?>>
										<?php echo $srchPlans["name"];?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-lg-6">
							<label for="refComm">Referral Commission</label>
							<input type="text" class="form-control" id="refComm" name="refComm" value="<?php echo $action->search_setting("refComm");?>" placeholder="Enter Referral commission" required>
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-6">
							<label for="btcWallet">Bitcoin Wallet Address</label>
							<input type="text" class="form-control" id="btcWallet" name="btcWallet" value="<?php echo $action->search_setting("btcWallet");?>" placeholder="Provide Bitcoin address" required>
						</div>
						<div class="col-lg-6">
							<label for="paypalAddr">Paypal Wallet Address</label>
							<input type="text" class="form-control" id="paypalAddr" name="paypalAddr" value="<?php echo $action->search_setting("paypalAddr");?>" placeholder="Provide paypal address" required>
						</div>
					</div>
					
					<div class="form-group row">
						<div class="col-lg-6">
							<label for="tronWallet">Tron Wallet Address</label>
							<input type="text" class="form-control" id="tronWallet" name="tronWallet" value="<?php echo $action->search_setting("tronWallet");?>" placeholder="Provide tron address" required>
						</div>
						<div class="col-lg-6">
							<label for="ethAddr">Ethereum Wallet Address</label>
							<input type="text" class="form-control" id="ethAddr" name="ethAddr" value="<?php echo $action->search_setting("ethAddr");?>" placeholder="Provide Ethereum address" required>
						</div>
					</div>
					
					<div class="form-group row">
					
						<div class="col-lg-6">
							<label for="tronWallet">Minimum Withdrawal </label>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1"><b>&dollar;</b></span>
								</div>
								<input type="text" class="form-control" id="min_withdraw" name="min_withdraw" value="<?php echo $action->withdrawSettings()->min_withdrawal;?>" placeholder="Enter minimum withdrawal" required>
							</div>
						</div>
						
						<div class="col-lg-6">
							<label for="tronWallet">Maximum Withdrawal </label>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1"><b>&dollar;</b></span>
								</div>
								<input type="text" class="form-control" id="max_withdraw" name="max_withdraw" value="<?php echo $action->withdrawSettings()->max_withdrawal;?>" placeholder="Enter maximum withdrawal" required>
							</div>
						</div>
						
					</div>
					
					<div class="form-group row">
					
						<div class="col-lg-6">
							<label for="ethAddr">EDT Merchant Address</label>
							<input type="text" class="form-control" id="edtMerchant" name="edtMerchant" value="<?php echo $action->search_setting("edtMerchant");?>" placeholder="Provide EDT Merchant address" required>
						</div>
					
						<div class="col-lg-6">
							<label for="ethAddr">Dollar to Naira</label>
							<input type="text" class="form-control" id="dollarNaira" name="dollarNaira" value="<?php echo $action->search_setting("dollarNaira");?>" placeholder="Provide dollar equivalent to Naira" required>
						</div>
						
					</div>
			   
					<hr> <b>Business Settings</b><br/><br/>
					
					<div class="form-group row">
						<div class="col-lg-6">
							<label for="input-1">Business creation value (<b>&dollar;</b>)</label>
							<input type="text" class="form-control" id="creation_point" name="creation_point" value="<?php echo $action->businesspoint()->creation;?>" placeholder="Amount to credit user for business creation" required>
						</div>
						<div class="col-lg-6">
							<label for="business_no">Business review value (<b>&dollar;</b>)</label>
							<input type="text"class="form-control" id="review_point" name="review_point" value="<?php echo $action->businesspoint()->review;?>" placeholder="Amount to credit user for business review" required>
						</div>
					</div>
			   
					<hr> <b>Withdrawal Settings</b><br/><br/>
					
					<div class="form-group row">
						<div class="col-lg-6">
							
							<label for="ltcWallet">Set Days of the week for Withdrawal</label><br/>
							<label><input type="checkbox" name="wdrDays[]" id="wdrDays" value="Mon" <?php if(in_array("Mon" , explode(",", $action->withdrawSettings()->wdrDay))) { echo 'checked'; } ?> /> Monday</label>
							<label><input type="checkbox" name="wdrDays[]" id="wdrDays" value="Tue" <?php if(in_array("Tue" , explode(",", $action->withdrawSettings()->wdrDay))) { echo 'checked'; } ?> /> Tuesday</label>
							<label><input type="checkbox" name="wdrDays[]" id="wdrDays" value="Wed" <?php if(in_array("Wed" , explode(",", $action->withdrawSettings()->wdrDay))) { echo 'checked'; } ?> /> Wednesday</label>
							<label><input type="checkbox" name="wdrDays[]" id="wdrDays" value="Thur" <?php if(in_array("Thur" , explode(",", $action->withdrawSettings()->wdrDay))) { echo 'checked'; } ?> /> Thursday</label>
							<label><input type="checkbox" name="wdrDays[]" id="wdrDays" value="Fri" <?php if(in_array("Fri" , explode(",", $action->withdrawSettings()->wdrDay))) { echo 'checked'; } ?> /> Friday</label>
							<label><input type="checkbox" name="wdrDays[]" id="wdrDays" value="Sat" <?php if(in_array("Sat" , explode(",", $action->withdrawSettings()->wdrDay))) { echo 'checked'; } ?> /> Saturday</label>
							<label><input type="checkbox" name="wdrDays[]" id="wdrDays" value="Sun" <?php if(in_array("Sun" , explode(",", $action->withdrawSettings()->wdrDay))) { echo 'checked'; } ?> /> Sunday</label>
						
						</div>
						
					</div>
					
					<input type="hidden" id="adminupdtsettingBtn" name="adminupdtsettingBtn" value="adminupdtsettingBtn">
									
					<div class="form-group">
						<button type="submit" class="btn btn-light px-5" name="updtSettings" id="updtSettings"><b><i class="icon-pencil"></i> Modify Settings</b></button>
					</div>
				</form>
					
			</div>
			
         </div>
         </div>
      </div>

    </div><!--End Row-->

	<!--start overlay-->
		  <div class="overlay toggle-menu"></div>
		<!--end overlay-->

    </div>
    <!-- End container-fluid-->
    
   </div>
  
  <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
	
  </div>
	<!--Start footer-->
		<footer class="footer">
      <div class="container">
        <div class="text-center">
          Copyright © 2021 Cizar Consult.
        </div>
      </div>
    </footer>
	
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
  <!-- Chart js -->
  
  <script src="assets/plugins/Chart.js/Chart.min.js"></script>
 
  <!-- Index js -->
  <script src="assets/js/index.js"></script>

  
</body>
</html>