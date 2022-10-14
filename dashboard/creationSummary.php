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
  <title>9jaBusiness - Business Creation Summary</title>
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
           <div class="card-title" style="font-size: 20px">Created Business Summary</div>
           <p style="font-size: 18px;">Your wallet balance is <b>&dollar;<?php echo number_format($action->userWallet($userid)["usd"], 2);?></b></p>
           <hr>
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<tr>
						<th>S/No</th>
            <th>Business Info</th>
            <th>Business Address</th>
            <th>Status </th> 
             <th> </th>
					</tr>
					<tr>
					 <?php $i = 1;
					     $usr = $action->query("SELECT * FROM `businesscreation` where userid='$userid' order by id desc limit $start_page, $per_page");
              $usr->execute();
					   while($usrInfo = $usr->fetch(PDO::FETCH_ASSOC)) {
                 $id = $usrInfo["id"];
                 $address = $usrInfo["address"];
                $businessname = $usrInfo["businessname"];
                $business_category = $usrInfo["business_category"];
                $dateCreated = $usrInfo["dateCreated"];
                $txStatus = $usrInfo["status"];
                $earnings = $usrInfo["earnings"];
                $url = $usrInfo["url"];
                $founder = $usrInfo["founder"];
                $mobile = $usrInfo["mobile"];
                $establishment_date = $usrInfo["datefounded"];
                $workhours = $usrInfo["workhours"];
                $description = $usrInfo["description"];
                $attachment = json_decode($loadBuss["attachment"], true);
                $logo = $attachment["logo"];
                $office_pic = $attachment["office"];

                if($txStatus == 0) {
                    $status = "<span class='text-info'><b>Pending</b></span>";
                } else if($txStatus == 1) {
                    $status = "<span class='text-success'><b>Approved</b></span>";
                }  else if($txStatus == 2) {
                    $status = "<span class='text-danger'><b>Failed</b></span>";
                }   else {
                    $status = "";
                }
					   ?>
						   <td><?php echo $i++;?></td>
						  <td><?php echo $businessname;?> <br/>
                    <?php if(!empty($business_category)) { ?>
                        <b style="color: #f5a21b">Category : </b><?php echo $action->business_category($business_category);?><br/>
                    <?php } ?>
                    <b style="color: gold">Website : </b><?php echo $url;?>
                </td>
                <td><?php echo $address;
                    if($txStatus == 1) { ?>
                        <br/>
                        <b style="color: #f5a21b">Earnings : </b> &dollar;<?php echo number_format($usrInfo["earnings"], 2);?>
                    <?php } ?>
                    <br/>
                    <b style="color: #E4CD05">Date Created : </b> <?php echo $dateCreated;?>
                    
                </td>
                <td class="font-bold text-muted">
                    <?php echo $status;?>
                </td>
                <td>
                    <button class="btn btn-sm btn-info pl-4 pr-4" data-toggle="modal" data-target="#userid<?php echo $id;?>">
                        View <i class="fa fa-th ml-1"></i>
                    </button>
                </td>


                    <div class="modal fade" id="userid<?php echo $id;?>" style='margin-top: 40px;'>
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title" style="color> Business Information</h4>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div id="modalContent">
                                      <?php
                                        if($txStatus == 0) {
                                            ?>
                            
                                        
                                            <p style="color:black;text-align: center; font-size: 16px;">Business Name: <b><?php echo $businessname;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Address: <b><?php echo $address;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Website: <b><?php echo $url;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Founder: <b><?php echo $founder;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Working Hour: <b><?php echo $workhours;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Establishment Date: <b><?php echo $establishment_date;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Phone Contact: <b><?php echo $mobile;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Other Description: <b><?php echo $description;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Logo: <img src="../uploads/<?php echo $logo;?>" style="width: 200px; height: 150px;" class="img img-responsive"/></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Office Building:    <img src="../uploads/<?php echo $office_pic;?>" style="width: 280px; height: 200px;" class="img img-responsive"/></p><br>
                                           
                                            <br><br>
                                            <div align="center">
                                               
                                            </div>
                                            <br>

                                            <center>
                                                <a href="index" class="btn btn-danger">Close Window</a>
                                            </center>
                                            <?php
                                        } else if($txStatus == 1) {
                                            ?>
                                          
                                            <p style="color:black;text-align: center; font-size: 16px;">Business Name: <b><?php echo $businessname;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Address: <b><?php echo $address;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Website: <b><?php echo $url;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Founder: <b><?php echo $founder;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Working Hour: <b><?php echo $workhours;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Establishment Date: <b><?php echo $establishment_date;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Phone Contact: <b><?php echo $mobile;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Other Description: <b><?php echo $description;?></b></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Logo: <img src="../uploads/<?php echo $logo;?>" style="width: 200px; height: 150px;" class="img img-responsive"/></p><br>
                                            <p style="color:black;text-align: center; font-size: 16px;">Office Building:    <img src="../uploads/<?php echo $office_pic;?>" style="width: 280px; height: 200px;" class="img img-responsive"/></p><br>
                                           
                                         

                                            <center>
                                                <a href="index" class="btn btn-danger">Close Window</a>
                                            </center>
                                            <?php
                                        } else if($txStatus == 2) {
                                            ?>
											
											<div style="word-wrap: break-word; color: #000; font-size: 20px; margin-bottom: 1%">
												<?php echo nl2br($usrInfo["msg"]);?>
											</div>
                                            <center>
                                                <a href="index" class="btn btn-danger">Close Window</a>
                                            </center>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

					   </tr>
					   <?php } ?>
				</table>
		  
				<div class="text-center" style="margin-top: 2%">
					<?php echo $action->paginate("", "SELECT * FROM `businesscreation` where userid='$userid' order by id desc");?>
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
