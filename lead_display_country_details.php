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
						  <li class="breadcrumb-item"><a href="">Lead Module</a></li>
						  <li class="breadcrumb-item active">Lead Details</li>
						</ol>
						<?php echo $message; ?>
					  </div>
					</div>
					<div class="row mb-2">
					  <div class="col-sm-12">
						<h4 style="text-align:center;"><b>Lead Details</b></h4>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->

				</section>

			<section class="content">				
			    <div class="card">
				
           
			        <div class="card-body">
					  
					  <table id="example2" class="table table-bordered table-striped">
						<thead>
							<tr>
							  <th>Ref ID</th>
							  <th>Posted Country</th>
							  <th>Posted For Country</th>
							</tr>
					</thead>
					<tbody>
					<?php 
				
					include("config.php");
					$lead_id = $_GET['id'];
					$sql_app = "select l.leadref_id,co.name as country from leads l, countries co where l.status='1' and l.id='$lead_id' and l.country_id=co.country_id";
					$res_app = mysqli_query($conn,$sql_app);
					$row_app = mysqli_fetch_array($res_app);
					?>
							<tr>
								<td><?php echo $row_app['leadref_id']?></td>
							    <td><?php echo $row_app['country']?></td>
								<td>
								    <?php
                                        $sql_country = "select l.lead_id,l.country_id,co.name as country_name from lead_display_countries l, countries co where l.lead_id='$lead_id' and l.country_id=co.country_id";
    								    $res_country = mysqli_query($conn,$sql_country);
    								    while($row_country = mysqli_fetch_array($res_country))
    								    {
    								        echo $row_country['country_name'];echo "<br>";
    								    }
								    ?>
								</td>
							</tr>
		
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
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
/* $('#country').on('change', function() {
  var country = $('#country').val();
  var type = $('#type').val();
  $.ajax({
		type:"post",
		url:"get_leads.php",
		data:{
			country:country,
			type:type
		},
		//dataType:'json',
		success:function(response)
		{
			//alert(response);
			$("#lead_report").empty();
			$("#lead_report").append(response);
		},
		error:function(error)
		{
			alert(error);
		},
	});
}); */
</script>
</body>
</html>
