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
            <h1 class="m-0 text-dark">OTP Request List</h1>
            <h4 style="color:red"><?php echo $message; ?></h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item">Admin User </li>
              <li class="breadcrumb-item active">OTP List</li>
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
						  <th>Sr.No</th>
						  <th>Mobile Number</th>
						  <th>OTP</th> 
						</tr>
						</thead>
						<tbody>
						<?php
						$sql_chk = "select * from otp ORDER BY id DESC";
						$query_chkres = mysqli_query($conn,$sql_chk);
						if(mysqli_num_rows($query_chkres)>0){
						$srno = 0;	
							while($row = mysqli_fetch_array($query_chkres)){
								$srno++;
								$mobile=$row['mobile'];
								$otp=$row['otp']; 
								
						?>	
						   	<tr>
							  <td><?= $srno;?></td>
							  <td><?= $mobile;?></td>
							  <td><?= $otp;?></td>
							</tr>
						<?php
							}
						}
						?>
						
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