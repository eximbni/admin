<?php 
$message='';
	include("config.php");
	
	require '../PHPMailer/src/Exception.php';
	require '../PHPMailer/src/PHPMailer.php';
	//require 'PHPMailer/src/PHPMailerAutoload.php';
	require '../PHPMailer/src/SMTP.php';
	
	if(isset($_POST['approve']))
	{
		$id = $_POST['approve_id'];
		$app_budget = $_POST['app_budget'];
		$amount = $_POST['amount'];
		$coupons = $_POST['coupons'];
		$expiry_date = $_POST['expiry_date'];
		
		$sql_accept = "update event_request set status='1', approved_budget='$app_budget' where id='$id'";
		$res_accept = mysqli_query($conn,$sql_accept);
		if($res_accept)
		{
        	$message="<div class='alert alert-success'>Event Request Approved</div>";
	        //echo "Event Request Approved";
		}
		else
		{
			$message="<div class='alert alert-danger'>Failed to approve event request </div>";
			//echo "Failed to approve event request";
			//echo mysqli_error($conn);
		}
	}
	
	if(isset($_POST['reject']))
	{
		$id = $_POST['reject_id'];
		$sql_reject = "update event_request set status='2' where id='$id'";
		$res_reject = mysqli_query($conn,$sql_reject);
		if($res_reject)
		{
			//echo "Event Request rejected";
			$message="<div class='alert alert-success'>Event Request rejected</div>";
		}
		else
		{
			$message="<div class='alert alert-danger'>Failed to reject Event Request </div>";
			//echo "Failed to reject Event Request";
			//echo mysqli_error($conn);
		}
	}
?>  
  <style>
  .di{ margin-right:38px;padding:6px;text-align:center;}
  </style>

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
						  <li class="breadcrumb-item"><a href="">Franchise Module</a></li>
						  <li class="breadcrumb-item active">Event Request</li>
						</ol>
						<?php echo $message; ?>
					  </div>
					</div>
					<div class="row mb-2">
					  <div class="col-sm-12">
						<h4 style="text-align:center;"><b>Event Request</b></h4>
					  </div>
					</div><!-- /.container-fluid -->
				</section>
				<section>
				<div class="row p-2">
					<div class="col-md-2 di" id="p">Pending
					</div>
					<div id="a" class="col-md-2 di ">Approved
					</div>
					<div class="col-md-2 di" id="r">Rejected
					</div>
				</div>
				 
  
				</section>
			<section class="content" id="pending">
    
				  <div class="card">
				
           
			   <div class="card-body">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
						  <th>ID</th>
						  <th>Franchise Name</th>
						  <th>Event Name</th>
						  <th>Guest</th>
						  <th>Date</th>
						  <th>Budget</th>
						  <th>Venue</th>
						  <th>Partcipents</th>
						  <th>Conversions</th>
						  <th>Action</th>
						  <th>Action</th>
						</tr>
						</thead>
						<tbody>
							<?php
								$srno = 1;
								include("config.php");
								//$sql_franch = "SELECT er.*,fr.name FROM event_request er, franchise_users fr where er.franchise_id=fr.id and er.status='0'";
								$sql_franch = "SELECT er.*, fr.name FROM event_request er, franchise_users fr where er.franchise_id = fr.id and er.status='0'";
								$res_franch = mysqli_query($conn,$sql_franch);
								while($row_franch=mysqli_fetch_array($res_franch))
								{
								?>
								<tr>
								  <td><?php echo $srno; ?></td>
								  <td><?php echo $row_franch['name']; ?></td>
								  <td><?php echo $row_franch['event_name']; ?></td>
								  <td><?php echo $row_franch['guest']; ?></td>
								  <td><?php echo $row_franch['event_date']; ?></td>
								  <td><?php echo $row_franch['budget']; ?></td>
								  <td><?php echo $row_franch['venue']; ?></td>
								  <td><?php echo $row_franch['participents']; ?></td>
								  <td><?php echo $row_franch['conversions']; ?></td>
								  <td><button type="button" data-toggle="modal" data-target="#exampleModal" id="<?php echo $row_franch['id']; ?>btn" onclick="approve(<?php echo $row_franch['id']; ?>)" class="btn btn-outline-success bt">Apporve</button></td>
								  <td>
								      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
								          <input type="hidden" name="reject_id" id="reject_id" value="<?php echo $row_franch['id']; ?>" class="form-control">
								          <button type="submit" class="btn btn-outline-danger btt" name="reject">Reject</button> 
							          </form>
							      </td>
								</tr>
							<?php $srno++; } ?>
						  
						</tbody>
						
						
					  </table>
					</div>
				 
			</div>
			</section>
			<section class="content" id="approve">
    
				  <div class="card">
				
           
			   <div class="card-body">
					  <table id="example2" class="table table-bordered table-striped">
						<thead>
						<tr>
						  <th>ID</th>
						  <th>Franchise Name</th>
						  <th>Event Name</th>
						  <th>Guest</th>
						  <th>Date</th>
						  <th>Budget</th>
						  <th>Venue</th>
						  <th>Partcipents</th>
						  <th>Conversions</th>
						  <th>Approved Budget</th>
						</tr>
						</thead>
						<tbody>
							<?php
								$srno = 1;
								include("config.php");
								//$sql_franch = "SELECT er.*,fr.name FROM event_request er, franchise_users fr where er.franchise_id=fr.id and er.status='1'";
								$sql_franch = "SELECT er.*, fr.name FROM event_request er, franchise_users fr where er.franchise_id = fr.user_id and er.status='1'";
								$res_franch = mysqli_query($conn,$sql_franch);
								while($row_franch=mysqli_fetch_array($res_franch))
								{
								?>
								<tr>
								  <td><?php echo $srno; ?></td>
								  <td><?php echo $row_franch['name']; ?></td>
								  <td><?php echo $row_franch['event_name']; ?></td>
								  <td><?php echo $row_franch['guest']; ?></td>
								  <td><?php echo $row_franch['event_date']; ?></td>
								  <td><?php echo $row_franch['budget']; ?></td>
								  <td><?php echo $row_franch['venue']; ?></td>
								  <td><?php echo $row_franch['participents']; ?></td>
								  <td><?php echo $row_franch['conversions']; ?></td>
								  <td><?php echo $row_franch['approved_budget'] ?></td>
								</tr>
							<?php $srno++; } ?>
						  
						</tbody>
						
						
					  </table>
					</div>
				 
			</div>
			</section>
			<section class="content" id="rejected">
    
				  <div class="card">
				
           
			   <div class="card-body">
					  <table id="example3" class="table table-bordered table-striped">
						<thead>
						<tr>
						  <th>ID</th>
						  <th>Franchise Name</th>
						  <th>Event Name</th>
						  <th>Guest</th>
						  <th>Date</th>
						  <th>Budget</th>
						  <th>Venue</th>
						  <th>Partcipents</th>
						  <th>Conversions</th>
						</tr>
						</thead>
						<tbody>
							<?php
								$srno = 1;
								include("config.php");
								//$sql_franch = "SELECT er.*,fr.name FROM event_request er, franchise_users fr where er.franchise_id=fr.id and er.status='2'";
								$sql_franch = "SELECT er.*, fr.name FROM event_request er, franchise_users fr where er.franchise_id = fr.user_id and er.status='2'";
								$res_franch = mysqli_query($conn,$sql_franch);
								while($row_franch=mysqli_fetch_array($res_franch))
								{
								?>
								<tr>
								  <td><?php echo $srno; ?></td>
								  <td><?php echo $row_franch['name']; ?></td>
								  <td><?php echo $row_franch['event_name']; ?></td>
								  <td><?php echo $row_franch['guest']; ?></td>
								  <td><?php echo $row_franch['event_date']; ?></td>
								  <td><?php echo $row_franch['budget']; ?></td>
								  <td><?php echo $row_franch['venue']; ?></td>
								  <td><?php echo $row_franch['participents']; ?></td>
								  <td><?php echo $row_franch['conversions']; ?></td>
								</tr>
							<?php $srno++; } ?>
						  
						</tbody>
						
						
					  </table>
					</div>
				 
			</div>
			</section>
			</div>
			
		
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Approved Request</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<label>Approved Budget</label>
		<input type="number" name="app_budget" onkeydown="return event.keyCode !=69" class="form-control" placeholder="Enter Approved Budget" required>
		<input type="hidden" name="approve_id" id="approve_id" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <!--button type="button" class="btn btn-primary">Ok</button-->
		<?php if(isset($_POST['approve'])) { ?>
			<input type="submit" name="approve" class="btn btn-primary" value="Ok" disabled>
		<?php }else{?>
			<input type="submit" name="approve" class="btn btn-primary" value="Ok">
		<?php } ?>
		</form>
      </div>
    </div>
  </div>
</div>


<!--<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Reason</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <div class="modal-body">
		<input type="text"  class="form-control" placeholder="Enter Reason" name="reason" required  size="10">
		<input type="hidden" name="reject_id" id="reject_id" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Ok</button>
		<input type="submit" name="reject" class="btn btn-primary" value="Ok">
      </div>
	  </form>
    </div>
  </div>
</div>-->

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
    $("#example1").DataTable({
	  "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
	});
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
    });
	 $('#example3').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
    });
	$('#example4').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
    });
  });
</script>
<script>
$(document).ready(function(){
	 
	  $("#approve").hide();
	  $("#rejected").hide();
	  $("#additional").hide();
	  $("#p").css("background", "white");
  $("#p").click(function(){
    $("#pending").show();
	$("#p").css("background", "white");
	$("#a").css("background", "none");
	$("#r").css("background", "none");
	$("#add").css("background", "none");
	$("#approve").hide();
	  $("#rejected").hide();
	  $("#additional").hide();
  });
  $("#a").click(function(){
    $("#approve").show();
	
		$("#p").css("background", "none");
		$("#r").css("background", "none");
		$("#a").css("background", "white");
		$("#add").css("background", "none");
	$("#pending").hide();
	 $("#additional").hide();
	  $("#rejected").hide();
  });
  $("#r").click(function(){
    $("#rejected").show();
	
		$("#r").css("background", "white");
		$("#p").css("background", "none");
		$("#a").css("background", "none");
		$("#add").css("background", "none");
		
	$("#pending").hide();
	  $("#approve").hide();
	  $("#additional").hide();
  });
  $("#add").click(function(){
    $("#additional").show();
	
		$("#add").css("background", "white");
		$("#r").css("background", "none");
		$("#p").css("background", "none");
		$("#a").css("background", "none");
		
	$("#pending").hide();
	  $("#approve").hide();
	  $("#rejected").hide();
  });
});
</script>
<script>
function approve(clicked_id)
{
	//alert(clicked_id);
	document.getElementById("approve_id").value=clicked_id;
	document.getElementById("clicked_id"+btn).style.display = "none";
}
/*function reject(clicked_id)
{
	//alert(clicked_id);
	document.getElementById("reject_id").value=clicked_id;
	document.getElementById("clicked_id").style.display = "none";
}*/
</script>
</body>
</html>
