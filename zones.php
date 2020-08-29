<?php
include("config.php");
date_default_timezone_set("Asia/Calcutta");
$date = date('Y-m-d');
  if(isset($_POST['submit']))
	{
		$zone_name = $_POST['zone_name'];
		$country_id = $_POST['country_id'];
		$state_id = $_POST['state_id'];
		
		foreach($state_id As $value)
		{
			$sql = "INSERT INTO `zones`(`zone_name`, `country_id`, `state_id`, `created_date`) VALUES('$zone_name','$country_id','$value','$date')";
			$res = mysqli_query($conn, $sql);
			if($res)
			{
				$message= "<div class='alert alert-success'>Zone inserted Successfully.</div>";
			}
			else
			{
				echo $sql;
				echo mysqli_error($conn);
				$message= "<div class='alert alert-danger'>Failed To Insert.</div>";
			}
		}
	}
 ?>

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
						  <li class="breadcrumb-item"><a href="">System Data</a></li>
						  <li class="breadcrumb-item active">Zones</li>
						</ol>
						<?php echo $message; ?>
					  </div>
					</div>
					<div class="row mb-2">
					  <div class="col-sm-12">
						<h4 style="text-align:center;"><b>Zones</b></h4>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->

				</section>
				
				<section class="content">

				<div class="card">	
				<div class="card-body">
				<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >			
				  <div class="box-body">
				  <div class="row">
						<div class="col-md-6">
							<label>Zone Name</label>
							<input type="text" class="form-control" name="zone_name" id="zone_name" placeholder="Zone Name">
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label>Select Country</label>
							  <select class="form-control" name="country_id" id="country_id">
								<option value=""> --Select Country-- </option>
								<?php
								echo $sql_countries ="SELECT country_id,name FROM `countries`";
								$query_countries = mysqli_query($conn, $sql_countries);
								while($res_countries = mysqli_fetch_array($query_countries)){
									if($countryid == $res_countries['country_id']){
										$status ="selected";
									}else{
										$status ="";
									}
								?>
								<option value="<?= $res_countries['country_id']?>" <?= $status;?>>	<?= $res_countries['name']?></option>
								<?php
								}
								?>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label>Select State</label>
							  <select class="form-control select2" multiple="multiple" name="state_id[]" id="state" data-placeholder="Select States" style="width: 100%;" required>
								
							  </select>
							</div>
						</div>
								
				</div>
					  <!-- /.box-body -->

				  <div class="box-footer text-right mb-3" >
					<button type="submit" name="submit" id="submit" class="btn btn-outline-primary" onclick="return checkValidation()">Submit</button>
				  </div>
				 </form>
				 
				 
			</div>
			</div>
			</section>
				
				
			<section class="content">
    
				  <div class="card">
				
           
			   <div class="card-body">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
						  <th>ID</th>
						  <th>Country Name</th>
						  <th>State Name</th>
						  <th>Zones</th>	
						</tr>
						</thead>
					<?php include("config.php");
						$get = "select z.*, c.name as country, s.name as state from zones z, countries c, state s where z.country_id=c.country_id and z.state_id = s.zone_id";
						$res = mysqli_query($conn,$get);
						if ($res){
							while($row=mysqli_fetch_assoc($res)){
						?>
					   <tr>
						  <td><?php echo $row['id'];?></td>
						  <td><?php echo $row['country'];?> </td>
						  <td><?php echo $row['state'];?> </td>
						  <td><?php echo $row['zone_name'];?> </td>
						  </tr>
						<?php }} ?>
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
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
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
    //Initialize Select2 Elements
    $('.select2').select2()
 });

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
  
  $('#country_id').on('change', function() {
  var a = $('#country_id').val();
  $.ajax({
		type:"POST",
		url:"get_state.php",
		data:{
			id:a
		},
		dataType:'json',
		success:function(response)
		{
			//alert(response);
			$("#state").empty;
			$("#state").append(response);
		},
		error:function(error)
		{
			alert(error);
		},
	});
});
</script>
</body>
</html>
