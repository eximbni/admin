<?php

$msg ='';
$meeting_id ='';
$meeting_pass = '';
$webinar_title = '';
$webinar_datetime = '';
$message='';
$error_message='';

if(isset($_POST['submit'])){
	include("config.php");
	$webinar_title = $_POST['webinar_title'];
	$description = $_POST['webinar_description'];
	$duration_hrs = $_POST['duration_hrs'];
	$duration_min = $_POST['duration_min'];	
	$schedule_date = $_POST['schedule_date'];	
	$schedule_time = $_POST['scheduletime'];	
	$schedule_time = $schedule_time.":00";
	$meeting_id = $_POST['meeting_id'];	
	$meeting_pass = $_POST['meeting_pass'];	
	$meeting_duration = $duration_hrs.":".$duration_min;
	$created_date = date("Y-m-d");
	$webinar_datetime = $schedule_date." ".$schedule_time;
	$posted_by = $_POST['user_id'];
	
	$sql = "INSERT INTO `webinar`(`title`, `description`, `webinar_date`, `webinar_time`, `meeting_duration`, `status`,`meeting_id`, `meeting_pass`,`webinar_datetime`,`posted_by`)values('$webinar_title','$description','$schedule_date','$schedule_time','$meeting_duration','0','$meeting_id','$meeting_pass','$webinar_datetime','$posted_by')";
	$res = mysqli_query($conn,$sql);
	if($res){
		$message = "Webinar Schedule Added Successfully";
		
	}
	else{
		$error_message = "Failed To Add Webinar. ". mysqli_error($conn);
	}
}
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
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
		 
			<div class="content-wrapper" >
		
				<section class="content-header">
				  <div class="container-fluid">
					<div class="row mb-2">
					  <div class="col-sm-12">
						<ol class="breadcrumb float-sm-left">
						  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
						  <li class="breadcrumb-item"><a href="">Schedular Module</a></li>
						  <li class="breadcrumb-item active">Add Webinar Schedule</li>
						</ol>
						
					  </div>
					</div>
					<div class="row mb-2">
					  <div class="col-sm-12">
						<h4 style="text-align:center;"><b>Add Webinar Schedule</b></h4>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->

				</section>
				<section>
				<h4 style="color:green"><?= $message; ?></h4>
				<h4 style="color:red"><?= $error_message; ?></h4>
				<div class="card p-3">
				<div class="container"><?php //print_r($_SESSION);?>
					<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
							
						<div class="box-body">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
									  <label for="">Topic</label>
									  <input type="text" name="webinar_title" id="webinar_title"  id="webinar_title" class="form-control"placeholder="Webinar Title" style="width:50% !important">
									</div>
								</div>
								<div class="col-md-12">
										<div class="form-group">
									  <label for="">Description</label>
									  <input type="text" name="webinar_description" id="webinar_description" class="form-control" placeholder="Webinar Description" style="width:50% !important">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
									  <label for="">When</label>
									  <div class="row">
									      <div class="col-md-3"><input type="date" name="schedule_date" id="schedule_date" onkeydown="return event.keyCode != 69" class="form-control" ></div>
									      <div class="col-md-3">
									          <input type="time" name="schedule_time" id="schedule_time" onkeydown="return event.keyCode != 69" class="form-control" >
									          <input type="hidden" name="scheduletime" id="scheduletime" class="form-control" >
									          <input type="text" name="user_id" id="user_id" class="form-control" value="<?= $_SESSION['user_id'];?>" >
									       </div>
									  </div>
									</div>
								</div>
							 
								<div class="col-md-12">
									<div class="form-group">
									  <div class="row">
									      <div class="col-md-3">
									          <label for="">Duration (Hrs)</label>
									          <select class="form-control" name="duration_hrs" id="duration_hrs">
									              <option value=""> Select Hrs </option>
									              <?php 
									                for($i=0; $i < 24 ; $i++){
									                    if($i <10){
									                       $i = '0'.$i; 
									                    }
									              ?>
									                <option value="<?= $i ?>"><?= $i ?></option>
									              <?php
									                }
									              ?>
								                </select>
									      </div>
									      <div class="col-md-3">
									        <label for="">(Min)</label>
									        <select class="form-control" name="duration_min" id="duration_min">
									            <option value=""> Select Min </option>
									             <?php 
									                for($ii=0; $ii <= 60; $ii++){
									                    if($ii <10){
									                       $ii = '0'.$ii; 
									                    }
									              ?>
									                <option value="<?= $ii ?>"><?= $ii ?></option>
									              <?php
									                }
									              ?>
									          	    </select>
									      </div>
									     
									  </div>
									 </div>
								</div>
								</div>
								<div class="row">
								    <div class="col-md-6">
								        <div class="form-group">
									  <label for="">Meeting ID</label>
									   <input type="text" name="meeting_id" id="meeting_id" class="form-control" value="<?php echo rand(111111,999999);?>" style="width:50% !important">
									</div>
								    </div>
								</div>
									<div class="row">
								    <div class="col-md-6">
								        <div class="form-group">
									  <label for="">Meeting Password</label>
									    <input type="text" name="meeting_pass" id="meeting_pass" class="form-control" value="<?php echo rand(111111,999999);?>" style="width:50% !important">
									</div>
								    </div>
								</div>
									 <div class="box-footer text-center">
									<input type="submit" name="submit" class="btn btn-primary" onclick="return validate()" value="Save">
									<input type="submit" name="submit" class="btn btn-outline-danger" value="cancel" style="margin-left:5%">
								  </div>
									
								  </div>
								  <!-- /.box-body -->

								 
					 </form>
					 
					 
				</div>
				</div>
				</section>
			</div>
</div>

<div class="modal fade" id="schecularModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Webinar Schedule Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
          <div class="row" id="webinarmsg" >
                <div class="form-group col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <strong > Title </strong>
                        </div>
                        <div class="col-md-8">
                            : <?= $webinar_title ?>
                        </div> 
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <strong > URL </strong>
                        </div>
                        <div class="col-md-8">
                            : <a href="https://eximbin.com/videoconference/" target="_blank" > https://eximbin.com/videoconference/</a>
                        </div>
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <strong > Meeting ID </strong>
                        </div>
                        <div class="col-md-8">
                            : <?= $meeting_id ?>
                        </div>
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <strong > Password </strong>
                        </div>
                        <div class="col-md-8">
                            : <?= $meeting_pass ?>
                        </div>
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <strong > Start Date & Time </strong>
                        </div>
                        <div class="col-md-8">
                            : <?= $webinar_datetime ?>
                        </div> 
                    </div>
                </div>                

                <input type="hidden" id="spantxt_meeting_id" value="<?= $meeting_id ?>"  >
                <input type="hidden" id="spantxt_meeting_pass" value="<?= $meeting_pass ?>"  >
                <input type="hidden" id="spantxt_scheduletime" value="<?= $webinar_datetime ?>" >
          </div>
      
      </div>
      <div class="modal-footer">
          <span class="text-success" id="copiedtext"> </span> 
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="CopyToClipboard('webinarmsg')" id="copy" tooltip="Copy to clipboard">Copy to Clipboard</button>
        <span class="tooltiptext" ></span>
      </div>
    </div>
  </div>
</div>


<script>
 $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
 });
 
 
 function validate(){
   if($("#webinar_title").val() ==""){
      alert("Please enter webinar title"); 
       $("#webinar_title").focus();
      return false;
   } 

   if($("#webinar_description").val() ==""){
      alert("Please enter webinar description"); 
       $("#webinar_description").focus();
      return false;
   }  
   
    if($("#schedule_date").val() ==""){
      alert("Please select webinar date"); 
       $("#schedule_date").focus();
      return false;
   }    
   
    if($("#schedule_time").val() ==""){
      alert("Please select webinar time"); 
       $("#schedule_time").focus();
      return false;
    }else{
        $("#scheduletime").val($("#schedule_time").val());
    }
    
    if($("#duration_hrs").val() ==""){
      alert("Please select duration Hrs"); 
       $("#duration_hrs").focus();
      return false;
    }
    
    if($("#duration_min").val() ==""){
      alert("Please select duration Min"); 
       $("#duration_min").focus();
      return false;
    }
    
    
 }
 
    $(document).ready(function(){

      function alignModal(){
          var modalDialog = $(this).find(".modal-dialog");
          /* Applying the top margin on modal dialog to align it vertically center */
          modalDialog.css("margin-top", Math.max(0, ($(window).height() - modalDialog.height()) / 2));
      }
      // Align modal when it is displayed
      $(".modal").on("shown.bs.modal", alignModal);
      
      // Align modal when user resize the window
      $(window).on("resize", function(){
          $(".modal:visible").each(alignModal);
      }); 

    
        if($("#spantxt_meeting_id").val() !=""){
            $("#schecularModal").modal('show');
            $('#schecularModal').modal({backdrop: 'static', keyboard: false}) ; 
        }
    
    });
    

    function CopyToClipboard(containerid) {
      if (document.selection) {
        var range = document.body.createTextRange();
        range.moveToElementText(document.getElementById(containerid));
        range.select().createTextRange();
        document.execCommand("copy");
      } else if (window.getSelection) {
        var range = document.createRange();
        range.selectNode(document.getElementById(containerid));
        window.getSelection().addRange(range);
        document.execCommand("copy");
        $("#copiedtext").text("Text has been copied");
        //alert("Text has been copied")
      }
    }    
    
    
</script>
 </body>
 </html>