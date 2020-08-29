<?php 
include("config.php");
include "header.php";

$message ="";
if(isset($_POST['search'])){
	$country_id = $_POST['country_id'];
	$lead_type = $_POST['lead_type'];

}else{
	$country_id = '';
	$lead_type = '';
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
						  <li class="breadcrumb-item"><a href="">System Data</a></li>
						  <li class="breadcrumb-item active">HSN Codes</li>
						</ol>
						<?php echo $message; ?>
					  </div>
					</div>
					<div class="row mb-2">
					  <div class="col-sm-12">
						<h4 style="text-align:center;"><b>HSN Codes</b></h4>
					  </div>
					</div>
				  </div><!-- /.container-fluid -->

				</section>
				
				
				<section class="content">

				<div class="card">
				<h4 ><?php echo $message ?></h4>	
				<div class="card-body">
				<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >		
				  <div class="box-body">
				  <div class="row">
						<div class="form-group">
						  <label>Select Country</label>
						  <select class="form-control" name="country_id" id="country_id">
							<option value=""> --Select Country-- </option>
							<?php
							echo $sql_countries ="SELECT country_id,name FROM `countries`";
							$query_countries = mysqli_query($conn, $sql_countries);
							while($res_countries = mysqli_fetch_array($query_countries)){
								if($countryid == $res_countries['country_id']){
									$status ="selected";
								}else{
									$status ="";
								}
							?>
							<option value="<?= $res_countries['country_id']?>" <?= $status;?>>	<?= $res_countries['name']?></option>
							<?php
							}
							?>
							</select>
						</div>
						<div class="form-group" style="margin: 3%;">
						    <button type="submit" name="search" id="search" class="btn btn-outline-primary">Search</button>
						</div>	
    				</div>
    					  <!-- /.box-body -->
    
    				  <div class="box-footer text-right mb-3" >
    					
    				  </div>
    		 </form>
    		 
    		 
    	</div>
    	</div>
    	</div>
    	</section>



			<section class="content">
    
				  <div class="card">
				
           
			   <div class="card-body">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
						  <th>ID</th>
						  <th>Category Name</th>
						  <th>Chapter Name</th>
						  <th>HSN Code</th>
						  <th>Description</th>
						 
						</tr>
						</thead>
						<tbody>
						    <?php
						    $i=1;
						    if($country_id <> ''){
                            	$table_name = 'hsncodes_'.$country_id;
                            	$get_hsn = "SELECT hs.hscode, hs.english as hsndescription, ca.category_name, ch.chapter_name FROM $table_name hs, categories ca, chapters ch where hs.chapter_id=ch.id and ch.category_id=ca.id";
                            	$res_hsn = mysqli_query($conn,$get_hsn);
                            	while($row_hsn=mysqli_fetch_assoc($res_hsn))
                            	{ ?>
                            	    <tr>
                            	        <td><?php echo $i; ?></td>
                            	        <td><?php echo $row_hsn['category_name']; ?></td>
                            	        <td><?php echo $row_hsn['chapter_name']; ?></td>
                            	        <td><?php echo $row_hsn['hscode']; ?></td>
                            	        <td><?php echo $row_hsn['hsndescription']; ?></td>
                            	   </tr>
                            <?php $i++;	}
						    }
						  ?>
						</tbody>

					  </table>
					</div>
				 
			</div>
			</section>


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
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
</body>
</html>