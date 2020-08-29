<?php 
include("config.php");
include "header.php";

$message ="";
if(isset($_POST['search'])){
	$countryid = $_POST['country_id'];
	$planid = $_POST['plan_id'];

}else{
	$countryid = '';
	$planid = '';
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
						  <li class="breadcrumb-item"><a href="">Admin User Module</a></li>
						  <li class="breadcrumb-item active">User List</li>
						</ol>
					  </div>
					</div>
					<div class="row mb-2">
					  <div class="col-sm-12">
						<h4 style="text-align:center;"><b>User List</b></h4>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->

				</section>
			
			<section class="content">
    
				  <div class="card">
				
           
			   <div class="card-body" style="overflow:scroll" >
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
						  <th>Sr.No</th>
						  <th>Username</th>
						  <th>Mobile No</th>
						  <th>Email</th>
						  <th>Role</th>
						  <th>Designation</th>
						  <th>Joining Date</th>
						  <th>Alternate Number</th>
						  <th>Permission</th>
						  <th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$sql_chk = "SELECT * FROM `admin_users`";
						//echo $sql_chk;
						$query_chkres = mysqli_query($conn,$sql_chk);
						if(mysqli_num_rows($query_chkres)>0){
						$srno = 1;	
							while($row = mysqli_fetch_array($query_chkres)){
						?>	
						   	<tr>
							  <td align="center"><?= $srno; ?></td>
							  <td align="left"><?= $row['name']; ?></td>
							  <td align="center"><?= $row['mobile']; ?></td>
							  <td align="center"><?= $row['email'];?></td>
							  <td align="left"><?= $row['role'];?></td>
							  <td align="left"><?= $row['designation'];?></td>
							  <td align="center"><?= $row['joining'];?></td>
							  <td align="center"><?= $row['aleternate_number'];?></td>
							  <td align="left"><?= $row['permissions'];?></td>
							  <td><a class="btn btn-warning" href="edit_user.php?id=<?php echo $row['id']; ?>">Edit</a></td>
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

/*
function get_projectdetail(countryid){
  //alert(countryid);
  $.ajax({
    type:"post",
    url : "ajaxGetPlanName.php",
    data : {countryid : countryid },
    success: function(plandata){
      // alert(plandata);
       $('#plan_id').html(plandata);
    }
  }); 

} 
*/

function get_plandetail(countryid){
  //alert(countryid);
  $.ajax({
    type:"post",
    url : "ajaxGetPlanName.php",
    data : {countryid : countryid},
    success: function(plandata){
      // alert(plandata);
       $('#plan_id').html(plandata);
    }
  }); 

} 

function checkValidation(){
	var country_id = $("#country_id").val();
	
	if(country_id ==''){
		alert("Please Select Country");
		$("#country_id").focus();
		return false;
	}

}	

</script>
</body>
</html>
