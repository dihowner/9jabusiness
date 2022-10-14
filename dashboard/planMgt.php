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

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>9jaBusiness - Plan Management</title>
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

    <div class="row mt-3">
      <div class="col-lg-12">
         <div class="card">
           <div class="card-body">
		   
			<?php
			if(isset($_POST["addLevel"])) {
				$level_name = addslashes($_POST["level_name"]);
				$amount = $_POST["amount"];
				$business_no = $_POST["business_no"];
				$business_review = $_POST["business_review"];
				$refComm = $_POST["refComm"];
				
				// search Plan
				$searchPlan = $action->query("select * from plans where name='$level_name'"); $searchPlan->execute();
				
				if($searchPlan->rowCount() > 0) { ?>
					<div class="alert alert-danger"><b>Error : </b> Plan already exists </div>
				<?php } else if(filter_var($amount, FILTER_VALIDATE_FLOAT) == false) { ?>
					<div class="alert alert-danger"><b>Error : </b> Invalid plan amount </div>
				<?php } else if(filter_var($refComm, FILTER_VALIDATE_FLOAT) == false) { ?>
					<div class="alert alert-danger"><b>Error : </b> Invalid referral commission amount </div>
				<?php } else {
				
					$savePlan = $action->query("insert into plans (name, price, bus_no, bus_review, refComm) values ('$level_name', '$amount', '$business_no', '$business_review', '$refComm')");
					
					if($savePlan->execute()) { ?>
						<script>
							swal.fire({
								icon: "success",
								title: "Plan Added",
								text: "Plan level has been added succesfully"
							}).then((isRedirect) => {
								if(isRedirect.isConfirmed) {
									window.location = "";
								}
							});
						</script>
					<?php } else { ?>
						<div class="alert alert-danger"><b>Error : </b> We could not create a plan </div>
					<?php }
					
				}
			}
			?>
		   
			<ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
                <li class="nav-item">
                    <a href="javascript:void();" data-target="#profile" data-toggle="pill" class="nav-link active"><i class="icon-plus"></i>
						<span class="hidden-xs">Create Level</span></a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void();" data-target="#messages" data-toggle="pill" class="nav-link"><i class="icon-list"></i> 
						<span class="hidden-xs">All Levels</span></a>
                </li>
            </ul>
            <div class="tab-content p-3">
                <div class="tab-pane active" id="profile">
                    
					<form method="post" style="margin-top: 2%">
						<div class="form-group row">
							<div class="col-lg-6">
								<label for="input-1">Level Name</label>
								<input type="text" class="form-control" id="level_name" name="level_name" placeholder="Enter Level Name" required>
							</div>
							<div class="col-lg-6">
								<label for="input-1">Amount(&dollar;)</label>
								<input type="number" min="0" class="form-control" id="amount" name="amount" placeholder="Enter Price of Level" required>
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-lg-6">
								<label for="business_no">Number of business</label>
								<input type="number" min="1" class="form-control" id="business_no" name="business_no" placeholder="How many businesses can be created" required>
							</div>
							<div class="col-lg-6">
								<label for="input-1">Number of business review</label>
								<input type="number" min="1" class="form-control" id="business_review" name="business_review" placeholder="How many business can be review" required>
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-lg-6">
								<label for="business_no">Referral Commission</label>
								<input type="text" class="form-control" id="refComm" name="refComm" placeholder="Referral commission" required>
							</div>
						</div>
				   
						<div class="form-group">
							<button type="submit" class="btn btn-light px-5" name="addLevel"><i class="icon-plus"></i> Add Level</button>
						</div>
					</form>
					
                </div>
                <div class="tab-pane" id="messages">
					
					
				<div class="table-responsive" style="margin-top: 2%">
				   <table class="table table-striped">
					  <thead>
						<tr>
						  <th scope="col">#</th>
						  <th scope="col">Level Name</th>
						  <th scope="col">Price</th>
						  <th scope="col">Number of Business</th>
						  <th scope="col">Number of Business Review</th>
						  <th scope="col">Referral Commission</th>
						  <th scope="col"></th>
						</tr>
					  </thead>
					  <tbody>
						<tr>
						<?php $i = 1;
						$loadLev = $action->query("select * from plans order by id desc"); $loadLev->execute();
						while($loadLevs = $loadLev->fetch(PDO::FETCH_ASSOC)) { ?>
							<td scope="row"><?php echo $i++;?></td>
							<td><?php echo $loadLevs["name"];?></td>
							<td>&dollar;<?php echo number_format($loadLevs["price"], 2);?></td>
							<td><?php echo number_format($loadLevs["bus_no"]);?></td>
							<td><?php echo number_format($loadLevs["bus_review"]);?></td>
							<td><?php echo number_format($loadLevs["refComm"], 2);?>%</td>
							<td>
								<button class="btn btn-danger btn-sm" id="delBtn<?php echo $loadLevs["id"];?>"><b><i class="icon-trash"></i> Delete</b></button>
								<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#edtModal<?php echo $loadLevs["id"];?>"><b><i class="icon-pencil"></i> Edit</b></button>
							</td>
							
							<div id="edtModal<?php echo $loadLevs["id"];?>" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" style="color: #000">Edit Level</h4>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>
										<div class="modal-body">
											<form method="post">
											
												<div class="form-group">
													<label style="color: #000"><b>Level Name</b></label>
													<input type="text" class="form-control" value="<?php echo $loadLevs["name"];?>" style="background: rgba(21, 14, 14, 0.45)"  id="level_name<?php echo $loadLevs['id'];?>" name="level_name<?php echo $loadLevs['id'];?>">
												</div>
											
												<div class="form-group">
													<label style="color: #000"><b>Price</b></label>
													<input type="number" min="0" class="form-control" value="<?php echo $loadLevs["price"];?>" style="background: rgba(21, 14, 14, 0.45)"  id="price<?php echo $loadLevs['id'];?>" name="price<?php echo $loadLevs['id'];?>">
												</div>
											
												<div class="form-group">
													<label style="color: #000"><b>Number of Business</b></label>
													<input type="number" min="1" class="form-control" value="<?php echo $loadLevs["bus_no"];?>" style="background: rgba(21, 14, 14, 0.45)"  id="bus_no<?php echo $loadLevs['id'];?>" name="bus_no<?php echo $loadLevs['id'];?>">
												</div>
											
												<div class="form-group">
													<label style="color: #000"><b>Number of Business Review</b></label>
													<input type="number" min="1" class="form-control" value="<?php echo $loadLevs["bus_review"];?>" style="background: rgba(21, 14, 14, 0.45)"  id="bus_review<?php echo $loadLevs['id'];?>" name="bus_review<?php echo $loadLevs['id'];?>">
												</div>
											
												<div class="form-group">
													<label style="color: #000"><b>Referral Commission</b></label>
													<input type="text" class="form-control" value="<?php echo $loadLevs["refComm"];?>" style="background: rgba(21, 14, 14, 0.45)"  id="refComm<?php echo $loadLevs['id'];?>" name="refComm<?php echo $loadLevs['id'];?>">
												</div>
											
												<div class="form-group text-center">
													<button class="btn btn-primary" type="submit" name="updateLevel<?php echo $loadLevs["id"];?>" id="updateLevel<?php echo $loadLevs["id"];?>"><b>Modify</b></button>
												</div>
											</form>
										</div>										
									</div>
								</div>
							</div>
							
							
							<script>
								$(document).ready(function() {
									
									//Edit Button...
									$("#updateLevel<?php echo $loadLevs['id'];?>").click(function(e) {
										e.preventDefault();
										const level_id = <?php echo $loadLevs['id'];?>;
										
										var formData = {
											updateLevel: "updateLevel",
											level_name: $("#level_name<?php echo $loadLevs['id'];?>").val(),
											price: $("#price<?php echo $loadLevs['id'];?>").val(),
											bus_no: $("#bus_no<?php echo $loadLevs['id'];?>").val(),
											bus_review: $("#bus_review<?php echo $loadLevs['id'];?>").val(),
											refComm: $("#refComm<?php echo $loadLevs['id'];?>").val(),
											id: level_id
										}
										
										if($("#level_name<?php echo $loadLevs['id'];?>").val().length == 0 || $("#price<?php echo $loadLevs['id'];?>").val().length == 0 || $("#bus_no<?php echo $loadLevs['id'];?>").val().length == 0 || $("#bus_review<?php echo $loadLevs['id'];?>").val().length == 0 ) {
											swal.fire({
												icon: 'error',
												title: "Missing field",
												text: "Please fill all field",
												confirmButtonText: 'OK'
											});
										} else {
											
											$.ajax({
												type: "POST",
												data: formData,
												url: "../process.php",
												success: function (response) {
													console.log(response);
																										
													if($.trim(response) == "success") {
														swal.fire({
															title: "Success!",
															html: "Level updated succesfully",
															icon: "success"
														}).then(function() { 
															window.location = "";
														})
													} else if($.trim(response) == "login_needed") {
														swal.fire({
															title: "Unauthorized Access",
															html: "Your session has expired. Kindly login to continue",
															icon: "error"
														}).then(function() { 
															window.location = "";
														})
													} else {
														swal.fire({
															icon: 'error',
															title: "Error Updating",
															text: "Oops, error updating level, please try again",
															confirmButtonText: 'OK'
														});
													}
												},
												error: function () {
													swal.fire({
														icon: 'error',
														title: "Error Updating",
														text: "Oops, error processing request, please try again",
														confirmButtonText: 'OK'
													});
												}
											});
											
										}
										
									});
									
									//Delete Button...
									$("#delBtn<?php echo $loadLevs['id'];?>").click(function() {
										const level_name = "<?php echo $loadLevs['name'];?>"
										const level_id = <?php echo $loadLevs['id'];?>;
										
										var formData = {
											deleteLeveL: "deleteLeveL",
											id: level_id
										}
										
										Swal.fire({
											icon: 'warning',
											title: "Delete Level ("+level_name+") ?",
											text: "You won't be able to revert this and all users on this plan won't be able to execute any transaction!",
											allowOutsideClick: false,
											showCancelButton: true,
											showLoaderOnConfirm: true,
											confirmButtonText: 'Yes, delete it!',
											
										}).then((result) => {
											if (result.isConfirmed) {
												$.ajax({
													type: "POST",
													data: formData,
													url: "../process.php",
													// url: "process.php",
													success: function (response) {
														console.log(response);
														if($.trim(response) == "success") {
															swal.fire({
																title: "Success!",
																html: "Level (<b>"+level_name+"</b>) has been deleted succesfully",
																icon: "success"
															}).then(function() { 
																window.location = "";
															})
														} else if($.trim(response) == "login_needed") {
															swal.fire({
																title: "Unauthorized Access",
																html: "Your session has expired. Kindly login to continue",
																icon: "error"
															}).then(function() { 
																window.location = "";
															})
														} else {
															swal.fire({
																icon: 'error',
																title: "Error Deleting",
																text: "Oops, error processing request, please try again",
																confirmButtonText: 'OK'
															});
														}
													},
													error: function () {
														swal.fire({
															icon: 'error',
															title: "Error Deleting",
															text: "Oops, error processing request, please try again",
															confirmButtonText: 'OK'
														});
													}
												});
											}
										});
									});
								});
							</script>
							
						</tr>
						<?php } ?>
					  </tbody>
					</table>
				</div>
				
				</div>
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