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
  <title>Business - Sign Up</title>
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
		  <div class="card-title text-uppercase text-center py-3">Contact Us</div>
		    <form method="post" id="contact">
		 <?php
                    if(isset($_POST["sendSupport"])) {
                        $fullname = ucfirst($_POST["fullname"]);
                        $email = strtolower($_POST["email"]);
                        $phone = strtoupper($_POST["phone"]);
                        $subject = strtoupper($_POST["subject"]);
                        $message = $_POST["message"];
                        $receiver = "support@edt.com";
                        if(filter_var($email, FILTER_VALIDATE_EMAIL) != true) {
                        ?>
                            <div class="alert alert-danger">Email address seems not be valid</div>
                        <?php
                        }  else {

                            // set content type header for html email
                            $headers  = 'MIME-Version: 1.0' . "\r\n";
                            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                            // set additional headers
                            $headers .= 'From: Edeposite <support@edt.com>' . "\r\n".'X-Mailer: PHP/' . phpversion();
                            $body= "<html>
    <head>
        <title>". $subject ."</title>
    </head>
    <body>
    <div style='font-family:arial;border:2px solid #c0c0c0;padding:15px;border-radius:5px;'>
	This is an enquiry email via <a href='https://edt.com/contact' target='_blank'>https://edt.com/contact</a> from: $fullname < <a href='mailto:$email'>$email</a> >
	<br><br>
	Subject: $subject
	<br><br>
	$message
</div></div></body>";
                            if(mail($receiver, $subject, $body, $headers)) {
                                $response = 'Message Sent<br> Thank you for contacting us, our support representative will get back to you.';
                            ?>
                            <div class="alert alert-success"><?php echo $response;?></div>
                            <?php
                            }
                            else
                            {
                                $error = 'Message Sending Failed<br> Unable to send your message.';
                            ?>
                            <div class="alert alert-warning"><?php echo $error;?></div>
                            <?php
                            }
                        }
                    }
                    ?>
			 
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
			   <label for="phone" class="sr-only">Phone Number</label>
			   <div class="position-relative has-icon-right">
				  <input type="text" required id="phone" name="phone" class="form-control input-shadow" placeholder="Enter Phone Number">
				  <div class="form-control-position">
					  <i class="icon-phone"></i>
				  </div>
			   </div>
			  </div>
			    <div class="form-group">
			   <label for="subject">Subject: </label>
			   <div class="position-relative has-icon-right">
				  <input type="text" required id="subject" name="subject" class="form-control input-shadow" placeholder="Enter Subject">
			   </div>
			  </div>
			  <div class="form-group">
			   <label for="message">Message: </label>
			   <div class="position-relative has-icon-right">
				  <textarea required id="message" name="message" class="form-control input-shadow" placeholder="Enter Phone Number"> </textarea>
			   </div>
			  </div>
			   <div class="form-group">
			     <div class="icheck-material-white">
                   <input type="checkbox" id="user-checkbox" checked="" required />
                   <label for="user-checkbox">I Agree With Terms & Conditions</label>
			     </div>
			    </div>
			  
			 <button type="submit" name="contact" id="contact" class="btn btn-light btn-block waves-effect waves-light">Contact Us</button>
			 
			
			 </form>
		   </div>
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
