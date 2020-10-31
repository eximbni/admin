<?php
include("config.php");
$message='';

if(isset($_POST['activate'])){
    $adminuserid = $_POST['act_adminuserid'];
    
    $update_sql = "UPDATE admin_user_roles SET status='1' WHERE id ='$adminuserid' ";
    $update_res = mysqli_query($conn,$update_sql);
	if($update_res){
		$message = "<h4 style='color:green'> Admin User Role Activated Successfully </h4>";
	}
	else{
		$message = "<h4 style='color:red'> Error activating admin user role </h4>";
		echo mysqli_error($conn);
	}    
    
}

if(isset($_POST['delete'])){
    $adminuserid = $_POST['del_adminuserid'];
    
    $update_sql = "UPDATE admin_user_roles SET status='0' WHERE id ='$adminuserid' ";
    $update_res = mysqli_query($conn,$update_sql);
	if($update_res){
		$message = "<h4 style='color:green'> Admin User Role Deleted Successfully </h4>";
	}
	else{
		$message = "<h4 style='color:red'> Error deleting admin user role </h4>";
		echo mysqli_error($conn);
	}    
    
}

if(isset($_POST['submit'])){
    
	$roles = $_POST['roles'];

	$sql = "insert into admin_user_roles(role_name,status) values('$roles','1')";
	$res = mysqli_query($conn,$sql);
	if($res){
		$message = "<h4 style='color:green'> Roles Added Successfully </h4>";
	}
	else{
		$message = "<h4 style='color:red'> Error adding roles </h4>";
		echo mysqli_error($conn);
	}
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
            <h1 class="m-0 text-dark">Add Roles</h1>
             <?= $message; ?>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item">Admin User </li>
              <li class="breadcrumb-item active">Add Roles</li>
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
									 <div class="col-6">
    									<div class="form-group">
										    <label for="">Enter Role Name</label>
							                <input type="text" class="form-control" id="roles" name="roles" placeholder="Enter Roles" required="required">
										</div>
									</div>
									 <div class="col-1">
    									<div class="form-group">
										    <label for=""> &nbsp;</label>
										    <div class="input-group">
										        <input type="submit" class="btn btn-primary btn-block" name="submit" value="Submit"> 
										    </div> 
										</div>
									</div>									
            					</div>
                            </div> 
                            </form>
                        </div>  
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body"> 
                        <div class="table-responsive">
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
        							while($rows1 = mysqli_fetch_array($query_chkres)){
        							    if($rows1['status'] =='1'){
        							        $status ="Active";
        							    }else{
        							        $status= "Inactive";
        							    }        							    
        						?>	
        						   	<tr>
        							  <td align="center"><?= $srno; ?></td>
        							  <td align="left"><?= $rows1['role_name']; ?></td>
        							  <td align="center"><?= $status; ?></td>
        							  <td>
        							    <a class="btn btn-warning  btn-sm" href="edit_roles.php?id=<?php echo $rows1['id']; ?>">Edit</a>
        							    <?php
        							       if($rows1['status'] =='1'){
        							    ?>
        							        <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
        							            <input type="hidden" id="del_adminuserid"  name ="del_adminuserid" value="<?= $rows1['id']; ?>" >
        							            <input type="submit" class="btn btn-danger btn-sm"  name ="delete" value="Del" >
        							        </form>        							    
        							    <?php
        							    }else{
        							    ?>
        							        <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
        							            <input type="hidden" id="act_adminuserid"  name ="act_adminuserid" value="<?= $rows1['id']; ?>" >
        							            <input type="submit" class="btn btn-success btn-sm"  name ="activate" value="Activate" >
        							        </form>         							    
        							    <?php
        							    }
        							    ?> 
        							   </td>
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
            </div>
        </div>
    </section>    
    </div>
    
<?php
    require "footer1.php";
?>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
 