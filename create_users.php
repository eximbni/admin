<?php
$message='';
if(isset($_POST['submit'])){
	include("config.php");
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
	if($role==3)
	{
	    $country_id=$_POST['country_id'];
	    $state_id=$_POST['state_id'];
	}
	else
    {
	    $country_id='';
	    $state_id='';
	}
	
	foreach($checkbox1 as $selected)  
	{  
		$selected1 .= $selected.",";  
	}
	$selected1 = rtrim($selected1, ",");
	$chk = "select * from admin_users where email='$email'";
	$chkres = mysqli_query($conn,$chk);
	if(mysqli_num_rows($chkres)>0){
		$message="User Already Exists";
	}
	else{
	$sql = "insert into admin_users(name,mobile,email,password,role,designation,joining,aleternate_number,permissions,country_id,state_id) values('$username','$mobile','$email','$password','$role','$designation','$join_date','$aleternate_number','$selected1','$country_id','$state_id')";
	//echo $sql;
	$res = mysqli_query($conn,$sql);
	if($res){
		$message = "User Added Successfully";
	}
	else{
		$message = "Error adding User";
		echo mysqli_error($conn);
	}
	}
}
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
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
						  <li class="breadcrumb-item active">Create User</li>
						</ol>
					  </div>
					</div>
					<div class="row mb-2">
					  <div class="col-sm-12">
						<h4 style="text-align:center;"><b>Create User</b></h4>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->
	
				</section>
				
				
				<section>
				<h2 style="color:red"><?php echo $message; ?></h2>
				<div class="card p-3">
				<div class="container">
					<form role="form" action="<?php echo $_SERVER['PHP-SELF']; ?>" method="POST">
									
									<div class="form-group">
									  <label for="">Username </label>
									  <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
									</div>
									<div class="form-group">
									  <label for="">Mobile No </label>
									  <input type="number" class="form-control" id="" name="mobile" placeholder="Mobile No" required>
									</div>
									<div class="form-group">
									  <label for="">Email </label>
									  <input type="email" class="form-control" id="" name="email" placeholder="Email" required>
									</div>
									<div class="form-group">
									  <label for="">Password </label>
									  <input type="password" class="form-control" name="password" id="" placeholder="******" required>
									</div>
									<div class="form-group">
									  <label>Role</label>
									  <select class="form-control" name="role" id="role" required onchange="checkrole();">
										<option>select</option>
									<?php include("config.php");
										$get = "select * from admin_user_roles";
										$res = mysqli_query($conn,$get);
										if($res){
											while($row=mysqli_fetch_assoc($res)){
										?>
											<option value="<?php echo $row['id'];?>"><?php echo $row['role_name'];?></option>
									<?php }} ?>	
										
									  </select>
									  <!--select class="form-control" name="role">
									  <option>Select Role</option>
										<option>Super Admin</option>
										<option>Admin</option>
										<option>User</option>
									  </select-->
									</div>
									<div class="form-group" id="country" style="display:none;">
									  <label for="">Country</label>
									  <select class="form-control" name="country_id" id="country_id" onchange="getState();" required>
											<option>Select</option>
											<?php include("config.php");
                    						$get = "select * from countries";
                    						$res = mysqli_query($conn,$get);
                    						if ($res){
                    							while($row=mysqli_fetch_assoc($res)){
                    						?>
                    										<option value="<?php echo $row['country_id'];?>"><?php echo $row['name'];?></option>
                    						<?php }} ?>	
										  </select>
									</div>
									<div class="form-group" id="state" style="display:none;">
									  <label>Select State</label>
									  <select class="form-control" name="state_id" id="state_id">
										
									  </select>
									</div>
									<div class="form-group">
									  <label for="">User Designation</label>
									  <input type="text" class="form-control" id="" name="designation" placeholder="User Designation" required>
									</div>
									<div class="form-group">
									  <label for="">Joining Date</label>
									  <input type="date" class="form-control" id="" data-date-format="YYYY-MM-DD" name="join_date" placeholder="Join Date" required>
									</div>
									<div class="form-group">
									  <label for="">Alternate No </label>
									  <input type="number" class="form-control" id="" name="aleternate_number" placeholder="Alternate Number"required>
									</div>
									<div class="form-group">
										<label>Permissions</label>
										<br>
										<input type="checkbox" name="permission[]" value="franchise" unchecked> Franchise Module
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="checkbox" name="permission[]" value="ad_user" unchecked> Addmin User Module
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="checkbox" name="permission[]" value="leads" unchecked> Leads Module
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="checkbox" name="permission[]" value="package" unchecked> Packages Module&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="checkbox" name="permission[]" value="accounts" unchecked> Accounts Module&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="checkbox" name="permission[]" value="cms" unchecked> CMS Module&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="checkbox" name="permission[]" value="notification" unchecked> Notification Module<br/>
										<input type="checkbox" name="permission[]" value="banner" unchecked> Banner Module&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="checkbox" name="permission[]" value="schedular" unchecked> Schedular Module&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="checkbox" name="permission[]" value="system" unchecked> System Data&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
 <script>
 function getState()
 {
	var country_id = $("#country_id").val();
	//alert(country_id);
	$.ajax({
		type:"POST",
		url:"get_state.php",
		data:{
			id:country_id
		},
		dataType:'json',
		success:function(response)
		{
			//alert(response);
			$("#state_id").empty;
			$("#state_id").append(response);
		},
		error:function(error)
		{
			alert(error);
		},
	});
 }
 
 function checkrole()
 {
     var role = $("#role").val();
     if(role==3)
     {
         document.getElementById('country').style.display = "block";
         document.getElementById('state').style.display = "block";
     }
     else
     {
         document.getElementById('country').style.display = "none";
         document.getElementById('state').style.display = "none";
     }
 }
 </script>
 </html>