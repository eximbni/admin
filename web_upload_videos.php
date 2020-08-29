<?php 
include("config.php");
include "header.php";
error_reporting(0);
$message ="";

if(isset($_REQUEST['videoSubmit'])){
	
	$videoTitle = $_REQUEST['title'];
	$videoDesc = $_REQUEST['description'];
	$videoTags = $_REQUEST['tags'];
	$webinar_id = $_REQUEST['webinar_id'];
	$todays = date("Y-m-d H:i:00");
	
	if($_FILES["videoFile"]["name"] != ''){
	    $fileSize = $_FILES['videoFile']['size'];
	    $fileType = $_FILES['videoFile']['type'];
	    $fileName = str_shuffle('nityanandamaity').'-'.basename($_FILES["videoFile"]["name"]);
		$targetDir = "webinar_videos/";
		$targetFile = $targetDir . $fileName;
		//$fileType = pathinfo($fileName, PATHINFO_EXTENSION); 

		$allowedTypeArr = array("video/mp4", "video/avi", "video/mpeg", "video/mpg", "video/mov", "video/wmv", "video/rm");
		if(in_array($fileType, $allowedTypeArr)) {
		    if(move_uploaded_file($_FILES['videoFile']['tmp_name'], $targetFile)) {
		        $videoFilePath = $targetFile;
		    }else{
		    	$message= "<div class='alert alert-danger'>Sorry, there was an error uploading your file.</div>";
		    }
		}else{
			header('Location:'.BASE_URI.'upload_webinar_videos.php?err=fe');
			$message= "<div class='alert alert-danger'>Sorry, only MP4, AVI, MPEG, MPG, MOV & WMV files are allowed.</div>";
		}
	    
	    if($videoFilePath){

			$sql_videos = "INSERT INTO `webinar_videos`(`video_title`, `video_description`, `video_tags`, `video_path`, `webinar_id`,`created`) VALUES('$videoTitle','$videoDesc','$videoTags', '$videoFilePath','$webinar_id','$todays')";
			$res_videos = mysqli_query($conn,$sql_videos);
			if($res_videos){
				$message= "<div class='alert alert-success'>Webinar video uploaded Successfully.</div>";
			}else{
				$message= "<div class='alert alert-danger'>Some problems occured, please try again.</div>";
			}
		}else{

			$message= "<div class='alert alert-danger'>Sorry, there was an error uploading your file.</div>";

		}	
		
	}else{
		$message= "<div class='alert alert-danger'>Please select a video file for upload.</div>";
		
	}

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
						  <li class="breadcrumb-item"><a href="">Webinar Module</a></li>
						  <li class="breadcrumb-item active">Webinar Video List</li>
						</ol>
					  </div>
					</div>
					<div class="row mb-2">
					  <div class="col-sm-12">
						<h6 style="text-align:center;"><b> Upload Webinar Videos</b></h6>
						<?php echo $message; ?>
						<?php echo $message1; ?><?php echo $message2; ?><?php echo $message3; ?><?php echo $message4; ?><?php echo $message5; ?><?php echo $message6; ?><?php echo $message7; ?>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->

				</section>
			
<section class="content">
    <div class="card">
		<div class="card-body" style="overflow:scroll" >

		<form method="post" name="multiple_upload_form" id="multiple_upload_form" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">

					    <div class="row">

							<div class="col-md-6">
								
								<div class="form-group">
								  	<label>Select Webinar</label>
								  	<select class="form-control" name="webinar" id="webinar" onchange="getWebinarDetails()">
										<option>select</option>
										<?php 
											$get = "select * from webinar WHERE status ='1' ";
											$res = mysqli_query($conn,$get);
											if($res){
												while($row=mysqli_fetch_assoc($res)){
											?>
												<option value="<?= $row['id'].",".$row['description'].",".$row['title'];?>"><?= $row['title'];?></option>
										<?php }} ?>					
								  	</select>
								</div>

								<div class="form-group">
									  <label>Video Description</label>
									  <input type="text" class="form-control" name="description" id="description" required>
									  <input type="hidden" class="form-control" name="title" id="title" >
									  <input type="hidden" class="form-control" name="webinar_id" id="webinar_id" >
								</div>

							</div>

							<div class="col-md-6">

								<div class="form-group">
									<label>Video Tags </label>
									<input type="text" class="form-control" name="tags" id="tags" >
								</div>

								<div class="form-group">
									<label>Choose Video File <span class="text-danger">*</span></label> 							
									<div >
										<input type="hidden" name="MAX_FILE_SIZE" value="26214400" />
										<input type="file" name="videoFile" id="videoFile"  required>
									 	<button type="submit" id="submit" name="videoSubmit" class="btn btn-outline-success pull-right" >Upload</button>
									</div>
								</div>

						  	</div>

					  <!-- /.box-body -->
						</div>

		</form>

		</div>

	</div>
</section>


			<section class="content">
    
				  <div class="card">
				
           
			   <div class="card-body" style="overflow:scroll" >
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
						  	<th>Sr.No</th>
	                    	<th>Titles </th>
		                    <th>Path </th>
		                    <th>Description </th>
		                    <th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$sdate = date('Y-m-d')." 00:00:00";
						$edate = date('Y-m-d')." 23:59:59";
						$cdate = date('Y-m-d H:i:00');

						$sql_chk = "SELECT * FROM `webinar_videos` WHERE status='0' ";
						//echo $sql_chk;
						$query_chkres = mysqli_query($conn,$sql_chk);
						if(mysqli_num_rows($query_chkres)>0){
						$srno = 1;	
							while($row = mysqli_fetch_array($query_chkres)){
						?>	
						   	<tr>
							  <td align="center"><?= $srno; ?></td>
							  <td align="left"><?= $row['video_title']; ?></td>
							  <td align="left"><?= $row['video_path'];?></td>
							  <td align="left"><?= $row['video_description'];?></td>
							  <td> <a class="btn btn-success" href="https://eximbni.com/miiosadmin/<?= $row['video_path']; ?>" target="_blank" > View </a> </td>
						  	
							</tr>
						<?php
							$srno++;
							}
						}
						else{

						}
						?>
						</tbody>
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

function cnfapproval(){
	var confapp = confirm("Are you sure to approved this webinar");
	if(confapp == false){
		return false;
	}
}	

function getWebinarDetails(){
	var webinar = $("#webinar").val();
	var webdata = webinar.split(',');
	$("#webinar_id").val(webdata[0]);
	$("#title").val(webdata[2]);
	$("#description").val(webdata[1]);

}
</script>
</body>
</html>
