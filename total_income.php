<?php 
require "header1.php"; 
$dollar = 0.013;
?>
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Total Transactions Income List</h1>
            <h4 style="color:red"><?= $message; ?></h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item">Dashboard </li>
              <li class="breadcrumb-item active">Total Income</li>
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
                     <th>Sr.No</th>
                     <th>Franchise Name</th>
                     <th>Transaction Date</th>
                     <th>Transaction For</th>
                     <th>INR Amount</th>
                     <th>USD Amount <br>( INR 1 = USD <?= $dollar; ?>)</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                     $i=1;
                     $dollartoatal = 0;
                     $totalamount = 0;
                     
                     $lastYearDate = date("Y-m-d", strtotime("-1 year"));
                     $sql_app = "SELECT fa.amount, fa.payment_for, fa.payment_date, fu.name FROM `frachise_accounts` fa, franchise_users  fu WHERE fa.franchise_id = fu.id AND fa.payment_date >= '$lastYearDate' ORDER BY fa.id DESC";
                     $res_app = mysqli_query($conn,$sql_app);
                     while($row_app=mysqli_fetch_array($res_app)) { 
                         $name = $row_app['name'];
                         $payment_date = $row_app['payment_date'];
                         $payment_for = $row_app['payment_for'];
                         $amount = $row_app['amount'];
                         $dollaramount = $amount * $dollar;
                         
                         $totalamount = $totalamount + $amount;
                         
                         $dollartoatal = $dollartoatal + $dollaramount;
                         
                     ?>
                  <tr>
                     <td><?= $i; ?></td>
                     <td><?= $name; ?></td>
                     <td><?= $payment_date; ?></td>
                     <td><?= $payment_for; ?> </td>
                     <td align="right"><?= number_format($amount,'2'); ?></td>
                     <td align="right"><?= number_format($dollaramount,'2'); ?></td>
                  </tr>
                  <?php $i++; } ?>
               </tbody>
               <tfooter>
                   <tr>
                       <td colspan="4" align="center"> <strong> Total Income </strong> </td>
                       <td align="right"><strong> <?= number_format($totalamount,'2'); ?> </strong> </td>
                       <td align="right"><strong> <?= number_format($dollartoatal,'2'); ?> </strong> </td>
                   </tr>
               </tfooter>
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