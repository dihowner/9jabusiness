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
  <title>Pending Business Upload - Admin Menu</title>
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
				<div class="card-header" style="font-size: 20px">Pending Business Review</div>
				
				<?php 
				if(isset($_REQUEST["viewReview"])) {
					
					$reviewID = base64_decode($_REQUEST["viewReview"]);
					$loadRev = $action->query("select * from businessreview where id='$reviewID' order by id desc"); $loadRev->execute();
					$loadRevs = $loadRev->fetch(PDO::FETCH_ASSOC);
					
					$busID = $loadRevs["bus_id"];
					$loadBus = $action->query("select * from businesscreation where id='$busID'"); $loadBus->execute();
					$loadBuss = $loadBus->fetch(PDO::FETCH_ASSOC);
					
					$attachment = json_decode($loadBuss["attachment"], true);
					$logo = $attachment["logo"];
					$office_pic = $attachment["office"];
					
					// print_r($points);
					$totalPoint = $action->businesspoint()->review;
					
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
					<h3><b>User Review</b></h3><br/>		
					
					<div class="msg_cell">
						<b style="color: gold"><?php echo ucwords($action->clientInfo($loadRevs["userid"])["username"]);?>: </b> 
						<?php echo $loadRevs["message"];?>
					</div>
					
					<br/><h4><b>Earning Value</b></h4>
					<input type="text" class="form-control" id='earnAmnt' name='earnAmnt' placeholder="Enter earning amount" required />
					
					<div class="row" style="margin-top: 10px">
						<div class="col-lg-12">
							<label>Reason for declining</label>
							<textarea class="form-control" id='dclnMsg' name='dclnMsg' placeholder="Reason for declining this business review"></textarea>
						</div>
					</div>
					
					<div class="row" style="margin-bottom: 2%">
						<div class="col-lg-12 text-center" style="margin: 12px">
							<a class="btn btn-success btn-lg" href="?txType=approve&id=<?php echo $_REQUEST["viewReview"];?>" onclick="apprBus(event)" style="margin-bottom: 10px"><b>Approve</b></a>
							<a class="btn btn-danger btn-lg" href="?txType=decline&id=<?php echo $_REQUEST["viewReview"];?>" onclick="declineBus(event)" style="margin-bottom: 10px"><b>Decline</b></a>
						</div>
					</div>
					
					<script>
						function apprBus(ev) {
							ev.preventDefault();
					
							var urlToRedirect = ev.currentTarget.getAttribute('href');
							
							// var totalPoint = '<?php echo number_format($totalPoint, 2);?>';
							var totalPoint = $("#earnAmnt").val();
							var totalPoints = $("#earnAmnt").val() / <?php echo $action->search_setting("dollarNaira");?>;
							var businessname = '<?php echo $loadBuss["businessname"];?>';
							
							if(totalPoint == "") {
								swal.fire({
									title: "Earning Required",
									html: "Please enter earning value for this business approval",
									icon: "error"
								})
							} else {
								swal.fire({
									title: "Are you sure?",
									html: "You are about to approve a review for this business (<b>"+businessname+"</b>), a total of <b>"+totalPoints+"</b> USD will be credited to this user",
									icon: "warning",
									buttons: true,
									dangerMode: true,
									allowOutsideClick: false,
									showCancelButton: true,
									confirmButtonText: 'Proceed',
								}).then((isRedirect) => {
									if(isRedirect.isConfirmed) {
										window.location = urlToRedirect+"&point="+totalPoint;
									}
								})
							}
						}
						
						function declineBus(ev) {
							ev.preventDefault();
					
							var urlToRedirect = ev.currentTarget.getAttribute('href');
							
							var businessname = '<?php echo $loadBuss["businessname"];?>';
							var dclnMsg = $("#dclnMsg").val();
							
							if(dclnMsg.length == "") {
								swal.fire({
									title: "Error ",
									html: "Please state the reason why you want to decline this business",
									icon: "info"
								});
								
							} else if(dclnMsg.length < 10) {
								swal.fire({
									title: "Error ",
									html: "Message is too short",
									icon: "info"
								});
								
							} else {
								swal.fire({
									title: "Are you sure?",
									html: "You are about to decline this business (<b>"+businessname+"</b>) for a reason best known to You",
									icon: "warning",
									buttons: true,
									dangerMode: true,
									allowOutsideClick: false,
									showCancelButton: true,
									confirmButtonText: 'Proceed',
								}).then((isRedirect) => {
									if(isRedirect.isConfirmed) {
										window.location = urlToRedirect+"&&msg="+dclnMsg;
									}
								})
							}
						}
						
					</script>
					
				<?php } else if(isset($_REQUEST["txType"])) {

					
					switch($_REQUEST["txType"]) {
					
						case "approve":
							$payID =  base64_decode($_REQUEST["id"]);
							
							$loadBus = $action->query("select * from businessreview where id='$payID'"); $loadBus->execute();
							
							//Total amount as
							$reviewFee = $action->businesspoint()->review; //Set by admin...

							$point = $_REQUEST["point"];
									
							$totalPoint = $point / $action->search_setting("dollarNaira");
							
							if($loadBus->rowCount() > 0) {
								
								$loadBuss = $loadBus->fetch(PDO::FETCH_ASSOC);
								
								if($loadBuss["status"] == 1) { ?>
									<script>
										swal.fire({ 
											html: "<font size='5px'>Review already approved</font>", 
											icon: "error"
										}).then((isRedirect) => {
									
											if(isRedirect.isConfirmed) {
												window.location = 'pendingreviews'
											}
												
										});
									</script>
								<?php } else if($loadBuss["status"] == 0) {

									if($action->userLevel($userid) == 1 && $totalPoint > $reviewFee) {
										?>
										<script>
											// var earnValue = "<?php echo $point;?>";
											var earnValue = "<?php echo $totalPoint;?>";
											var allowedPoint = "<?php echo $reviewFee;?>";
											swal.fire({ 
												title: "Approval Error", 
												html: "Review was not approved because earning value <b>($"+earnValue+")</b> is greater than <b>$"+allowedPoint+"</b>", 
												icon: "error"
											}).then((isRedirect) => {
										
												if(isRedirect.isConfirmed) {
													window.location = 'pendingreviews'
												}
													
											});
										</script>
									<?php 
									} else {
									
									//How much does user has in wallet ?
									$currWallet = $action->userWallet($loadBuss["userid"]);
									$usd_amnt = $currWallet["usd"];
									
									$newAmnt = $usd_amnt + $totalPoint;
									
									//Credit the user wallet...
									$action->updateBlc($loadBuss["userid"], $newAmnt, "usd");
									
									$txid = mt_rand(11111, 99999).mt_rand(11111, 99999);
									$response = json_encode([
										"msg" => "Business review earning",
										"bus_review_id" => $payID,
										"ngnAmnt" => $point,
										"convRate" => $action->search_setting("dollarNaira"),
										"usdAmnt" => $totalPoint,
										"type" => "review"
									]);
									
									//Update the Review as approved
									$updtBus = $action->query("update businessreview set status=1, earnings='$totalPoint', dateApproved='".date("D j F, Y; h:i a")."' where id='$payID'"); $updtBus->execute();
									$crtTrans = $action->query("insert into transaction (userid, amount, transaction_id, type, status, dateCreated, dateUpdated, response, apprBy) values ('".$loadBuss["userid"]."', '$totalPoint', '$txid', 'earning', '1', '".date("D j F, Y; h:i a")."', '".date("D j F, Y; h:i a")."', '".addslashes($response)."', '".$userInfo["fullname"]."')"); 
									$crtTrans->execute();
									
									$message = "<html>
            <head>
                <title>Approval of Business Review</title>
            </head>
			<body style='background-color: #030f4f;'>
  <table border='0' cellpadding='0' cellspacing='0' width='100%' style='margin-top: 2%'>
    <tr>
      <td align='center' bgcolor='#030f4f'>
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
          <tr>
            <td align='left' bgcolor='#ffffff' style='padding: 36px 24px 0; font-family: Helvetica, Arial, sans-serif; border-top: 3px solid #264762;'>
              <h1 style='text-align: center; margin: 0; font-size: 36px; font-weight: 700; letter-spacing: -1px; line-height: 48px;'>9ja Business</h1>
              <h4 style='text-align: center; margin: 0; font-size: 20px; font-weight: 700; letter-spacing: -1px; line-height: 48px;'>Approval of Business Review!</h4>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td align='center' bgcolor='#030f4f'>
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
          <tr>
            <td align='left' bgcolor='#f5a21b' style='padding: 24px; font-family: Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;'>
              <p style='margin: 0;'>
				Hey <b>".$action->clientInfo($loadRevs["userid"])['fullname'].", </b> <br/> Your business review for ".$loadBuss["businessname"]." has been approved successfully and <b>$".number_format($totalPoint, 2)." has been credited to your wallet
				
				<br><br>Best Regards, 
				<br>9ja Business
				
			  </p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
	
    <tr>
      <td align='center' bgcolor='#030f4f' style='padding: 24px;'>
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
          <tr>
            <td align='center' bgcolor='#030f4f' style='padding: 12px 24px; font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;'>
              <p style='color: #fff; margin: 0;'>You received this email because you requested for it in-order to change your password</p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>";
						
$action->sendmail("Approved Business Review", "no-reply@9jabusiness.com", $action->clientInfo($loadRevs["userid"])['email'], $message);
									
									
										?>
										<script>
											swal.fire({ 
												html: "<font size='5px'>Review approved successfully</font>", 
												icon: "success"
											}).then((isRedirect) => {
										
												if(isRedirect.isConfirmed) {
													window.location = 'pendingreviews'
												}
													
											});
										</script>
									<?php 	
									
									}

								} else { ?>
									<script>
										swal.fire({ 
											html: "<font size='5px'>Review already declined</font>", 
											icon: "error"
										}).then((isRedirect) => {
									
											if(isRedirect.isConfirmed) {
												window.location = 'pendingreviews'
											}
												
										});
									</script>
								<?php }
								
							} else { ?>
							<script>
								swal.fire({ 
									html: "<font size='5px'>Review does not exists</font>", 
									icon: "error"
								}).then((isRedirect) => {
							
									if(isRedirect.isConfirmed) {
										window.location = 'pendingreviews'
									}
										
								});
							</script>
						<?php  }
						break;
						
						case "decline" :
						
							$declnMsg =  addslashes($_REQUEST["msg"]);
							$payID =  base64_decode($_REQUEST["id"]);
							$loadBus = $action->query("select * from businessreview where id='$payID'"); $loadBus->execute();
							
							if($loadBus->rowCount() > 0) {
								
								$loadBuss = $loadBus->fetch(PDO::FETCH_ASSOC);
								
								if($loadBuss["status"] == 1) { ?>
									<script>
										swal.fire({ 
											html: "<font size='5px'>Review already approved</font>", 
											icon: "error"
										}).then((isRedirect) => {
									
											if(isRedirect.isConfirmed) {
												window.location = 'pendingreviews'
											}
												
										});
									</script>
								<?php 
								} else if($loadBuss["status"] == 0) {
									
									//Update the business as approved
									$txid = mt_rand(11111, 99999).mt_rand(11111, 99999);
									$response = json_encode([
										"msg" => "Declination of Business review",
										"bus_id" => $loadBuss["bus_id"],
										"type" => "creation"
									]);
									
									//Update the review as declined
									$updtBus = $action->query("update businessreview set status=2, msg='$declnMsg', apprBy='".$userInfo["fullname"]."', dateApproved='".date("D j F, Y; h:i a")."' where id='$payID'"); $updtBus->execute();
									$crtTrans = $action->query("insert into transaction (userid, amount, transaction_id, type, status, dateCreated, dateUpdated, response, apprBy) values ('".$loadBuss["userid"]."', '0', '$txid', 'earning', '3', '".date("D j F, Y; h:i a")."', '".date("D j F, Y; h:i a")."', '".addslashes($response)."', '".$userInfo["fullname"]."')"); 
									$crtTrans->execute();
								 
									$message = "<html>
            <head>
                <title>Declined Business Review</title>
            </head>
			<body style='background-color: #030f4f;'>
  <table border='0' cellpadding='0' cellspacing='0' width='100%' style='margin-top: 2%'>
    <tr>
      <td align='center' bgcolor='#030f4f'>
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
          <tr>
            <td align='left' bgcolor='#ffffff' style='padding: 36px 24px 0; font-family: Helvetica, Arial, sans-serif; border-top: 3px solid #264762;'>
              <h1 style='text-align: center; margin: 0; font-size: 36px; font-weight: 700; letter-spacing: -1px; line-height: 48px;'>9ja Business</h1>
              <h4 style='text-align: center; margin: 0; font-size: 20px; font-weight: 700; letter-spacing: -1px; line-height: 48px;'>Declined Business Review!</h4>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td align='center' bgcolor='#030f4f'>
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
          <tr>
            <td align='left' bgcolor='#f5a21b' style='padding: 24px; font-family: Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;'>
              <p style='margin: 0;'>
				Hey <b>".$action->clientInfo($loadRevs["userid"])['fullname'].", </b> <br/> Your business review for ".$loadBuss["businessname"]." has been declined successfully
				
				<br><br>Best Regards, 
				<br>9ja Business
				
			  </p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
	
    <tr>
      <td align='center' bgcolor='#030f4f' style='padding: 24px;'>
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
          <tr>
            <td align='center' bgcolor='#030f4f' style='padding: 12px 24px; font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;'>
              <p style='color: #fff; margin: 0;'>You received this email because you requested for it in-order to change your password</p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>";
						
$action->sendmail("Declined Business Review", "no-reply@9jabusiness.com", $action->clientInfo($loadRevs["userid"])['email'], $message);
								 
								 
								 ?>
									<script>
										swal.fire({ 
											html: "<font size='5px'>Review declined successfully</font>", 
											icon: "success"
										}).then((isRedirect) => {
									
											if(isRedirect.isConfirmed) {
												window.location = 'pendingreviews'
											}
												
										});
									</script>
								<?php 
									
								} else { ?>
									<script>
										swal.fire({ 
											html: "<font size='5px'>Review already declined</font>", 
											icon: "error"
										}).then((isRedirect) => {
									
											if(isRedirect.isConfirmed) {
												window.location = 'pendingreviews'
											}
												
										});
									</script>
								<?php }
								
							} else { ?>
							<script>
								swal.fire({ 
									html: "<font size='5px'>Review does not exists</font>", 
									icon: "error"
								}).then((isRedirect) => {
							
									if(isRedirect.isConfirmed) {
										window.location = 'pendingreviews'
									}
										
								});
							</script>
						<?php  }
							
						break;
					
					}
				} else { ?>
				<div class="table-responsive">
					<table class="table table-bordered">
						<tr>
							<td>S/N</td>
							<td>User Info</td>
							<td>Business Name</td>
							<td>Reviewed By</td>
							<td></td>
						</tr>
						<tr>
							<?php $i = 1;
							$loadRev = $action->query("select * from businessreview where status=0 order by id desc limit $start_page, $per_page"); $loadRev->execute();
							while($loadRevs = $loadRev->fetch(PDO::FETCH_ASSOC)) {
								$mainBus = $action->query("select * from businesscreation where id='".$loadRevs["bus_id"]."'"); $mainBus->execute();
								$mainBuss = $mainBus->fetch(PDO::FETCH_ASSOC);
								?>
							<td><?php echo $i++;?></td>	
							<td>
								<?php echo $action->clientInfo($mainBuss["userid"])["fullname"];?> <br>
								<b style="color: gold"><?php echo $action->clientInfo($mainBuss["userid"])["email"];?> <br>
							</td>
							<td>
								<?php echo $mainBuss["businessname"];?> <br>
								<b style="color: gold"><?php echo $mainBuss["founder"];?> <br>
							</td>
							<td>
								<?php echo $action->clientInfo($loadRevs["userid"])["fullname"];?> <br>
								<b style="color: gold"><?php echo $action->clientInfo($loadRevs["userid"])["email"];?></b> <br>
								<b style="color: #f5a21b">Date Created : </b> <?php echo $loadRevs["dateCreated"];?> <br>
							</td>
							<td>
								<a href="?viewReview=<?php echo base64_encode($loadRevs["id"]);?>" class="btn btn-info"> View</a> 
							</td>
						</tr>
							<?php } ?>
							
					</table>
		  
					<div class="text-center" style="margin-top: 2%">
						<?php echo $action->paginate("", "select * from businessreview where status=0 order by id desc");?>
					</div>
				</div>
				
				<?php } ?>
				
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