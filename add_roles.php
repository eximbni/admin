<?php
$message='';
if(isset($_POST['submit'])){
	include("config.php");
	$roles = $_POST['roles'];

	$sql = "insert into admin_user_roles(role_name,status) values('$roles','1')";
	$res = mysqli_query($conn,$sql);
	if($res){
		$message = "Roles Added Successfully";
	}
	else{
		$message = "Error adding roles";
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
						  <li class="breadcrumb-item active">Roles</li>
						</ol>
					  </div>
					</div>
					<div class="row mb-2">
					  <div class="col-sm-12">
						<h4><b>Add Roles</b></h4>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->
	
				</section>
				
				<h4><?php echo $message; ?></h4>
				<section class="container">
				<div class="col-md-12 card"> 	
				<div class="row">
				<div class="col-md-10">
				<form role="form" action="<?php echo $_SERVER['PHP-SELF']; ?>" method="POST">
						<div class="form-group">
							<label for="">Enter Role Name</label>
							<input type="text" class="form-control" id="roles" name="roles" placeholder="Enter Roles" required="">
						</div>
						
				</div>
				<div class="col-md-2" style="margin-top:30px;">
							<input type="submit" class="btn btn-primary btn-block" name="submit" value="Submit">
						</div>
					 </form>
				</div>
				</div>
				<div class="col-md-10">
					
					 
				
				
				</div>	
				</section>
				<section class="container">
				<div class="card">
				<table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
						  <th>Sr.No</th>
						  <th>Role</th>
						  <th>Status</td>
						  <th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$sql_chk = "SELECT * FROM `admin_user_roles`";
						//echo $sql_chk;
						$query_chkres = mysqli_query($conn,$sql_chk);
						if(mysqli_num_rows($query_chkres)>0){
						$srno = 1;	
							while($row = mysqli_fetch_array($query_chkres)){
						?>	
						   	<tr>
							  <td align="center"><?= $srno; ?></td>
							  <td align="left"><?= $row['role_name']; ?></td>
							  <td align="center"><?= $row['status']; ?></td>
							  <td><a class="btn btn-warning" href="edit_user.php?id=<?php echo $row['id']; ?>">Edit</a></td>
							</tr>
						<?php
							$srno++;
							}
						}
						else{

						}
						?>
						</tbody>
					  </table>
					  </div>
				</section>
				
			</div>
</div>
 </body>
 </html>