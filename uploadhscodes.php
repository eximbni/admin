<?php
$message="";
//$conn = mysqli_connect("localhost", "root", "", "test");
include("config.php");
if(isset($_POST['import'])) 
{

date_default_timezone_set("Asia/Calcutta");
$date = date('Y-m-d');

    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
		fgetcsv($file, 10000, ","); 

        while (($column = fgetcsv($file, 20000, ",")) !== FALSE) {

			$chapter_id = $column[0];
			$hscode = $column[1];
			$english = $column[2];
			$hs4= $column[3];
			$hs5 = $column[4];
			$hs6 = $column[5];
			$hs8 = $column[6];
			$policy = $column[7];
			$condition = $column[8];


			//echo $leadref_id = $ext.$value.$chapter_id;
			$sql_lead = "INSERT INTO `hsncodes_99_old1` (`chapter_id`, `hscode`, `english`, `hs4`, `hs5`, `hs6`, `hs8`, `policy`, `condition`) VALUES ('$chapter_id', '$hscode', '$english', '$hs4', '$hs5', '$hs6', '$hs8', '$policy', '$condition')";
			$res_lead = mysqli_query($conn,$sql_lead);

			if($res_lead)
			{
				$type = "success";
				$message= "<div class='alert alert-success'>Lead inserted Successfully.</div>";
			}else{
				$type = "error";
				$message= "<div class='alert alert-danger'>Problem in Importing CSV Lead Post.</div>";
			}

		}
       
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
	<aside class="main-sidebar sidebar-dark-primary elevation-4"> <?php include("sidemenu.php");?>  </aside>
	<div class="content-wrapper">

	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-12" id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>">
				<ol class="breadcrumb float-sm-left">
				  	<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				  	<li class="breadcrumb-item"><a href="">HSCODEs Module</a></li>
				  	<li class="breadcrumb-item active">Bulk HSCODEs Post</li>
					</ol>
					<?php echo $message; ?>
			  	</div>
			</div>
			<div class="row mb-2">
			  <div class="col-sm-12">
				<h4 style="text-align:center;"><b>Bulk Lead Post </b></h4>
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

							<div class="col-md-12">				

								<div class="form-group">
									<label>Choose CSV File <span class="text-danger">*</span></label> 
									Click here to download <label><a href="postLeadCSV.csv" target="_blank"> CSV Format</a></label>
									
									<div >
										<input type="file" name="file" id="file" accept=".csv" required>
									 	<button type="submit" id="submit" name="import" class="btn btn-outline-success pull-right" >Import</button>
									</div>
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


 </body>
 </html>