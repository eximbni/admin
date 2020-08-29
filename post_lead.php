<?php
$message="";
if(isset($_POST['submit']))
{
include("config.php");
date_default_timezone_set("Asia/Calcutta");
$date = date('Y-m-d');
$leadref_id = $ext."-".$user_country."-".$chapter_id."-". date("Y-m-d h:i:s")."-".rand(111111-999999);
$lead_type=$_POST['lead_type'];
if($lead_type=="Buy"){
	$ext = "B";
	}
else{
	$ext="S";
}
$category_id = $_POST['category'];
$chapter_id=$_POST['chapter'];
$hsn_code = $_POST['hsn_code'];
$product = $_POST['product'];
$uom = $_POST['uom'];
$continent = $_POST['continent'];
$country = $_POST['country'];
$country_id =$_POST['lead_country'];
$quantity = $_POST['quantity'];
$lead_cost = $_POST['lead_cost'];
$mobile = $_POST['mobile'];
$last_date = $_POST['last_date'];
$desc = $_POST['desc'];
$targetDir = "docs/";
$fileName = basename($_FILES["doc"]["name"]);
$targetFilePath = $targetDir . $fileName;
$FilePath = "leaddocs/". $fileName;
if($ext=='B'){
	$sno = "select sno from leads where lead_type='Buy' and chapter_id='$chapter_id' order by id desc limit 1";
	$resno = mysqli_query($conn, $sno);
	if($resno){
		while($rowno=mysqli_fetch_assoc($resno)){
			$sno = $rowno['sno'];
		}
	}
	$nso =$sno+1;
	$nso;
}
else{
	$sno = "select sno from leads where lead_type='Sell' and chapter_id='$chapter_id' order by id desc limit 1";
	$resno = mysqli_query($conn, $sno);
	if($resno){
		while($rowno=mysqli_fetch_assoc($resno)){
			$sno = $rowno['sno'];
		}
	}
	$nso = $sno+1;
	$nso;
}


$getcountry_code = "select iso_code_3 from countries where country_id='$country_id'";
$rescountry_code = mysqli_query($conn,$getcountry_code);
if($rescountry_code){
	while($row_country=mysqli_fetch_assoc($rescountry_code)){
		$country_code = $row_country["iso_code_3"];
	}
}

$leadref_id = $ext."-".$country_code."-".$chapter_id."-".mt_rand(11111111,99999999);
$sql_lead = "INSERT INTO `leads`(`leadref_id`, `lead_type`, `lead_cost`, `posted_by`, `hsn_id`, `chapter_id`, `categories_id`, `product_id`, `uom_id`, `country_id`, `quantity`, `description`, `posted_date`, `expiry_date`, `bulk_lead`, `status`, `sno`) VALUES 
('$leadref_id','$lead_type','$lead_cost','5','$hsn_code','$chapter_id','$category_id','$product','$uom','$country_id','$quantity','$desc','$date','$last_date','0','1','$nso')";
$res_lead = mysqli_query($conn,$sql_lead);

if($res_lead)
{
	$getlead_id = "select id from leads where posted_by=5 order by id desc limit 1;";
	$reslead = mysqli_query($conn,$getlead_id);
	while($row= mysqli_fetch_assoc($reslead)){
	$lead_id = $row["id"];
	}
	foreach($country As $value)
{
	$inscountry = "insert into lead_display_countries (lead_id, country_id) values('$lead_id','$value')";
	$rescountry = mysqli_query($conn,$inscountry);
	if($rescountry){
		$message= "<div class='alert alert-success'>Lead inserted Successfully.</div>";
	}
}
	
}
else
{
	//echo "Lead insert failed";
	$message= "<div class='alert alert-danger'>Failed to insert lead.</div>";
}
}
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
	<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
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
				  <li class="breadcrumb-item"><a href="">Lead Module</a></li>
				  <li class="breadcrumb-item active">Post Lead</li>
				</ol>
				
			  </div>
			</div>
			<div class="row mb-2">
			  <div class="col-sm-9">
				<h4 style="text-align:center;"><b>Post Lead</b></h4>
			  </div>
			  <div class="col-sm-3">
			  	Click here to <a href="bulk_PostLead.php" target="_blank">Bluk Lead Post </a> 
			  </div>
			</div>
		  </div><!-- /.container-fluid -->

		</section>
				
				
				
			<?php echo $message; ?>
	<section class="content">
    
	  <div class="card p-3">
							
	<div class="container">
	
	<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		  <div class="box-body">
		    <div class="row">
			<div class="col-md-6">
			<div class="form-group">
			  <label>Lead type</label>
			  <select class="form-control" name="lead_type">
				<option>select</option>
				<option>Sell</option>
				<option>Buy</option>
			  </select>
			</div>
			<div class="form-group">
			  <label>Select Role</label>
					  
			</div>
			<div class="form-group">
				  <label>Select Chapter</label>
				  <select class="form-control" id="chapter" name="chapter" required>
					<!--option>select</option>
					<option>option 1</option>
					<option>option 2</option-->
				  </select>
			</div>
			<div class="form-group">
				  <label>Select HSN Code</label>
				  <select class="form-control" name="hsn_code" id="hsn_code" required>
					<!--option>select</option>
					<option>option 1</option>
					<option>option 2</option-->
				  </select>
			</div>
			<div class="form-group">
				  <label>Select Product</label>
				  <select class="form-control" name="product" id="product" required>
					<!--option>select</option>
					<option>option 1</option>
					<option>option 2</option-->
				  </select>
			</div>
			<div class="form-group">
				  <label>Select UOM</label>
				  <select class="form-control" name="uom" required>
					<option>select</option>
					<?php include("config.php");
						$get = "select * from uoms";
						$res = mysqli_query($conn,$get);
						if($res){
							while($row=mysqli_fetch_assoc($res)){
						?>
							<option value="<?php echo $row['id'];?>"><?php echo $row['uom'];?></option>
					<?php }} ?>
				  </select>
			</div>
			<div class="form-group">
				  <label>Lead Source Country</label>
				  <select class="form-control" name="lead_country" required>
					<option>select</option>
					<?php include("config.php");
						$get = "select * from countries";
						$res = mysqli_query($conn,$get);
						if($res){
							while($row=mysqli_fetch_assoc($res)){
						?>
							<option value="<?php echo $row['country_id'];?>"><?php echo $row['name'];?></option>
					<?php }} ?>
				  </select>
			</div>
			</div>
			<div class="col-md-6">
			
			
			<div class="form-group">
				  <label>Select Country</label>
				  <select class="form-control select2" multiple="multiple" name="country[]" data-placeholder="Select Country" style="width: 100%;" required>
					<?php include("config.php");
						$get = "select * from countries";
						$res = mysqli_query($conn,$get);
						if($res){
							while($row=mysqli_fetch_assoc($res)){
						?>
							<option value="<?php echo $row['country_id'];?>"><?php echo $row['name'];?></option>
					<?php }} ?>

				  </select>
			</div>
			
			<div class="form-group">
			  <label for="">Quantity</label>
			  <input type="number" class="form-control" id="" placeholder="Quantity" name="quantity" required>
			</div>
			<div class="form-group">
			  <label for="">Lead Cost</label>
			  <input type="number" class="form-control" id="" placeholder="Lead Cost" name="lead_cost" required>
			</div>
			<div class="form-group">
			  <label for="">Mobile</label>
			  <input type="number" class="form-control" id="" placeholder="Mobile" name="mobile" required>
			</div>
			<div class="form-group">
			  <label for="">Last Date</label>
			  <input type="date" class="form-control" id="" placeholder="Last Date" name="last_date" required>
			</div>
			
			<div class="form-group">
                    <label for="exampleInputFile">Upload Document</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="doc">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                     
                    </div>
            </div>
			
			<div class="form-group">
			  <label for="exampleInputPassword1">Description</label>
				<textarea class="form-control" placeholder="Type Here" name="desc" required></textarea>
			</div>
			
			
			
		  </div>
		  <!-- /.box-body -->
		</div>
		  <div class="box-footer text-right mb-3" >
			<button type="submit" class="btn btn-outline-primary" name="submit">Submit</button>
		  </div>
	</form>

	
	</div>
</div>
</div>
</div>
<script>
$('#category').on('change', function() {
  var a = $('#category').val();
  $.ajax({
		type:"POST",
		url:"get_chapter.php",
		data:{
			id:a
		},
		dataType:'json',
		success:function(response)
		{
			//alert(response);
			$("#chapter").empty;
			$("#chapter").append(response);
		},
		error:function(error)
		{
			alert(error);
		},
	});
});

$('#chapter').on('change', function() {
  var a = $('#chapter').val();
  $.ajax({
		type:"POST",
		url:"get_hsncode.php",
		data:{
			id:a
		},
		dataType:'json',
		success:function(response)
		{
			//alert(response);
			$("#hsn_code").empty;
			$("#hsn_code").append(response);
		},
		error:function(error)
		{
			alert(error);
		},
	});
});

$('#hsn_code').on('change', function() {
  var a = $('#hsn_code').val();
  $.ajax({
		type:"POST",
		url:"get_hsncode_desc.php",
		data:{
			id:a
		},
		dataType:'json',
		success:function(response)
		{
			//alert(response);
			$("#product").empty;
			$("#product").append(response);
		},
		error:function(error)
		{
			alert(error);
		},
	});
});

$('#continent').on('change', function() {
  var a = $('#continent').val();
  $.ajax({
		type:"POST",
		url:"get_countries.php",
		data:{
			id:a
		},
		dataType:'json',
		success:function(response)
		{
			//alert(response);
			$("#country").empty;
			$("#country").append(response);
		},
		error:function(error)
		{
			alert(error);
		},
	});
});
</script>
<script>
 $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
 });
 
 $('form').on('focus', 'input[type=number]', function (e) {
  $(this).on('wheel.disableScroll', function (e) {
    e.preventDefault()
  })
})
$('form').on('blur', 'input[type=number]', function (e) {
  $(this).off('wheel.disableScroll')
})
</script>
 </body>
 </html>