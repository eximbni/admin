<?php 
include("config.php");
include "header.php";

$message ="";
if(isset($_GET['id'])){
	$lead_id = $_GET['id']; 

}else{
 
	$lead_id = '';
	
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
						  <li class="breadcrumb-item"><a href="#">Leads Module</a></li>
						  <li class="breadcrumb-item"><a href="all_lead_reports.php">Posted Lead Details </a></li>
						  <li class="breadcrumb-item active"> Lead Preview </li>
						</ol>
					  </div>
					</div>

				  </div><!-- /.container-fluid -->

				</section>
				
			<section class="content">
				<div class="card">
				    <div class="card-header">
				        <p style="text-align:center;"> <b>Lead Preview</b></p>
				    </div>
				    	<?php
  
   							    $sql_leads = "SELECT l.*,u.name FROM leads l, countries c, lead_display_countries ldc, users u WHERE l.posted_by = u.id  and l.country_id = c.country_id and l.id=ldc.lead_id AND l.id='$lead_id' GROUP BY l.id";
								$res_leads = mysqli_query($conn,$sql_leads);
								$row_count = mysqli_num_rows($res_leads);
								$id=1;
								if($row_count>0)
								{
								while($row_leads=mysqli_fetch_array($res_leads))
								{
								    $id = $row_leads['id'];
									$lead_id = $row_leads['leadref_id'];
									$username = $row_leads['name'];
									$posted_date = $row_leads['posted_date'];
									$lead_type = $row_leads['lead_type'];
									$lead_cost = $row_leads['lead_cost'];
									$quantity = $row_leads['quantity'];
									$description = trim($row_leads['description']);
									$posted_date = $row_leads['posted_date'];
									$expiry_date = $row_leads['expiry_date'];
									$status = $row_leads['status'];
									$price_option = $row_leads['price_option'];
									$price = $row_leads['price_inusd'];
									$currency = $row_leads['currency'];
									$special_instruc = $row_leads['special_instruc'];
									$port_type = $row_leads['port_type'];
									$loading_port = $row_leads['loading_port'];
									$destination_port = $row_leads['destination_port'];
									$inspection_auth = $row_leads['inspection_auth'];
									$remark = $row_leads['remark'];
									
									
									$country_id = $row_leads['country_id'];
									$hsn_id = $row_leads['hsn_id'];
									/*echo $hsn_table = "hsncodes_".$country_id; echo "<br>";
									echo $sql_hsn = "select * from $hsn_table where hscode='$hsn_id'";
									$res_hsn = mysqli_query($conn,$sql_hsn);
									$rows_hsn = mysqli_fetch_array($res_hsn);
									$hsncode = $rows_hsn['hscode'];*/
									
									$chapter_id = $row_leads['chapter_id'];
									$sql_chapter = "select * from chapters where id='$chapter_id'";
									$res_chapter = mysqli_query($conn,$sql_chapter);
									$rows_chapter = mysqli_fetch_array($res_chapter);
									$chapter_name = $rows_chapter['chapter_name'];
									
									$categories_id = $row_leads['categories_id'];
									$sql_categories = "select * from categories where id='$categories_id'";
									$res_categories = mysqli_query($conn,$sql_categories);
									$rows_categories = mysqli_fetch_array($res_categories);
									$category_name = $rows_categories['category_name'];
									
									$product_id = $row_leads['product_id'];
									$sql_products = "select * from products where id='$product_id'";
									$res_products = mysqli_query($conn,$sql_products);
									$rows_products = mysqli_fetch_array($res_products);
									$product_name = $rows_products['product'];
									
									$uom_id = $row_leads['uom_id'];
									$sql_uoms = "select * from uoms where id='$uom_id'";
									$res_uoms = mysqli_query($conn,$sql_uoms);
									$rows_uoms = mysqli_fetch_array($res_uoms);
									$uom = $rows_uoms['uom'];
									
									
									
				
									
									if($status==0)
									{
										$status="Pending";
									}
									elseif($status==1)
									{
										$status="Approved";
									}
									elseif($status==99)
									{
										$status="Rejected";
									}
									else
									{
										$status="Pending";
									}
									$sr++;
									
								}
								}
								
									
								?>
								
					<div class="card-body">
					    
    					<div class="row">
	   						<div class="col-4">
	   						    <label>Posted By</label> : <?= $username; ?>
    						</div>
    						<div class="col-4">
                                <label>Lead ID</label> : <?= $lead_id; ?>
    						</div>
    						<div class="col-4">
    						    <label>Lead Posted Date</label> : <?= $posted_date; ?>
    						</div>			
    					</div>	
					    
    					<div class="row">
	   						<div class="col-4">
    						    <label>Lead Type</label> : <?= $lead_type; ?>
    						</div>
    						<div class="col-4">
    						    <label>Lead Category</label> : <?= $category_name; ?>
    						</div>
    						<div class="col-4">
    						    <label>Lead Chapter</label> : <?= $chapter_name; ?>
    						</div>			
    					</div>	
					    
    					<div class="row">
	   						<div class="col-4">
    						    <label>Lead HSCode</label> : <?= $hsn_id; ?>
    						</div>
    						<div class="col-4">
    						    <label>Description</label> : <?= $description; ?>
    						</div>
    						<div class="col-4">
    						    <label>Price Model</label> : <?= $price_option; ?> 
    						</div>			
    					</div>	
    					
					    
    					<div class="row">
	   						<div class="col-4">
    						    <label>Selected Currency</label> : <?= $currency; ?> 
    						</div>
    						<div class="col-4">
    						    <label>Lead Price</label> : <?= $price; ?> 
    						</div>
    						<div class="col-4">
    						    <label>Lead Expiry Date</label> : <?= $expiry_date; ?>
    						</div>			
    					</div>	
    					
					    
    					<div class="row">
	   						<div class="col-4">
    						    <label>Units</label> : <?= $uom; ?>
    						</div>
    						<div class="col-4">
    						    <label>Quantity</label> : <?= $quantity; ?>
    						</div>
    						<div class="col-4">
    						    <label>Business Address </label> : <?= $lead_id; ?>
    						</div>
    					</div>	    					
    					<div class="row">
    						<div class="col-4">
    						    <label>Special Instruction</label> : <?= $special_instruc; ?>
    						</div>
    						<div class="col-4">
    						    <label>Port Type</label> : <?= $port_type; ?>
    						</div>
    						<div class="col-4">
    						    <label>Loading Port</label> : <?= $loading_port; ?>
    						</div>
    						<div class="col-4">
    						    <label>Destintion Port </label> : <?= $destination_port; ?>
    						</div>
    					</div>
    					<div class="row">
    						<div class="col-6">
    						    <label>International Quality Certification Agency</label> :  <?= $inspection_auth; ?> 
    						</div>
    						<div class="col-6">
    						    <label>Remarks/ Quality Assessment </label> : <?= $remark; ?>
    						</div>
    					</div>
    					<div class="row">
    					    <?php
    					        $i=1;
        					    $sql_doc = "SELECT * FROM `lead_documents` WHERE lead_id='$id'";
    							$res_doc = mysqli_query($conn,$sql_doc);
    							while($rows_doc = mysqli_fetch_assoc($res_doc))
    							{ ?>
    							    <div class="col-3">
            						    <label>Doc <?php echo $i; ?></label> : <a href="<?= $rows_doc['doc_path']; ?>" target="_blank"><?= $rows_doc['doc_name']; ?></a>
            						</div>
    						<?php $i++; } ?>
    						<!--div class="col-3">
    						    <label>Doc1</label> : <a href="<?= $doc1_path; ?>" target="_blank"><?= $doc1; ?></a>
    						</div>
    						<div class="col-3">
    						    <label>Doc2</label> : <a href="<?= $doc2_path; ?>" target="_blank"><?= $doc2; ?></a>
    						</div>
    						<div class="col-3">
    						    <label>Doc3</label> : <a href="<?= $doc3_path; ?>" target="_blank"><?= $doc3; ?></a>
    						</div>
    						<div class="col-3">
    						    <label>Doc4</label> : <a href="<?= $doc4_path; ?>" target="_blank"><?= $doc4; ?></a>
    						</-->
    					</div>

				    </div>
				    
				</div>
            </section>
            
            <section class="content">				
			    <div class="card">
				    <div class="card-header">
				        <p style="text-align:center;"> <b>Lead Display Countries</b></p>
				    </div>
           
			        <div class="card-body">
					  
					  <table id="example2" class="table table-bordered table-striped">
						<thead>
							<tr>
							  <th>Posted From Country</th>
							  <th>Posted To Countries</th>
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
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": false,
      "autoWidth": false,
    });
  });
</script>
 
</body>
</html>