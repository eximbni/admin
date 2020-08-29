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
						  <li class="breadcrumb-item active">EXIM Fund</li>
						</ol>
						<?php echo $message; ?>
					  </div>
					</div>
					<div class="row mb-2">
					  <div class="col-sm-12">
						<h4 style="text-align:center;"><b>EXIM Fund</b></h4>
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
						<div class="col-md-5">
							<div class="form-group">
							  <label>Select Country</label>
							  <select class="form-control" name="country_id" id="country_id" onchange="getState()">
								<option value=""> --Select Country-- </option>
								<?php
								$sql_countries ="SELECT country_id,name FROM `countries`";
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
						<div class="col-md-5">
							<div class="form-group">
							  <label>Select State</label>
							  <select class="form-control" name="state_id" id="state_id">
								<option value=""> --Select State-- </option>
								</select>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group" style="margin-top:20%;">
								<button type="button" name="search" id="search" class="btn btn-outline-primary" onclick="return getdata()">Search</button>
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
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
						  <th>Sr.No</th>
						  <th>User</th>
						  <th>Country</th>
						  <th>State</th>
						  <th>Amount</th>
						  <th>Payment For</th>
						  <th>Payment Date</th>
						</tr>
						</thead>
						<tbody id="result">
					        <?php
					            $i=0;
					            $sql = "SELECT e.*, c.name as countryname, s.name as statename, u.name as username FROM eximfund e, countries c, state s, users u where e.state_id=s.zone_id and c.country_id=e.country_id and u.id=e.user_id";
					            $result = mysqli_query($conn,$sql);
					            while($row=mysqli_fetch_array($result))
					            { ?>
					            <tr>
					                <?php $i++; ?>
					                <td><?php echo $i; ?></td>
					                <td><?php echo $row['username']; ?></td>
					                <td><?php echo $row['countryname']; ?></td>
					                <td><?php echo $row['statename']; ?></td>
					                <td><?php echo $row['amount']; ?></td>
					                <td><?php echo $row['payment_for']; ?></td>
					                <td><?php echo $row['payment_date']; ?></td>
					           </tr>     
					       <?php } ?>
						</tbody>
						<tfoot>
							
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
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });

function getState(){
	var country_id = $("#country_id").val();
	if(country_id ==''){
		alert("Please Select Country");
		$("#country_id").focus();
		return false;
	}
	else
	{
		//alert(country_id);
		$.ajax({
			type:"post",
			url : "get_state.php",
			data : {id : country_id},
			success: function(resdata){
			   //alert(resdata);
			   console.log(resdata);
			   $('#state_id').empty();
			   $('#state_id').html(resdata);
			}
		}); 
	}
}
function getdata(){
	var country_id = $("#country_id").val();
	var state_id = $("#state_id").val();
		//alert(country_id);alert(state_id);
		$.ajax({
			type:"post",
			url : "geteximfund.php",
			data : {country_id : country_id,state_id : state_id},
			success: function(resdata){
			   //alert(resdata);
			   console.log(resdata);
			   $('#result').empty();
			   $('#result').html(resdata);
			}
		}); 
}
</script>
</body>
</html>