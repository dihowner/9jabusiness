
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
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>9jaBusiness- Home</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: BizLand - v3.3.0
  * Template URL: https://bootstrapmade.com/bizland-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">contact@example.com</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 5589 55488 55</span></i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
  </section>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="index">9jaBusiness<span>.</span></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt=""></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#how">Get to know how</a></li>
     
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          <li><a href="register">Register</a></li>
          <li><a href="login">Sign In</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container" data-aos="zoom-out" data-aos-delay="100">
      <h1>Welcome to <span>9jaBusiness</span></h1>
      <h2>We are a platform to make money online</h2>
      <div class="d-flex">
        <a href="#about" class="btn-get-started scrollto">Get Started</a>
       
	 </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">


    <!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>About</h2>
          <h3>Find Out More <span>About Us</span></h3>
         </div>

        <div class="row">
          <div class="col-lg-3" data-aos="fade-right" data-aos-delay="100">
          <!--  <img src="assets/img/about.jpg" class="img-fluid" alt=""> -->
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
           <p class="fst-italic">
             9jabusiness is a platform that registers all businesses in Nigeria online. The aim is to have a centralized repository where people can search for the nearest product seller or service provider. It also has a review feature for users to give fellow users prior knowledge of a product or service from past users experienced. 
 </p>
          </div>
        </div>

      </div>
    </section>
	
	 <!-- ======= About Section ======= -->
    <section  id="featured-services" class="featured-services">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>9jaBusiness</h2>
          <h3>How To Make <span>Money With It</span></h3>
         </div>

       
        <div class="row">
          <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon"><i class="bx bxl-dribbble"></i></div>
              <h4 class="title"><a href="">Earnings</a></h4>
              <p class="description">9jabusiness has an earning reward system.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4 class="title"><a href="">Uploads / Reviews</a></h4>
              <p class="description">Users can upload businesses around them, review uploaded businesses, and get paid. </p>
            </div>
          </div>

     
          <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
              <div class="icon"><i class="bx bx-world"></i></div>
              <h4 class="title"><a href="">Referrals</a></h4>
              <p class="description">Users can also refer another person to the platform and get paid.</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End About Section -->

  <section id="how" class="about section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Modes of Payments</h2>
          <h3>How to make <span>Payment</span></h3>
         </div>

        <div class="row">
          
          <div class="col-lg-12 pt-9 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
           <p class="fst-italic">
            There are 5 modes of payments which are; eDeposite coin, Bitcoin, Ethereum,Tron and Paypal. <br>Download Trust Wallet App here to get the wallet addresses for Bitcoin, Tron, and Ethereum <a href="https://play.google.com/store/apps/details?id=com.wallet.crypto.trustapp">https://play.google.com/store/apps/details?id=com.wallet.crypto.trustapp</a>
 </p>
 <p>You can simply ignore these wallets, but make sure you add an eDeposite wallet address. <br>
To open an eDeposite account visit <a href="https://edeposite.info">eDeposite.info</a><br>
To learn more about eDeposite visit <a href="https://edeposite.org">eDeposite.org</a><br>
Join our Telegram group by clicking on the link <a href="https://t.me/joinchat/Goxu0HWupG9iFdqX">https://t.me/joinchat/Goxu0HWupG9iFdqX</a> WhatsApp communities and request a purchase of eDT coin.
</p>
 <ul> After signing up, complete your profile 
 <li><p style="font-size:17px;"><b>Step 1:</b> Create an account, while creating an account upload a profile picture of not more than "500kb" size. <br>
On the left-hand side, there is a menu bar, click on Profile</p>
</li>
 <li><p style="font-size:17px;"><b>Step 2:</b> Edit your account details, Complete your profile by putting the relevant account details where appropriate. These consist of your account details where you want your earnings to be credited. The first and the only compulsory Wallet address required is the eDeposite wallet address.
<br>To create an eDeposite account visit www.edeposite.info. <br>
After creating an eDeposite account, your eDeposite Public Address and Private Key will be sent to your email. <br>

<br>Copy the Public Address sent to your email and add it to your 9jabusiness account profile. </p>
</li>
You can 
 <li><p style="font-size:17px;"><b>Step 3:</b>  (Optional) Purchase a Level Pan if you want to earn more or maintain your Free Mode Plan. </p></li>
 <li> <p style="font-size:17px;"><b>Step 4:</b>  Activities:
<ul>
<li>Click on Upload Business, fill in the correct details of the business, and click “Upload Business”</li>
<li> Click on Review Business and comment at the bottom of the business details.</li>
</ul> </p>
</li>

 </ul>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->



    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Withdrawals</h2>
          <h3>Check our <span>Successful Payouts</span></h3>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bx bxl-dribbble"></i></div>
              <h4><a href="">Lorem Ipsum</a></h4>
              <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4><a href="">Sed ut perspiciatis</a></h4>
              <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-tachometer"></i></div>
              <h4><a href="">Magni Dolores</a></h4>
              <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-world"></i></div>
              <h4><a href="">Nemo Enim</a></h4>
              <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-slideshow"></i></div>
              <h4><a href="">Dele cardo</a></h4>
              <p>Quis consequatur saepe eligendi voluptatem consequatur dolor consequuntur</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-arch"></i></div>
              <h4><a href="">Divera don</a></h4>
              <p>Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Services Section -->


    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contact</h2>
          <h3><span>Contact Us</span></h3>
          <p>You can contact us via the following contact details or kindly fill the form below</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-6">
            <div class="info-box mb-4">
              <i class="bx bx-map"></i>
              <h3>Our Address</h3>
              <p>A108 Adam Street, New York, NY 535022</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box  mb-4">
              <i class="bx bx-envelope"></i>
              <h3>Email Us</h3>
              <p>info@9jabusiness.online</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box  mb-4">
              <i class="bx bx-phone-call"></i>
              <h3>Call Us</h3>
              <p>+1 5589 55488 55</p>
            </div>
          </div>

        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">

          <div class="col-lg-6 ">
            <iframe class="mb-4 mb-lg-0" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>
          </div>

          <div class="col-lg-6">
            <form method="post" role="form" class="php-email-form">
				 <?php
                    if(isset($_POST["sendSupport"])) {
                        $fullname = ucfirst($_POST["fullname"]);
                        $email = strtolower($_POST["email"]);
                        $subject = strtoupper($_POST["subject"]);
                        $message = $_POST["message"];
                        $receiver = "info@9jabusiness.online";
                        if(filter_var($email, FILTER_VALIDATE_EMAIL) != true) {
                        ?>
                            <div class="alert alert-danger">Email address seems not be valid</div>
                        <?php
                        }  else {

                            // set content type header for html email
                            $headers  = 'MIME-Version: 1.0' . "\r\n";
                            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                            // set additional headers
                            $headers .= 'From: Edeposite <info@9jabusiness.online>' . "\r\n".'X-Mailer: PHP/' . phpversion();
                            $body= "<html>
    <head>
        <title>". $subject ."</title>
    </head>
    <body>
    <div style='font-family:arial;border:2px solid #c0c0c0;padding:15px;border-radius:5px;'>
	This is an enquiry email via <a href='https://9jabusiness.online/contact' target='_blank'>https://9jabusiness.online/contact</a> from: $fullname < <a href='mailto:$email'>$email</a> >
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
              <div class="row">
                <div class="col form-group">
                  <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Your Name" required>
                </div>
                <div class="col form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" id="message" rows="5" placeholder="Message" required></textarea>
              </div>
           
              <div class="text-center"><button name="sendSupport" id="sendSupport" type="submit">Send Message</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">


    <div class="container py-4">
      <div class="copyright">
        &copy; Copyright <strong><span>9jaBusiness</span></strong>. All Rights Reserved
      </div>
    
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>