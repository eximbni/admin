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
						  <li class="breadcrumb-item"><a href="">Franchise Module</a></li>
						  <li class="breadcrumb-item active">Target Reports</li>
						</ol>
						<?php echo $message; ?>
					  </div>
					</div>
					<div class="row mb-2">
					  <div class="col-sm-12">
						<h4 style="text-align:center;"><b>Target Reports</b></h4>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->

				</section>
				
			<section class="content">
				<div class="card">
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
					<div class="card-body">
					<div class="row">
					    <div class="col-3">
						<label>Select Country</label>
						
						<select class="form-control" name="country" id="country">
							<option value=''>Select Country</option>
							<?php include("config.php");
    						$get = "select * from countries";
    						$res = mysqli_query($conn,$get);
    						if ($res){
    							while($row=mysqli_fetch_assoc($res)){
    						?>
    										<option value="<?php echo $row['country_id'];?>"><?php echo $row['name'];?></option>
    						<?php }} ?>
						</select>
						</div>
						<div class="col-3">
						<label>Select Type</label>
						<select class="form-control" name="franchise_type" id="franchise_type" required>
							<option value='0'>All</option>
							<?php include("config.php");
    						$get = "select * from franchise_type";
    						$res = mysqli_query($conn,$get);
    						if ($res){
    							while($row=mysqli_fetch_assoc($res)){
    						?>
    							<option value="<?php echo $row['code'];?>"><?php echo $row['franchise'];?></option>
    						<?php }} ?>	
						</select>
						</div>
						
						<div class="col-3">
						    <label>Select Target Type</label>
							  <select class="form-control" name="target_type" id="target_type" required>
								<option>Select</option>
								<option value="1">Yearly</option>
								<option value="2">Monthly</option>
								<option value="3">Quarterly</option>
							  </select>
						</div>
						<div class="col-2" style="margin-top:3%">
							<button type="submit" class="btn btn-outline-primary" name="search">Search</button>
						</div>
				</form>
					</div>
					</div>
				</div>
				
				  <div class="card">
				
           
			   <div class="card-body">
					  
					  <table id="example1" class="table table-bordered table-striped">
					      <?php
					        $target_type = $_POST['target_type'];
					        if($target_type==1)
						    {
						        $column = "Year";
						    }
						    else if($target_type==2)
						    {
						        $column = "Month";
						        if($month==1){$monthtxt = 'Janaury';}elseif($month==2){$monthtxt = 'February';}elseif($month==3){$monthtxt = 'March';}elseif($month==4){$monthtxt = 'April';}elseif($month==5){$monthtxt = 'May';}elseif($month==6){$monthtxt = 'June';}elseif($month==7){$monthtxt = 'July';}elseif($month==8){$monthtxt = 'August';}elseif($month==9){$monthtxt = 'September';}elseif($month==10){$monthtxt = 'October';}elseif($month==11){$monthtxt = 'November';}elseif($month==12){$monthtxt = 'December';}else{$monthtxt = '';}
						    }
						    else if($target_type==3)
						    {
						        $column = "Quarter";   
						    }
						    else
						    {
						        $column = "Year";
						    }
    					?>
						<thead>
						<tr>
						  <th>ID</th>
						  <th>Franchise Name</th>
						  <th><?php echo $column;  ?></th>
						  <th>Target</th>
						  <th>Achievement</th>
						</tr>
						</thead>
						<tbody id="lead_report">
							<?php
							if(isset($_POST['search']))
							{
								include("config.php");
								$country_id=$_POST['country'];
								$franchise_type=$_POST['franchise_type'];
								$target_type = $_POST['target_type'];
								if($franchise_type=='0')
								{
								    $sql_leads = "select ft.*,fu.name from franchise_target ft, franchise_users fu where ft.country_id='$country_id' and ft.target_type='$target_type' and ft.franchise_id=fu.id";
								}
								else
								{
								    $sql_leads = "select ft.*,fu.name from franchise_target ft, franchise_users fu where ft.franchise_type='$franchise_type' and ft.country_id='$country_id' and ft.target_type='$target_type' and ft.franchise_id=fu.id";
								}
								//echo $sql_leads;
								$res_leads = mysqli_query($conn,$sql_leads);
								$row_count = mysqli_num_rows($res_leads);
								$id=1;
								if($row_count>0)
								{
    								while($row_leads=mysqli_fetch_array($res_leads))
    								{
    								    $franchise_name = $row_leads['name'];
    								    if($target_type==1)
    								    {
    								        $period = $row_leads['year'];
    								    }
    								    elseif($target_type==2)
    								    {
    								        $month = $row_leads['month'];
    								        if($month==1){$period='January';}elseif($month==2){$period='February';}elseif($month==3){$period='March';}elseif($month==4){$period='April';}elseif($month==5){$period='May';}elseif($month==6){$period='June';}elseif($month==7){$period='July';}elseif($month==8){$period='August';}elseif($month==9){$period='September';}elseif($month==10){$period='October';}elseif($month==11){$period='November';}else{$period='December';}
    								    }
    								    else
    								    {
    								        $quarter = $row_leads['quarter'];
    								        if($quarter==1){$period='First';}elseif($quarter==2){$period='Second';}elseif($quarter==3){$period='Third';}else{$period='Fourth';}
    								    }
    								    
    								    $quarter = $row_leads['quarter'];
    								    $target = $row_leads['target'];
    								    $achievement = $row_leads['achievement'];
    									echo $data = "<tr><td>$id</td><td>$franchise_name</td><td>$period</td><td>$target</td><td>$achievement</td></tr>";
    									$id++;
    								}
								}
								else
								{
									echo "<tr><td colspan='5' align='center'>No Records Founds</td></tr>";
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
  });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
/* $('#country').on('change', function() {
  var country = $('#country').val();
  var type = $('#type').val();
  $.ajax({
		type:"post",
		url:"get_leads.php",
		data:{
			country:country,
			type:type
		},
		//dataType:'json',
		success:function(response)
		{
			//alert(response);
			$("#lead_report").empty();
			$("#lead_report").append(response);
		},
		error:function(error)
		{
			alert(error);
		},
	});
}); */
</script>
</body>
</html>