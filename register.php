<?php require "action.php"; $action = new Action();
if(isset($_SESSION["username"])) {
    $userid = $_SESSION["username"];
	session_destroy();
} else {
    $userid = "";
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
  <title>9jaBusiness - Sign Up</title>
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
  
</head>

<body class="bg-theme bg-theme1">

<!-- start loader -->
   <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
   <!-- end loader -->

<!-- Start wrapper-->
 <div id="wrapper">

	<div class="card card-authentication1 mx-auto my-4">
		<div class="card-body">
		 <div class="card-content p-2">
		 	<div class="text-center">
		 		<img src="dashboard/assets/images/logo-icon.png" alt="logo icon">
		 	</div>
		  <div class="card-title text-uppercase text-center py-3">Sign Up</div>
		    <form method="post" id="register-form" enctype="multipart/form-data">
			
			<?php

if(isset($_REQUEST["registerAccount"])) {
    $fullname = ucwords($_POST["fullname"]);
    $username = strtolower($_POST["username"]);
    $email = strtolower($_POST["email"]);
    $referral = $_POST["referral"];
    $password = md5(strtolower($_POST["password"]));
    $con_password = md5(strtolower($_POST["con_password"]));

    //We need to check the referral code supplied is valid or not....
    if(!empty($referral)) {
        $referralID = $action->referralID($referral);
    }
	
    if(!empty($_FILES["avatar"]["name"])) {
		$avatar = $_FILES["avatar"]["name"];
		$avatartmp = $_FILES["avatar"]["tmp_name"];
		$avatarsize = $_FILES["avatar"]["size"];
		$extension = strtolower(pathinfo($avatar)["extension"]);
	}
	
    if(empty($fullname) || empty($username) || empty($email) || empty($password)) {
        echo "<div class='alert alert-danger'><b>Please fill all field!</b></div>";
    } else if($password != $con_password) {
        echo "<div class='alert alert-danger'><b>Password does not match!</b></div>";
    } else if(empty($avatartmp) && !empty($_FILES["avatar"]["name"])) {
        echo "<div class='alert alert-danger'><b>Invalid file selected as profile picture!</b></div>";
    } else if(!in_array($extension, array("jpg", "bmp", "png", "jpeg")) && !empty($_FILES["avatar"]["name"])) {
        echo "<div class='alert alert-danger'><b>File extension is not allowed. Only <b>png, jpeg, jpg and bmp</b> are allowed</b></div>";
    } else if($avatarsize > 512000 && !empty($_FILES["avatar"]["name"])) {
        echo "<div class='alert alert-danger'><b>Profile picture is too big. Maximum of 500KB per upload</b></div>";
    } else if($action->emailExist($email) == 1) {
        echo "<div class='alert alert-success'><b>Email is already associated with an account!</b></div>";
    } else if($action->usernameExist($username) == 1) {
        echo "<div class='alert alert-danger'><b>Username Already Exist!</b></div>";
    } else {
		
		if(!empty($_FILES["avatar"]["name"])) {
			$newFile = date("Ymd").mt_rand(1111, 9039).".jpg";
			$path = "img/avatar/".$newFile;
			$movefile = move_uploaded_file($avatartmp, $path);
		} else { $newFile = ''; }
		
		if(!$movefile && !empty($_FILES["avatar"]["name"])) {
			echo "<div class='alert alert-danger'><b>Error: Unable to upload file</b></div>";
		} else {
			
			if($action->saveAccount($fullname, $username, $email, $password, $referral, $newFile)) {
			
				?>
					<script>
						alert("Your registration was successful! Proceed to login");
						window.location = "login";
					</script>
				<?php
				
				
			} else {
				echo "<div class='alert alert-danger'><b>Error: Unable to create account</b></div>";				
			}
		}
    }
}


 if(isset($_REQUEST["refer"])) { $refer = $_REQUEST["refer"]; }


          //Client wants to activate account...
			if(isset($_REQUEST["activateAccount"])) {
				if(!empty($_REQUEST["activateAccount"])) {
					$activateAccount = $_REQUEST["activateAccount"];
					$runQuery = $action->query("select * from verification where code='$activateAccount' and status='Pending'");
					$runQuery->execute();
					if($runQuery->rowCount() == 1) { //Activation is pending ...
						$runQueryInfo = $runQuery->fetch(PDO::FETCH_ASSOC);
						$clientID = $runQueryInfo["clientID"];

						$updtAccnt = $action->query("update users set activation='YES' where id='$clientID'");
						if($updtAccnt->execute()) {
							  //Since user has been updated, then we need to update verification code...
                            $updtVerify = $action->query("update verification set status='used' where clientID='$clientID' and code='$activateAccount'");
                            $updtVerify->execute();

                            $message = "Dear Admin, new member verified
                                Client Email: ".$action->clientemail($clientID)." <br>
                                Username: ".$action->loggedusername($clientID)." <br>";

                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    // set additional headers
                    $headers .= 'From: Survey <support@survey.com>' . "\r\n".'X-Mailer: PHP/' . phpversion();
                    $body= "<html>
    <head>
        <title>Member Registration</title>
    </head>
    <body>
    <div style='font-family:arial;border:2px solid #c0c0c0;padding:15px;border-radius:5px;'>
	$message
</div></div></body>";

                            mail("admin@survey.com", "Member Registration", $message, $headers);

							  ?>
							  <script>
								  alert("Account activated successfully. You can now login");
								  window.location = "login";
							  </script>
						  <?php
						} else {
						  ?>
							  <script>
								  alert("Error in activation. Please try again");
								  window.location = "login";
							  </script>
						  <?php
						}
					} else { //Activation not found nor pending...
						?>
							<script>
								alert("Account already activated");
								window.location = "login";
							</script>
						<?php
					}

				} else {
				?>
					<script>
						alert("Unknown error occured");
						window.location = "login";
					</script>
                  <?php
				}
			}
		  ?>
		  
			  <div class="form-group">
			  <label for="exampleInputName" class="sr-only">Username</label>
			   <div class="position-relative has-icon-right">
				  <input type="text" required id="username" name="username" class="form-control input-shadow" placeholder="Enter Your Username">
				  <div class="form-control-position">
					  <i class="icon-user"></i>
				  </div>
			   </div>
			  </div>
			    <div class="form-group">
			  <label for="exampleInputName" class="sr-only">Fullname</label>
			   <div class="position-relative has-icon-right">
				  <input type="text" required id="fullname" name="fullname" class="form-control input-shadow" placeholder="Enter Your Fullname">
				  <div class="form-control-position">
					  <i class="icon-user"></i>
				  </div>
			   </div>
			  </div>
			  <div class="form-group">
			  <label for="exampleInputEmailId" class="sr-only">Email Address</label>
			   <div class="position-relative has-icon-right">
				  <input type="email" required id="email" name="email" class="form-control input-shadow" placeholder="Enter Your Email ID">
				  <div class="form-control-position">
					  <i class="icon-envelope-open"></i>
				  </div>
			   </div>
			  </div>
			  <div class="form-group">
			   <label for="exampleInputPassword" class="sr-only">Password</label>
			   <div class="position-relative has-icon-right">
				  <input type="password" required id="password" name="password" class="form-control input-shadow" placeholder="Choose Password">
				  <div class="form-control-position">
					  <i class="icon-lock"></i>
				  </div>
			   </div>
			  </div>
			   <div class="form-group">
			   <label for="exampleInputPassword" class="sr-only">Confirm Password</label>
			   <div class="position-relative has-icon-right">
				  <input type="password" required id="con_password" name="con_password" class="form-control input-shadow" placeholder="Confirm Password">
				  <div class="form-control-position">
					  <i class="icon-lock"></i>
				  </div>
			   </div>
			  </div>
			     <div class="form-group">
			   <label for="profilepic">Upload Profile Picture(maximum of 500kb)</label>
			   <div class="position-relative has-icon-right">
				  <input type="file" id="avatar" name="avatar" class="form-control input-shadow" placeholder="Upload Profile Picture" accept="image/x-png,image/png,image/bmp,image/jpg,image/jpeg">
				  <div class="form-control-position">
					  <i class="icon-file"></i>
				  </div>
			   </div>
			  </div>
			  <?php
			if(!empty($refer)) {
			?>
			     <div class="form-group">
			   <label for="referralid" class="sr-only">Referral Id</label>
			   <div class="position-relative has-icon-right">
				  <input type="text" id="referral" name="referral" class="form-control input-shadow" value="Your Referral Id: <?php echo $refer;?>" disabled>
				  <input type="hidden" id="referral" name="referral" class="form-control input-shadow" value="<?php echo $refer;?>" placeholder="Enter Referral Id (Optional*)">
				  <div class="form-control-position">
					  <i class="icon-people"></i>
				  </div>
			   </div>
			  </div>
			   <?php
				} else {
				?>
			  <div class="form-group">
			   <label for="referralid" class="sr-only">Referral Id</label>
			   <div class="position-relative has-icon-right">
				  <input type="text" id="referral" name="referral" value="<?php if(isset($referral)) {echo $referral;}?>" class="form-control input-shadow" placeholder="Enter Referral Id (Optional*)">
				  <div class="form-control-position">
					  <i class="icon-people"></i>
				  </div>
			   </div>
			  </div>
			  <?php } ?>
			   <div class="form-group">
			     <div class="icheck-material-white">
                   <input type="checkbox" id="user-checkbox" checked="" required />
                   <label for="user-checkbox">I Agree With  <a href="terms-conditions" target="_blank">Terms & Conditions</a></label>
			     </div>
			    </div>
			  
			 <button type="submit" name="registerAccount" id="registerAccount" class="btn btn-light btn-block waves-effect waves-light">Sign Up</button>
			  
		
			
			 </form>
		   </div>
		  </div>
		  <div class="card-footer text-center py-3">
		    <p class="text-warning mb-0">Already have an account? <a href="login"> Sign In here</a></p>
		  </div>
	     </div>
    
     <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	<!--start color switcher-->
   <div class="right-sidebar">
    <div class="switcher-icon">
      <i class="zmdi zmdi-settings zmdi-hc-spin"></i>
    </div>
    <div class="right-sidebar-content">

      <p class="mb-0">Gaussion Texture</p>
      <hr>
      
      <ul class="switcher">
        <li id="theme1"></li>
        <li id="theme2"></li>
        <li id="theme3"></li>
        <li id="theme4"></li>
        <li id="theme5"></li>
        <li id="theme6"></li>
      </ul>

      <p class="mb-0">Gradient Background</p>
      <hr>
      
      <ul class="switcher">
        <li id="theme7"></li>
        <li id="theme8"></li>
        <li id="theme9"></li>
        <li id="theme10"></li>
        <li id="theme11"></li>
        <li id="theme12"></li>
		<li id="theme13"></li>
        <li id="theme14"></li>
        <li id="theme15"></li>
      </ul>
      
     </div>
   </div>
  <!--end color switcher-->
	
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
