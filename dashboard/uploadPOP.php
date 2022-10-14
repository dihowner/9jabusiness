<?php
require "../action.php"; $action = new Action();
$userid = $_SESSION["username"];
$userWallet = $action->userWallet($userid);

//Is user having a pending payment...
$srchPay = $action->query("select * from payment where userid='$userid' and walletID!='' and attachment is NULL limit 1"); $srchPay->execute();

if(empty($action->clientID($userid)) || !isset($userid)) {
    session_destroy();
    $action->redirect_to("../login");
} else if($srchPay->rowCount() > 0) {
    #$action->redirect_to("uploadPOP");
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
  <title>9jaBusiness - Upload Payment Receipt</title>
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
			   <div class="card-title" style="font-size: 20px">Upload Proof of Payment</div>
			   <p style="font-size: 18px; displays: none">Kindly follow the instruction below and upload proof of payment</p>
			 </div>
         </div>
      </div>

    </div><!--End Row-->

	<!--start overlay-->
		  <div class="overlay toggle-menu"></div>
		<!--end overlay-->

    </div>
    <!-- End container-fluid-->
		<div class="col">
		<div class="row row-cols-1 row-cols-lg-3">
			<div class="col-sm-12">
			<div class="col-sm-12" style="font-size: 20px">
			
				<?php
				
				$srchPays = $srchPay->fetch(PDO::FETCH_ASSOC);
				
				if(isset($_POST["uploadPOP"])) {
					$payID = $srchPays["id"];
					$fileName = strtolower($_FILES["fileupload"]["name"]);
					$fileName_tmp = $_FILES["fileupload"]["tmp_name"];
					
					$extension = strtolower(pathinfo($fileName)["extension"]);
					
					$allowed_extension = array("jpg", "png", "jpeg", "bmp");
					$folder = "../uploads/proof/";
					
					if(empty($fileName_tmp)) { ?>
						<div class="alert-danger" style="padding: 15px; margin-bottom: 10px"><b> Error: </b> Invalid file selected</div>
					<?php } else if(!in_array($extension, $allowed_extension)) { ?>
						<div class="alert alert-danger" style="padding: 15px; margin-bottom: 10px"><b> Error: </b> Invalid file extension <b>(<?php echo $extension;?>)</b> selected</div>
					<?php } else if($_FILES["fileupload"]["size"] > 5120000) { ?>
						<div class="alert alert-danger" style="padding: 15px; margin-bottom: 10px"><b> Error: </b> File is too large, maximum of 5mb</div>
					<?php } else {
						
						$join = $folder . $fileName;
						
						// if(move_uploaded_file($fileName_tmp, $join)) {
						if($action->compressImage($fileName_tmp, $join, 60)) { //Reduce the image size and upload...
							$fileName = "proof/".$fileName;
							$updtFile = $action->query("update payment set attachment='$fileName', status='5' where id='$payID'"); 
							$updtFile->execute(); ?>
							<script>
								alert("Upload was successful");
								window.location = "index";
							</script>
						<?php } else { ?>
							<div class="alert-danger" style="padding: 15px; margin-bottom: 10px"><b> Error: </b> Unable to upload proof of payment</div>
						<?php }
					}
					
				}
				
				$planID = $srchPays["planID"];
				
				$srchPlan = $action->query("select * from plans where id='$planID'"); $srchPlan->execute();
				$srchPlans = $srchPlan->fetch(PDO::FETCH_ASSOC);
				
				switch($srchPays["currency"]) {
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
				
				<b>Plan Name:  </b><?php echo $srchPlans["name"];?> <br>
				<b>Amount:  </b><?php echo number_format($srchPlans["price"], 2);?> <br>
				<b>Currency Type:  </b><?php echo $curr_type;?> <br>
				<b>Pay To:  </b><?php echo $srchPays["walletID"];?> <br>
				<hr> After payment, ensure to screenshot and upload the proof of payment for payment approval and plan activation 
				<form method="post" enctype="multipart/form-data">
					
					<label><b>Select File</b></label>
					<input type="file" class="form-control" placeholder="Select file" required name="fileupload" />
					<br>
					<b style="color: red">NOTE : </b> Maximum of 5mb  and only jpg, jpeg, png and bmp files are allowed 
					<br>
					<button class="btn btn-primary" type="submit" name="uploadPOP"><b>Upload Proof</b></button>
				</form>
			
			</div>
		</div>
		
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
