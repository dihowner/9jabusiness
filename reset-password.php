<?php
require "action.php";
$action = new Action();
if(isset($_SESSION["username"])) {
    $userid = $_SESSION["username"];
    if (!empty($action->clientID($userid)) && isset($userid)) {
        session_destroy();
    }
}

if(!function_exists("Is_email")) {
    function Is_email($email) {
        // if the username input string is an e-mail,return true
        if(filter_var($email,FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        else {
            return false;
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
  <title>9jabusiness - Reset Password</title>
  <!-- loader--
  <link href="dashboard/assets/css/pace.min.css" rel="stylesheet"/>
  <script src="dashboard/assets/js/pace.min.js"></script>
  <!-- loader-->
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

<!-- Start wrapper-->
 <div id="wrapper">

 <div class="height-100v d-flex align-items-center justify-content-center">
	<div class="card card-authentication1 mb-0">
		<div class="card-body">
		 <div class="card-content p-2">
		 
					
     <?php
                    if(isset($_REQUEST["resetAccount"])) {
                        $resetUser = $_REQUEST["resetAccount"];
                            if(empty($resetUser)) {
                                ?>
                                <script>
                                    alert("Unknown Error");
                                    window.location = "login";
                                </script>
                            <?php
                            }else {
                                $srchCode = $action->query("select * from reset where code='$resetUser' and status='NEW'");
                                $srchCode->execute();
                                if($srchCode->rowCount() == 0) {
                                ?>
                                    <script>
                                        alert("Reset code has already been used");
                                        window.location = "login";
                                    </script>
                                <?php
                                } else {
                                    $srchCodeInfo = $srchCode->fetch(PDO::FETCH_ASSOC);
                                    $userid = $srchCodeInfo["userid"];

                                    $runQuery = $action->query( "SELECT * FROM `users` where id='$userid'");
                                    $runQuery->execute();
                                    $runQueryInfo = $runQuery->fetch(PDO::FETCH_ASSOC);
                                    $email = $runQueryInfo["email"];
                                }
                            }
                                ?>
					
		   <div class="card-title text-uppercase pb-2">Reset Password</div>
		    <form method="post"  id="login-form" autocomplete="off">
			
                        <?php

                        if(isset($_POST["changePass"])) {
                            $newPass = strtolower($_POST["newPass"]);
                            $confirmPass = strtolower($_POST["confirmPass"]);
                            if(empty($newPass) || empty($newPass)) {
                                ?>
                                <div class="alert alert-danger"><b>Please fill all field</b></div>
                            <?php
                            } else {
                                $newPass = md5($newPass);
                                $changePass = $action->query("update users set password='$newPass' where id='$userid'");
                                $changeCode = $action->query("update reset set status='used' where code='$resetUser'");

                                if($changePass->execute()) {
                                    if($changeCode->execute()) {
                                        ?>
                                            <script>
                                                alert("Password changed successfully. Proceed to login");
                                                window.location = "login";
                                            </script>
                                        <?php
                                        } else {
                                            ?>
                                                <div class="alert alert-danger"><b>Error modifying password</b></div>
                                            <?php
                                        }
                                } else {
                                ?>
                                    <div class="alert alert-danger"><b>Unknown Error occurred</b></div>
                                <?php
                                }
                            }
                        }
                        ?>
			  <div class="form-group">
			  <label for="exampleInputEmailAddress" class="">Email Address</label>
			   <div class="position-relative has-icon-right">
				  <input type="text" class="form-control input-shadow" value='<?php echo $email;?>' disabled>
				  <div class="form-control-position">
					  <i class="icon-envelope-open"></i>
				  </div>
			   </div>
			  </div>
			  
			   <div class="form-group">
			  <label for="exampleInputEmailAddress" class="sr-only">Username</label>
			   <div class="position-relative has-icon-right">
				  <input type="text" value='<?php echo $resetUser;?>' disabled  class="form-control input-shadow">
				  <div class="form-control-position">
					  <i class="icon-user"></i>
				  </div>
			   </div>
			  </div>
			  
			   <div class="form-group">
			  <label for="exampleInputEmailAddress" class="">Password</label>
			   <div class="position-relative has-icon-right">
				  <input type="password" name="newPass" id="newPass" placeholder="Enter new password" class="form-control input-shadow" required>
				  <div class="form-control-position">
					  <i class="icon-lock"></i>
				  </div>
			   </div>
			  </div>
			    <div class="form-group">
			  <label for="exampleInputEmailAddress" class="">Confirm Password</label>
			   <div class="position-relative has-icon-right">
				  <input type="password" name="confirmPass" id="confirmPass" placeholder="Confirm new password" class="form-control input-shadow" required>
				  <div class="form-control-position">
					  <i class="icon-lock"></i>
				  </div>
			   </div>
			  </div>			 
			 
			  <button type="submit" name="changePass" id="changePass" class="btn btn-light btn-block mt-3">Change Password</button>
			 </form>
		 <?php

                    } else {
                    if(isset($_POST["recover"])) {
                        $resetUser = $_POST["resetUser"];
                        if (Is_email($resetUser)) {
                            $runQuery = $action->query("SELECT * FROM `users` where email='$resetUser'");
                        } else {
                            $runQuery = $action->query("SELECT * FROM `users` where username='$resetUser'");
                        }

                        $runQuery->execute();

                        if ($runQuery->rowCount() == 0) {
                            ?>
                            <div class="alert alert-danger"><b>Username not found</b></div>
                            <?php
                        } else {
                            $runQueryInfo = $runQuery->fetch(PDO::FETCH_ASSOC);
                            $email = $runQueryInfo["email"];
                            $username = $runQueryInfo["username"];
                            $userid = $runQueryInfo["id"];

                            //We need to check if user has alread requested before...
                            $srchCode = $action->query("select * from reset where userid='$userid' and status='NEW'");
                            $srchCode->execute();
                            if ($srchCode->rowCount() == 1) {//code exist already...
                                $srchCodeInfo = $srchCode->fetch(PDO::FETCH_ASSOC);
                                $resetCode = $srchCodeInfo["code"];
                            } else {
                                for ($i = 1; $i <= 10; $i++) {
                                    $resetCode = strtolower(str_replace(array('0', 'o', 'i'), 'Z', substr(md5(mt_rand(109032, 987453)), 0, 15)));
                                }
                                $saveCode = $action->query("INSERT INTO `reset`(`userid`, `code`) VALUES ('$userid', '$resetCode')");
                                $saveCode->execute();
                            }


                            // set content type header for html email
                            $headers  = 'MIME-Version: 1.0' . "\r\n";
                            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                            // set additional headers
                            $headers .= 'From: Password Reset <no-reply@(9jabusiness).online>' . "\r\n".'X-Mailer: PHP/' . phpversion();
                            $subject = "Reset your password";
                            $body= "<html>
    <head>
        <title>".$subject."</title>
    </head>
    <body>
		<div style='width:80%;margin:0px auto;padding:10px;background:#fff;'>
			
				<p style='font-size:22px; color: #000'><em>Hi ". $email." (".$username."),</em></p>

				<p style='font-size:20px;color:#000;font-family:georgia;'>
					You recently request for a password reset on your account. Kindly click on the link below to change your password. 
					<br><br>Reset Code: ". $resetCode . "<br><br>
					<a href='https://9jabusiness.online/reset-password?resetAccount=".$resetCode."' target='_blank' style='text-decoration: none; color: red'>
						https://9jabusiness.online/reset-password?resetAccount=".$resetCode."
					</a><br>
					<br>
					Regards,<br>
					9jabusiness
                </p>
			<div style='background:#000; color:#fff; padding:5px;'>&copy; ". date('Y') ." 9jabusiness All Rights Reserved </div>
		</div>
</body>
</html>";

        if(mail($email, $subject, $body, $headers)) {
                ?>
            <div class="alert alert-success" style="padding: 10px"><b>A reset link has been sent to your email. Please check your inbox or spam folder.</b></div>
        <?php
        } else {
        ?>
            <script>
                alert("Click here to proceed");
                window.location = "https://9jabusiness.online/reset-password?resetAccount="+<?php echo $resetCode;?>+"";
            </script>
        <?php
        }

                        }
                    }

                        ?>
		  <div class="card-title text-uppercase pb-2">Reset Password</div>
		    <p class="pb-2">Please enter your email address. You will receive a link to create a new password via email.</p>
		    <form method="post"  id="login-form" autocomplete="off">
			  <div class="form-group">
			  <label for="exampleInputEmailAddress" class="">Email Address</label>
			   <div class="position-relative has-icon-right">
				  <input type="text" id="resetUser" name="resetUser" class="form-control input-shadow" placeholder="Email Address or Username" required>
				  <div class="form-control-position">
					  <i class="icon-envelope-open"></i>
				  </div>
			   </div>
			  </div>
			 
			  <button type="submit" name="recover" id="recover" class="btn btn-light btn-block mt-3">Reset Password</button>
			 </form>
		   </div>
		  </div>
		  	<?php } ?>
		   <div class="card-footer text-center py-3">
		    <p class="text-warning mb-0">Return to the <a href="login"> Sign In</a></p>
		  </div>
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
