<?php 
require "header1.php";
?>
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Total Active Users List</h1>
            <h4 style="color:red"><?= $message; ?></h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item">Dashboard </li>
              <li class="breadcrumb-item active">Total Active Users</li>
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
                          <th>Sr.no</th>
                          <th>Name</th>
                          <th>Mobile</th>
                          <th>Email</th>
                          <th>Country</th>
                          <th>Subscribed Package</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                        </tr>
                        </thead>
                        <tbody>
        				<?php
        				$srno = 0;
        				$sql_users = "SELECT u.*,cr.name as cntrname, sub.id as sub_id, sub.plan_name as plan_name FROM users u, countries cr, subscriptions sub where u.country_id=cr.country_id and u.subscription_id=sub.id and u.status='1' AND u.email_check='1' AND u.subscription_id IS NOT NULL group by u.id order by u.id desc";
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