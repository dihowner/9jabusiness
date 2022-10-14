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
	$clientInfo = $action->clientInfo($userid);
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
  <title>9jaBusiness - Pending Payment </title>
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
				
			<div class="card-header">Payment Pending Approval</div>
			
			<?php if(isset($_REQUEST["loadPay"])) { 
				$paymentID = base64_decode($_REQUEST["loadPay"]);
				$loadPay = $action->query("select * from payment where id='$paymentID'"); $loadPay->execute();
				$loadPays = $loadPay->fetch(PDO::FETCH_ASSOC);
				
				switch($loadPays["currency"]) {
					case "eth":
						$curr_type = "Ethereum";
					break;
					case "btc":
						$curr_type = "Bitcoin";
					break;
					case "tron":
						$curr_type = "Tron";
					break;
					case "paypal":
						$curr_type = "Paypal";
					break;
				}
				
				$srchPlan = $action->query("select * from plans where id='".$loadPays["planID"]."'"); $srchPlan->execute();
				$srchPlans = $srchPlan->fetch(PDO::FETCH_ASSOC);
			?>
			
				
				<div class="row">
					<div class="col-lg-12">
						<div class="msg_cell">
							<b>Client Name : </b> <?php echo $action->clientInfo($loadPays["userid"])["fullname"];?>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-lg-6">
						<div class="msg_cell">
							<b>Client Email : </b> <?php echo $action->clientInfo($loadPays["userid"])["email"];?>
						</div>
					</div>
					
					<div class="col-lg-6">
						<div class="msg_cell">
							<b>Amout : </b> <?php echo number_format($loadPays["amount"], 2);?>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-lg-6">
						<div class="msg_cell">
							<b>Currency : </b> <?php echo $curr_type;?>
						</div>
					</div>
					
					<div class="col-lg-6">
						<div class="msg_cell">
							<b>Plan Name : </b> <?php echo $srchPlans["name"];?>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-lg-6">
						<div class="msg_cell">
							<b>Business Creation : </b> <?php echo $srchPlans["bus_no"];?>
						</div>
					</div>
					
					<div class="col-lg-6">
						<div class="msg_cell">
							<b>Business Review : </b> <?php echo $srchPlans["bus_review"];?>
						</div>
					</div>
				</div>
				
				<div class="row" style="margin-bottom: 2%">
					<div class="col-lg-12" style="margin: 12px">
						<label><b>Attachment</b></label> <small style="color: gold; font-size: 14px">Click on the image for larger view</small>
						<br><br>
						
						<a href="../uploads/<?php echo $loadPays["attachment"];?>" target="_blank">
							<img src="../uploads/<?php echo $loadPays["attachment"];?>" style="width: 280px; height: 200px;" class="img img-responsive"/>
						</a>
					</div>
				</div>
				
				<div class="row" style="margin-bottom: 2%">
					<div class="col-lg-12 text-center" style="margin: 12px">
						<a class="btn btn-success btn-lg" href="?txType=approve&id=<?php echo $paymentID;?>" onclick="confirmPay(event)" style="margin-bottom: 10px"><b>Approve</b></a>
						<a class="btn btn-danger btn-lg" href="?txType=decline&id=<?php echo $paymentID;?>" onclick="declinePay(event)" style="margin-bottom: 10px"><b>Decline</b></a>
					</div>
				</div>
				
				<br><br>
				
				<script>
				function confirmPay(ev) {
					ev.preventDefault();
					
					var urlToRedirect = ev.currentTarget.getAttribute('href');
					
					var currency = '<?php echo strtoupper($loadPays["currency"]);?>';
					var walletID = '<?php echo $loadPays["walletID"];?>';
					var amount = '<?php echo number_format($loadPays["amount"], 2);?>';
					var planName = '<?php echo strtoupper($srchPlans["name"]);?>';
					
					swal.fire({
						title: "Are you sure?",
						html: "You are about to approve <b>"+amount+ " "+currency +"</b> which was paid into the wallet address <b>"+walletID +"</b> for the activation of <b>"+planName+"</b>",
						icon: "warning",
						buttons: true,
						dangerMode: true,
						allowOutsideClick: false,
						showCancelButton: true,
						confirmButtonText: 'Approve Payment',
					}).then((isRedirect) => {
						
						if(isRedirect.isConfirmed) {
							
							window.location = urlToRedirect;
						} else { 
							//Show or Do Nothing... 
						}
					});
				}
				
				function declinePay(ev) {
					ev.preventDefault();
					
					var urlToRedirect = ev.currentTarget.getAttribute('href');
					
					var currency = '<?php echo strtoupper($loadPays["currency"]);?>';
					var walletID = '<?php echo $loadPays["walletID"];?>';
					var amount = '<?php echo number_format($loadPays["amount"], 2);?>';
					var planName = '<?php echo strtoupper($srchPlans["name"]);?>';
					
					swal.fire({
						title: "Are you sure?",
						html: "You are about to decline <b>"+amount+ " "+currency +"</b> which was paid into the wallet address <b>"+walletID +" <br/> Once declined, action is irreversible",
						icon: "warning",
						buttons: true,
						dangerMode: true,
						allowOutsideClick: false,
						showCancelButton: true,
						confirmButtonText: 'Decline Payment',
					}).then((isRedirect) => {
						
						if(isRedirect.isConfirmed) {
							
							window.location = urlToRedirect;
						} else { 
							//Show or Do Nothing... 
						}
					});
					
				}
				
				</script>
				
			<?php } else if(isset($_REQUEST["txType"])) { 
				
				switch($_REQUEST["txType"]) {
					
					case "approve":
						
						$payID = $_REQUEST["id"];
				
						$loadPay = $action->query("select * from payment where id='$payID' and status=5"); $loadPay->execute();
						
						if($loadPay->rowCount() > 0) {
						
							$loadPays = $loadPay->fetch(PDO::FETCH_ASSOC);
							$userid_pay = $loadPays["userid"];
							$transaction_id = $loadPays["transaction_id"];
					
							$srchPlan = $action->query("select * from plans where id='".$loadPays["planID"]."'"); $srchPlan->execute();
							$srchPlans = $srchPlan->fetch(PDO::FETCH_ASSOC);
	
							//Has referral earns his commission... ?
							$chkRef = $action->query("select * FROM `referral` where clientReferred='$userid_pay' and pointRcv='NO'"); $chkRef->execute();
							
							//Referral Commission...
							if($chkRef->rowCount() > 0) { // Referral is yet to be paid...
								$chkRefs = $chkRef->fetch(PDO::FETCH_ASSOC);
								$IRefer = $chkRefs["userID"];
								
								$amount = $loadPays["amount"];
								
								if($srchPlans["refComm"] > 0) { //Plan referral commission is set 
									$refPercent = (($amount * $srchPlans["refComm"])/100);
								} else {
									$refPercent = (($amount * $action->search_setting("refComm"))/100);
								}
								
								$updtRef = $action->query("insert into transaction (userid, amount, transaction_id, reference_id, response, status, type, dateCreated, dateUpdated, apprBy) values ('$IRefer', '$refPercent', '$txid', '".$_REQUEST["txid"]."', 'Referral bonus credited', '1', 'referral', '$timed', '$timed', '".$clientInfo["fullname"]."')"); 
								$updtRef->execute();
								
								//We need to credit the Referral wallet...
								$currWallet = $action->userWallet($IRefer);
								$usd_amnt = $currWallet["usd"];
								
								$newAmnt = $usd_amnt + $refPercent;
								
								$action->updateBlc($IRefer, $newAmnt, "usd");
								
							}
							
							$updatePay = $action->query("update payment set status=1 where id='$payID'"); $updatePay->execute();
							$updTran = $action->query("update transaction set status=1, apprBy='".$clientInfo["fullname"]."' where transaction_id='$transaction_id'"); 
							$updTran->execute();
							$updateUsr = $action->query("update users set planID='".$srchPlans["id"]."' where id='$userid_pay'"); $updateUsr->execute();
													
							?>
							<script>
								swal.fire({ html: "<font size='5px'>Payment approved successfully and plan activated</font>", icon: "success"})
								.then((isRedirect) => {
							
									if(isRedirect.isConfirmed) {
										window.location = 'pendpayments'
									}
										
								});
							</script>
						<?php } else { ?>
							<script>
								swal.fire({ html: "<font size='5px'>Payment already approved or does not exist</font>", icon: "error"})
								.then((isRedirect) => {
							
									if(isRedirect.isConfirmed) {
										window.location = 'pendpayments'
									}
										
								});
							</script>
						<?php  }
					break;
					
					case "decline":
					
						$payID = $_REQUEST["id"];
				
						$loadPay = $action->query("select * from payment where id='$payID' and status=5"); $loadPay->execute();
						$loadPays = $loadPay->fetch(PDO::FETCH_ASSOC);
						$transaction_id = $loadPays["transaction_id"];
						
						$updTran = $action->query("update transaction set status=3, apprBy='".$clientInfo["fullname"]."' where transaction_id='$transaction_id'"); 
						$updTran->execute();
				
						$updatePay = $action->query("update payment set status=3 where id='$payID'"); $updatePay->execute();
						?>
							<script>
								swal.fire({ html: "<font size='5px'>Payment declined successfully</font>", icon: "error"})
								.then((isRedirect) => {
							
									if(isRedirect.isConfirmed) {
										window.location = 'pendpayments'
									}
										
								});
							</script>
						<?php
					break;
					
				}
				
			} else { ?>
			
			<div class="card-body">
				
				<div class="table-responsive">
					<table class="table table-bordered">
						<tr>
							<td>S/N</td>
							<td>User Info</td>
							<td>Description</td>
							<td>Currency Used</td>
							<td></td>
						</tr>
						<tr>
						<?php $i = 1;
						$loadPay = $action->query("select * from payment where status=5 order by id desc limit $start_page, $per_page"); $loadPay->execute();
						while($loadPays = $loadPay->fetch(PDO::FETCH_ASSOC)) {
								
								$planID = $loadPays["planID"];
								
								$srchPlan = $action->query("select * from plans where id='$planID'"); $srchPlan->execute();
								$srchPlans = $srchPlan->fetch(PDO::FETCH_ASSOC);
								
								switch($loadPays["currency"]) {
									case "eth":
										$curr_type = "Ethereum";
									break;
									case "btc":
										$curr_type = "Bitcoin";
									break;
									case "tron":
										$curr_type = "Tron";
									break;
									case "paypal":
										$curr_type = "Paypal";
									break;
								}
								
							?>
							
							<td><?php echo $i++;?></td>
							<td>
								<?php echo $action->clientInfo($loadPays["userid"])["fullname"];?> <br>
								<b style="color: gold"><?php echo $action->clientInfo($loadPays["userid"])["email"];?> <br>
							</td>
							<td>
								<b style="color: #00FFFF">Amount Paid : <?php echo $loadPays["amount"];?> </b><br>
								<b style="color: gold">Plan Name : <?php echo $srchPlans["name"];?> <br>
							</td>
							<td>
								<?php echo $curr_type;?><br>
								<b style="color: #00FFFF">Paid To : <?php echo $loadPays["walletID"];?> </b>
							</td>
							<td>
								<a href="?loadPay=<?php echo base64_encode($loadPays["id"]);?>" id="btn_load" class="btn btn-info"> View</a> 
							</td>
								</tr>
						<?php } ?>
					</table>
		  
					<div class="text-center" style="margin-top: 2%">
						<?php echo $action->paginate("", "select * from payment where status=5 order by id desc");?>
					</div>
					
				</div>
				
			</div>
	
			<?php } ?>
	
			
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