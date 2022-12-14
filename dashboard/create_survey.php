<?php
require "../action.php";
$action = new Action();
$userid = $_SESSION["username"];
$userWallet = $action->userWallet($userid);

if(empty($action->clientID($userid)) || !isset($userid)) {
    session_destroy();
    $action->redirect_to("../login");
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
  <title>9jaBusiness - Create Business</title>
  
  <!--favicon-->
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
  <!-- Vector CSS -->
  <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
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

  <!--Start Dashboard Content-->

	<div class="card mt-3">
    <div class="card-content">
        <div class="row row-group m-0">
            <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                  <h2 class="text-white mb-0">Admin Menu</h2>
                   
                </div>
            </div>

        </div>
    </div>
 </div>  
	  
	<div class="row">
	
	 <div class="col-12 col-lg-12 col-xl-12">
	 <?php
				
				if(isset($_POST["createPlan"])) {
					$planName = addslashes($_POST["planName"]);
					$level_price = addslashes($_POST["level_price"]);
					$ques_per_day = addslashes($_POST["ques_per_day"]);
					$pay_per_ques = addslashes($_POST["pay_per_ques"]);
					
					
					//Search plan...
					$srchPlan = $action->query("select * from plans where name='$planName'"); $srchPlan->execute();
					
					if(empty($planName) || empty($level_price) || empty($ques_per_day) || empty($pay_per_ques)) {
						echo $action->error("Please fill all field");
					} else if($srchPlan->rowCount() > 0) {
						echo $action->error("Level plan already exist");
					} else {
						$saveSuv = $action->query("insert into plans (name, price, ques_per_day, pay_per_ques) values ('$planName', '$level_price', '$ques_per_day', '$pay_per_ques')");
						if($saveSuv->execute()) { ?>
							<script>
								alert("Investment plan created successfully");
								window.location = "create_business";
							</script>
						<?php } else {
							echo $action->error("Error creating Level plan");
						}
					}
				}
			
			?>
			
			
					<div class="card">
					<div class="card-header"> <h3><b>Create Investment Plan</h3> </div>
			
					<form method="post" autocomplete='off'>
					
						<div class="col-lg-12" style="margin-top: 1%">
							<div class="row">
								<div class="col-lg-6">
									<label><b>Level Name</b></label>
									<input type="text" class="form-control input-lg" placeholder="Enter plan name" name="planName" id="planName" required> 
								</div>
							
								<div class="col-lg-6">
									<label><b>Level Price</b></label>
									<input type="text" class="form-control input-lg" name="level_price" id="level_price" required> 
								</div>
							</div>
						</div>
					
						<div class="col-lg-12" style="margin-top: 1%">
							<div class="row">
								<div class="col-lg-6">
									<label><b>Questionnaire Per Day</b></label>
									<input type="text" class="form-control input-lg" name="ques_per_day" id="ques_per_day" required> 
								</div>
							
								<div class="col-lg-6">
									<label><b>Payment Per Questionnaire</b></label>
									<input type="text" class="form-control input-lg" name="pay_per_ques" id="pay_per_ques" required> 
								</div>
							</div>
						</div>
					
						<br>
						<div class="col-lg-12">
							<button type="submit" name="createPlan" onclick="return confirm('You are about to create a new investment plan \n \n Create Investment ?')" class="btn btn-primary">
								<i class='fa fa-plus'></i> Create Plan</button>  
						</div> <br>
					</form>
					
					
                </div>
	 
	 
	 </div>
	 
	</div><!--End Row-->
	
	
      <!--End Dashboard Content-->
	  
	<!--start overlay-->
		  <div class="overlay toggle-menu"></div>
		<!--end overlay-->
		
    </div>
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
	
  </div>
	
	<footer class="footer">
      <div class="container">
        <div class="text-center">
          Copyright ?? 2021 Cizar Consult.
        </div>
      </div>
    </footer>
	
  
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
	
 <!-- simplebar js -->
  <script src="assets/plugins/simplebar/js/simplebar.js"></script>
  <!-- sidebar-menu js -->
  <script src="assets/js/sidebar-menu.js"></script>
  <!-- loader scripts -->
  <script src="assets/js/jquery.loading-indicator.js"></script>
  <!-- Custom scripts -->
  <script src="assets/js/app-script.js"></script>
  <!-- Chart js -->
  
  <script src="assets/plugins/Chart.js/Chart.min.js"></script>
 
  <!-- Index js -->
  <script src="assets/js/index.js"></script>

  
</body>
</html>
