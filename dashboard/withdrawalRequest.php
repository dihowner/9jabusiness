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
  <title>Withdrawal Request - Admin Menu</title>
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
				<div class="card-header" style="font-size: 20px">Pending Withdrawal Request</div>
				
				<?php 
				if(isset($_REQUEST["viewBus"])) {
					
					$busID = base64_decode($_REQUEST["viewBus"]);
					$loadBus = $action->query("select * from withdrawal where id='$busID'"); $loadBus->execute();
					$loadBuss = $loadBus->fetch(PDO::FETCH_ASSOC);
					
					$address = json_decode($loadBuss["address"]);
					
					?>
					
					<div class="row">
						<div class="col-lg-6">
							<div class="msg_cell">
								<b>Client Name : </b> <?php echo $action->clientInfo($loadBuss["userid"])["fullname"];?>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="msg_cell">
								<b>Client Email : </b> <?php echo $action->clientInfo($loadBuss["userid"])["email"];?>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="msg_cell">
								<b>Amount : </b> 
								
								<?php if($loadBuss["type"] == "bank") { 
									$amnt = "&#8358;".number_format($address->amountNaira, 2);
								?>
									&dollar;<?php echo number_format($loadBuss["amount"], 2);?> (&#8358;<?php echo number_format($address->amountNaira, 2);?>) 
								<?php } else { 
									$amnt = number_format($loadBuss["amount"], 2).strtoupper($loadBuss["type"]);
									echo number_format($loadBuss["amount"], 2).strtoupper($loadBuss["type"]);?> <br/>
								<?php }
								
								?>
								
							</div>
						</div>
						
						<?php if($loadBuss["type"] == "bank") { ?>
						
							<div class="col-lg-6">
								<div class="msg_cell">
									<b>Bank Name : </b> <?php echo $address->bankName;?>
								</div>
							</div>
						
							<div class="col-lg-6">
								<div class="msg_cell">
									<b>Account Name : </b> <?php echo $address->accName;?>
								</div>
							</div>
						
							<div class="col-lg-6">
								<div class="msg_cell">
									<b>Account Number : </b> <?php echo $address->accNo;?>
								</div>
							</div>
						<?php } else { ?>
							
							<div class="col-lg-6">
								<div class="msg_cell">
									<b>Wallet Address : </b> <?php echo $address->wallet;?>
								</div>
							</div>
							
						<?php } ?>
						
							<div class="col-lg-12">
								<div class="col-lg-12">
									<label>Reason for declining</label>
									<textarea class="form-control" id='dclnMsg' name='dclnMsg' placeholder="Reason for declining this withdrawal request"></textarea>
								</div>
							</div>
							
					</div>
					
				
					<div class="row" style="margin-bottom: 2%">
						<div class="col-lg-12 text-center" style="margin: 12px">
							<a class="btn btn-success btn-lg" href="?txType=approve&id=<?php echo $_REQUEST["viewBus"];?>" onclick="apprBus(event)" style="margin-bottom: 10px"><b>Approve</b></a>
							<a class="btn btn-danger btn-lg" href="?txType=decline&id=<?php echo $_REQUEST["viewBus"];?>" onclick="declineBus(event)" style="margin-bottom: 10px"><b>Decline</b></a>
						</div>
					</div>
					
					<script>
						function apprBus(ev) {
							ev.preventDefault();
					
							var urlToRedirect = ev.currentTarget.getAttribute('href');
							
							var amount = '<?php echo $amnt;?>';
							var walletAddr = "<?php echo $address->wallet;?>";
							var type = '<?php echo $loadBuss["type"];?>';
							var bankName = '<?php echo $address->bankName;?>';
							var accName = '<?php echo $address->accName;?>';
							var accNo = '<?php echo $address->accNo;?>';
							
							if(type == "bank") {
								swal.fire({
									title: "Are you sure?",
									html: "Confirm that <b>"+amount+"</b> was paid into the bank account details below <br><br>Bank Name : <b>"+bankName+"</b> <br>Account Name : <b>"+accName+"</b> <br>Account Number : <b>"+accNo+"</b> <br>",
									icon: "warning",
									buttons: true,
									dangerMode: true,
									allowOutsideClick: false,
									showCancelButton: true,
									confirmButtonText: 'Proceed',
								}).then((isRedirect) => {
									if(isRedirect.isConfirmed) {
										window.location = urlToRedirect;
									}
								})
							} else {
								swal.fire({
									title: "Are you sure?",
									html: "Confirm that <b>"+amount+"</b> was paid into the wallet address <b>"+walletAddr+"</b>",
									icon: "warning",
									buttons: true,
									dangerMode: true,
									allowOutsideClick: false,
									showCancelButton: true,
									confirmButtonText: 'Proceed',
								}).then((isRedirect) => {
									if(isRedirect.isConfirmed) {
										window.location = urlToRedirect;
									}
								})
							}
						}
						
						function declineBus(ev) {
							ev.preventDefault();
					
							var urlToRedirect = ev.currentTarget.getAttribute('href');
							var dclnMsg = $("#dclnMsg").val();
							
							if(dclnMsg.length == "") {
								swal.fire({
									title: "Error ",
									html: "Please state the reason why you want to decline this withdrawal request",
									icon: "info"
								});
								
							} else if(dclnMsg.length < 10) {
								swal.fire({
									title: "Error ",
									html: "Decline message is too short",
									icon: "info"
								});
								
							} else {
								swal.fire({
									title: "Are you sure?",
									html: "You are about to decline this withdrawal request for a reason best known to You",
									icon: "warning",
									buttons: true,
									dangerMode: true,
									allowOutsideClick: false,
									showCancelButton: true,
									confirmButtonText: 'Proceed',
								}).then((isRedirect) => {
									if(isRedirect.isConfirmed) {
										window.location = urlToRedirect+"&msg="+dclnMsg;
									}
								})
							}
						}
						
					</script>
					
				<?php } else if(isset($_REQUEST["txType"])) {

					switch($_REQUEST["txType"]) {
					
						case "approve":
							$payID =  base64_decode($_REQUEST["id"]);
				
							$loadBus = $action->query("select * from withdrawal where id='$payID'"); $loadBus->execute();
							
							if($loadBus->rowCount() > 0) {
								
								$loadBuss = $loadBus->fetch(PDO::FETCH_ASSOC);
								
								if($loadBuss["status"] == 1) { ?>
									<script>
										swal.fire({ html: "<font size='5px'>Withdrawal already approved</font>", icon: "error"})
										.then((isRedirect) => {
									
											if(isRedirect.isConfirmed) {
												window.location = 'withdrawalRequest'
											}
												
										});
									</script>
								<?php } else if($loadBuss["status"] == 0) {
									
									//Update the business as approved
									$updtBus = $action->query("update withdrawal set status=1, dateApproved='".date("D j F, Y; h:i a")."' where id='$payID'"); 
									$updtBus->execute();
									
									//Update the business as approved
									$updtTran = $action->query("update transaction set status=1, dateUpdated='".date("D j F, Y; h:i a")."' where transaction_id='".$loadBuss["transaction_id"]."'"); 
									$updtTran->execute();
								 
									$message = "<html>
            <head>
                <title>Approval of Withdrawal Request!</title>
            </head>
			<body style='background-color: #030f4f;'>
  <table border='0' cellpadding='0' cellspacing='0' width='100%' style='margin-top: 2%'>
    <tr>
      <td align='center' bgcolor='#030f4f'>
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
          <tr>
            <td align='left' bgcolor='#ffffff' style='padding: 36px 24px 0; font-family: Helvetica, Arial, sans-serif; border-top: 3px solid #264762;'>
              <h1 style='text-align: center; margin: 0; font-size: 36px; font-weight: 700; letter-spacing: -1px; line-height: 48px;'>9ja Business</h1>
              <h4 style='text-align: center; margin: 0; font-size: 20px; font-weight: 700; letter-spacing: -1px; line-height: 48px;'>Approval of Withdrawal Request!</h4>
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
				Hey <b>".$action->clientInfo($loadBuss["userid"])['fullname'].", </b> <br/> Your withdrawal request of <b>$".$loadBuss["amount"]."</b> has been approved and paid successfully
				
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
						
$action->sendmail("Successful Withdrawal Payment", "no-reply@9jabusiness.com", $action->clientInfo($loadBuss["userid"])['email'], $message);						
								 
								 ?>
									<script>
										swal.fire({ html: "<font size='5px'>Withdrawal approved successfully</font>", icon: "success"})
										.then((isRedirect) => {
									
											if(isRedirect.isConfirmed) {
												window.location = 'withdrawalRequest'
											}
												
										});
									</script>
								<?php 
								
								} else { ?>
									<script>
										swal.fire({ html: "<font size='5px'>Withdrawal already declined</font>", icon: "error"})
										.then((isRedirect) => {
									
											if(isRedirect.isConfirmed) {
												window.location = 'withdrawalRequest'
											}
												
										});
									</script>
								<?php }
								
							} else { ?>
							<script>
								swal.fire({ html: "<font size='5px'>Withdrawal does not exists</font>", icon: "error"})
								.then((isRedirect) => {
							
									if(isRedirect.isConfirmed) {
										window.location = 'withdrawalRequest'
									}
										
								});
							</script>
						<?php  }
							
						break;
						
						case "decline" :
						
							$declnMsg =  addslashes($_REQUEST["msg"]);
							$payID =  base64_decode($_REQUEST["id"]);
							$loadBus = $action->query("select * from withdrawal where id='$payID'"); $loadBus->execute();
							
							if($loadBus->rowCount() > 0) {
								
								$loadBuss = $loadBus->fetch(PDO::FETCH_ASSOC);
								
								if($loadBuss["status"] == 1) { ?>
									<script>
										swal.fire({ html: "<font size='5px'>Withdrawal already approved</font>", icon: "error"})
										.then((isRedirect) => {
									
											if(isRedirect.isConfirmed) {
												window.location = 'withdrawalRequest'
											}
												
										});
									</script>
								<?php 
								} else if($loadBuss["status"] == 0) {
									
									//We need to credit the user back, How much does user has in wallet ?
									$currWallet = $action->userWallet($loadBuss["userid"]);
									$usd_amnt = $currWallet["usd"];
									
									$newAmnt = $usd_amnt + $loadBuss["amount"];
									
									//Credit the user wallet...
									$action->updateBlc($loadBuss["userid"], $newAmnt, "usd");
									
									$txID = mt_rand(111111, 999999).mt_rand(111111, 999999);
									
									$response = json_encode(["msg" => "Reversal of withdrawal request",
										"type" => "reversal",
										"method" => $loadBuss["type"]									
									]);
									
									//Save the transaction record...
									$saveTrn = $action->query("insert into transaction (userid, amount, transaction_id, response, type, status, apprBy, dateCreated, dateUpdated) values ('".$loadBuss["userid"]."', '".$loadBuss["amount"]."', '$txID', '".addslashes($response)."', 'reversal', '1', '".$action->clientname($userid)."', '".date("D j F, Y; h:i a")."', '".date("D j F, Y; h:i a")."')");
									$saveTrn->execute();
									
									//Update the transaction as declined
									$updtTran = $action->query("update transaction set dateUpdated='".date("D j F, Y; h:i a")."', status=2 where transaction_id='".$loadBuss["transaction_id"]."'"); $updtTran->execute();
								 
									//Update the withdrawal as declined
									$updtWdr = $action->query("update withdrawal set status=2, msg='$declnMsg', dateApproved='".date("D j F, Y; h:i a")."' where id='$payID'"); $updtWdr->execute();
								 
								 
									$message = "<html>
            <head>
                <title>Declined Withdrawal Request</title>
            </head>
			<body style='background-color: #030f4f;'>
  <table border='0' cellpadding='0' cellspacing='0' width='100%' style='margin-top: 2%'>
    <tr>
      <td align='center' bgcolor='#030f4f'>
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
          <tr>
            <td align='left' bgcolor='#ffffff' style='padding: 36px 24px 0; font-family: Helvetica, Arial, sans-serif; border-top: 3px solid #264762;'>
              <h1 style='text-align: center; margin: 0; font-size: 36px; font-weight: 700; letter-spacing: -1px; line-height: 48px;'>9ja Business</h1>
              <h4 style='text-align: center; margin: 0; font-size: 20px; font-weight: 700; letter-spacing: -1px; line-height: 48px;'>Declined Withdrawal Request!</h4>
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
				Hey <b>".$action->clientInfo($loadBuss["userid"])['fullname'].", </b> <br/> Your withdrawal request of <b>$".$loadBuss["amount"]."</b> has been declined, kindly contact admin
				
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
						
$action->sendmail("Declined Withdrawal Payment", "no-reply@9jabusiness.com", $action->clientInfo($loadBuss["userid"])['email'], $message);	
								 
								 ?>
									<script>
										swal.fire({ html: "<font size='5px'>Withdrawal declined successfully</font>", icon: "success"})
										.then((isRedirect) => {
									
											if(isRedirect.isConfirmed) {
												window.location = 'withdrawalRequest'
											}
												
										});
									</script>
								<?php 
									
								} else { ?>
									<script>
										swal.fire({ html: "<font size='5px'>Withdrawal already declined</font>", icon: "error"})
										.then((isRedirect) => {
									
											if(isRedirect.isConfirmed) {
												window.location = 'withdrawalRequest'
											}
												
										});
									</script>
								<?php }
							} else { ?>
							<script>
								swal.fire({ html: "<font size='5px'>Business does not exists</font>", icon: "error"})
								.then((isRedirect) => {
							
									if(isRedirect.isConfirmed) {
										window.location = 'withdrawalRequest'
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
							<td>Description</td>
							<td></td>
						</tr>
						<tr>
							<?php $i = 1;
							$loadBus = $action->query("select * from withdrawal where status=0 order by id desc limit $start_page, $per_page"); $loadBus->execute();
							while($loadBuss = $loadBus->fetch(PDO::FETCH_ASSOC)) {
									$address = json_decode($loadBuss["address"] , true);
									switch($loadBuss["type"]) {
										case "edt":
											$curr_type = "Edeposite Coin";
										break;
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
								<?php echo $action->clientInfo($loadBuss["userid"])["fullname"];?> <br>
								<b style="color: gold"><?php echo $action->clientInfo($loadBuss["userid"])["email"];?> </b>
							</td>
							<td>
								<?php if($loadBuss["type"] == "bank") { ?>
									&#8358;<?php echo number_format($address["amountNaira"], 2);?> <br/>
									&dollar;<?php echo number_format($loadBuss["amount"], 2);?> <br/>
									<b style="color: gold">Currency : Naira </b><br>
								<?php } else { ?>
									<?php echo number_format($loadBuss["amount"], 2).strtoupper($loadBuss["type"]);?> <br/>
									<b style="color: gold">Currency : <?php echo $curr_type;?> </b><br>
								<?php } ?>
							</td>
							<td>
								<a href="?viewBus=<?php echo base64_encode($loadBuss["id"]);?>" class="btn btn-info"> View</a> 
							</td>
						</tr>
							<?php } ?>
							
					</table>
		  
					<div class="text-center" style="margin-top: 2%">
						<?php echo $action->paginate("", "select * from withdrawal where status=0 order by id desc");?>
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