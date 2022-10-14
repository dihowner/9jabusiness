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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>9jaBusiness - Upload Business</title>
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
           <div class="card-title" style="font-size: 20px">Upload Business</div>
           <p style="font-size: 18px;">Your wallet balance is <b>&dollar;<?php echo number_format($action->userWallet($userid)["usd"], 2);?></b></p>
           <hr>
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
				
			if(isset($_POST["uploadBusiness"])) {
				
				$business_name = addslashes(ucwords($_POST["business_name"]));
				$address = addslashes($_POST["address"]);
				$business_category = addslashes($_POST["business_category"]);
				$business_site = addslashes($_POST["business_site"]);
				$person_in_charge = addslashes(ucwords($_POST["person_in_charge"]));
				$phone = addslashes($_POST["phone"]);
				
				if(!empty($_POST["establishment_date"])) {
					$establishment_date = date("Y-m-d", strtotime($_POST["establishment_date"]));
				} else { $establishment_date = ''; }
				
				$working_hour = addslashes($_POST["working_hour"]);
				$description = addslashes($_POST["description"]);
								
				//Logo...
				if(!empty($_FILES["office_building"]["name"])) { //Not a compulsory field...
					$business_logo_name = $_FILES["business_logo"]["name"];
					$business_logo_tmp_name = $_FILES["business_logo"]["tmp_name"];
					$business_logo_size = $_FILES["business_logo"]["size"];
					$business_logo_extension = strtolower(pathinfo($business_logo_name)["extension"]);
				} else { $business_logo_name = ''; }
				
				if(!empty($_FILES["office_building"]["name"])) { //Not a compulsory field...
					$office_building_name = $_FILES["office_building"]["name"];
					$office_building_tmp_name = $_FILES["office_building"]["tmp_name"];
					$office_building_size = $_FILES["office_building"]["size"];
					$office_building_extension = strtolower(pathinfo($office_building_name)["extension"]);
				} else { $office_building_name = ''; }
				
				// Valid extension
				$valid_ext = array('png','jpeg','jpg');
				
				//Folder to upload to...
				$folder = "../uploads/business/";
				
				//We need to check how many business user can create in a day based on the plan he/she is using...
				$userPlan_id = $userInfo["planID"];
				
				//Check plan table...
				$srchPlan = $action->query("select * from plans where id='$userPlan_id'"); $srchPlan->execute();
				$srchPlans = $srchPlan->fetch(PDO::FETCH_ASSOC);
				$no_business_to_create = $srchPlans["bus_no"];
				
				//We need to check if user has created any business today...
				$todaysDate = date("D j F, Y");
				$busExist = $action->query("select * from businesscreation where businessname='$business_name'"); $busExist->execute();
				$srchBusiness = $action->query("select * from businesscreation where userid='$userid' and status!=2 and dateCreated like '%$todaysDate%'"); $srchBusiness->execute();
				
				
				if($srchBusiness->rowCount() == $no_business_to_create) { //Check if the Business logo extension is
				?>
					<div class="alert-danger" style="padding: 15px; margin-bottom: 10px"><b> Error: </b> You have used up your daily business creation limit (Maximum of <?php echo $no_business_to_create;?> businesses daily)</div>
				<?php } else if($busExist->rowCount() > 0) { //Business exists
				?>
					<div class="alert-danger" style="padding: 15px; margin-bottom: 10px"><b> Error: </b> Business name already exists</div>
				<?php } else if(!in_array($business_logo_extension, $valid_ext) && !empty($business_logo_name)) { //Check if the Business logo extension is
				?>
					<div class="alert-danger" style="padding: 15px; margin-bottom: 10px"><b> Error: </b> Invalid file extension (<?php echo $business_logo_extension;?>) uploaded for business logo</div>
				<?php } else if(!in_array($office_building_extension, $valid_ext) && !empty($office_building_name)) { ?>
					<div class="alert-danger" style="padding: 15px; margin-bottom: 10px"><b> Error: </b> Invalid file extension (<?php echo $business_logo_extension;?>) uploaded for office building </div>
				<?php } else if($business_logo_size > 5120000) { ?>
					<div class="alert alert-danger" style="padding: 15px; margin-bottom: 10px"><b> Error: </b> File is too large, maximum of 5mb required for business logo</div>
				<?php } else if($office_building_size > 5120000 && !empty($office_building_name)) { ?>
					<div class="alert alert-danger" style="padding: 15px; margin-bottom: 10px"><b> Error: </b> File is too large, maximum of 5mb required for office building</div>
				<?php } else {
						
						if(!empty($office_building_name)) { //Is Office building uploaded..
							$bus_office_logo = strtolower(substr($business_name, 0, 4)).mt_rand(1111, 9909).mt_rand(1111, 9909).".png";
							
							//Upload office building Logo...
							$action->compressImage($office_building_tmp_name, $folder.$bus_office_logo, 60);  //Reduce business logo size and upload...
							
						} else { $bus_office_logo = ''; }
						
						if(!empty($business_logo_name)) { //Is business logo uploaded..
						
							$bus_logo = strtolower(substr($business_name, 0, 4)).date("Ydhs").".png";
							
							//Upload building Logo...
							$action->compressImage($business_logo_tmp_name, $folder.$bus_logo, 60);
						} else { $bus_logo = ''; }
						
						//Prepare the attachment json
						if(!empty($bus_office_logo) && !empty($bus_logo)) {
							$attachment = ["logo" => "business/".$bus_logo, "office" => "business/".$bus_office_logo];
						} else if(empty($bus_office_logo) && !empty($bus_logo)) {
							$attachment = ["logo" => "business/".$bus_logo];
						} else if(!empty($bus_office_logo) && empty($bus_logo)) {
							$attachment = ["office" => "business/".$bus_office_logo];
						} else { $attachment = ''; }
						
						if(!empty($attachment)) { $attachment = json_encode($attachment); }
						
						//Since all is done, then let's save...
						$saveBusiness = $action->query("insert into businesscreation (userid, businessname, business_category, address, attachment, url, founder, mobile, datefounded, workhours, description, dateCreated) values ('$userid', '$business_name', '$business_category', '$address', '$attachment', '$business_site', '$person_in_charge', '$phone', '$establishment_date', '$working_hour', '$description', '".date("D j F, Y; h:i a")."')");
						$saveBusiness->execute();
						
						?>
						<script>
							swal.fire({
								title: "Upload Successful",
								text: "Business uploaded successfully, kindly await admin approval",
								icon: "success"
							}).then((isRedirect) => {
								if(isRedirect.isConfirmed) {
									window.location = 'uploadbusiness'
								}
							});
						</script>
						<?php 
					}
				// print_r($_FILES);
				
			}
		   ?>	   
		   
            <form method="post" enctype="multipart/form-data">
			
			<div class="form-group row">
			<div class="col-lg-6">
           <label for="input-1">Business Name</label>
            <input type="text" class="form-control" id="business_name" name="business_name" placeholder="Enter Business Name" required>
           </div>
		   <div class="col-lg-6">
            <label for="input-2">Business Logo(Maximum of 5mb)</label>
            <input type="file" class="form-control" id="business_logo" name="business_logo">
           </div>
		   </div>
           <div class="form-group row">
			<div class="col-lg-12">
            <label for="input-5">Business Category</label>
            <select  class="form-control" id="business_category" name="business_category" required>
				<option value="">-- Select --</option>
				<?php
				$srchCat = $action->query("select * from category order by category_name asc"); $srchCat->execute();
				while($srchCats = $srchCat->fetch(PDO::FETCH_ASSOC)) { ?>
					<option value="<?php echo $srchCats["id"];?>"><?php echo $srchCats["category_name"];?></option>
				<?php } ?>
			</select>
           </div>
           </div>
           <div class="form-group row">
		   <div class="col-lg-6">
            <label for="input-3">Address</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Enter Business Address" required>
           </div>
			<div class="col-lg-6">
            <label for="input-4">Office Building(Maximum of 5mb)</label>
            <input type="file" class="form-control" id="office_building" name="office_building">
           </div>
           </div>
           <div class="form-group row">
			<div class="col-lg-6">
            <label for="input-5">Business Website</label>
            <input type="url" class="form-control" id="business_site" name="business_site" placeholder="Enter Office Website URL e.g http://www.example.com">
           </div>
			<div class="col-lg-6">
            <label for="input-4">Founder / Manager / CEO</label>
            <input type="text" class="form-control" id="person_in_charge" name="person_in_charge" placeholder="Enter Name (User should specify position)">
           </div>
           </div>
           <div class="form-group row">
		   
			<div class="col-lg-6">
				<label for="input-5">Phone Contact</label>
				<input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Contact">
			</div>
		   
			<div class="col-lg-6">
            <label for="input-4">Establishment Date</label>
            <input type="date" class="form-control" id="establishment_date" name="establishment_date" >
           </div>
           </div>
           <div class="form-group row">
			<div class="col-lg-12">
            <label for="input-5">Working Hours</label>
            <textarea  class="form-control" id="working_hour" name="working_hour" placeholder="Enter working hour if more than one, separate by new line or comma"></textarea>
           </div>
           </div>
           <div class="form-group row">
			<div class="col-lg-12">
            <label for="input-5">Other Description</label>
            <textarea  class="form-control" id="description" name="description" placeholder="Enter business description"></textarea>
           </div>
           </div>
           <div class="form-group py-2">
             <div class="icheck-material-white">
            <input type="checkbox" id="user-checkbox1" checked="" disabled />
            <label for="user-checkbox1">I Agree Terms & Conditions</label>
            </div>
           </div>
           <div class="form-group">
            <button type="submit" class="btn btn-light px-5" name="uploadBusiness"><i class="icon-lock"></i> Upload Business</button>
          </div>
          </form>
		  
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
