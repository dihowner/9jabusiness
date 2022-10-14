<?php
require "action.php";
$action = new Action();

if(isset($_SESSION["logOut"])) {
	unset($_COOKIE["username"]);
	unset($_SESSION["logOut"]);
} else {

	if(isset($_COOKIE["username"]) && !empty($_COOKIE["username"])) {

		// Get Current date, time
		$current_time = time();
		$current_date = date("Y-m-d H:i:s", $current_time);
		$cookie_expiration_time = $current_time + (30 * 24 * 60 * 60);  // for 1 month
		$expiry_date = date("Y-m-d H:i:s", $cookie_expiration_time);
		

		if($expiry_date >= $current_date && !empty($_COOKIE["username"])) {
			// $_SESSION["username"] = $_COOKIE["username"];
			$action->redirect_to("dashboard/index");
		}	
	}
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
  <title>9jaBusiness - Sign In</title>
  <!-- loader--
  <link href="dashboard/assets/css/pace.min.css" rel="stylesheet"/>
  <script src="dashboard/assets/js/pace.min.js"></script>
  <!--favicon-->
  <link rel="icon" href="dashboard/assets/images/favicon.ico" type="image/x-icon">
  <!-- Bootstrap core CSS-->
  <link href="dashboard/assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="dashboard/assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="dashboard/assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Custom Style-->
  <link href="dashboard/assets/css/app-style.css" rel="stylesheet"/>
  <script src="dashboard/assets/js/jquery-2.1.4.min.js"></script>
  <script src="dashboard/survey.js"></script>
  
</head>

<body class="bg-theme bg-theme1">

<!-- start loader -->
   <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
   <!-- end loader -->

<!-- Start wrapper-->
 <div id="wrapper">

 <div class="loader-wrapper"><div class="lds-ring"><div></div><div></div><div></div><div></div></div></div>
	<div class="card card-authentication1 mx-auto my-5">
		<div class="card-body">
		 <div class="card-content p-2">
		 	<div class="text-center">
		 		<img src="dashboard/assets/images/logo-icon.png" alt="logo icon">
		 	</div>
		  <div class="card-title text-uppercase text-center py-3">Sign In</div>
		    <form method="post" id="login-form" autocomplete="off">
			 <?php
	if(isset($_POST["clientLogin"])) {
		$username = strtolower($_POST["username"]);
		$password = strtolower($_POST["password"]);
		
		if($action->userLogin($username, $password) == "logged") {
			$action->redirect_to("dashboard/index");
		} else {	
			echo $action->userLogin($username, $password);
		}
	}
	?>
			  <div class="form-group">
			  <label for="exampleInputUsername" class="sr-only">Username</label>
			   <div class="position-relative has-icon-right">
				  <input type="text" id="username" name="username" class="form-control input-shadow" placeholder="Enter Username or E-mail">
				  <div class="form-control-position">
					  <i class="icon-user"></i>
				  </div>
			   </div>
			  </div>
			  
			  
			<div class="form-group">
				<div class="input-group">
					<input type="password" name="password" id="password" class="form-control input-shadow" placeholder="Enter Password">
					<span class="input-group-prepend">
						<button type="button" class="btn btn-light" id="showPass"><i class="fa fa-eye fa-2x"></i></button>
					</span>
				</div>
			</div>
			
			<div class="form-row">
			 <div class="form-group col-6">
			   
			 </div>
			 <div class="form-group col-6 text-right">
			  <a href="reset-password">Reset Password</a>
			 </div>
			</div>
			 <button type="submit" name="clientLogin" id="clientLogin" class="btn btn-light btn-block">Sign In</button>
			  
	
			 
			 </form>
		   </div>
		  </div>
		  <div class="card-footer text-center py-3">
		    <p class="text-warning mb-0">Do not have an account? <a href="register"> Sign Up here</a></p>
		  </div>
	     </div>
    
     <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	
	</div><!--wrapper-->
	
  <!-- Bootstrap core JavaScript-->
  <script src="dashboard/assets/js/jquery.min.js"></script>
  <script src="dashboard/assets/js/popper.min.js"></script>
  <script src="dashboard/assets/js/bootstrap.min.js"></script>
	
  <!-- sidebar-menu js -->
  <script src="dashboard/assets/js/sidebar-menu.js"></script>
  
  <!-- Custom scripts -->
  <script src="dashboard/assets/js/app-script.js"></script>
  
</body>
</html>
