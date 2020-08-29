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


include("header.php")?>
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
						  <li class="breadcrumb-item"><a href="">Package Module</a></li>
						  <li class="breadcrumb-item active">Subscibed User List</li>
						</ol>
						<?php echo $message; ?>
					  </div>
					</div>
					<div class="row mb-2">
					  <div class="col-sm-12">
						<h4 style="text-align:center;"><b>Subscibed User List</b></h4>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->

				</section>
			
			
		        	<section class="content">
			<div class="row">
			<div class="col-12">
			<div class="card">
         
            <!-- /.card-header -->
            <div class="card-body">
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

				?>
                <tr>
                  <td><?php echo $srno; ?></td>
                  <td><?php echo $row_users['name']; ?></td>
                  <td><?php echo $row_users['mobile']; ?></td>
                  <td><?php echo $row_users['email']; ?></td>
                  <td><?php echo $row_users['cntrname']; ?></td>
                  <td><?php echo $row_users['plan_name']; ?></td>
                  <td><?php echo $row_users['subscription_start']; ?></td>
                  <td><?php echo $row_users['subscription_end']; ?></td>
				  <td><a href="edit_subscription.php?id=<?php echo $row_users['sub_id']; ?>" class="btn btn-warning">Edit</a></td>
                  <td><?php	if($status==0){ ?> <a class="btn btn-success" href="subscribed_users.php?act=<?= $row_users['id']; ?>" onclick="return confirm('Are you sure you want to active this users?');" title="Activate" ><em class="fa fa-toggle-on"></em></a> <?php }else{ ?> <a class="btn btn-danger" href="subscribed_users.php?del=<?= $row_users['id']; ?>" onclick="return confirm('Are you sure you want to block this users?');" title="Block" ><em class="fa fa-toggle-off"></em></a><?php }?>
                  	 </td>
                </tr>
                <?php } ?>
         
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          </div>
          </div>
          </section>

            </div>
<!-- DataTables -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- DataTables -->

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script> 

 <script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })
</script>
 </html>