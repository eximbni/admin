<?php
include("config.php");
$message='';

if(isset($_POST['submit'])){
	$country_id=$_POST['country_id'];
	$rechargeamt=$_POST['rechargeamt'];
	$credits = $_POST['credits'];
	$rfq = $_POST['rfq'];
	$banners = $_POST['banners'];

	$created_date = date("Y-m-d");

	$chk = "select * from recharge_package where country_id='$country_id'";
	$chkres = mysqli_query($conn,$chk);
	if(mysqli_num_rows($chkres)>0){
		$message="<span style='color:red'>Recharge Already exists</span>";
	}
	else{
		$sql_insert_subscriptions = "insert into recharge_package(country_id,amount,credits,rfq,banners,created_date,status) values('$country_id','$rechargeamt','$credits','$rfq','$banners','$created_date','1')";
		$res_subscriptions = mysqli_query($conn,$sql_insert_subscriptions);
		if($res_subscriptions){
			$message = "<span style='color:green'>Recharge Completed Successfully</span>";
		}
		else{
			$message = "<span style='color:red'>Failed To Recharge</span>";
		}

	}
}

?>
<!DOCTYPE html>
<html>
<head>
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
			
			<?php include("header.php")?>
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
						  <li class="breadcrumb-item"><a href="">Package Module</a></li>
						  <li class="breadcrumb-item active">Recharge</li>
						</ol>
						<?php echo $message; ?>
					  </div>
					</div>
					<div class="row mb-2">
					  <div class="col-sm-12">
						<h4 style="text-align:center;"><b>Recharge</b></h4>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->

				</section>
				
				
				<section class="content">
				<div class="card">
				<h4 ><?php echo $message ?></h4>	
				<div class="container">
				<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >			
				  <div class="box-body">
				  <div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Select Country</label>
							<select class="form-control" name="country_id" id="country_id" onchange="get_plandetail(this.value)">
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
						<div class="form-group">
						  <label for="">Recharge Amount</label>
						  <input type="number" class="form-control" id="rechargeamt" name="rechargeamt" placeholder="Recharge Amount">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label for="">No of RFQ </label>
						  <input type="number" class="form-control" id="rfq" name="rfq" placeholder="No of RFQ">
						</div>
						<div class="form-group">
						  <label>No Of Credits</label>
						   <input type="number" class="form-control" id="credits" name="credits" placeholder="No of Credits">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label>NO Of Banners</label>
						   <input type="number" class="form-control" id="banners" name="banners" placeholder="No of Banners">
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
</div>
</div>
<script type="text/javascript">
function checkValidation(){
	var country_id = $("#country_id").val();
	var rechargeamt = $("#rechargeamt").val();
	var rfq = $("#rfq").val();
	var credits = $("#credits").val();
	var banners = $("#banners").val();
	var leadpost = $("#leadpost").val();
	var chat = $("#chat").val();
	var plan_description = $("#plan_description").val();

	if(country_id ==''){
		alert("Please select Country");
		$("#country_id").focus();
		return false;
	}

	if(rechargeamt ==''){
		alert("Please Enter Recharge Amount");
		$("#rechargeamt").focus();
		return false;
	}
	if(rfq ==''){
		alert("Please Enter No Of RFQ");
		$("#rfq").focus();
		return false;
	}
	
	if(credits ==''){
		alert("Please Enter No Of Credits");
		$("#credits").focus();
		return false;
	}	

	if(banners ==''){
		alert("Please Enter banners");
		$("#banners").focus();
		return false;
	}

	if(webinar ==''){
		alert("Please Select Webinar");
		$("#webinar").focus();
		return false;
	}	

	if(chat ==''){
		alert("Please Select Chat");
		$("#chat").focus();
		return false;
	} 
	
}	

</script>
 </body>
 </html>