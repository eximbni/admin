<?php 
include("config.php");
include "header.php";
error_reporting(0);
$message ="";
if(isset($_GET['id'])){
	$webinarid = $_GET['id'];


}else{
	header("Location: webinarlist.php");
	exit;
}
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
						  <li class="breadcrumb-item active">Participate List</li>
						</ol>
					  </div>
					</div>
					<div class="row mb-2">
					  <div class="col-sm-12">
						<h6 style="text-align:center;"><b>Invited And Participate Users List</b></h6>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->

				</section>
			
			<section class="content">
    
				  <div class="card">
				
           
			   <div class="card-body" style="overflow:scroll" >
					  <table id="example1" class="table table-bordered table-striped">
						<?php
						$sql_chk = "SELECT * FROM `webinar` WHERE id = '$webinarid'";
						//echo $sql_chk;
						$query_chkres = mysqli_query($conn,$sql_chk);
						$numrows = mysqli_num_rows($query_chkres);
						if( $numrows == null || $numrows <=0 ){
						
						echo "<tr><td colspan='3' align='center' class='text-danger'> <strong> No records found </strong> </td> </tr>";
						}else{
							
							$row = mysqli_fetch_array($query_chkres);

						?>

						<thead>
						<tr>
						  	<th><?= "Date & Time : ".$row['webinar_datetime']; ?> </th>
						  	<th> <?= "Title : ".$row['title']; ?> </th>
		                    <th> <?= "Description :".$row['description'];?> </th>
						</tr>	
						<tr>
						  	<th>Sr.No</th>
	                    	<th > Participate Users </th>
		                    <th>Status </th>
						</tr>
						</thead>
						<tbody>
						<?php	
							$sql_chk1 = "SELECT invitee_id FROM `webinar_invitees` WHERE webinar_id = '$webinarid'";
							$query_chkres1 = mysqli_query($conn,$sql_chk1);
							if(mysqli_num_rows($query_chkres1)>0){

							$srno = 1;	
							while($row1 = mysqli_fetch_array($query_chkres1)){

								$invitee_id= $row1['invitee_id'];
								$quers = mysqli_query($conn,"SELECT name FROM `users` WHERE id = '$invitee_id'");
								if(mysqli_num_rows($quers)>0){
									$row12 = mysqli_fetch_array($quers);
									$participate_name = $row12['name'];
								}else{
									$participate_name = '';
								}	
						?>	
						   	<tr>
							  <td align="center"><?= $srno; ?></td>
							  <td align="left"><?= $participate_name; ?></td>
							  <td>
							  	<?php
							  		if($row['status'] == 1 ){
							  	?>
							  		<a class="btn btn-warning" href="#"> Invited </a>	
							  	<?php 	
							  		}else if($row['status'] == 2 ){
							  	?>
							  		<a class="btn btn-success" href="#">Participated</a>
							  	<?php 	
							  		}else{

							  		echo "";	
/*							  	?>
							  		
							  	<?php */	
							  		}
							  	?>
							  	</td>
							</tr>
							<?php
								$srno++;
								}
							}
							else{
								echo "No records found";
							}
							?>
						</tbody>
					<?php

						}

					?>

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
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables/dataTables.bootstrap4.js"></script>
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
