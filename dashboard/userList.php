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

$per_page = 100;
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
  <title>9jaBusiness - User List</title>
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

<div class="clearfix"></div>
	
<div class="content-wrapper">
	<div class="container-fluid">

		<div class="row mt-3">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
			
							<?php
							
							if(isset($_POST["updUsr"])) {
								$uid = $_POST["uid"];
								$newPlan = $_POST["newPlan"];
								
								$timed = date("D j F, Y; h:i a");
								
								$walletBlc = $action->userWallet($uid)["usd"];
								
								$planInfo = $action->planInfo($newPlan);
								
								$amount = $planInfo["price"];
								$refComm = $planInfo["refComm"];
								
								$txID = mt_rand(111111, 920920).mt_rand(111111, 920920);
								
								if($walletBlc < $amount) { ?>
									<script>
										swal.fire({
											icon: "error",
											title: "Insufficient Balance",
											text: "User wallet balance is not sufficient to process this transaction"
										});
									</script>
								<?php } else {
									$newBlc = $walletBlc - $amount;
	
									//Has referral earns his commission... ?
									$chkRef = $action->query("select * FROM `referral` where clientReferred='$uid' and pointRcv='NO'"); $chkRef->execute();
									
									//Referral Commission...
									if($chkRef->rowCount() > 0) { // Referral is yet to be paid...
										$chkRefs = $chkRef->fetch(PDO::FETCH_ASSOC);
										$IRefer = $chkRefs["userID"];
										
										if($refComm > 0) {
											$refPercent = (($amount * $refComm)/100);
										} else {
											$refPercent = (($amount * $action->search_setting("refComm"))/100);
										}
										
										$updtRef = $action->query("insert into transaction (userid, amount, transaction_id, reference_id, response, status, type, dateCreated, dateUpdated) values ('$IRefer', '$refPercent', '$txid', '".$_REQUEST["txid"]."', 'Referral bonus credited', '1', 'referral', '$timed', '$timed')"); 
										$updtRef->execute();
										
										//We need to credit the Referral wallet...
										$currWallet = $action->userWallet($IRefer);
										$usd_amnt = $currWallet["usd"];
										
										$newAmnt = $usd_amnt + $refPercent;
										
										$action->updateBlc($IRefer, $newAmnt, "usd");
										
									}
									
									$response = json_encode(["msg" => "Plan activated with earnings wallet", 
										"type" => "earning",
										"plan_name" => $planInfo["name"],
										"bfrAmnt" => $walletBlc,
										"aftAmnt" => $newBlc,
									]);
									
									$action->updateBlc($uid, $newBlc, "usd");
									
									$updtTran = $action->query("insert into transaction (userid, amount, transaction_id, reference_id, response, status, dateCreated, dateUpdated, type) values ('$uid', '$amount', '$txID', '', '".addslashes($response)."', '1', '$timed', '$timed', 'plan')"); 
									$updtTran->execute();
									
									$updtUsr = $action->query("update users set planID='$newPlan' where id='$userid'"); $updtUsr->execute();
								 ?>
									<script>
										swal.fire({
											icon: "success",
											title: "Plan Assigned",
											text: "Plan has been assigned successfully to this user"
										}).then(function() { 
											window.location = "";
										})
									</script>
								<?php
								}
								
							}
							
							if(isset($_REQUEST["viewRef"])) { 
								$refID = $_REQUEST["viewRef"];
							?>
								<div class="card-header"><b style='color: gold'><?php echo $action->clientInfo($refID)["fullname"];?>'s</b> Referral</div>
								
								<table class="table table-bordered">
									<tr>
										<th>S/No</th> <th>User Details</th> <th>Plan Info</th>
									</tr>
									<tr>
										<?php $i = 1;
										$allUser = $action->query("select * from referral where userID='$refID' order by id desc limit $start_page, $per_page");
										$allUser->execute();
										while ($allUserInfo = $allUser->fetch(PDO::FETCH_ASSOC)) {
											$uid = $allUserInfo["clientReferred"];
														
											//Search plan...
											$srchPlan = $action->query("select * from plans where id='".$action->clientInfo($uid)["planID"]."'"); $srchPlan->execute();
											$srchPlans = $srchPlan->fetch(PDO::FETCH_ASSOC);
										?>
										
											<td><?php echo $i++;?></td>
											<td>
												<a href="?viewRef=<?php echo $uid; ?>" style="color: #d49a34">
													<b><?php echo $action->clientname($uid);?></b>
												</a>
												<br> <b style="color: gold">Email : </b> <?php echo $action->clientemail($uid); ?> 
												<br> <b style="color: #f5a21b">Wallet Balance : </b> &dollar;<?php echo number_format($action->userWallet($uid)["usd"], 2); ?> 
												<br> <b style="color: #ff8800">Referral Code : </b> <?php echo $action->userCode($uid); ?> 
											</td>
											<td>
												<?php echo $srchPlans["name"]; ?>
												<br> <b style="color: gold">Business Creation : </b> <?php echo number_format($srchPlans["bus_no"]); ?> business per day 
												<br> <b style="color: #f5a21b">Business Review : </b> <?php echo number_format($srchPlans["bus_review"]); ?> review per day 
											</td>
										<?php } ?>
									</tr>
								</table>
								
							<?php } else { ?>
								<div class="card-header">Our Users</div>
							<?php 
								if(isset($_REQUEST["banUser"])) {
									$banUser = $_REQUEST["banUser"];
									
									$updtUsr = $action->query("update users set status=0 where id='$banUser'"); 
									if($updtUsr->execute()) { ?>
										<script>
											swal.fire({
												icon: "success",
												title: "User Suspended",
												text: "User suspended successfully",
												allowOutsideClick: false,
											}).then((result) => {
												if (result.isConfirmed) {
													window.location = "userList"
												}
											});
										</script>
									<?php } else { ?>
										<div class="alert alert-danger" style='padding:15px; font-size: 20px'><b>Error: </b> Unable to suspend user account</div>
									<?php }
								}
								
									if(isset($_REQUEST["delUser"])) {
									$delUser = $_REQUEST["delUser"];
									
									$deltUsr = $action->query("delete from users where id='$delUser'"); 
									if($deltUsr->execute()) { ?>
										<script>
											swal.fire({
												icon: "success",
												title: "User Deleted",
												text: "User deleted successfully",
												allowOutsideClick: false,
											}).then((result) => {
												if (result.isConfirmed) {
													window.location = "userList"
												}
											});
										</script>
									<?php } else { ?>
										<div class="alert alert-danger" style='padding:15px; font-size: 20px'><b>Error: </b> Unable to delete user account</div>
									<?php }
								}
								
								
								if(isset($_REQUEST["activateUser"])) {
									$activateUser = $_REQUEST["activateUser"];
									
									$updtUsr = $action->query("update users set status=1 where id='$activateUser'"); 
									if($updtUsr->execute()) { ?>
										<script>
											swal.fire({
												icon: "success",
												title: "User Activated",
												text: "User activated successfully",
												allowOutsideClick: false,
											}).then((result) => {
												if (result.isConfirmed) {
													window.location = "userList"
												}
											});
										</script>
									<?php } else { ?>
										<div class="alert alert-danger" style='padding:15px; font-size: 20px'><b>Error: </b> Unable to activate user account</div>
									<?php }
								}
								?>
								
								<ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
									<li class="nav-item">
										<a href="javascript:void();" data-target="#profile" data-toggle="pill" class="nav-link active"><i class="icon-plus"></i>
											<span class="hidden-xs">Active Users</span></a>
									</li>
									<li class="nav-item">
										<a href="javascript:void();" data-target="#messages" data-toggle="pill" class="nav-link"><i class="icon-ban"></i> 
											<span class="hidden-xs">Suspended Users</span></a>
									</li>
								</ul>
								<div class="tab-content p-3">
									<div class="tab-pane active" id="profile">
										
										<div class="table-responsive">
											<table class="table table-bordered table-striped">
												<tbody> <!-- class is white -->
													<tr>
														<th>S/No</th> <th>User Details</th> <th>Plan Info</th> <th></th> 
													</tr>
													<tr>
													<?php $i = 1;
													if(isset($_REQUEST["type"]) && $_REQUEST["type"] == "active") {
														$allUser = $action->query("select * from users where status=1 order by id desc limit $start_page, $per_page");
													} else {
														$allUser = $action->query("select * from users where status=1 order by id desc limit $start_page, $per_page");
													}
													
													$allUser->execute();
													
													while ($allUserInfo = $allUser->fetch(PDO::FETCH_ASSOC)) {
														$uid = $allUserInfo["id"];
														
														//Search plan...
														$srchPlan = $action->query("select * from plans where id='".$action->clientInfo($uid)["planID"]."'"); $srchPlan->execute();
														$srchPlans = $srchPlan->fetch(PDO::FETCH_ASSOC);
														
														?>
														<td><?php echo $i++;?></td>
													   <td>
														<a href="?viewRef=<?php echo $uid; ?>" style="color: #d49a34">
															<b><?php echo $action->clientname($uid);?></b>
														</a>
															<br> <b style="color: gold">Email : </b> <?php echo $action->clientemail($uid); ?> 
															<br> <b style="color: #f5a21b">Wallet Balance : </b> &dollar;<?php echo number_format($action->userWallet($uid)["usd"], 2); ?> 
															<br> <b style="color: #ff8800">Referral Code : </b> <?php echo $action->userCode($uid); ?> 
													   </td>
													   <td>
															<?php echo $srchPlans["name"]; ?>
															<br> <b style="color: gold">Business Creation : </b> <?php echo number_format($srchPlans["bus_no"]); ?> business per day 
															<br> <b style="color: #f5a21b">Business Review : </b> <?php echo number_format($srchPlans["bus_review"]); ?> review per day 
													   </td>
														<td>
															<button  class="btn btn-info btn-md" data-toggle="modal" data-target="#swtPlan<?php echo $uid;?>">
																<b><i class="fa fa-exchange"></i> Change Plan</b>
															</button>
															<a href="?banUser=<?php echo $uid;?>"  class="btn btn-warning btn-md" onclick="BlockUser(event)">
																<b><i class="fa fa-ban"></i> Suspend</b>
															</a>
															<a href="?delUser=<?php echo $uid;?>"  class="btn btn-danger btn-md" onclick="DeleteUser(event)">
																<b><i class="fa fa-trash"></i> Delete</b>
															</a>
														</td>													
												
																		
								<div class="modal fade" id="swtPlan<?php echo $uid;?>">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title">Modify Admin</h4>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span></button>
											</div>
											<div class="modal-body">
												<form method="post">
													<label style="color: #000">Current Plan</label>
													<input class="form-control" value="<?php echo $action->planInfo($action->clientInfo($uid)["planID"])["name"];?>" disabled>
													<br>
													
													<label style="color: #000">Wallet Balance</label>
													<input class="form-control" value="&dollar;<?php echo number_format($action->userWallet($uid)["usd"], 2); ?>" disabled>
													<input class="form-control" value="<?php echo $uid; ?>" type="hidden" name="uid">
													<br>
													
													<label style="color: #000">Select Plan</label>
													<select class="form-control" name="newPlan" style="background: rgba(21, 14, 14, 0.45)" required>
														<option vaiue="">-- Select -- </option>
														<?php 
														$loadPlan = $action->query("Select * from plans order by name asc"); $loadPlan->execute();
														while($loadPlans = $loadPlan->fetch(PDO::FETCH_ASSOC)) { ?>
															<option value="<?php echo $loadPlans["id"];?>" <?php if($action->clientInfo($uid)["planID"] == $loadPlans["id"] || $loadPlans["price"] == 0) { echo "disabled"; } ?>>
																<?php echo $loadPlans["name"] ." => &dollar;".number_format($loadPlans["price"], 2);?>
															</option>
														<?php } ?>
													</select>
													
													
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														<button type="submit" class="btn btn-primary" name="updUsr" onclick="return confirm('Modify Admin')"> Modify User </button>
													</div>
												</form>
											</div>
										<!-- /.modal-content -->
									</div>
											<!-- /.modal-dialog -->
								</div>

													</tr>
														
														<script>
										
									
														function BlockUser(ev) {
															ev.preventDefault();
													
															var urlToRedirect = ev.currentTarget.getAttribute('href');
															swal.fire({
																icon: "info",
																title: "Deactivate User",
																text: "You're about to deactivate user account which will make user unable to make any transaction with his or her account. Proceed ?",
																allowOutsideClick: false,
																showCancelButton: true,
																confirmButtonText: 'Yes, I agree',
															}).then((result) => {
																if (result.isConfirmed) {
																	window.location = urlToRedirect
																}
															});
														}
														
														function DeleteUser(ev) {
															ev.preventDefault();
													
															var urlToRedirect = ev.currentTarget.getAttribute('href');
															swal.fire({
																icon: "info",
																title: "Delete User",
																text: "You're about to delete user account which will prevent user from having access to his or her account. Proceed ?",
																allowOutsideClick: false,
																showCancelButton: true,
																confirmButtonText: 'Yes, I agree',
															}).then((result) => {
																if (result.isConfirmed) {
																	window.location = urlToRedirect
																}
															});
														}
														
													
														</script>
														
													<?php } ?>
												</tbody>
											</table>
											
											<div class="text-center" style="margin-top: 2%">
												<?php echo $action->paginate("type=active&", "select * from users where status=1 order by id desc");?>
											</div>
											
										</div>
										
									</div>
									<div class="tab-pane" id="messages">
										
										<div class="table-responsive">
											<table class="table table-bordered table-striped">
												<tbody> <!-- class is white -->
													<tr>
														<th>S/No</th> <th>User Details</th> <th>Plan Info</th> <th></th>
													</tr>
													<tr>
													<?php $i = 1;
													if(isset($_REQUEST["type"]) && $_REQUEST["type"] == "suspend") {
														$allSuspend = $action->query("select * from users where status=0 order by id desc limit $start_page, $per_page");
													} else {
														$allSuspend = $action->query("select * from users where status=0 order by id desc limit $start_page, $per_page");
													}
													
													$allSuspend->execute();
													
													while ($allSuspendInfo = $allSuspend->fetch(PDO::FETCH_ASSOC)) {
														$uids = $allSuspendInfo["id"];
														
														//Search plan...
														$srchPlan2 = $action->query("select * from plans where id='".$action->clientInfo($uids)["planID"]."'"); $srchPlan2->execute();
														$srchPlan2s = $srchPlan2->fetch(PDO::FETCH_ASSOC);
														
														?>
														<td><?php echo $i++;?></td>
													   <td><?php echo $action->clientname($uids);?>
															<br> <b style="color: gold">Email : </b> <?php echo $action->clientemail($uids); ?> 
															<br> <b style="color: #f5a21b">Wallet Balance : </b> &dollar;<?php echo number_format($action->userWallet($uids)["usd"], 2); ?> 
													   </td>
													   <td>
															<?php echo $srchPlan2s["name"]; ?>
															<br> <b style="color: gold">Business Creation : </b> <?php echo number_format($srchPlan2s["bus_no"]); ?> business per day 
															<br> <b style="color: #f5a21b">Business Review : </b> <?php echo number_format($srchPlan2s["bus_review"]); ?> review per day 
													   </td>
														<td>
															<a href="?activateUser=<?php echo $uids;?>"  class="btn btn-primary btn-lg" onclick="ActvateUser(event)">
																<b><i class="fa fa-ban"></i> Activate</b>
															</a>
														</td>

													</tr>
														<script>
														function ActvateUser(ev) {
															ev.preventDefault();
													
															var urlToRedirect = ev.currentTarget.getAttribute('href');
															swal.fire({
																icon: "info",
																title: "Activate User",
																text: "You're about to activate user account which will make enable user to continue their transaction. Proceed ?",
																allowOutsideClick: false,
																showCancelButton: true,
																confirmButtonText: 'Yes, I agree',
															}).then((result) => {
																if (result.isConfirmed) {
																	window.location = urlToRedirect
																}
															});
														}
														</script>
														
													<?php } ?>
												</tbody>
											</table>
											
											<div class="text-center" style="margin-top: 2%">
												<?php echo $action->paginate("type=suspend&", "select * from users where status=0 order by id desc");?>
											</div>
											
										</div>
									
									</div>
								</div>
							<?php } ?>
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