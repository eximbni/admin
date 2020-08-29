  

			<?php include "header.php"?>
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
						  <li class="breadcrumb-item"><a href="">Schedular Module</a></li>
						  <li class="breadcrumb-item active">Start & End Webinars</li>
						</ol>
						<?php echo $message; ?>
					  </div>
					</div>
					<div class="row mb-2">
					  <div class="col-sm-12">
						<h4 style="text-align:center;"><b>Start & End Webinars</b></h4>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->

				</section>
				
			<section class="content">
    
				  <div class="card">
				
           
			   <div class="card-body">
					  <table id="example1" class="table table-bordered table-striped">
						<thead >
						<tr>
						  <th>Sr.No</th>
						  <th>Date & Time</th>
						  <th>Title</th>
						  <th>Description</th>
						  <th>Meeting Id</th>
						  <th>Password</th>
						  <th width="165px" align="center">Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
						include("config.php");
						$todaysdate = date("Y-m-d");
						$i=1;
						$sql_expo = "select * from webinar WHERE webinar_date ='$todaysdate'";
						$res_expo = mysqli_query($conn,$sql_expo);
						while($row_expo = mysqli_fetch_array($res_expo))
						{
						    $status = $row_expo['status'];
						    $id = $row_expo['id'];
						?>
					   <tr>
						    <td><?php echo $i; ?></td>
						    <td><?php echo $row_expo['webinar_datetime']; ?></td>
						    <td><?php echo $row_expo['title']; ?></td>
						    <td><?php echo $row_expo['description']; ?></td>
						    <td><?php echo $row_expo['meeting_id']; ?> </td>
						    <td><?php echo $row_expo['meeting_pass']; ?></td>
						    <td>
								<input type="hidden" id="title<?= $id;?>" value="<?= $row_expo['title'];?>" >
								<input type="hidden" id="description<?= $id;?>" value="<?= $row_expo['description'];?>" >
								<input type="hidden" id="meeting_id<?= $id;?>" value="<?= $row_expo['meeting_id'];?>" >
								<input type="hidden" id="meeting_pass<?= $id;?>" value="<?= $row_expo['meeting_pass'];?>" >
								<input type="hidden" id="webinar_datetime<?= $id;?>" value="<?= $row_expo['webinar_datetime'];?>" >
								
								<button type="button" onclick="showmodal(<?= $id;?>,<?= $status;?>)" class="btn btn-outline-info ">Copy</button>						        
						        <?php  if($status==0) {?>
								<button type="button" onclick="updatestatus(<?= $id;?>,<?= $status;?>)" class="btn btn-outline-success">Start Meeting</button> 
								<?php }else{ ?>
							   	<button type="button" onclick="updatestatus(<?= $id;?>,<?= $status;?>)" class="btn btn-outline-danger">End Meeting</button>
								<?php } ?>

						    </td>		
						</tr>
						<?php $i++; } ?>
						</tbody>
					  </table>
					</div>
				 
			</div>
			</section>
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
                            : <span id="spantxt_title" > </span>
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
                            : <span id="spantxt_meeting_id" > </span>
                        </div>
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <strong > Password </strong>
                        </div>
                        <div class="col-md-8">
                            : <span id="spantxt_meeting_pass" > </span>
                        </div>
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <strong > Start Date & Time </strong>
                        </div>
                        <div class="col-md-8">
                            : <span id="spantxt_scheduletime" > </span>
                        </div> 
                    </div>
                </div>                

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
  
    function updatestatus(id, upstatus){
       
        $.post("ajax_updatewebinarstatus.php", {id: id,upstatus:upstatus}, function(resultdata){
            console.log("response data : ",resultdata);
            if(resultdata == 1 && upstatus == 0){
               alert("Webinar is started successfully");
               location.reload();
            }else if(resultdata == 1 && upstatus == 1){
               alert("Webinar is ended successfully");
               location.reload();
            }else{
               alert("Something went wrong"); 
               return false;
            }
        });
        
    }

    function showmodal(ids){
        $("#spantxt_title").text($("#title"+ids).val());  
        $("#spantxt_meeting_id").text($("#meeting_id"+ids).val()); 
        $("#spantxt_meeting_pass").text($("#meeting_pass"+ids).val()); 
        $("#spantxt_scheduletime").text($("#webinar_datetime"+ids).val()); 
        
        $("#schecularModal").modal('show');
        $('#schecularModal').modal({backdrop: 'static', keyboard: false}) ;     
    }

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
