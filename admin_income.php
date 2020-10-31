<?php 
$message ="";
if(isset($_POST['search'])){
	$country_id = $_POST['country_id'];
}else{
	$country_id = '';
}

 require "header1.php";

?>  
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Admin Income</h1>
            <h4 ><?php echo $message; ?></h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item">Accounts Module </li>
              <li class="breadcrumb-item active">Admin Income </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
	<!--section class="content">

				<div class="card">
				<h4><?php echo $message ?></h4>	
				<div class="card-body">
				<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">			
				  <div class="box-body">
				  <div class="row">
						<div class="col-md-6">
							<div class="form-group">
							  <label>Select Country</label>
							  <select class="form-control" name="country_id" id="country_id">
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
						<div class="col-md-6">
							<div class="form-group" style="margin-top:6%;">
								<button type="button" name="search" id="search" class="btn btn-outline-primary" onclick="return checkValidation()">Search</button>
							</div>

						</div>
								
				</div>
				

				  <div class="box-footer text-right mb-3" >
					
				  </div>
		 </form>
		 
		 
	</div>
	</div>
	</section-->



			<section class="content">
    
				  <div class="card">
				
           
			   <div class="card-body">
					  <table id="example2" class="table table-bordered table-striped">
						<thead>
						<tr>
						  <th>Sr.No</th>
						  <th>Country Name</th>
						  <th>Amount</th>
						  <th>Action</th>
						</tr>
						</thead>
						<tbody id='result'>
						<?php 
						$srno = 1;
						date_default_timezone_set("Asia/Kolkata");
						$today = date('Y-m-d');
                        $start_date = date('Y-m-01', strtotime($today));
                        $last_date =  date('Y-m-t', strtotime($today));
						//$sql = "SELECT ai.*, c.name as country_name FROM admin_income ai, countries c WHERE ai.txn_type<>'credits' and u.country_id=c.country_id ORDER BY ai.id DESC";
						//$sql = "SELECT sum(ai.txn_amount) as tot_txn_amt, c.name as country_name, c.country_id FROM admin_income ai, users u, countries c WHERE ai.user_id=u.id and ai.txn_type<>'credits' and u.country_id=c.country_id GROUP BY c.country_id";
						$sql = "SELECT sum(ai.txn_amount) as tot_txn_amt, c.name as country_name, c.country_id FROM admin_income ai, users u, countries c WHERE ai.user_id=u.id and ai.txn_type<>'credits' and u.country_id=c.country_id and ai.txn_date between '$start_date' and '$last_date' GROUP BY c.country_id";
						$res = mysqli_query($conn,$sql);
						while($row=mysqli_fetch_array($res))
						{	$country_id = $row['country_id']; 
						?>
						<tr>
							<td><?php echo $srno; ?></td>
							<td><?php echo $row['country_name']; ?></td>
							<td><?php echo $row['tot_txn_amt']; ?></td>
							<td><a class="btn btn-outline-primary" href="country_admin_income.php?country_id=<?php echo $country_id; ?>">View</a></td>
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
<?php
require "footer1.php"
?>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
 
<script type="text/javascript">

function checkValidation(){
	var country_id = $("#country_id").val();
	if(country_id ==''){
		alert("Please Select Country");
		$("#country_id").focus();
		return false;
	}
	else
	{
		alert(country_id);
		$.ajax({
			type:"post",
			url : "getadmin_income.php",
			data : {country_id : country_id},
			success: function(resdata){
			   //alert(resdata);
			   console.log(resdata);
			   $('#result').html(resdata);
			}
		}); 
	}
}
</script>
</body>
</html>