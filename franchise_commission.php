<?php 
include("config.php");
include "header.php";

$message ="";
if(isset($_POST['search'])){
	$countryid = $_POST['country_id'];
	$planid = $_POST['plan_id'];

}else{
	$countryid = '';
	$planid = '';
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
						  <li class="breadcrumb-item active">Franchise Commission</li>
						</ol>
						<?php echo $message; ?>
					  </div>
					</div>
					<div class="row mb-2">
					  <div class="col-sm-12">
						<h4 style="text-align:center;"><b>Franchise Commission</b></h4>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->

				</section>
				
				<section class="content">
				<div class="card">
				<h4 ><?php echo $message ?></h4>	
				<div class="card-body">
				<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >			
				  <div class="box-body">
				  <div class="row">
					<div class="col-md-6">
						<div class="form-group">
						  <label>Select Country</label>
						  <select class="form-control" name="country_id" id="country_id" onchange="get_type(this.value)">
							<option value=""> --Select Country-- </option>
							<?php
							$sql_countries ="SELECT country_id, name FROM `countries`";
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
		                <label for="exampletenant_plotno">Select Franchise Type</label>
		                <select name="fr_type" id="fr_type" class="form-control">
		                  <option value=""> --Select Type-- </option>
							<?php
							$sql_franchies ="SELECT code, franchise FROM `franchise_type`";
							$query_franchies = mysqli_query($conn, $sql_franchies);
							while($res_franchies = mysqli_fetch_array($query_franchies)){
							?>
							<option value="<?= $res_franchies['code']?>">	<?= $res_franchies['franchise']?></option>
							<?php
							}
							?>
						</select>	
						</div>

					</div>
					<div class="col-md-6">
						<div class="form-group">
		                <label for="exampletenant_plotno">Select Chapter</label>
		                <select name="chapter_id" id="chapter_id" class="form-control" onchange="get_frachise(this.value)">
							<option value=""> --Select Chapter-- </option>
							<?php
							$sql_franchies ="SELECT id, chapter_name FROM `chapters`";
							$query_franchies = mysqli_query($conn, $sql_franchies);
							while($res_franchies = mysqli_fetch_array($query_franchies)){
							?>
							<option value="<?= $res_franchies['id']?>">	<?= $res_franchies['chapter_name']?></option>
							<?php
							}
							?>
		                </select>
						</div>

					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label>Select Franchise</label>
						  <select class="form-control" name="fruser_id" id="fruser_id">
							<option value=""> --Select Franchise-- </option>
							<?php
							$sql_franchies ="SELECT id, name FROM `franchise_users`";
							$query_franchies = mysqli_query($conn, $sql_franchies);
							while($res_franchies = mysqli_fetch_array($query_franchies)){
								if($fruserid == $res_franchies['id']){
									$status ="selected";
								}else{
									$status ="";
								}
							?>
							<option value="<?= $res_franchies['id']?>" <?= $status;?>>	<?= $res_franchies['name']?></option>
							<?php
							}
							?>
							
						  </select>
						</div>
					</div>			
				</div>
					  <!-- /.box-body -->

				  <div class="box-footer text-right mb-3" >
					<button type="submit" name="search" id="search" class="btn btn-outline-primary" onclick="return checkValidation()">Search</button>
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
						  <th>Franchise Name</th>
						  <th>Amount</th>
						  <th>Payment For</th>
						  <th>Payment Date</th>
						</tr>
						</thead>
						<tbody>
						<?php
						if(isset($_POST['search']))
						{
							$fruser_id = $_POST['fruser_id'];
							$sql_chk = "SELECT fa.*,fu.name FROM frachise_accounts fa, franchise_users fu where fa.franchise_id='$fruser_id' and fa.franchise_id = fu.id";

						}else{
							$sql_chk = "SELECT fa.*,fu.name FROM frachise_accounts fa, franchise_users fu where fa.franchise_id = fu.id";
						}
						//echo $sql_chk;
						$query_chkres = mysqli_query($conn,$sql_chk);
						if(mysqli_num_rows($query_chkres)>0){
						$srno = 0;	
							while($row = mysqli_fetch_array($query_chkres)){
								$srno++;
								$name=$row['name'];
								$amount	=$row['amount'];
								$payment_for=$row['payment_for'];
								$payment_date=$row['payment_date'];
								
								$total_commission = $total_commission + $amount;
						?>	
						   	<tr>
							  <td align="center"><?= $srno; ?></td>
							  <td align="center"><?= $name; ?></td>
							  <td align="center"><?= number_format($amount,'2'); ?></td>
							  <td align="center"><?= $payment_for;?></td>
							  <td align="center"><?= $payment_date;?></td>
							</tr>
						<?php
							}
						}
						else{

						}
						?>
						</tbody>
						<tfoot>
							<tr>
							  <th align="left" colspan="4"> Total Commission </th>
							  <td align="right"><strong><?= number_format($total_commission,'2');?></strong></td>
							</tr>
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

function checkValidation(){
	var fruser_id = $("#fruser_id").val();
	
	if(fruser_id ==''){
		alert("Please Select franchise");
		$("#fruser_id").focus();
		return false;
	}

	var fr_type = $("#fr_type").val();
	
	if(fr_type ==''){
		alert("Please Select franchise type");
		$("#fr_type").focus();
		return false;
	}
}	
function get_frachise(chapter_id){
 //alert(countryid);
 var country_id = $("#country_id").val();
 var fr_type = $("#fr_type").val();
 
  $.ajax({
    type:"post",
    url : "getfranchise.php",
    data : {
		countryid : country_id,
		fr_type : fr_type,
		chapter_id : chapter_id
	},
    success: function(plandata){
      // alert(plandata);
       $('#fruser_id').html(plandata);
    }
  });

}
</script>
</body>
</html>
