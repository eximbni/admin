<?php 
$message="";
 require "header1.php";

?>  
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Recharge</h1>
            <h4 ><?php echo $message; ?></h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item">Accounts Module </li>
              <li class="breadcrumb-item active">Recharge </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>   
				
				
			<section class="content">
    
				  <div class="card">
				
           
			   <div class="card-body">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
						  <th>ID</th>
						  <th>User Name</th>
						  <th>Plan Name</th>
						  <th>Recharge Name</th>
						  <th>Amount</th>
						  <th>Start Date</th>
						  <th>End Date</th>
						  <th>Status</th>
						  <th>Action</th>
						</tr>
						</thead>
						<tbody>
					  
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
 		
