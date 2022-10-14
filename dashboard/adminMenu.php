<?php
require "../action.php";
$action = new Action();
$userid = $_SESSION["username"];
$userWallet = $action->userWallet($userid);

if(empty($action->clientID($userid)) || !isset($userid)) {
    session_destroy();
    $action->redirect_to("../login");
} else {
	$userInfo = $action->clientInfo($userid);
	if($userInfo["usertype"] == 0) {
		$action->redirect_to("index");
	}
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
  <title>9jaBusiness - Admin Menu</title>
  <!-- loader--
  <link href="assets/css/pace.min.css" rel="stylesheet"/>
  <script src="assets/js/pace.min.js"></script>
  <!--favicon-->
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
  <!-- Vector CSS -->
  <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
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

  <!--Start Dashboard Content-->

	<div class="card mt-3">
    <div class="card-content">
        <div class="row row-group m-0">
            <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                  <h2 class="text-white mb-0">Admin Menu</h2>
                   
                </div>
            </div>

        </div>
    </div>
 </div>  
	  
	<div class="row">
	
	<div class="col-12 col-lg-4 col-xl-4">
	    <div class="card">
		 <div class="card-header">General Settings
		   
		 </div>
	
		<a href="general_settings"> <div class="card-body">
			 <h1 align="center" style="font-size:80px;"> <i class="fa fa-gear"></i> </h1>
		   </div> </a>
		</div>
	</div>

	<div class="col-12 col-lg-4 col-xl-4">
	    <div class="card">
			<div class="card-header">Our Users</div>
	
			<a href="userList"><div class="card-body">
				 <h1 align="center" style="font-size:80px;"> <i class="fa fa-users"></i> </h1>
			   </div>  </a>
		</div>
	</div>
	 
	<div class="col-12 col-lg-4 col-xl-4">
	    <div class="card">
			<div class="card-header">Category Management</div>
	
			<a href="categoryMgt"><div class="card-body">
				<h1 align="center" style="font-size:80px;"> <i class="fa fa-folder-open-o"></i> </h1>
		   </div>  </a>
		</div>
	</div>
	 
	<div class="col-12 col-lg-4 col-xl-4">
	    <div class="card">
			<div class="card-header">Level Plans</div>
	
			<a href="planMgt"><div class="card-body">
				<h1 align="center" style="font-size:80px;"> <i class="fa fa-bars"></i> </h1>
		   </div>  </a>
		</div>
	</div>
	
	<div class="col-12 col-lg-4 col-xl-4">
	    <div class="card">
		 <div class="card-header">Pending Uploads
		   
		 </div>
	
		<a href="pendbusupload"> <div class="card-body">
			 <h1 align="center" style="font-size:80px;"> <i class="zmdi zmdi-format-list-bulleted"></i> </h1>
		   </div> </a>
		</div>
	</div>
	
	<div class="col-12 col-lg-4 col-xl-4">
	    <div class="card">
			<div class="card-header">Pending Reviews</div>
	
			<a href="pendingreviews"> 
				<div class="card-body">
					<h1 align="center" style="font-size:80px;"> <i class="zmdi zmdi-format-list-bulleted"></i> </h1>
				</div>
			</a>
			
		</div>
	</div>
	
	<div class="col-12 col-lg-4 col-xl-4">
	    <div class="card">
		 <div class="card-header">Pending Payments
		   
		 </div>
	
		<a href="pendpayments"> <div class="card-body">
			 <h1 align="center" style="font-size:80px;"> <i class="fa fa-credit-card"></i> </h1>
		   </div> </a>
		</div>
	</div>
	
	<div class="col-12 col-lg-4 col-xl-4">
	    <div class="card">
		 <div class="card-header">Withdrawal Request
		   
		 </div>
	
		<a href="withdrawalRequest"> <div class="card-body">
			 <h1 align="center" style="font-size:80px;"> <i class="fa fa-credit-card"></i> </h1>
		   </div> </a>
		</div>
	</div>
	
	<div class="col-12 col-lg-4 col-xl-4">
	    <div class="card">
		 <div class="card-header">Transaction History
		   
		 </div>
	
		<a href="transacthistory"> <div class="card-body">
			 <h1 align="center" style="font-size:80px;"> <i class="fa fa-history"></i> </h1>
		   </div> </a>
		</div>
	</div>
	
	<div class="col-12 col-lg-4 col-xl-4">
	    <div class="card">
		 <div class="card-header">Payment History
		   
		 </div>
	
		<a href="paymenthistory"> <div class="card-body">
			 <h1 align="center" style="font-size:80px;"> <i class="fa fa-history"></i> </h1>
		   </div> </a>
		</div>
	</div>
	
	<div class="col-12 col-lg-4 col-xl-4">
	    <div class="card">
		 <div class="card-header">Withdrawal History
		   
		 </div>
	
		<a href="withdrawalhistory"> <div class="card-body">
			 <h1 align="center" style="font-size:80px;"> <i class="fa fa-history"></i> </h1>
		   </div> </a>
		</div>
	</div>
	
	<div class="col-12 col-lg-4 col-xl-4">
	    <div class="card">
		 <div class="card-header">Plan Purchase History
		   
		 </div>
	
		<a href="planPurchase"> <div class="card-body">
			 <h1 align="center" style="font-size:80px;"> <i class="fa fa-money"></i> </h1>
		   </div> </a>
		</div>
	</div>
	
	<div class="col-12 col-lg-4 col-xl-4">
	    <div class="card">
		 <div class="card-header">Activity Log
		   
		 </div>
	
		<a href="activitylog"> <div class="card-body">
			 <h1 align="center" style="font-size:80px;"> <i class="fa fa-file-archive-o"></i> </h1>
		   </div> </a>
		</div>
	</div>
	 
	
	</div><!--End Row-->
	
	
      <!--End Dashboard Content-->
	  
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
  <!-- loader scripts -->
  <script src="assets/js/jquery.loading-indicator.js"></script>
  <!-- Custom scripts -->
  <script src="assets/js/app-script.js"></script>
  <!-- Chart js -->
  
  <script src="assets/plugins/Chart.js/Chart.min.js"></script>
 
  <!-- Index js -->
  <script src="assets/js/index.js"></script>

  
</body>
</html>
