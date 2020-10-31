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
               <h1 class="m-0 text-dark">Lead Banners</h1>
               <h4 style="color:red"><?php echo $message; ?></h4>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item">Leads </li>
                  <li class="breadcrumb-item active">Lead Banners</li>
               </ol>
            </div>
            <!-- /.col -->
         </div>
         <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->
   <section class="content">
      <div class="card">
         <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
               <thead>
                  <tr>
                     <th>Sr.No</th>
                     <th>Posted By</th>
                     <th>Country</th>
                     <th>Chapter</th>
                     <th>Image</th>
                     <th>Start Date</th>
                     <th>End Date</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                     $i=1;
                     $sql_banner = "SELECT b.*,u.name as username,c.name as country FROM post_banners b, users u, countries c where b.posted_by=u.id and b.country_id=c.country_id";
                     $res_banner = mysqli_query($conn,$sql_banner);
                     while($row_banner = mysqli_fetch_array($res_banner))
                     {
                     ?>
                  <tr>
                     <td><?php echo $i; ?>
                     <td><?php echo $row_banner['username']; ?></td>
                     <td><?php echo $row_banner['country']; ?></td>
                     <td><?php echo "CH".$row_banner['chapter_id']; ?></td>
                     <td><?php echo "<img src='".$row_banner['banner_image']."' class='img-circle' width='50' height='50'>"; ?></td>
                     <td><?php echo $row_banner['start_date']; ?></td>
                     <td><?php echo $row_banner['end_date']; ?></td>
                  </tr>
                  <?php $i++; } ?>
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