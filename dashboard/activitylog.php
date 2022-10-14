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
  <title>9jaBusiness - Plan Management</title>
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
		   
			<?php
			if(isset($_POST["addLevel"])) {
				$level_name = addslashes($_POST["level_name"]);
				$amount = $_POST["amount"];
				$business_no = $_POST["business_no"];
				$business_review = $_POST["business_review"];
				$refComm = $_POST["refComm"];
				
				// search Plan
				$searchPlan = $action->query("select * from plans where name='$level_name'"); $searchPlan->execute();
				
				if($searchPlan->rowCount() > 0) { ?>
					<div class="alert alert-danger"><b>Error : </b> Plan already exists </div>
				<?php } else if(filter_var($amount, FILTER_VALIDATE_FLOAT) == false) { ?>
					<div class="alert alert-danger"><b>Error : </b> Invalid plan amount </div>
				<?php } else if(filter_var($refComm, FILTER_VALIDATE_FLOAT) == false) { ?>
					<div class="alert alert-danger"><b>Error : </b> Invalid referral commission amount </div>
				<?php } else {
				
					$savePlan = $action->query("insert into plans (name, price, bus_no, bus_review, refComm) values ('$level_name', '$amount', '$business_no', '$business_review', '$refComm')");
					
					if($savePlan->execute()) { ?>
						<script>
							swal.fire({
								icon: "success",
								title: "Plan Added",
								text: "Plan level has been added succesfully"
							}).then((isRedirect) => {
								if(isRedirect.isConfirmed) {
									window.location = "";
								}
							});
						</script>
					<?php } else { ?>
						<div class="alert alert-danger"><b>Error : </b> We could not create a plan </div>
					<?php }
					
				}
			}
			?>
		   
			<ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
                <li class="nav-item">
                    <a href="javascript:void();" data-target="#profile" data-toggle="pill" class="nav-link active"><i class="icon-check"></i>
						<span class="hidden-xs">Approved Business</span></a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void();" data-target="#messages" data-toggle="pill" class="nav-link"><i class="fa fa-times-circle"></i> 
						<span class="hidden-xs">Declined Business</span></a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void();" data-target="#apprRev" data-toggle="pill" class="nav-link"><i class="icon-check"></i> 
						<span class="hidden-xs">Approved Review</span></a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void();" data-target="#dclnRev" data-toggle="pill" class="nav-link"><i class="fa fa-times-circle"></i> 
						<span class="hidden-xs">Declined Review</span></a>
                </li>
            </ul>
            <div class="tab-content p-3">
                <div class="tab-pane active" id="profile">
                    
					<div class="table-responsive" style="margin-top: 2%">
					   <table class="table table-striped">
							<tr>
								<td>S/N</td>
								<td>User Info</td>
								<td>Business Name</td>
								<td>Remarks</td>
							</tr>
							<tr>
								<?php $i = 1;
								$loadBus = $action->query("select * from businesscreation where status=1 order by id desc"); $loadBus->execute();
								while($loadBuss = $loadBus->fetch(PDO::FETCH_ASSOC)) { ?>
									<td><?php echo $i++;?></td>
									<td>
										<?php echo $action->clientInfo($loadBuss["userid"])["fullname"];?> <br>
										<b style="color: gold"><?php echo $action->clientInfo($loadBuss["userid"])["email"];?></b> <br>
									</td>
									<td>
										<?php echo $loadBuss["businessname"];?> <br>
										<b style="color: gold"><?php echo $loadBuss["founder"];?></b> <br>
									</td>

									<td>
										<b style="color: #2af51b">Earnings : </b> &dollar;<?php echo number_format($loadBuss["earnings"], 2);?></b> <br>
										<b style="color: gold">Date Approved : </b> <?php echo $loadBuss["dateApproved"];?> <br>
										<b style="color: #f5a21b">Approved By: </b> <?php echo $loadBuss["apprBy"];?></b> <br>
									</td>
							</tr>
							<?php } ?>
						
						</table>
					</div>
					
                </div>
                <div class="tab-pane" id="messages">
                    
					<div class="table-responsive" style="margin-top: 2%">
					   <table class="table table-striped">
							<tr>
								<td>S/N</td>
								<td>User Info</td>
								<td>Business Name</td>
								<td>Remarks</td>
							</tr>
							<tr>
								<?php $n = 1;
								$loadBus = $action->query("select * from businesscreation where status=2 order by id desc"); $loadBus->execute();
								while($loadBuss = $loadBus->fetch(PDO::FETCH_ASSOC)) { ?>
									<td><?php echo $n++;?></td>
									<td>
										<?php echo $action->clientInfo($loadBuss["userid"])["fullname"];?> <br>
										<b style="color: gold"><?php echo $action->clientInfo($loadBuss["userid"])["email"];?></b> <br>
									</td>
									<td>
										<?php echo $loadBuss["businessname"];?> <br>
										<b style="color: gold"><?php echo $loadBuss["founder"];?></b> <br>
									</td>

									<td>
										<b style="color: gold">Date Declined : </b> <?php echo $loadBuss["dateApproved"];?> <br>
										<b style="color: #f5a21b">Declined By: </b> <?php echo $loadBuss["apprBy"];?></b> <br>
									</td>
							</tr>
							<?php } ?>
						
						</table>
					</div>
					
				</div>
                <div class="tab-pane" id="apprRev">
                    
					<div class="table-responsive" style="margin-top: 2%">
					   <table class="table table-striped">
							<tr>
								<td>S/N</td>
								<td>Created By</td>
								<td>Business Name</td>
								<td>Reviewed By</td>
								<td>Remarks</td>
							</tr>
							<tr>
								<?php $n = 1;
								$loadRevs = $action->query("select * from businessreview where status=1 order by id desc"); $loadRevs->execute();
								while($loadRevss = $loadRevs->fetch(PDO::FETCH_ASSOC)) { 
									$srchBus = $action->query("select * from businesscreation where id='".$loadRevss["bus_id"]."'"); $srchBus->execute();
									$srchBuss = $srchBus->fetch(PDO::FETCH_ASSOC);
								?>
									<td><?php echo $n++;?></td>
									<td>
										<?php echo $action->clientInfo($loadRevss["userid"])["fullname"];?> <br>
										<b style="color: gold"><?php echo $action->clientInfo($loadRevss["userid"])["email"];?></b> <br>
									</td>
									<td>
										<?php echo $srchBuss["businessname"];?> <br>
										<b style="color: gold"><?php echo $srchBuss["founder"];?></b> <br>
									</td>
									<td>
										<?php echo $action->clientInfo($srchBuss["userid"])["fullname"];?> <br>
										<b style="color: gold"><?php echo $action->clientInfo($srchBuss["userid"])["email"];?></b> <br>
									</td>

									<td>
										<b style="color: #2af51b">Earnings : </b> &dollar;<?php echo number_format($loadRevss["earnings"], 2);?></b> <br>
										<b style="color: gold">Date Approved : </b> <?php echo $loadRevss["dateApproved"];?> <br>
										<b style="color: #f5a21b">Approved By : </b> <?php echo $loadRevss["apprBy"];?></b> <br>
									</td>
							</tr>
							<?php } ?>
						
						</table>
					</div>
					
				</div>
                <div class="tab-pane" id="dclnRev">
                    
					<div class="table-responsive" style="margin-top: 2%">
					   <table class="table table-striped">
							<tr>
								<td>S/N</td>
								<td>Created By</td>
								<td>Business Name</td>
								<td>Reviewed By</td>
								<td>Remarks</td>
							</tr>
							<tr>
								<?php $n = 1;
								$loadRevs = $action->query("select * from businessreview where status=2 order by id desc"); $loadRevs->execute();
								while($loadRevss = $loadRevs->fetch(PDO::FETCH_ASSOC)) { 
									$srchBus = $action->query("select * from businesscreation where id='".$loadRevss["bus_id"]."'"); $srchBus->execute();
									$srchBuss = $srchBus->fetch(PDO::FETCH_ASSOC);
								?>
									<td><?php echo $n++;?></td>
									<td>
										<?php echo $action->clientInfo($loadRevss["userid"])["fullname"];?> <br>
										<b style="color: gold"><?php echo $action->clientInfo($loadRevss["userid"])["email"];?></b> <br>
									</td>
									<td>
										<?php echo $srchBuss["businessname"];?> <br>
										<b style="color: gold"><?php echo $srchBuss["founder"];?></b> <br>
									</td>
									<td>
										<?php echo $action->clientInfo($srchBuss["userid"])["fullname"];?> <br>
										<b style="color: gold"><?php echo $action->clientInfo($srchBuss["userid"])["email"];?></b> <br>
									</td>

									<td>
										<b style="color: gold">Date Declined : </b> <?php echo $loadRevss["dateApproved"];?> <br>
										<b style="color: #f5a21b">Declined By : </b> <?php echo $loadRevss["apprBy"];?></b> <br>
									</td>
							</tr>
							<?php } ?>
						
						</table>
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