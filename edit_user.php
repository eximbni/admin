<?php
include("config.php");
$message='';
if(isset($_POST['submit'])){
	$id = $_POST['id'];
	$username=$_POST['username'];
	$mobile=$_POST['mobile'];
	$email=$_POST['email'];
	$password=md5($_POST['password']);
    $role = $_POST['role'];
    $designation = $_POST['designation'];
	$join_date = $_POST['join_date'];
	$aleternate_number = $_POST['aleternate_number'];
	$checkbox1=$_POST['permission'];  
	$count = count($_POST['permission']);
	$selected1=""; 
	foreach($checkbox1 as $selected)  
	{  
		$selected1 .= $selected.",";  
	}
	$selected1 = rtrim($selected1, ",");

	$sql = "update admin_users  set name='$username',mobile='$mobile',email='$email',role='$role',designation='$designation',joining='$join_date',aleternate_number='$aleternate_number',permissions='$selected1' where id='$id'";
	//echo $sql;
	$res = mysqli_query($conn,$sql);
	if($res){
		$message = "User Update Successfully";
	}
	else{
		$message = "Error updating User";
		echo mysqli_error($conn);
	}
}
?>
<!DOCTYPE html>
<html>
<head>
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

			<?php include("header.php")?>
		  <!-- /.navbar -->

		  <!-- Main Sidebar Container -->
		  <aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<?php include("sidemenu.php");?>
		  </aside>
			<div class="content-wrapper">
			
				<section class="content-header">
				  <div class="container-fluid">
					<div class="row mb-2">
					  <div class="col-sm-12">
						<ol class="breadcrumb float-sm-left">
						  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
						  <li class="breadcrumb-item"><a href="">Admin User Module</a></li>
						  <li class="breadcrumb-item active">Edit User</li>
						</ol>
					  </div>
					</div>
					<div class="row mb-2">
					  <div class="col-sm-12">
						<h4 style="text-align:center;"><b>Edit User</b></h4>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->
	
				</section>
				
				
				<section>
				<h2 style="color:red"><?php echo $message; ?></h2>
				<div class="card p-3">
				<div class="container">
					<form role="form" action="<?php echo $_SERVER['PHP-SELF']; ?>" method="POST">
									<?php
									$id = $_GET['id'];
									$sql = "select * from admin_users where id='$id'";
									$res = mysqli_query($conn,$sql);
									$row = mysqli_fetch_assoc($res);
									$permissions=explode(",",$row['permissions']);
									?>
									<div class="form-group">
									  <label for="">Username </label>
									  <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo $row['name']; ?>" required>
									  <input type="hidden" class="form-control" name="id" value="<?php echo $row['id']; ?>">
									</div>
									<div class="form-group">
									  <label for="">Mobile No </label>
									  <input type="number" class="form-control" id="" name="mobile" placeholder="Mobile No" value="<?php echo $row['mobile']; ?>" required>
									</div>
									<div class="form-group">
									  <label for="">Email </label>
									  <input type="email" class="form-control" id="" name="email" placeholder="Email" value="<?php echo $row['email']; ?>" required>
									</div>
									<!--div class="form-group">
									  <label for="">Password </label>
									  <input type="password" class="form-control" name="password" id="" placeholder="******" required>
									</div-->
									<div class="form-group">
									  <label>Role</label>
									  <select class="form-control" name="role">
									  <option><?php echo $row['role']; ?></option>
									  <option>Select Role</option>
										<option>Super Admin</option>
										<option>Admin</option>
										<option>User</option>
									  </select>
									</div>
									<div class="form-group">
									  <label for="">User Designation</label>
									  <input type="text" class="form-control" id="" name="designation" placeholder="User Designation" value="<?php echo $row['designation']; ?>" required>
									</div>
									<div class="form-group">
									  <label for="">Joining Date</label>
									  <input type="date" class="form-control" id="" data-date-format="YYYY-MM-DD" name="join_date" placeholder="Join Date" value="<?php echo $row['joining']; ?>" required>
									</div>
									<div class="form-group">
									  <label for="">Alternate No </label>
									  <input type="number" class="form-control" id="" name="aleternate_number" placeholder="Alternate Number" value="<?php echo $row['aleternate_number']; ?>" required>
									</div>
									<div class="form-group">
										<label>Permissions</label>
										<br>
										<input type="checkbox" name="permission[]" value="franchise" <?php if(in_array("franchise",$permissions)) { ?> checked="checked" <?php } ?> > Franchise Module
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="checkbox" name="permission[]" value="ad_user" <?php if(in_array("ad_user",$permissions)) { ?> checked="checked" <?php } ?> > Addmin User Module
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="checkbox" name="permission[]" value="leads" <?php if(in_array("leads",$permissions)) { ?> checked="checked" <?php } ?> > Leads Module
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="checkbox" name="permission[]" value="package" <?php if(in_array("package",$permissions)) { ?> checked="checked" <?php } ?> > Packages Module&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="checkbox" name="permission[]" value="accounts" <?php if(in_array("accounts",$permissions)) { ?> checked="checked" <?php } ?> > Accounts Module&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="checkbox" name="permission[]" value="cms" <?php if(in_array("cms",$permissions)) { ?> checked="checked" <?php } ?> > CMS Module&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="checkbox" name="permission[]" value="notification" <?php if(in_array("notification",$permissions)) { ?> checked="checked" <?php } ?> > Notification Module<br/>
										<input type="checkbox" name="permission[]" value="banner" <?php if(in_array("banner",$permissions)) { ?> checked="checked" <?php } ?> > Banner Module&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="checkbox" name="permission[]" value="schedular" <?php if(in_array("schedular",$permissions)) { ?> checked="checked" <?php } ?> > Schedular Module&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="checkbox" name="permission[]" value="system" <?php if(in_array("system",$permissions)) { ?> checked="checked" <?php } ?> > System Data&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									</div>
									
									
								  <div class="box-footer text-right " >
									<input type="submit" class="btn btn-outline-primary" name="submit" value="Submit">
								  </div>
					 </form>
					 
				</div>
				</div>
				</section>
			</div>
</div>
 </body>
 </html>