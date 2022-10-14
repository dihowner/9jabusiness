<?php
require "../action.php"; $action = new Action();
// require "../class_edeposit.php"; $edeposit = new edeposit();
$userid = $_SESSION["username"];
$userWallet = $action->userWallet($userid);

if(empty($action->clientID($userid)) || !isset($userid)) {
    session_destroy();
    $action->redirect_to("../login");
} else if(empty($action->clientInfo($userid)["edt_address"])) {
	$action->redirect_to("profile");
} else if($srchPay->rowCount() > 0) {
    $action->redirect_to("uploadPOP");
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
  <title>9jaBusiness - Fund Wallet</title>
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
  
</head>

<!-- <body class="bg-theme bg-theme1"> -->
<body>

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
	  
	  
        <div class="col-lg-12" style="font-size: 20px">
						
			<?php
			if(isset($_POST["process"])) {
				$amount = $_POST["amount"];
				$payType = $_POST["payType"];
				$txID = mt_rand(11111, 90909).mt_rand(11111, 90909);
				
				if(strtolower($payType) == "edt") {
				
			?>
				Hey <b><?php echo $action->clientInfo($userid)["fullname"]; ?></b> , Kindly ensure to write down your <b>Transaction ID (<?php echo $txID;?>)</b> for future reference.
				
				<br><br>
				Amount : &dollar;<?php echo number_format($amount , 2);?> <br>
				Transaction ID : <?php echo $txID;?> <br>
				Date of transaction : <?php echo date("D j F, Y; h:i a");?> <br><br>
				
				<div class="col-lg-12">
					<div class="alert-message">
						<div id="response"></div>
					</div>
				</div>
				
				<input type="hidden" name="amount"  id="amount" value="<?php echo $amount;?>">
				<input type="hidden" name="txID" id="txID" value="<?php echo $txID;?>">
				<button type="submit" class="btn btn-primary" id="processBtn"><b><i class="fa fa-credit-card"></i> Process Payment</b></button>
			
			
				
			<?php 
				} else { ?>
					Hey <b><?php echo $action->clientInfo($userid)["fullname"]; ?></b> , Kindly follow the instruction below to get your wallet funded.<br><br>
					Amount : &dollar;<?php echo number_format($amount , 2);?> <br>
					Transaction ID : <?php echo $txID;?> <br>
					Date of transaction : <?php echo date("D j F, Y; h:i a");?> <br><br>
					
					<a href="?uploadProof" class="btn btn-default"><b><i class="fa fa-arrow-left"></i> Cancel Payment</b></a>
					<a href="?uploadProof" class="btn btn-primary"><b><i class="fa fa-upload"></i> Upload Proof</b></a>
					
				<?php }
			} else { ?>
           <p>
				Kindly enter amount you want to credit your wallet </p>
				
			<form method="post">
				<label><b>Enter Amount:</b></label>
				<input type="text" class="form-control input-lg" name="amount" placeholder="Enter amount you want to credit" required>
				<br>
				<label><b>Select Wallet:</b></label>
				<select class="form-control input-lg" name="payType" required>
					<option value="">-- Select Method -- </option>
					<option value="edt">Edeposite Coin </option>
					<option value="btc">Bitcoin</option>
					<option value="btc">Ethereum</option>
					<option value="tron">Tron</option>
					<option value="paypal">Paypal</option>
				</select>
				<br>
				<button type="submit" class="btn btn-primary" name="process"><b>Submit</b></button>
				
			</form>
			<?php } ?>
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
