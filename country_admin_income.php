<?php 
include("config.php");
include "header.php";

$message ="";
if(isset($_POST['search'])){
	$country_id = $_POST['country_id'];
}else{
	$country_id = '';
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
						  <li class="breadcrumb-item"><a href="">Accounts Module</a></li>
						  <li class="breadcrumb-item active">Admin Income</li>
						</ol>
						<?php echo $message; ?>
					  </div>
					</div>
					<div class="row mb-2">
					  <div class="col-sm-12">
						<h4 style="text-align:center;"><b>Admin Income</b></h4>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->

				</section>
				
				
				<section class="content">

				<div class="card">
				<h4><?php echo $message ?></h4>	
				<div class="card-body">
				<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">			
				  <div class="box-body">
				  <div class="row">
						<div class="col-md-6">
							<div class="form-group">
							  <label>Select Transaction Type</label>
							  <select class="form-control" name="trans_type" id="trans_type">
								<option value=""> --Select Transaction-- </option>
								<option value="subscription">subscription</option>
								<option value="leads">leads</option>
								<option value="franchise">franchise</option>
								<option value="banner">banner</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group" style="margin-top:6%;">
					        <?php $country_id = $_GET['country_id'];?>
						    <input type="hidden" id="country_id" name="country_id" value="<?= $country_id; ?>">
								<button type="button" name="search" id="search" class="btn btn-outline-primary" onclick="return checkValidation()">Search</button>
							</div>

						</div>
								
				</div>
				

				  <div class="box-footer text-right mb-3" >
					
				  </div>
		 </form>
		 
		 
	</div>
	</div>
	</section>



			<section class="content">
    
				  <div class="card">
				
           
			   <div class="card-body">
					  <table id="example2" class="table table-bordered table-striped">
						<thead>
						<tr>
						  <th>Sr.No</th>
						  <th>User Name</th>
						  <th>Country Name</th>
						  <th>Amount</th>
						  <th>Transaction Type</th>
						  <th>Transaction For</th>
						  <th>Transaction ID</th>
						  <th>Transaction Date</th>
						  <th>Status</th>
						</tr>
						</thead>
						<tbody id='result'>
						
						<?php 
						$srno = 1;
						include('config.php');
						date_default_timezone_set("Asia/Kolkata");
						$today = date('d-m-Y');
                        $start_date = date('Y-m-01', strtotime($today));
                        $last_date =  date('Y-m-t', strtotime($today));
                        $sql = "SELECT ai.*, u.name as username, c.name as country_name FROM admin_income ai, users u, countries c WHERE ai.user_id=u.id and ai.txn_type<>'credits' and u.country_id=c.country_id and ai.txn_date between '$start_date' and '$last_date' GROUP BY c.country_id ORDER BY ai.id DESC";
						//$sql = "SELECT ai.*, u.name as username, c.name as country_name FROM admin_income ai, users u, countries c WHERE ai.txn_date>='$start_date' and ai.txn_date<='$last_date' and ai.user_id=u.id and ai.txn_type<>'credits' and u.country_id='$country_id' and u.country_id=c.country_id ORDER BY ai.id DESC";
						$res = mysqli_query($conn,$sql);
						while($row=mysqli_fetch_array($res))
						{	$status = $row_admin_income['status'];
							if($status==1){ $status_txt="Success"; }else{ $status_txt="Failed"; } 
						?>
						
						<tr>
							<td><?php echo $srno; ?></td>
							<td><?php echo $row['username']; ?></td>
							<td><?php echo $row['country_name']; ?></td>
							<td><?php echo $row['txn_amount']; ?></td>
							<td><?php echo $row['txn_type']; ?></td>
							<td><?php echo $row['txn_for']; ?></td>
							<td><?php echo $row['txn_id']; ?></td>
							<td><?php echo $row['txn_date']; ?></td>
							<td><?php echo $status_txt; ?></td>
						</tr>
						
						<?php $srno++; } ?>
						</tbody>
						<tfoot id="result1">
							
						</tfoot>

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
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });

function checkValidation(){
	var trans_type = $("#trans_type").val();
	var country_id = $("#country_id").val();
	if(trans_type ==''){
		alert("Please Select transaction type");
		$("#trans_type").focus();
		return false;
	}
	else
	{
	//	alert(trans_type);	alert(country_id);
		
		$.ajax({
			type:"POST",
			url : "getadmin_income.php",
			data : {trans_type : trans_type, country_id : country_id},
			success: function(resdata){
			   //alert(resdata);
			   console.log(resdata);
			   $('#result').empty();
			   $('#result').html(resdata);
			}
		}); 
	}
}
</script>
</body>
</html>