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

$per_page = 20;
if(isset($_GET["currentpage"])) {
	$page = $_GET["currentpage"];
} else  {
	$page = 1;
}
$start_page = ($page-1) * $per_page;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>9jaBusiness - Payment History</title>
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
           <div class="card-title" style="font-size: 20px">Payment History</div>
           <p style="font-size: 18px;">Your wallet balance is <b>&dollar;<?php echo number_format($action->userWallet($userid)["usd"], 2);?></b></p>
           <hr>
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<tr>
						<th>S/No</th>
						<th>User Info</th>
						<th>Description</th>
						<th>Amount</th>
						<th>Transaction Date</th>
						<th></th>
					</tr>
					<tr>
					 <?php $i = 1;
					   $loadTran = $action->query("select * from withdrawal where status!=0 order by id desc limit $start_page, $per_page"); $loadTran->execute();
					   // $loadTran = $action->query("select * from withdrawal order by id desc limit 50"); $loadTran->execute();
					   while($loadTrans = $loadTran->fetch(PDO::FETCH_ASSOC)) {					
							
							$address = json_decode($loadTrans["address"]);
							
							if($loadTrans["type"] == "edt") {
								$currency = "Edeposite Coin";
							} else if($loadTrans["type"] == "btc") {
								$currency = "Bitcoin";
							} else if($loadTrans["type"] == "eth") {
								$currency = "Ethereum";
							} else if($loadTrans["type"] == "tron") {
								$currency = "Tron";
							} else { $currency = ''; }
							
					   ?>
						   <td><?php echo $i++;?></td>
						   <td>
							<?php echo $action->clientInfo($loadTrans["userid"])["fullname"];?> <br>
								<b style="color: gold"><?php echo $action->clientInfo($loadTrans["userid"])["email"];?></b> <br>
						   </td>
						   <td>
								<?php if($loadTrans["type"] == "bank") { ?>
									<b style="color: #f5a21b">Bank Name : </b> <?php echo $address->bankName;?> <br>
									<b style="color: gold">Account Name : </b> <?php echo $address->accName;?> <br>
									<b style="color: #E4CD05">Account Name : </b> <?php echo $address->accNo;?> <br>
								<?php } else { ?>
									
									<b style="color: #f5a21b">Currency : </b> <?php echo $currency;?></b> <br>
									<b style="color: gold">Wallet Address : </b><?php echo $address->wallet;?></b> <br>
								<?php } ?>
						   </td>
						   <td>&dollar;<?php echo number_format($loadTrans["amount"], 2);?></td>
						
						   <td>
							<b style="color: #f5a21b">Date Created : </b> <?php echo $loadTrans["dateCreated"];?> <br/>
							<b style="color: gold">Date Approved : </b> <?php echo $loadTrans["dateApproved"];?></td>
							
						   <td>
							<?php if($loadTrans["status"] == 1) { ?>
								<span class="badge badge-success" style="padding: 15px">Approved</span>
							<?php } else if($loadTrans["status"] == 2) { ?>
								<span class="badge badge-danger" style="padding: 15px">Cancelled</span>
							<?php } else { ?>
								<span class="badge badge-info">Unknown Status</span>
							<?php }  ?>	
							</td>
					   </tr>
					   <?php } ?>
				</table>
		  
				<div class="text-center" style="margin-top: 2%">
					<?php echo $action->paginate("", "select * from withdrawal where status!=0 order by id desc");?>
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
