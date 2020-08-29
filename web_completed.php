<?php 
include("config.php");
include "header.php";

$message ="";

?>  


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
						  <li class="breadcrumb-item"><a href="">Webinar Module</a></li>
						  <li class="breadcrumb-item active">Webinar Completed List</li>
						</ol>
					  </div>
					</div>
					<div class="row mb-2">
					  <div class="col-sm-12">
						<h6 style="text-align:center;"><b>Completed Webinar List</b></h6>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->

				</section>
			
			<section class="content">
    
				  <div class="card">
				
           
			   <div class="card-body" style="overflow:scroll" >
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
						  	<th>Sr.No</th>
	                    	<th>Titles </th>
		                    <th>Webinar Date </th>
		                    <th>Start Times </th>
		                    <th>Duration </th>
		                    <th>Description </th>
		                    <th>Status</th>
		                    <th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$sql_chk = "SELECT * FROM `webinar` WHERE status='2'";
						//echo $sql_chk;
						$query_chkres = mysqli_query($conn,$sql_chk);
						if(mysqli_num_rows($query_chkres)>0){
						$srno = 1;	
							while($row = mysqli_fetch_array($query_chkres)){
						?>	
						   	<tr>
							  <td align="center"><?= $srno; ?></td>
							  <td align="left"><?= $row['title']; ?></td>
							  <td align="center"><?= $row['webinar_date']; ?></td>
							  <td align="center"><?= $row['webinar_time'];?></td>
							  <td align="left"><?= $row['duration'];?></td>
							  <td align="left"><?= $row['description'];?></td>

							  
							  	<?php
							  		if($row['status'] == 0 ){
							  	?>
							  		<td> Waiting for approval </td>
							  		<td> <a class="btn btn-warning" href="webapproval.php?id=<?php echo $row['id']; ?>" onclick="return cnfapproval()" > Approved </a></td>	
							  	<?php 	
							  		}else if($row['status'] == 1 ){
							  	?>
							  		<td> Waiting for Start </td>
							  		<td> <a class="btn btn-success" href="webinar_participate.php?id=<?php echo $row['id']; ?>">Users Invites</a> </td>
							  	<?php 	
							  		}else{
							  	?>
							  		<td> Completed </td>
							  		<td> <a class="btn btn-success" href="webinar_participate.php?id=<?php echo $row['id']; ?>"> Users Joined </a></td>
							  			
							  	<?php 	
							  		}
							  	?>
							  	
							</tr>
						<?php
							$srno++;
							}
						}
						else{

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

function cnfapproval(){
	var confapp = confirm("Are you sure to approved this webinar");
	if(confapp == false){
		return false;
	}
}	

</script>
</body>
</html>
