<?php 
   session_start();
   include("config.php");
   $message ="";
   require "header1.php";
    if(isset($_POST['search'])){
    	$county_name = $_POST['county_id'];
    	$chapter_id = $_POST['chapter_id'];
    	$type_name = $_POST['type'];
    	$display_country = $_POST['country'];	
    	
    
    }else{
    	$county_name = '';
    	$planid = '';
    	$type_name = '';
    	$display_country = '';	
    } 
    
?>  
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">Posted Lead Report</h1>
               <h4 style="color:red"><?php echo $message; ?></h4>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item">Leads </li>
                  <li class="breadcrumb-item active">Posted Lead Report</li>
               </ol>
            </div>
            <!-- /.col -->
         </div>
         <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
   </div>

			<section class="content">
				<div class="card">
    				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    					<div class="card-body">
    					<div class="row">
    						<div class="col-3">
    						<label>Select Posted Country</label>
    						
    						<select class="form-control" name="county_id" id="county_id">
    							<option value=''>Select Country</option>
    							<?php
    							include("config.php");
    							$get_country = "SELECT * FROM `countries`";
    							$res_country = mysqli_query($conn,$get_country);
    							while($row_country=mysqli_fetch_array($res_country))
    							{
    							    if($county_name == $row_country['country_id']){
    							       echo "<option value=".$row_country['country_id']." selected>".$row_country['name']."</option>"; 
    							    }else{
    							       echo "<option value=".$row_country['country_id'].">".$row_country['name']."</option>"; 
    							    }
    								
    							}						
    							?>
    						</select> 
    						</div>					    
    					    
    					    
    						<div class="col-3">
    						<label>Select Type</label>
    						<select class="form-control" name="type" id="type">
    							<?php
    							if(isset($_POST['search']))
    							{
    								$lead_type=$_POST['type']; ?>
    								<option value="<?php echo $lead_type; ?>"><?php echo $lead_type; ?></option>
    							<?php } ?>
    							<option value="">Select Type</option>
    							<option value="Buy">Buy</option>
    							<option value="Sell">Sell</option>
    						</select>
    						</div>
    						<div class="col-3">
    						<label>Select Display Country</label>
    						
    						<select class="form-control" name="country" id="country">
    							<option value=''>Select Country</option>
    							<?php 
    							$get_country = "SELECT * FROM `countries`";
    							$res_country = mysqli_query($conn,$get_country);
    							while($row_country=mysqli_fetch_array($res_country))
    							{
    							    if($display_country == $row_country['country_id']){
    							       echo "<option value=".$row_country['country_id']." selected >".$row_country['name']."</option>";
    							    }else{
    							       echo "<option value=".$row_country['country_id'].">".$row_country['name']."</option>";
    							    }
    								
    							}						
    							?>
    						</select>
    						</div>
    						<div class="col-3">
    						<label>Select Chapter</label>
    						
    						<select class="form-control" name="chapter_id" id="chapter_id">
    							<option value=''>Select Chapters</option>
    							<?php
    							$get_chapters = "SELECT * FROM `chapters`";
    							$res_chapters = mysqli_query($conn,$get_chapters);
    							while($row_chapters=mysqli_fetch_array($res_chapters))
    							{
    							    
    							    if($chapter_id == $row_chapters['id']){
    							       	echo "<option value=".$row_chapters['id']." selected>".$row_chapters['chapter_name']."</option>";
    							    }else{
    							       	echo "<option value=".$row_chapters['id'].">".$row_chapters['chapter_name']."</option>";
    							    }							    
    							
    							}						
    							?>
    						</select>
    						</div>						
    						
    						<div class="col-4" style="margin-top:3%">
    							<button type="submit" class="btn btn-outline-primary" name="search">Search</button>
    						</div>
    				</form>
    					</div>
    					</div>
    				</form>
				</div>
            </section>	
			
			<section class="content">
                <div class="card">
                    <div class="card-body" style="overflow:scroll" >
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
						  <th>ID</th>
						  <th>Lead_ID</th>
						  <th>Username</th>
						  <th>Chapter</th>
						  <th>Category</th>
						  <th>HS Code</th>
						  <th>Uom</th>
						  <th>Quantity</th>
						  <th>Description</th>
						  <th>Posted_Date</th>
						  <th>Expiry_Date</th>
						  <th>Lead_Status</th>
						  <th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
							$sr =0;
							if(isset($_POST['search']))
							{
								include("config.php");
								$cont_id=$_POST['cont_id'];
								$reg_id=$_POST['reg_id'];
								$country_id=$_POST['county_id'];
								$lead_type=$_POST['type'];
								$country=$_POST['country'];
								$chapter_id = $_POST['chapter_id'];
								
								if($cont_id!='')
								{
								    $conti = "and c.continent='$cont_id'";
								}
								else
								{
								    $conti = "";
								}
								if($reg_id!='')
								{
								    $regi = "and c.continent_id='$reg_id'";
								}
								else
								{
								    $regi = "";
								}
								if($country_id!='')
								{
								    $count = "and c.country_id='$country_id'";
								}
								else
								{
								    $count = "";
								}
								if($lead_type!='')
								{
								    $ldtype = "and l.lead_type='$lead_type'";
								}
								else
								{
								    $ldtype = "";
								}
								if($country!='')
								{
								    $ldcount = "and ldc.country_id='$country'";
								}
								else
								{
								    $ldcount = "";
								}
								
								if($chapter_id!='')
								{
								    $lchapter_id = "and l.chapter_id='$chapter_id'";
								}
								else
								{
								    $lchapter_id = "";
								}
								
								$sql_leads = "select l.*,u.name from leads l, countries c, lead_display_countries ldc, users u where l.posted_by = u.id and l.status=1 and l.country_id = c.country_id and l.id=ldc.lead_id $lchapter_id $count $ldtype $ldcount GROUP BY l.id";
								$res_leads = mysqli_query($conn,$sql_leads);
								$row_count = mysqli_num_rows($res_leads);
								$id=1;
								if($row_count>0)
								{
								while($row_leads=mysqli_fetch_array($res_leads))
								{
									$lead_id = $row_leads['leadref_id'];
									$username = $row_leads['name'];
									
									$hsn_id = $row_leads['hsn_id'];
									$sql_hsn = "select * from hsncodes where id='$hsn_id'";
									$res_hsn = mysqli_query($conn,$sql_hsn);
									$rows_hsn = mysqli_fetch_array($res_hsn);
									$hsncode = $rows_hsn['hsncode'];
									
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
									
									$quantity = $row_leads['quantity'];
									$description = trim($row_leads['description']);
									$posted_date = $row_leads['posted_date'];
									$expiry_date = $row_leads['expiry_date'];
									$status = $row_leads['status'];
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
								?>
								<tr>
								    <td> <?= $sr; ?></td>
								    <td> <?= $lead_id; ?></td> 
								    <td> <?= $username; ?></td> 
								    <td> <?= $chapter_name; ?></td>  
								    <td> <?= $category_name; ?></td>
								    <td> <?= $hsn_id; ?></td>
								    <td> <?= $uom; ?></td>  
								    <td> <?= $quantity; ?></td>
								    <td> <?= $description; ?></td>  
								    <td> <?= $posted_date; ?></td> 
								    <td> <?= $expiry_date; ?></td>  
								    <td> <?= $status; ?></td> 
								    <td><a class="btn btn-info" href="lead_details.php?id=<?php echo $row_leads['id']; ?>">View</a></td>
								</tr>
								
								<?php
									$id++;
								}
								}
								else
								{
								?>
								<tr>
								    <td colspan='11' align='center'> No Leads For This Country </td>  
								   
								</tr>
								
								<?php 
								}
							}
							?>
						</tbody>
					  </table>
					</div>
				</div>
			</section>
			
</div>
<?php
   require "footer1.php"
   ?>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script> 
 
<script>
$('#cont_id').on('change', function() {
  var cont_id = $('#cont_id').val();
  //alert(cont_id);
  $.ajax({
		type:"post",
		url:"get_regions.php",
		data:{
			continent_id:cont_id
		},
		//dataType:'json',
		success:function(response)
		{
			//alert(response);
			$("#reg_id").empty();
			$("#reg_id").append(response);
		},
		error:function(error)
		{
			alert(error);
		},
	});
});
$('#reg_id').on('change', function() {
  var reg_id = $( "#reg_id option:selected" ).text();
  //alert(reg_id);
  $.ajax({
		type:"post",
		url:"getcountrybyregion.php",
		data:{
			region:reg_id
		},
		//dataType:'json',
		success:function(response)
		{
			//alert(response);
			$("#county_id").empty();
			$("#county_id").append(response);
		},
		error:function(error)
		{
			alert(error);
		},
	});
});
</script> 
