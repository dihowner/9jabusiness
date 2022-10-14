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
  <title>9jaBusiness - Category Management</title>
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
			if(isset($_POST["addCategory"])) {
				$cat_name = addslashes(str_replace("&", "and", $_POST["cat_name"]));
				
				$savePlan = $action->query("insert into category (category_name) values ('$cat_name')");
				
				if($savePlan->execute()) { ?>
					<script>
						swal.fire({
							icon: "success",
							title: "Category Added",
							text: "Category has been added succesfully"
						}).then((isRedirect) => {
							if(isRedirect.isConfirmed) {
								window.location = "";
							}
						});
					</script>
				<?php } else { ?>
					<div class="alert alert-danger"><b>Error : </b> We could not create a category </div>
				<?php }
				
			}
			?>
		   
			<ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
                <li class="nav-item">
                    <a href="javascript:void();" data-target="#profile" data-toggle="pill" class="nav-link active"><i class="icon-plus"></i>
						<span class="hidden-xs">Create Category</span></a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void();" data-target="#messages" data-toggle="pill" class="nav-link"><i class="icon-list"></i> 
						<span class="hidden-xs">All Category</span></a>
                </li>
            </ul>
            <div class="tab-content p-3">
                <div class="tab-pane active" id="profile">
                    
					<form method="post" style="margin-top: 2%" autocomplete="off">
						<div class="form-group row">
							<div class="col-lg-12">
								<label for="input-1">Category Name</label>
								<input type="text" class="form-control" id="cat_name" name="cat_name" placeholder="Enter Category Name" required>
							</div>
						</div>
				   
						<div class="form-group">
							<button type="submit" class="btn btn-light px-5" name="addCategory"><i class="icon-plus"></i> Add Category</button>
						</div>
					</form>
					
                </div>
                <div class="tab-pane" id="messages">
					
					
				<div class="table-responsive" style="margin-top: 2%">
				   <table class="table table-striped">
					  <thead>
						<tr>
						  <th scope="col">#</th>
						  <th scope="col">Category Name</th>
						  <th scope="col"></th>
						</tr>
					  </thead>
					  <tbody>
						<tr>
						<?php $i = 1;
						$loadCat = $action->query("select * from category order by id desc"); $loadCat->execute();
						while($loadCats = $loadCat->fetch(PDO::FETCH_ASSOC)) { ?>
							<td scope="row"><?php echo $i++;?></td>
							<td><?php echo $loadCats["category_name"];?></td>
							<td>
								<button class="btn btn-danger btn-sm" id="delBtn<?php echo $loadCats["id"];?>"><b><i class="icon-trash"></i> Delete</b></button>
								<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#edtModal<?php echo $loadCats["id"];?>"><b><i class="icon-pencil"></i> Edit</b></button>
							</td>
							
							<div id="edtModal<?php echo $loadCats["id"];?>" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" style="color: #000">Edit Category</h4>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>
										<div class="modal-body">
											<form method="post">
											
												<div class="form-group">
													<label style="color: #000"><b>Category Name</b></label>
													<input type="text" class="form-control" value="<?php echo $loadCats["category_name"];?>" style="background: #000" disabled>
												</div>
											
												<div class="form-group">
													<label style="color: #000"><b>Category Name</b></label>
													<input type="text" class="form-control" value="<?php echo $loadCats["category_name"];?>" style="background: rgba(21, 14, 14, 0.45)"  id="category_name<?php echo $loadCats['id'];?>" name="category_name<?php echo $loadCats['id'];?>">
												</div>
											
												<div class="form-group text-center">
													<button class="btn btn-primary" type="submit" name="updateCategory<?php echo $loadCats["id"];?>" id="updateCategory<?php echo $loadCats["id"];?>"><b>Modify</b></button>
												</div>
											</form>
										</div>										
									</div>
								</div>
							</div>
							
							
							<script>
								$(document).ready(function() {
									
									//Edit Button...
									$("#updateCategory<?php echo $loadCats['id'];?>").click(function(e) {
										e.preventDefault();
										const category_id = <?php echo $loadCats['id'];?>;
										
										var formData = {
											updateCategory: "updateCategory",
											category_name: $("#category_name<?php echo $loadCats['id'];?>").val(),
											id: category_id
										}
										
										if($("#category_name<?php echo $loadCats['id'];?>").val().length == 0){
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
															html: "Category updated succesfully",
															icon: "success"
														})
														.then(function() { 
															window.location = "";
														})
													} else if($.trim(response) == "login_needed") {
														swal.fire({
															title: "Unauthorized Access",
															html: "Your session has expired. Kindly login to continue",
															icon: "error"
														})
														.then(function() { 
															window.location = "";
														})
													} else {
														swal.fire({
															icon: 'error',
															title: "Error",
															text: "Oops, error updating category, please try again",
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
									
									//Delete Button...
									$("#delBtn<?php echo $loadCats['id'];?>").click(function() {
										const category_name = "<?php echo $loadCats['category_name'];?>"
										const category_id = <?php echo $loadCats['id'];?>;
										
										var formData = {
											deleteCategory: "deleteCategory",
											id: category_id
										}
										
										Swal.fire({
											icon: 'warning',
											title: "Delete Category ?",
											html: "You are about to delete <b>"+category_name+"</b>. You won't be able to revert this and all business on this category will be affected!",
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
																html: "Category (<b>"+category_name+"</b>) has been deleted succesfully",
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