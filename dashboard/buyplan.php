<?php
require "../action.php"; $action = new Action();
$userid = $_SESSION["username"];

//Is user having a pending payment...
$srchPay = $action->query("select * from payment where userid='$userid' and walletID!='' and attachment is NULL limit 1"); $srchPay->execute();

if(empty($action->clientID($userid)) || !isset($userid)) {
    session_destroy();
    $action->redirect_to("../login");
} else if(empty($action->clientInfo($userid)["edt_address"])) {
	$action->redirect_to("profile");
} else if($srchPay->rowCount() > 0) {
    $action->redirect_to("uploadPOP");
} else {
	$userInfo = $action->clientInfo($userid);	
	$planInfo = $action->planInfo($userInfo["planID"]);	
	$userWallet = $action->userWallet($userid);
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
  <title>9jaBusiness - Buy Plan</title>
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.0/dist/sweetalert2.all.min.js"></script>
  <script src='https://api.edeposite.info/js/v1/popup.js'></script>
  
  <style>
	.list-group {
		display: flex;
		flex-direction: column;
		padding-left: 0;
		margin-bottom: 0;
		border-radius: .25rem;
	}
	.pricing-table .card ul li.list-group-item {
		border-bottom: 1px solid rgb(255 255 255 / 15%);
		color: rgb(255 255 255 / 85%);
		font-size: 16px;
	}
	.list-group-flush > .list-group-item {
    border-width: 0 0 1px;
        border-bottom-width: 1px;
}
  </style>
  
</head>

<body class="bg-theme bg-theme1">

<!-- start loader -->
   <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
   <!-- end loader -->

<!-- Start wrapper-->
 <div id="wrapper">
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
           <div class="card-title" style="font-size: 20px">Buy Level Plan</div>
           <p style="font-size: 18px;">Your wallet balance is <b>&dollar;<?php echo number_format($action->userWallet($userid)["usd"], 2);?></b></p>
         </div>
         </div>
      </div>

    </div><!--End Row-->

	<!--start overlay-->
		  <div class="overlay toggle-menu"></div>
		<!--end overlay-->

    </div>
    <!-- End container-fluid-->
		<div class="col">
		<div class="row row-cols-1 row-cols-lg-3">
		
			<?php 
			
			if($userInfo["status"] == 0) { ?>
				<script>
					swal.fire({
						icon: "error",
						title: "Account Suspended",
						text: "Your account is temporary on suspension, kindly contact admin to unsuspend your account",
						allowOutsideClick: false,
					}).then((isRedirect) => {
						if(isRedirect.isConfirmed) {
							window.location = 'index'
						}
					});
				</script>
			<?php } else {
			
				$srchPlan = $action->query("select * from plans order by price, name asc"); $srchPlan->execute();
				while($srchPlans = $srchPlan->fetch(PDO::FETCH_ASSOC)) { 
					if($srchPlans["price"] == 0) { $upgrd = "Free Upgrade Plan"; } else { $upgrd = "$".number_format($srchPlans["price"], 2). " upgrade fee"; }
				?>
					<div class="col-sm-4">
						<div class="card bg-dark" style="border-radius: 25px">
							<div class="card-body">
								<h5 class="card-title text-white text-uppercase text-center" style="font-size: 1.5rem;"><?php echo $srchPlans["name"];?></h5>
								<hr class="my-4">
								<ul class="list-group list-group-flush">
								    	<li class="list-group-item bg-transparent text-white" style="font-size: 18px"><i class="icon-check"></i> Earn <?php echo number_format($srchPlans["refComm"]);?>% referral commision</li>
									<li class="list-group-item bg-transparent text-white" style="font-size: 18px"><i class="icon-check"></i> <?php echo $upgrd;?></li>
									<li class="list-group-item bg-transparent text-white" style="font-size: 18px"><i class="icon-check"></i> Addition of <?php echo number_format($srchPlans["bus_no"]);?> businesses</li>
									<li class="list-group-item bg-transparent text-white" style="font-size: 18px"><i class="icon-check"></i> <?php echo number_format($srchPlans["bus_review"]);?> business review</li>
								</ul>
								<div class="d-grid text-center">
									<?php if($srchPlans["id"] == $userInfo["planID"] || $srchPlans["price"] == 0 || $planInfo["price"] > $srchPlans["price"]) { ?>
										<button disabled class="btn btn-secondary my-2 radius-30">Activate</button>
									<?php } else { ?>
										<a href="#" data-toggle="modal" data-target="#edtModal<?php echo $srchPlans["id"];?>" class="btn btn-light my-2 radius-30">
											Activate
										</a>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
					
					<div id="edtModal<?php echo $srchPlans["id"];?>" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title" style="color: #000">Buy Plan</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
								<div class="modal-body">
									<form method="post">
										
										<label><b style="color: #000">Plan Name</b></label>
										<input class="form-control input-lg" value="<?php echo $srchPlans["name"];?>" style="background: rgba(21, 14, 14, 0.45)" disabled>
										<br/>
										
										<label><b style="color: #000">Plan Fee</b></label>
										<input class="form-control input-lg" value="<?php echo number_format($srchPlans["price"], 2);?>" style="background: rgba(21, 14, 14, 0.45)" disabled>
										<br/>
										<label style="color: #000"><b>Select Method</b></label>
										<select class="form-control input-lg" name="payType" id="payType<?php echo $srchPlans["id"];?>" style="background: rgba(21, 14, 14, 0.45)" required>
											<option value="">-- Select Method -- </option>
											<?php if($action->userWallet($userid)["usd"] > 0) { ?>
												<option value="earnings">Earnings Wallet - &dollar;<?php echo number_format($action->userWallet($userid)["usd"], 2);?></option>													
											<?php } ?>
											<option value="edt">Edeposite Coin (Activation Duration: Instantly)</option>
											<option value="btc">Bitcoin (Activation Duration: 96hrs)</option>
											<option value="eth">Ethereum (Activation Duration: 72hrs)</option>
											<option value="tron">Tron (Activation Duration: 48hrs)</option>
											<option value="paypal">Paypal (Activation Duration: 24hrs)</option>
											<option value="bank" style="display:none">Bank (Activation Duration: 12hrs)</option>
										</select>
										<br/>
										
										<div class="form-group text-center">
											<button class="btn btn-primary" type="submit" id="buyPlan<?php echo $srchPlans["id"];?>"><b>Activate Plan</b></button>
											<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
										</div>
										
										
									</form>
								</div>										
							</div>
						</div>
					</div>
					
					<script>
						$(document).ready(function() {
							$("#buyPlan<?php echo $srchPlans['id'];?>").click(function(e) {
								e.preventDefault();
								const level_name = "<?php echo $srchPlans['name'];?>";
								const level_id = <?php echo $srchPlans['id'];?>;
								var payType_val;
								
								var formData = {
									buyPlan: "buyPlan",
									id: level_id,
									payType: $("#payType<?php echo $srchPlans['id'];?>").val()
								}
								
								if($.trim($("#payType<?php echo $srchPlans['id'];?>").val()) == "") {
									Swal.fire({
										icon: 'warning',
										title: "Missing field",
										html: "Select Payment method"
									})
								} else {
									
									$("#buyPlan<?php echo $srchPlans['id'];?>").prop("disabled", true);
									
									if($("#payType<?php echo $srchPlans['id'];?>").val() == "edt") {
										payType_val = "Edeposite Coin";
									} else if($("#payType<?php echo $srchPlans['id'];?>").val() == "btc") {
										payType_val = "Bitcoin";
									} else if($("#payType<?php echo $srchPlans['id'];?>").val() == "eth") {
										payType_val = "Ethereum";
									} else if($("#payType<?php echo $srchPlans['id'];?>").val() == "tron") {
										payType_val = "Tron";
									} else if($("#payType<?php echo $srchPlans['id'];?>").val() == "paypal") {
										payType_val = "Paypal";
									} 
									
									Swal.fire({
										title: "Buy Plan",
										html: "You are about to activate <b>" + level_name +" </b> using "+payType_val +" as your payment method<br><br> Are you sure you want to proceed ?",
										allowOutsideClick: false,
										showCancelButton: true,
										showLoaderOnConfirm: true,
										confirmButtonText: 'Make Payment'
									}).then((result) => {
										if (result.isConfirmed) {
											if($("#payType<?php echo $srchPlans['id'];?>").val() == "edt") {
												
												// var eDeposite_public_address = "<?php echo $action->client_edt_walletAddress($userid);?>";
												var eDeposite_public_address = "<?php echo $action->search_setting("edtMerchant");?>";
												var amount = <?php echo $srchPlans["price"];?>;
												// var amount = 0.0003;
												
												//Prepare edt frame...
												let eD = new eDepositePop({
													token: amount,
													merchant_public_address: eDeposite_public_address,
													callback: function(response) {
														console.log(response);
														console.log(response.transaction_id);
														if($.trim(response.transaction_id) !== "") {
															alert("Your payment of "+amount+"edt has been received");
															window.location = "approve_edt?txid="+response.transaction_id+"&pid="+level_id;
														}
													},
													onclose:function(response) {
														$("#buyPlan<?php echo $srchPlans['id'];?>").prop("disabled", false);
														Swal.fire({
															title: "Payment Failed",
															html: "We could not process your request because you closed the payment window",
															icon: "error"
														});
													}
												});
												
												eD.openIframe();
					
											} else {
												$.ajax({
													type: "POST",
													data: formData,
													url: "../process.php",
													success: function (response) {	
														
														$("#buyPlan<?php echo $srchPlans['id'];?>").prop("disabled", false);
														
														if($.trim(response) == "sent" || $.trim(response) == "success") {
														
															swal.fire({
																title: "Success",
																html: "Plan activation was successful",
																icon: "success"
															}).then(function() { 
																window.location = "";
															})
															
														} else if($.trim(response) == "created") {
														
															swal.fire({
																title: "Success",
																html: "Thanks for showing interest in "+level_name+" <br> Kindly proceed to make payment for activation of your plan",
																icon: "success"
															}).then(function() { 
																window.location = "";
															})
															
														} else if($.trim(response) == "login_needed") {
															
															swal.fire({
																title: "Unauthorized Access",
																html: "Your session has expired. Kindly login to continue",
																icon: "error"
															}).then(function() { 
																window.location = "";
															})
															
														} else if($.trim(response) == "price_low") {
															
															swal.fire({
																title: "Activation Error",
																html: "You cannot downgrade to a free plan",
																icon: "error"
															})
															
														} else if($.trim(response) == "greater") {
															
															swal.fire({
																title: "Activation Error",
																html: "Insufficient Edeposite Coin wallet balance",
																icon: "error"
															})
															
														} else if($.trim(response) == "connection_problem") {
															
															swal.fire({
																title: "Activation Error",
																html: "We are unable to process your request at the moment, please try again later",
																icon: "error"
															})
															
														} else if($.trim(response) == "invalid") {
															
															swal.fire({
																title: "Activation Error",
																html: "We couldn't process your transaction due to an invalid merchant address or wallet address provided",
																icon: "error"
															})
															
														} else if($.trim(response) == "curr_plan") {
															
															swal.fire({
																title: "Activation Error",
																html: "Your current plan is the same with selected plan",
																icon: "error"
															})
															
														} else {
														
															swal.fire({
																icon: 'error',
																title: "Activation Error",
																// text: "Oops, We could not process your request, please try again",
																html: response,
																confirmButtonText: 'OK'
															});
														}
													}
												});
											}
										} else {
											$("#buyPlan<?php echo $srchPlans['id'];?>").prop("disabled", false);
										}
									});
								}
							});
						});
					</script>
					
					
				<?php }
			} ?>
			
		</div>
		
		</div>
   </div>
   </div>
   
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	<!--Start footer-->
	<footer class="footer">
      <div class="container">
        <div class="text-center">
          Copyright © 2018 Dashtreme Admin
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
