<?php
require "../action.php"; $action = new Action();
$userid = $_SESSION["username"];
$userWallet = $action->userWallet($userid);

//Is user having a pending payment...
$srchPay = $action->query("select * from payment where userid='$userid' and walletID!='' and attachment is NULL limit 1"); $srchPay->execute();

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
  <title>Business - Review Business</title>
  <!-- loader--
  <link href="assets/css/pace.min.css" rel="stylesheet"/>t
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

	.msg_cell {
		border: 1px solid #c4c4c4;
		padding: 10px;
		margin:10px;
		margin-top:10px;
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
           <div class="card-title" style="font-size: 20px">Review Business</div>
           <p style="font-size: 18px;">Your wallet balance is <b>&dollar;<?php echo number_format($action->userWallet($userid)["usd"], 2);?></b></p>
			
			<hr/>
			
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
			
			if(isset($_REQUEST["loadReview"])) {
				$business_id = base64_decode($_REQUEST["loadReview"]);
				
				$loadBus = $action->query("select * from businesscreation where id='$business_id'"); $loadBus->execute();
				$loadBuss = $loadBus->fetch(PDO::FETCH_ASSOC);
					
				$attachment = json_decode($loadBuss["attachment"], true);
				$logo = $attachment["logo"];
				$office_pic = $attachment["office"];
				
			?>

				<div class="row">
					<div class="col-lg-6">
						<div class="msg_cell">
							<b>Business Name : </b> <?php echo $loadBuss["businessname"];?>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="msg_cell">
							<b>Business Website : </b> <?php echo $loadBuss["url"];?>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-lg-6">
						<div class="msg_cell">
							<b>Founder : </b> <?php echo $loadBuss["founder"];?>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="msg_cell">
							<b>Business Contact : </b> <?php echo $loadBuss["mobile"];?>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-lg-6">
						<div class="msg_cell">
							<b>Date Founded : </b> <?php echo $loadBuss["datefounded"];?>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="msg_cell">
							<b>Business Website : </b> <?php echo $loadBuss["workhours"];?>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-lg-12">
						<div class="msg_cell">
							<b>Business Address : </b> <?php echo $loadBuss["address"];?>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-lg-12">
						<div class="msg_cell">
							<b>Description : </b> <?php echo $loadBuss["description"];?>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-lg-6">
						<h5 style="margin: 10px"><b>Business Logo</b>  <small style="color: gold; font-size: 14px">Click on the image for larger view</small></h5>
						
						<a href="../uploads/<?php echo $logo;?>" target="_blank">
							<img src="../uploads/<?php echo $logo;?>" style="width: 280px; height: 200px;" class="img img-responsive"/>
						</a>
						
					</div>
					
					<?php if(!empty($office_pic) && isset($office_pic)) { ?>
						<div class="col-lg-6">
							<h5 style="margin: 10px"><b>Office Building</b>  <small style="color: gold; font-size: 14px">Click on the image for larger view</small></h5>
							
							<a href="../uploads/<?php echo $office_pic;?>" target="_blank">
								<img src="../uploads/<?php echo $office_pic;?>" style="width: 280px; height: 200px;" class="img img-responsive"/>
							</a>
							
						</div>
					<?php } ?>
				</div>
				<hr>
				<h3><b>Reviews</b></h3><br/>
				<?php 
				//You can't drop a review again...
				$checkRev = $action->query("select * from businessreview where bus_id='$business_id' and userid='$userid' and status!=2"); $checkRev->execute();
				
				$loadRev = $action->query("select * from businessreview where bus_id='$business_id' and status=1 order by rand() desc limit 5"); $loadRev->execute();
				// $loadRev = $action->query("select * from businessreview where bus_id='$business_id' order by rand() desc limit 5"); $loadRev->execute();
				if($loadRev->rowCount() == 0) { ?>
					<div class="alert alert-danger" style="color: #000; font-size: 22px; padding: 15px"><b> No review yet for this business, kindly do so now</b> </div>
				<?php } else {
					while($loadRevs = $loadRev->fetch(PDO::FETCH_ASSOC)) { ?>
						<div class="msg_cell">
							<b style="color: gold"><?php echo ucwords($action->clientInfo($loadRevs["userid"])["username"]);?>: </b> 
							<?php echo $loadRevs["message"];?>
						</div>
					<?php }
				}
				
				//No user from user, proceed...
				if($checkRev->rowCount() == 0) { ?>
					<hr>
					<h3><b>Post Review</b></h3><br/>
					
					<form method="post">

						<div class="form-group row">
							<div class="col-lg-12">
							<label for="review">Your Review</label>
							<textarea  class="form-control" id="review" name="review" placeholder="Write your review" rows="4"></textarea>
					   </div>	

						<div class="col-lg-12 text-center" style="margin-top: 10px">
							<button class="btn btn-info btn-lg" type="submit" name="postReview" id="postReview"><b>Submit Review</b></button>
						</div>
						
					</form>
					
					<script>
					$(document).ready(function() {
						$("#postReview").click(function(e) {
							e.preventDefault();
							if($("#review").val().length < 10) {
								swal.fire({text: "Your review is too short", icon: "error"});
							} else {
								const id = <?php echo $business_id;?>;
								var encode_id = "<?php echo base64_encode($business_id);?>";
								var data = {
									postReview: "postReview",
									review: $("#review").val(),
									id: id
								}
								
								$.ajax({
									
									url: "../process.php",
									type: "POST",
									data: data,
                                    // dataType: "json",
									success: function (response) {
										
										if($.trim(response) == "login_needed") {
														
											swal.fire({
												title: "Unauthorized Access",
												html: "Your session has expired. Kindly login to continue",
												icon: "error"
											}).then(function() { 
												window.location = "";
											})
											
										} else if($.trim(response) == "success") {
										    
											swal.fire({
												title: "Success!",
												html: "Your review has been submitted successfully",
												icon: "success"
											}).then((isRedirect) => {
												if(isRedirect.isConfirmed) {
													window.location = "reviewbusiness";
												}
											});
											
										} else {
										
											swal.fire({
												title: "Error Reviewing!",
												html: response,
												icon: "error"
											})
										
										}
									}
								})
								
							}
								
						});
					});
					</script>
				
				<?php } else { ?>
					<div class="alert alert-warning" style="color: #000; font-size: 22px; padding: 15px"><b>Error : </b> Business already reviewed by You</div>
				<?php }
					
				} else { ?>
			
				<div class="table-responsive">
					<table class="table table-bordered">
						<tr>
							<td>S/N</td>
							<td>Business Name</td>
							<td>Business Info</td>
							<td></td>
						</tr>
						<tr>
						<?php $i = 1;
						
						$loadBus = $action->query("select * from businesscreation where userid!='$userid' and status='1' order by rand() desc"); $loadBus->execute();
						while($loadBuss = $loadBus->fetch(PDO::FETCH_ASSOC)) {
								
							//Check review...
							$revChk = $action->query("select * from businessreview where userid='$userid' and bus_id='".$loadBuss["id"]."' and status=0");
							$revChk->execute();
							?>
							
							<td><?php echo $i++;?></td>
							<td>
								<?php echo $loadBuss["businessname"];?> 
							</td>
							<td>
								<b style="color: #00FFFF">Founder : <?php echo $loadBuss["founder"];?> </b><br>
								<b style="color: gold">Date Founded : <?php echo $loadBuss["datefounded"];?> <br>
							</td>
							<td>
								<?php 
								if($revChk->rowCount() > 0) { ?>
									<button class="btn btn-warning" disabled><b>Awaiting Approval</b></button>
								<?php } else { ?>
									<a href="?loadReview=<?php echo base64_encode($loadBuss["id"]);?>" id="btn_load" class="btn btn-info"> Review</a> 
								<?php } ?>
							</td>
								</tr>
						<?php } ?>
					</table>
				</div>
			<?php } 
			} ?>
			</div>
         </div>
      </div>

    </div><!--End Row-->

	<!--start overlay-->
		  <div class="overlay toggle-menu"></div>
		<!--end overlay-->

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
