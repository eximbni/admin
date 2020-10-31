<?php 
$message=""; 
include("config.php");
include("fcmpush.php");
if(isset($_POST['import'])) 
{

date_default_timezone_set("Asia/Calcutta");
$date = date('Y-m-d');
    $fileName1 = $_FILES["file"]["name"];
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        //Insert File Name
        
        $date_time = date('Y-m-d h:i:s');
        $file = $fileName1.$date_time;
        $add_file = "insert into bulk_lead_file(`user_id`, `country_id`, `file_name`, `created`, `status`) values ('admin','99','$file','$date_time','1')";
        $res_file = mysqli_query($conn,$add_file);
        if($res_file)
        {
            echo "file uploaded";
        }
        //Insert File Name
        
        $file = fopen($fileName, "r");
        
fgetcsv($file, 10000, ","); 

        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {


$lead_type=$column[0];
if($lead_type=="Buy"){
	$ext = "B";
	}
else{
	$ext="S";
}

$country = '';
$country_id = $column[1];
$category_id = $column[2];
$chapter_id= $column[3];
$hsn_code = $column[4];
$uom = $column[5];
$quantity = $column[6];
$lead_cost = $column[7];
$desc = $column[9];
$last_date = date('Y-m-d', strtotime($column[8])); 
$loading_port = $column[10];
$destination_port = $column[11];
$port_type = $column[12];
$price_option = $column[13];
$currency = $column[14];
$price = $column[15];
$inspection_auth = $column[16];
$special_isntructions = $column[17];
$doc1 = $column[18];
$doc2 = $column[19];
$doc3 = $column[20];
$doc4 = $column[21];
if(isset($country_id) && isset($category_id) && isset($chapter_id) && isset($hsn_code) && isset($uom) && isset($quantity) && isset($lead_cost) ){

	    $getrefid = "select * from leads where lead_type='$lead_type' and country_id='$country_id' and chapter_id='$chapter_id' order by id desc limit 1";
	    $resref = mysqli_query($conn,$getrefid);
	    if(mysqli_num_rows($resref)>0){
	        while($row=mysqli_fetch_assoc($resref)){
	            $sno = $row["sno"];
	            }
	            $nsno = $sno+1;
	            
	    }
	    else{
	        $nsno = 1;
	    }

$getcountry_code = "select iso_code_2 from countries where country_id='$country_id'";
$rescountry_code = mysqli_query($conn,$getcountry_code);
if($rescountry_code){
	while($row_country=mysqli_fetch_assoc($rescountry_code)){
		$country_code = $row_country["iso_code_2"];
	}
}

//echo $leadref_id = $ext.$value.$chapter_id;
$sql_lead = "INSERT INTO `leads`(`lead_type`, `lead_cost`, `posted_by`, `hsn_id`, `chapter_id`, `categories_id`, `uom_id`, `country_id`, `quantity`, `description`, `posted_date`, `expiry_date`, `bulk_lead`, `status`, `sno`, `loading_port`, `destination_port`, `port_type`,`price_option`, `currency`, `price_inusd`, `inspection_auth`, `special_instruc`, `doc1`, `doc2`, `doc3`, `doc4`) VALUES ('$lead_type','$lead_cost','5','$hsn_code','$chapter_id','$category_id','$uom','$country_id','$quantity','$desc','$date','$last_date','1','1','$nsno','$loading_port','$destination_port','$port_type','$price_option','$currency','$price','$inspection_auth','$special_isntructions','$doc1','$doc2','$doc3','$doc4')";
$res_lead = mysqli_query($conn,$sql_lead);

if($res_lead)
{ 
    $lastinserted_id  = mysqli_insert_id($conn);
    if($chapter_id < 10){
        $chapter_id = '0'.$chapter_id;
    }
    
    $leadref_id = $ext."-".$country_code."-".$chapter_id."-".$lastinserted_id;
    
    mysqli_query($conn, "UPDATE `leads` SET `leadref_id` = '$leadref_id' WHERE id ='$lastinserted_id'" );
    
    $target_path = "uploads/lead_doc/";
    //doc1 
    $target_name1 = basename($_FILES['doc1']['name']);
    $target_path1 = $target_path . basename( $_FILES['doc1']['name']);
     
    if (move_uploaded_file($_FILES['doc1']['tmp_name'], $target_path1)) {
        echo "Upload and move success";
        mysqli_query($conn, "INSERT INTO `lead_documents`(`lead_id`, `doc_name`, `doc_path`, `user_id`, `created_date`, `status`) VALUES ('$lastinserted_id','$target_name1','$target_path1','0','$date_time','1')" );
    } else {
    echo $target_path1;
        echo "There was an error uploading the file, please try again!";
    }
    //doc1
    
    //doc2
    $target_name2 = basename($_FILES['doc2']['name']);
    $target_path2 = $target_path . basename($_FILES['doc2']['name']);
     
    if (move_uploaded_file($_FILES['doc2']['tmp_name'], $target_path2)) {
        echo "Upload and move success";
        mysqli_query($conn, "INSERT INTO `lead_documents`(`lead_id`, `doc_name`, `doc_path`, `user_id`, `created_date`, `status`) VALUES ('$lastinserted_id','$target_name2','$target_path2','0','$date_time','1')" );
    } else {
    echo $target_path;
        echo "There was an error uploading the file, please try again!";
    }
    //doc2
    
    //doc3
    $target_name3 = basename($_FILES['doc3']['name']);
    $target_path3 = $target_path . basename( $_FILES['doc3']['name']);
     
    if (move_uploaded_file($_FILES['doc3']['tmp_name'], $target_path3)) {
        echo "Upload and move success";
        mysqli_query($conn, "INSERT INTO `lead_documents`(`lead_id`, `doc_name`, `doc_path`, `user_id`, `created_date`, `status`) VALUES ('$lastinserted_id','$target_name3','$target_path3','0','$date_time','1')" );
    } else {
    echo $target_path;
        echo "There was an error uploading the file, please try again!";
    }
    //doc3
    
    //doc4
    $target_name4 = basename($_FILES['doc4']['name']);
    $target_path4 = $target_path . basename( $_FILES['doc4']['name']);
     
    if (move_uploaded_file($_FILES['doc4']['tmp_name'], $target_path4)) {
        echo "Upload and move success";
        mysqli_query($conn, "INSERT INTO `lead_documents`(`lead_id`, `doc_name`, `doc_path`, `user_id`, `created_date`, `status`) VALUES ('$lastinserted_id','$target_name4','$target_path4','0','$date_time','1')" );
    } else {
    echo $target_path;
        echo "There was an error uploading the file, please try again!";
    }
    //doc4
    
/*	$getlead_id = "select id from leads where posted_by=5 order by id desc limit 1;";
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
	}*/
	$type = "success";
	$message= "<div class='alert alert-success'>Lead inserted Successfully.</div>";
	
    $title ="New Lead Posted";
    $getusers = "select * from subscription_chapter where chapter_id='$chapter_id'";
    $resget = mysqli_query($conn,$getusers);
    if(mysqli_num_rows($resget)>0){
        while($frow=mysqli_fetch_assoc($resget)){
            $fcmusers[]= $frow["user_id"];
        }
       
    }
    foreach($fcmusers as $val){
    $fcmid ="select * from users where id='$val' and device_id !='' ";
    $resid = mysqli_query($conn,$fcmid);
    if($resid){
        while($furow = mysqli_fetch_assoc($resid)){
            $id[]=$furow["device_id"];
        }
    }
    }
    $push_message = "Hi New Lead Posted For Chapter ".$chapter_id.".";
    fcm($push_message,$id,$title);
	
}else{
	$type = "error";
	echo mysqli_error($conn);
	$message= "<div class='alert alert-danger'>Problem in Importing CSV Lead Post1.</div>";
}

}else{

	$type = "error";
	$message= "<div class='alert alert-danger'>Problem in Importing CSV Lead Post2.</div>";

}
        }
       
    }
    
}

 require "header1.php";

?>  
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Bulk Post Leads</h1>
            <h4 ><?php echo $message; ?></h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item">Lead Model </li>
              <li class="breadcrumb-item active">Bulk Post Leads </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    
	<section class="content">
    
		<div class="card p-3">
								
			<div class="container">

				<form class="form-horizontal" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">

				  	<div class="box-body">

					    <div class="row">

							<div class="col-md-6">
								
								<div class="form-group">
								  	<label>Select Category</label>
								  	<select class="form-control" name="category" id="category" >
										<option>select</option>
										<?php 
											$get = "select * from categories";
											$res = mysqli_query($conn,$get);
											if($res){
												while($row=mysqli_fetch_assoc($res)){
											?>
												<option value="<?php echo $row['id'];?>"><?php echo $row['id']." || ".$row['category_name'];?></option>
										<?php }} ?>					
								  	</select>
								</div>

								<div class="form-group">
									  <label>Select HSN Code</label>
									  <select class="form-control" name="hsn_code" id="hsn_code" >
										<!--option>select</option>
										<option>option 1</option>
										<option>option 2</option-->
									  </select>
								</div>

								<div class="form-group">
									  <label>Lead Source Country</label>
									  <select class="form-control" name="lead_country" >
										<option>select</option>
										<?php include("config.php");
											$get = "select * from countries";
											$res = mysqli_query($conn,$get);
											if($res){
												while($row=mysqli_fetch_assoc($res)){
											?>
												<option value="<?php echo $row['country_id'];?>"><?php echo $row['country_id']." || ".$row['name'];?></option>
										<?php }} ?>
									  </select>
								</div>


							</div>

							<div class="col-md-6">

								<div class="form-group">
									  <label>Select Chapter</label>
									  <select class="form-control" id="chapter" name="chapter" > </select>
								</div>

								<div class="form-group">
									  <label>Select UOM</label>
									  <select class="form-control" name="uom" >
										<option>select</option>
										<?php include("config.php");
											$get = "select * from uoms";
											$res = mysqli_query($conn,$get);
											if($res){
												while($row=mysqli_fetch_assoc($res)){
											?>
												<option value="<?php echo $row['id'];?>"><?php echo $row['id']." || ".$row['uom'];?></option>
										<?php }} ?>
									  </select>
								</div>
								

								<div class="form-group">
									<label>Choose CSV File <span class="text-danger">*</span></label> 
									Click here to download <label><a href="postLeadCSV.csv" target="_blank"> CSV Format</a></label>
									
									<div >
										<input type="file" name="file" id="file" accept=".csv" required>
									</div>
								</div>

						  	</div>

					  <!-- /.box-body -->
						</div>
						
						<div class="row">
						    <div class="col-md-3">
						        <div class="custom-file">
                                  <input type="file" class="custom-file-input"  id="doc1" name="doc1">
                                  <label class="custom-file-label" for="customFile">Doc 1</label>
                                </div>
						    </div>
						    <div class="col-md-3">
						        <div class="custom-file">
                                  <input type="file" class="custom-file-input"  id="doc2" name="doc2">
                                  <label class="custom-file-label" for="customFile">Doc 2</label>
                                </div>
						    </div>
						    <div class="col-md-3">
						        <div class="custom-file">
                                  <input type="file" class="custom-file-input"  id="doc3" name="doc3">
                                  <label class="custom-file-label" for="customFile">Doc 3</label>
                                </div>
						    </div>
						    <div class="col-md-3">
						        <div class="custom-file">
                                  <input type="file" class="custom-file-input"  id="doc4" name="doc4">
                                  <label class="custom-file-label" for="customFile">Doc 4</label>
                                </div>
						    </div>
						</div>
						
						<div class="row" style="float:right;margin-top: 2%;">
						    <button type="submit" id="submit" name="import" class="btn btn-outline-success pull-right" >Submit</button>
                        </div>
					</div>	

				</form>

			</div>

		</div>

	</section>

</div>
<?php
require "footer1.php"
?>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
 
 

<script type="text/javascript">
$(document).ready(function() {
    $("#frmCSVImport").on("submit", function () {

	    $("#response").attr("class", "");
        $("#response").html("");
        var fileType = ".csv";
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
        if (!regex.test($("#file").val().toLowerCase())) {
        	    $("#response").addClass("error");
        	    $("#response").addClass("display-block");
            $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
            return false;
        }
        return true;
    });
});
</script>

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
