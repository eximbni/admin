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
            <h1 class="m-0 text-dark">Total Active Leads List</h1>
            <h4 style="color:red"><?= $message; ?></h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item">Dashboard </li>
              <li class="breadcrumb-item active">Total Active Leads</li>
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
                    <table id="example3" class="table table-bordered" >
               <thead>
                  <tr>
                     <th>ID</th>
                     <th>Lead Type</th>
                     <th>Country</th>
                     <th>Posted For</th>
                     <th>Ref ID</th>
                     <th>Posted By</th>
                     <th>HSN Code</th>
                     <th>Chapter</th>
                     <th>Uom</th>
                     <th>Quantity</th>
                     <th>Description</th>
                     <th>Posted Date</th>
                     <th>Expiry Date</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                     $i=1;
                     $todayDate = date('Y-m-d');
                     $sql_app = "select l.*,u.name,co.name as country,ch.ch_description,uo.uom, co.name as country_name from leads l,users u, chapters ch, countries co, uoms uo where l.status='1' and l.posted_by=u.id and l.chapter_id=ch.id and l.uom_id=uo.id and l.country_id=co.country_id AND l.expiry_date >= '$todayDate' order by l.id desc";
                     $res_app = mysqli_query($conn,$sql_app);
                     while($row_app=mysqli_fetch_array($res_app)) { 
                         $lead_id = $row_app['id'];
                     ?>
                  <tr>
                     <td><?php echo $i; ?></td>
                     <td><?php echo $row_app['lead_type']?></td>
                     <td><?php echo $row_app['country']?></td>
                     <td><?php echo $row_app['country_name'];?> </td>
                     <td><?php echo $row_app['leadref_id']?></td>
                     <td><?php echo $row_app['name']?></td>
                     <td><?php echo $row_app['hsn_id']?></td>
                     <td><?php echo $row_app['ch_description']?></td>
                     <td><?php echo $row_app['uom']?></td>
                     <td><?php echo $row_app['quantity']?></td>
                     <td><?php echo $row_app['description']?></td>
                     <td><?php echo $row_app['posted_date']?></td>
                     <td><?php echo $row_app['expiry_date']?></td>
                  </tr>
                  <?php $i++; } ?>
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