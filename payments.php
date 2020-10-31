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
            <h1 class="m-0 text-dark">Franchise Payments</h1>
            <h4 style="color:red"><?php echo $message; ?></h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item">Franchise </li>
              <li class="breadcrumb-item active">Franchise Payments</li>
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
                  <th>Franchise</th>
                   <th>Country</th>
                    <th>email</th>
                  <th>Payment</th>
                  <th>Payment Type </th>
                  <th>Payment Date</th>
                </tr>
                </thead>
                <tbody>
                    <?php 
								$sql_franch = "SELECT fa.*, fr.email, fr.amount as payment,fr.country_id,fr.name, c.name as country from frachise_accounts fa, franchise_users fr,countries c  where fa.franchise_id=fr.id and fr.country_id=c.country_id";
								$res_franch = mysqli_query($conn,$sql_franch);
								while($row_franch=mysqli_fetch_array($res_franch))
								{
								?>
                <tr>
                  <td><?php echo $row_franch["name"];?></td>
                  <td><?php echo $row_franch["country"];?></td>
                  <td><?php echo $row_franch["email"];?></td>
                  <td><?php echo $row_franch["amount"];?></td>
                   <td><?php echo $row_franch["payment_for"];?></td>
                  <td> <?php echo $row_franch["payment_date"];?></td>
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
 