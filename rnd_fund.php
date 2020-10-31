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
            <h1 class="m-0 text-dark">RND Fund </h1>
            <h4 ><?php echo $message; ?></h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item">Accounts Module </li>
              <li class="breadcrumb-item active">RND Fund </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div> 
 
				
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
					      <!--  <?php
					            $i=0;
					            $sql = "SELECT r.*, c.name as countryname, s.name as statename, u.name as username FROM rndfund r, countries c, state s, users u where r.state=s.zone_id and c.country_id=r.country and u.id=r.user_id";
					            $result = mysqli_query($conn,$sql);
					            while($row=mysqli_fetch_array($result))
					            { ?>
					            <tr>
					                <?php $i++; ?>
					                <td><?php  $i; ?></td>
					                <td><?php  $row['username']; ?></td>
					                <td><?php  $row['countryname']; ?></td>
					                <td><?php  $row['statename']; ?></td>
					                <td><?php  $row['amount']; ?></td>
					                <td><?php  $row['payment_for']; ?></td>
					                <td><?php  $row['payment_date']; ?></td>
					           </tr>     
					       <?php } ?>-->
						</tbody>
						<tfoot>
							
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
			   //console.log(resdata);
			   $('#state_id').empty();
			   $('#state_id').append(resdata);
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
			url : "getrndfund.php",
			data : {country_id : country_id,state_id : state_id},
			success: function(resdata){
			   //alert(resdata);
			   //console.log(resdata);
			   $('#result').empty();
			   $('#result').append(resdata);
			}
		}); 
}
</script>
</body>
</html>