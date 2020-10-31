<?php 
   session_start();
   include("config.php");
   $message ="";
   require "header1.php";
   
   ?>  
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">Subscription Packages List</h1>
               <h4 style="color:red"><?php echo $message; ?></h4>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item">Packages </li>
                  <li class="breadcrumb-item active">Subscription Packages List</li>
               </ol>
            </div>
            <!-- /.col -->
         </div>
         <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
   </div>
   <section class="content">
      <div class="card">
         <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
               <thead>
                  <tr>
                     <th>Sr.No</th>
                     <th>Country</th>
                     <th>Plan Name</th>
                     <th>Plan Duration</th>
                     <th>Plan Description</th>
                     <th>Plan Cost</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                     $sql_chk = "select s.*, c.* from subscriptions s, countries c  where s.status='1' and s.country_id=c.country_id";
                     $query_chkres = mysqli_query($conn,$sql_chk);
                     if(mysqli_num_rows($query_chkres)>0){
                     $srno = 0;	
                     	while($row = mysqli_fetch_array($query_chkres)){
                     		$srno++;
                     		$plan_id=$row['id'];
                     		$country_id=$row['country'];
                     		$plan_name=$row['plan_name'];
                     		$plan_cost=$row['plan_cost'];
                     		$plan_duration=$row['plan_duration'];
                     		$plan_description = $row['plan_description'];
                     		$country = $row["name"];
                     		
                     ?>	
                  <tr>
                     <td><?= $srno;?></td>
                     <td><?= $country;?></td>
                     <td><?= $plan_name;?></td>
                     <td><?= $plan_duration;?></td>
                     <td><?= $plan_description;?></td>
                     <td><?= $plan_cost;?></td>
                  </tr>
                  <?php
                     }
                     }
                     ?>
               </tbody>
            </table>
         </div>
      </div>
   </section>
</div>
<?php
   require "footer1.php"
   ?>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>