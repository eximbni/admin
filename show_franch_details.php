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
	<aside class="main-sidebar sidebar-dark-primary elevation-4"> <?php include("sidemenu.php");?>  </aside>
	<div class="content-wrapper">

	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-12" id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>">
				<ol class="breadcrumb float-sm-left">
				  	<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				  	<li class="breadcrumb-item"><a href="">Franchise Module</a></li>
				  	<li class="breadcrumb-item active">Show Franchise Details</li>
					</ol>
					<?php echo $message; ?>
			  	</div>
			</div>
			<div class="row mb-2">
			  <div class="col-sm-12">
				<h4 style="text-align:center;"><b>Franchise Details</b></h4>
			  </div>
			</div>
		</div><!-- /.container-fluid -->
	</section>
				
		
	<section class="content">
    
		<div class="card p-3">
								
			<div class="container">

				<form class="form-horizontal" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">

				  	<div class="box-body">

					    <div class="row">
					        <?php
                			    include('config.php');
                				$id = $_GET['id'];
                		        $sql_name = "SELECT * FROM franchise_request WHERE id='$id'";
                		        $result_name = mysqli_query($conn,$sql_name);
                		        while($row_name = mysqli_fetch_array($result_name))
                		        {
                		            $business_background = $row_name['business_background'];
                		            $countryof_origin = $row_name['countryof_origin'];
                		            $business_info = $row_name['business_info'];
                		            $infrastructure = $row_name['infrastructure'];
                		            $url = $row_name['url'];
                		            $ownership_type = $row_name['ownership_type'];
                		            $anual_turnover = $row_name['anual_turnover'];
                		            $willing_tosetup = $row_name['willing_tosetup'];
                		        }
                		    ?>

							<div class="col-md-6">
								
								<div class="form-group">
								  	<label>Business Background</label> : <lable><?php echo $business_background; ?></lable>
								  	
								</div>

								<div class="form-group">
									  <label>Country of Origin</label> : <lable><?php echo $countryof_origin; ?></lable>
									  
								</div>

								<div class="form-group">
									  <label>Business Info</label> : <lable><?php echo $business_info; ?></lable>
									  
								</div>
								
								<div class="form-group">
									<label>Setup to Separate Infrastructure</label> : <lable><?php echo $willing_tosetup; ?></lable>
	
								</div>


							</div>

							<div class="col-md-6">

								<div class="form-group">
									  <label>Current Infrastructure</label> : <lable><?php echo $infrastructure; ?></lable>
									  
								</div>

								<div class="form-group">
									  <label>Website Link</label> : <lable><?php echo $url; ?></lable>
									  
								</div>
								

								<div class="form-group">
									<label>Ownership Type</label> : <lable><?php echo $ownership_type; ?></lable>
	
								</div>
								
								<div class="form-group">
									<label>Annual Approximately Turnover</label> : <lable><?php echo $anual_turnover; ?></lable>
	
								</div>

						  	</div>

					  <!-- /.box-body -->
						</div>

					</div>	

				</form>

			</div>

		</div>

	</section>

	</div>

</div>

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

 </body>
 </html>