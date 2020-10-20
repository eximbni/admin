
			<?php include "header.php"?>
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
						  <li class="breadcrumb-item active">HS Code Request</li>
						</ol>
						<?php echo $message; ?>
					  </div>
					</div>
					<div class="row mb-2">
					  <div class="col-sm-12">
						<h4 style="text-align:center;"><b>HS Code Request</b></h4>
					  </div>
					</div><!-- /.container-fluid -->
				</section>
			
			<section class="content">
    
				  <div class="card">
				
           
			   <div class="card-body">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
						  <th>ID</th>
						  <th>User Name</th>
						  <th>Country</th>
						  <th>Category</th>
						  <th>Chapter</th>
						  <th>Product</th>
						  <th>Description</th>
						  <th>Date</th>
						</tr>
						</thead>
						<tbody>
							<?php
								include("config.php");
								//$sql_hsreq = "SELECT hr.*, u.name as username, c.name,cat.category_name,ch.chapter_name FROM hscode_requests hr, users u, countries c, categories cat, chapters ch WHERE hr.user_id = u.id AND c.country_id = hr.country_id AND hr.chapter = ch.id AND hr.category = cat.id";
								$srno=0;
								$sql_hsreq = "SELECT hr.*, u.name as username ,c.name FROM hscode_requests hr, users u, countries c WHERE hr.user_id = u.id AND c.country_id = hr.country_id";
								$res_hsreq = mysqli_query($conn,$sql_hsreq);
								while($row_hsreq=mysqli_fetch_array($res_hsreq))
								{
									$srno++;
									//print_r($row_hsreq);
								?>
								<tr>
								  <td><?php echo $srno; ?></td>
								  <td><?php echo $row_hsreq['username']; ?></td>
								  <td><?php echo $row_hsreq['name']; ?></td>
								  <td><?php echo $row_hsreq['category']; ?></td>
								  <td><?php echo $row_hsreq['chapter']; ?></td>
								  <td><?php echo $row_hsreq['product']; ?></td>
								  <td><?php echo $row_hsreq['description']; ?></td>
								  <td><?php echo $row_hsreq['created_date']; ?></td>
								</tr>
							<?php } ?>
						  
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
    $("#example1").DataTable({
	  "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
	});
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
    });
	 $('#example3').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
    });
	$('#example4').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
    });
  });
</script>
</body>
</html>