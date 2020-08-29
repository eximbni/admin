<?php
date_default_timezone_set("Asia/Kolkata");
$message='';
if(isset($_POST['submit'])){
	include("config.php");
	$template_name=$_POST['template_name'];
	$template_path=$_POST['template_path'];
	$template_type=$_POST['template_type'];
	$date = date('Y-m-d h:i:s');
	$chk = "select * from templates where name='$name'";
	$chkres = mysqli_query($conn,$chk);
	if(mysqli_num_rows($chkres)>0){
		$message="Template Already Exists";
	}
	else{
	$sql = "insert into templates(template_name,template_path,template_type,created,status) values('$template_name','$template_path','$template_type','$date','1')";
	//echo $sql;
	$res = mysqli_query($conn,$sql);
	if($res){
		$message = "Template Added Successfully";
	}
	else{
		$message = "Error adding template";
		echo mysqli_error($conn);
	}
	}
}

if(isset($_POST['update'])){
	include("config.php");
	$id = $_POST['id'];
	$template_name=$_POST['template_name'];
	$template_path=$_POST['template_path'];
	$template_type=$_POST['template_type'];
	
	$sql = "update templates set template_name='$template_name',template_path='$template_path',template_type='$template_type' where id='$id'";
	//echo $sql;
	$res = mysqli_query($conn,$sql);
	if($res){
		$message = "Template update Successfully";
	}
	else{
		$message = "Error updating template";
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
						  <li class="breadcrumb-item"><a href="">System  Module</a></li>
						  <li class="breadcrumb-item active">Templates</li>
						</ol>
					  </div>
					</div>
					<div class="row mb-2">
					  <div class="col-sm-12">
						<h4 style="text-align:center;"><b>Templates</b></h4>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->
	
				</section>
				
				
				<section>
				<h2 id="msg" style="color:red"><?php echo $message; ?></h2>
				<div class="card p-3">
				<div class="container">
					
					 <?php
						if(isset($_GET['id']))
						{ ?>
					 <form id="update" role="form" action="<?php echo $_SERVER['PHP-SELF']; ?>" method="POST">
									<?php
									if(isset($_GET['id']))
									{
										$id = $_GET['id'];
										$sql_template = "select * from templates where id='$id'";
										$res_template = mysqli_query($conn, $sql_template);
										$row_template = mysqli_fetch_assoc($res_template);
									}
									?>
									<div class="form-group">
									  <label for="">Template Name </label>
									  <input type="text" class="form-control" id="template_name" name="template_name" placeholder="Template Name" value="<?php  echo $row_template['template_name']; ?>" required>
									  <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>">
									</div>
									<div class="form-group">
									  <label for="">Template Path </label>
									  <input type="text" class="form-control" id="template_path" name="template_path" placeholder="Template Path" value="<?php  echo $row_template['template_path']; ?>" required>
									</div>
									<div class="form-group">
									  <label>Template Type</label>
									  <select class="form-control" name="template_type">
									  <option><?php  echo $row_template['template_type']; ?></option>
									  <option>Select Type</option>
										<option>Super Admin</option>
										<option>Admin</option>
										<option>User</option>
									  </select>
									</div>
								  <div class="box-footer text-right " >
									<input type="submit" class="btn btn-outline-primary" name="update" value="Submit">
								  </div>
					 </form>
						<?php } else{ ?>
							<form id="add" role="form" action="<?php echo $_SERVER['PHP-SELF']; ?>" method="POST">
									
									<div class="form-group">
									  <label for="">Template Name </label>
									  <input type="text" class="form-control" id="template_name" name="template_name" placeholder="Template Name" required>
									</div>
									<div class="form-group">
									  <label for="">Template Path </label>
									  <input type="text" class="form-control" id="template_path" name="template_path" placeholder="Template Path" required>
									</div>
									<div class="form-group">
									  <label>Template Type</label>
									  <select class="form-control" name="template_type">
									  <option>Select Type</option>
										<option>Super Admin</option>
										<option>Admin</option>
										<option>User</option>
									  </select>
									</div>
								  <div class="box-footer text-right " >
									<input type="submit" class="btn btn-outline-primary" name="submit" value="Submit">
								  </div>
					 </form>
						<?php } ?>
				</div>
				</div>
				</section>
				
				<section class="content">
    
				  <div class="card">
				
           
			   <div class="card-body" style="overflow:scroll" >
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
						  <th>Sr.No</th>
						  <th>Template Name</th>
						  <th>Template Path</th>
						  <th>Template Type</th>
						  <th>Date</th>
						  <th>Status</th>
						  <th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$sql_chk = "SELECT * FROM `templates`";
						//echo $sql_chk;
						$query_chkres = mysqli_query($conn,$sql_chk);
						if(mysqli_num_rows($query_chkres)>0){
						$srno = 1;	
							while($row = mysqli_fetch_array($query_chkres)){
						?>	
						   	<tr>
							  <td align="center"><?= $srno; ?></td>
							  <td align="left"><?= $row['template_name']; ?></td>
							  <td align="center"><?= $row['template_path']; ?></td>
							  <td align="center"><?= $row['template_type'];?></td>
							  <td align="left"><?= $row['created'];?></td>
							  <td align="left"><?= $row['status'];?></td>
							  <td><a class="btn btn-warning" href="templates.php?id=<?php echo $row['id']; ?>" onclick="edit_temp();">Edit</a></td>
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
				 
			</div>
			</section>
			</div>
</div>
 </body>
 <script>
setTimeout(function() 
{
	$('#msg').fadeIn().delay(3000).fadeOut();
});
function edit_temp()
{
	document.getElementById("add").style.display = "none";
	document.getElementById("update").style.display = "block";
}
</script>
 </html>