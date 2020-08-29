<?php 
include("config.php");
include "header.php"?>  


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
						  <li class="breadcrumb-item"><a href="">Accounts Module</a></li>
						  <li class="breadcrumb-item active">Subscription</li>
						</ol>
						<?php echo $message; ?>
					  </div>
					</div>
					<div class="row mb-2">
					  <div class="col-sm-12">
						<h4><b>Subscription</b></h4>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->

				</section>
				
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


<!-- DataTables -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script> 
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
</body>
</html>
