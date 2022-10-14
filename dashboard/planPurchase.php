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
  <title>Plan Purchased History - Admin Menu</title>
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
	
  <style>
	.msg_cell {
		border: 1px solid #c4c4c4;
		padding: 10px;
		margin:10px;
		margin-top:10px;
	}
  </style>


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
        <li class="dropdown-item"><a href="buyplan"><i class="fa fa-money mr-2"></i> Buy Survey Plan</a></li>
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
				<div class="card-header" style="font-size: 20px">Plan Purchased History</div>
				<br>
				<div class="col-lg-12">
					<div class="form-inline">
						
						<form method="post">
							<select class="form-control" name="month" style="margin: 10px" required>
								<option value="">-- Select --</option>
								<?php $i = 1;
								date_default_timezone_set('UTC');
								$month = strtotime('0 month');
								while($i <= 12) { 
									$month_name = date('F', $month);
								?>
									<option value="<?php echo $month_name;?>"><?php echo $month_name;?></option>
								<?php 
									$month = strtotime('+1 month', $month);
									$i++;
								} ?>
							</select>
							
							<select class="form-control" name="year" style="margin: 10px" required>
								<option value="">-- Select --</option>
								<?php $i = 1;
								date_default_timezone_set('UTC');
								$month = strtotime('0 month');
								for($i=1; $i<=5; $i++) { ?>
									<option value="<?php echo date("Y")+$i-1;?>">
										<?php echo date("Y")+$i-1;?>
									</option>
								<?php } ?>
							</select>
							
							<button type="submit" class="btn btn-primary"><b>Search</b></button>
						</form>
					</div>
				</div>
				
				<br>
				<div class="col-lg-12">
					<div class="table-responsive">
						<table class="table table-bordered">
							<tr>
								<th>User Info</th>
								<th>Plan Name</th>
								<th>Amount</th>
								<th>Status</th>
								<th>Remarks</th>
							</tr>
							<tr>
								<?php
								
								if(isset($_POST["month"])) {
									$dateLike = $_POST["month"].", ".$_POST["year"];
									$loadTran = $action->query("select * from transaction where type='plan' and status=1 and (dateCreated like '%$dateLike%' or dateUpdated like '%$dateLike%') order by id desc limit $start_page, $per_page"); 
								} else {
									$loadTran = $action->query("select * from transaction where type='plan' and status=1 order by id desc limit $start_page, $per_page"); 
								}
								// $loadTran = $action->query("select * from transaction where type='plan' order by id desc limit 50"); 
								
								$loadTran->execute();
								while($loadTrans = $loadTran->fetch(PDO::FETCH_ASSOC)) {
									$response = json_decode($loadTrans["response"]);
									$txStatus = $loadTrans["status"];
								?>
								
								<td>
									<?php echo $action->clientInfo($loadTrans["userid"])["fullname"];?>
									<br> <b style="color: gold">Email : </b> <?php echo $action->clientemail($loadTrans["userid"]); ?> 
								</td>
								
								<td><?php echo $response->plan_name;?></td>
								
								<td>&dollar;<?php echo number_format($loadTrans["amount"], 2);?></td>
								
								<td><span class='text-success'><b>Approved</b></span></td>
								
								<td>
								
									<br><b style="color: #ff8800">Approved By: </b> <?php echo $loadTrans["apprBy"];?>
									<br><b style="color: #f5a21b">Date Created : </b> <?php echo $loadTrans["dateCreated"];?>
									<br><b style="color: gold">Date Approved : </b> <?php echo $loadTrans["dateUpdated"];?>
								</td>
								
							<tr>
								<?php } ?>
						</table>
		  
						<div class="text-center" style="margin-top: 2%">
							<?php echo $action->paginate("", "select * from transaction where type='plan' and status=1 order by id desc");?>
						</div>
					</div>
				
				</div>
				
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