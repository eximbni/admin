<?php
include("config.php");
$message='';
if(isset($_POST['submit'])){
	$id         =   $_POST['id'];
	$roles      =   $_POST['roles']; 
	$sql_insert = "update admin_user_roles  set role_name='$roles' where id='$id'";
	//echo $sql;
	$res_insert = mysqli_query($conn,$sql_insert);
	if($res_insert){
		$message = "<h4 style='color:green'> Admin User Role Update Successfully </h4>";
	}
	else{
		$message = "<h4 style='color:red'> Error updating Admin User Role </h4>";
		echo mysqli_error($conn);
	}
	//header("location: edit_roles.php?id=".$id."");
	header("location: add_roles.php");	
}
require "header1.php";
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Update Admin User Role</h1>
            <?php echo $message; ?> 
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item">Admin User </li>
              <li class="breadcrumb-item active">Update Admin User Role</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body"> 
                        <div class="  ">
            				<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
            				<input type="hidden" name="country_id" class="form-control" value="<?php echo $_SESSION['country']; ?>">
                            <div class="box-body">
                                <div class="row">
								<?php
									$id = $_GET['id'];
									$sql_get = "select * from admin_user_roles where id='$id' AND status='1'";
									$res_get = mysqli_query($conn,$sql_get);
									if($res_get){
									$row_roles_get = mysqli_fetch_assoc($res_get); 
								?>
									
									<div class="col-6 form-group">
									  <label for="">Role Name </label>
									  <input type="text" class="form-control"id="roles" name="roles" placeholder="Enter Roles" value="<?= $row_roles_get['role_name']; ?>" required>
									  <input type="hidden" class="form-control" name="id" value="<?= $row_roles_get['id']; ?>">
									</div>
									<div class="col-1">
    									<div class="form-group">
										    <label for=""> &nbsp;</label>
										    <div class="input-group">
										        <input type="submit" class="btn btn-primary btn-block" name="submit" value="Submit"> 
										    </div> 
										</div>
									</div>
								<?php
									}else{
								?>
								    <div class="col-12 form-group">
									  <label style="color:red;"> Role is Inactive </label> 
									</div>
								<?php
									}
								?>
            					</div>
                            </div> 
                            </form>
                        </div>  
                </div>
                
            </div>
        </div>
    </section>
    
    </div>
    
<?php
    require "footer1.php";
?>