<?php 
include("config.php");
if(isset($_GET['del'])){

	$block_id = $_GET['del'];
	$sql_usersblock = "UPDATE users SET status='0' where id='$block_id'";
	$res_users_block = mysqli_query($conn,$sql_usersblock);

	header("location:subscribed_users.php");
	exit;

}				
if(isset($_GET['act'])){

	$activate_id = $_GET['act'];
	$sql_usersactivate = "UPDATE users SET status='1' where id='$activate_id'";
	$res_users_activate = mysqli_query($conn,$sql_usersactivate);

	header("location:subscribed_users.php");
	exit;

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
            <h1 class="m-0 text-dark">Users List</h1>
            <h4 style="color:red"><?= $message; ?></h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item">Admin User </li>
              <li class="breadcrumb-item active">Users List</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  
    <section class="content">
        <div class="container-fluid">
 
            <div class="card">
                <div class="card-body table-responsive"> 
                     <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Mobile</th>
                          <th>Email</th>
                          <th>Country</th>
                          <th>Subscribed Package</th>
                          <th>Start Date</th>
                          <th>End Date</th>
        				  <th>Email Status</th>
        				  <th>User Status</th>
        				  <th>Edit</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
        				<?php
        				$srno = 0;
        				$sql_users = "SELECT u.*,cr.name as cntrname, sub.id as sub_id, sub.plan_name as plan_name FROM users u, countries cr, subscriptions sub where u.country_id=cr.country_id and u.subscription_id=sub.id and u.subscription_id IS NOT NULL group by u.id order by u.id desc";
        				$res_users = mysqli_query($conn,$sql_users);
        				while($row_users=mysqli_fetch_array($res_users))
        				{
        					$srno++;
        					$status =$row_users['status'];
        					
        				    if($row_users['email_check'] =='1'){
        				        $email_check = "<span class='text-success'> Verified </span> ";
        				    }else{
        				        $email_check = "<span class='text-danger'> Not Verified </span> ";
        				    } 
        					
        				    if($row_users['status'] =='1'){
        				        $status = "<span class='text-success'> Active </span> ";
        				    }else{
        				        $status = "<span class='text-danger'> Inactive </span> ";
        				    } 
        				    
       				    
        				?>
                        <tr>
                          <td><?= $srno; ?></td>
                          <td><?= $row_users['name']; ?></td>
                          <td><?= $row_users['mobile']; ?></td>
                          <td><?= $row_users['email']; ?></td>
                          <td><?= $row_users['cntrname']; ?></td>
                          <td><?= $row_users['plan_name']; ?></td>
                          <td><?= $row_users['subscription_start']; ?></td>
                          <td><?= $row_users['subscription_end']; ?></td>
        				  <td><?= $email_check; ?></td>
        				  <td><?= $status; ?></td>
        				  <td><a href="edit_subscriberuser.php?id=<?= $row_users['sub_id']; ?>" class="btn btn-warning">Edit</a></td>
                          <td><?php	if($status==0){ ?> <a class="btn btn-success" href="subscribed_users.php?act=<?= $row_users['id']; ?>" onclick="return confirm('Are you sure you want to active this users?');" title="Activate" ><em class="fa fa-toggle-on"></em></a> <?php }else{ ?> <a class="btn btn-danger" href="subscribed_users.php?del=<?= $row_users['id']; ?>" onclick="return confirm('Are you sure you want to block this users?');" title="Block" ><em class="fa fa-toggle-off"></em></a><?php }?>
                          	 </td>
                        </tr>
                        <?php } ?>
                 
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
require "footer1.php"
?>  

<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script> 