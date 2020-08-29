<?php
	include("config.php");
$msg ='';
$meeting_id ='';
$meeting_pass = '';
$webinar_title = '';
$webinar_datetime = '';
$message='';
$error_message='';

if(isset($_POST['submit'])){

$uploaddir = '../api/uploads/';
   $randkey = rand(0000,9999);
     $gateway_img_path = $_POST["gateway_country"]."_".$randkey."_".$_FILES['profileimg']['name'];

    if ($_FILES["profileimg"]["size"] > 25000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    $uploadfile = $uploaddir.$gateway_img_path;
    /* Upload file */
    if (move_uploaded_file($_FILES['profileimg']['tmp_name'], $uploadfile)) {
        //move_uploaded_file($_FILES['bannerimg']['tmp_name'],$uploadfile);
 

    	$gateway_name = $_POST['gateway_name'];
    	$gateway_page_path = $_POST['gateway_page_path'];
    	$gateway_country = $_POST['gateway_country'];
    	$gateway_folder = $_POST['gateway_folder'];	 
    	$created = date("Y-m-d H:i:s"); 
    	$created_by = $_POST['user_id'];
    	
    	$sql = "INSERT INTO `payment_gateway`(`gateway_name`, `gateway_country`,`gateway_folder`, `gateway_page_path`,`created`,`created_by`,`img_path`) values('$gateway_name','$gateway_country','$gateway_folder','$gateway_page_path','$created','$created_by','$gateway_img_path')";
    	$res = mysqli_query($conn,$sql);
    	if($res){
    		$message = "Payment Gateway Added Successfully";
    	}
    	else{
    		$error_message = "Failed To Add Payment Gateway. ". mysqli_error($conn);
    	}
	
    }else{
        	$error_message = "Failed To Upload Payment Gateway Logo. ". mysqli_error($conn);
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
						  <li class="breadcrumb-item active">Add Payment Gateway</li>
						</ol>
						
					  </div>
					</div>
				  </div><!-- /.container-fluid -->

				</section>
				<section class="content">
				<h4 style="color:green"><?= $message; ?></h4>
				<h4 style="color:red"><?= $error_message; ?></h4>
				<div class="card">
				 
    				<div class="card-header">
    				    <h4 > Add Payment Gateway Detail </h4>
    				</div>				
					<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
							
						<div class="card-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									  <label for="">Payment Gateway Name* </label> <span class="text-danger" id="gateway_name_error"> </span>
									  <input type="text" name="gateway_name" id="gateway_name" class="form-control"placeholder="Payment Gateway Name" required>
									  <input type="hidden" name="user_id" id="user_id" class="form-control" value="<?= $_SESSION['user_id'];?>" >
									</div>
								</div>
								<div class="col-md-6">
										<div class="form-group">
									  <label for="">Select Payment Gateway Country* </label> <span class="text-danger" id="gateway_country_error"> </span>
									  <select name="gateway_country" id="gateway_country" class="form-control" required>
									      <option value="0"> Select Country </option>
            							<?php
            							    $sql_countries ="SELECT country_id, name FROM `countries` order by name";
            							    $query_countries = mysqli_query($conn, $sql_countries);
            							    while($res_countries = mysqli_fetch_array($query_countries)){
            							?>
            							    <option value="<?= $res_countries['country_id']?>">	<?= $res_countries['name']?></option>
            							<?php
            							    }
            							?>
									   </select>
									</div>
								</div>
							</div>
							
							<div class="row">
								    <div class="col-md-6">
								        <div class="form-group">
									        <label for="">Payment Gateway Folder Name* </label><span class="text-danger" id="gateway_folder_error"> </span>
									        <input type="text" name="gateway_folder" id="gateway_folder" class="form-control" value="" placeholder="Payment Gateway Folder Name" required>
									    </div>
								    </div>

								    <div class="col-md-6">
								        <div class="form-group">
									        <label for="">Gateway Page Path* </label> <span class="text-danger" id="gateway_page_path_error"> </span>
									        <input type="text" name="gateway_page_path" id="gateway_page_path" class="form-control" value="" placeholder="Payment Gateway Page Path" required>
									    </div>
								    </div>
							</div>
							
							<div class="row">
							    <div class="col-md-6">
								        <div class="form-group">
									        <label for="">Gateway Logo* </label> <span class="text-danger" id="profileimg_error"> </span><br>
									        <input type="file" name="profileimg" id="profileimg" accept="image/gif,image/jpeg,image/jpg,image/png" required >
									    </div>							        
							    </div>
							    
						        <div class="col-md-3">
								        <div class="form-group">
									        <label for=""> &nbsp; </label><br>
									        <button type="button" name="submit" align="left" class="btn btn-outline-danger"> Cancel </button>
									    </div>							        
							    </div>							    
						        <div class="col-md-3">
								        <div class="form-group" align="right" >
									        <label for=""> &nbsp; </label><br>
									        <button type="submit" name="submit" class="btn btn-success" onclick="return validate()"> Submit </button>
									    </div>							        
							    </div>								    
                            </div>
						
						</div>		 
					</form>
					 
					 
				
				</div>
				</section>
				
<section class="content">
    
				 <div class="card">
				<div class="card-header">
				    <h4 > Payment Gateway Detail </h4>
				</div>
           
			   <div class="card-body">
					  <table id="example1" class="table table-bordered table-striped">
						<thead >
						<tr>
						  <th>Sr.No</th>
						  <th>Gateway Name</th>
						  <th>Gateway Country</th>
						  <th>Gateway Folder Name</th>
						  <th>Gateway Page Path</th>
						  <th width="165px" align="center">Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$todaysdate = date("Y-m-d");
						$i=1;
						$sql_expo = "select * from payment_gateway ORDER BY id";
						$res_expo = mysqli_query($conn,$sql_expo);
						while($row_expo = mysqli_fetch_array($res_expo))
						{
						    $status = $row_expo['status'];
						    $id = $row_expo['id'];
						?>
					   <tr>
						    <td><?php echo $i; ?></td>
						    <td><?php echo $row_expo['gateway_name']; ?></td>
						    <td><?php echo $row_expo['gateway_country']; ?></td>
						    <td><?php echo $row_expo['gateway_folder']; ?></td>
						    <td><?php echo $row_expo['gateway_page_path']; ?> </td>
						    <td>
								<input type="hidden" id="gname<?= $id;?>" value="<?= $row_expo['gateway_name'];?>" >
								<input type="hidden" id="gcountry<?= $id;?>" value="<?= $row_expo['gateway_country'];?>" >
								<input type="hidden" id="gfolder<?= $id;?>" value="<?= $row_expo['gateway_folder'];?>" >
								<input type="hidden" id="gpagepath<?= $id;?>" value="<?= $row_expo['gateway_page_path'];?>" >
								<button type="button" onclick="showmodal(<?= $id;?>,<?= $status;?>)" class="btn btn-outline-info ">Edit</button>						        
						        <?php  if($status==0) {?>
								<button type="button" onclick="updatestatus(<?= $id;?>,<?= $status;?>)" class="btn btn-outline-success">Activate</button> 
								<?php }else{ ?>
							   	<button type="button" onclick="updatestatus(<?= $id;?>,<?= $status;?>)" class="btn btn-outline-danger">Delete</button>
								<?php } ?>								
						    </td>		
						</tr>
						<?php $i++; } ?>
						</tbody>
					  </table>
					</div>
				 
			</div>
			</section>				
<div class="modal fade" id="schecularModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Payment Gateway Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
          <div class="row" id="webinarmsg" >
                <div class="form-group col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <strong > Gateway Name </strong> <span class="text-danger" id="gname_error"> </span>
                            : <input type="text" class="form-control" name="gname" id="gname" >
                            <input type="hidden" class="form-control" name="paymentgatewayid" id="paymentgatewayid" >
                        </div> 
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <strong > Gateway Country </strong> <span class="text-danger" id="gcountry_error"> </span>
                            <input type="hidden" class="form-control" name="gcountrycode" id="gcountrycode" >
                            : <select class="form-control" name="gcountry" id="gcountry">
                                <option value="" > Select Country</option>
            							<?php
            							    $sql_countries1 ="SELECT country_id, name FROM `countries` order by name";
            							    $query_countries1 = mysqli_query($conn, $sql_countries1);
            							    while($res_countries1 = mysqli_fetch_array($query_countries1)){
            							?>
            							    <option value="<?= $res_countries1['country_id']?>">	<?= $res_countries1['name']?></option>
            							<?php
            							    }
            							?>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <strong > Gateway Folder </strong> <span class="text-danger" id="gfolder_error"> </span>
                            <input type="text" class="form-control" name="gfolder" id="gfolder" >
                        </div>
                    </div>
                </div>
                
                <div class="form-group col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <strong > Gateway Page Path </strong> <span class="text-danger" id="gpagepath_error"> </span>
                            <input type="text" class="form-control" name="gpagepath" id="gpagepath" >
                        </div>
                    </div>
                </div>
                

          </div>
      
      </div>
      <div class="modal-footer">
          <span class="text-success" id="copiedtext"> </span> 
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" onclick="updatevalidate()" id="copy" > Update</button>
        <span class="tooltiptext" ></span>
      </div>
    </div>
  </div>
</div>
			
			</div>
</div>
<!-- DataTables -->

<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script> 

<script>
 $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
 });
 
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
  
 function validate(){
     
    if($("#gateway_name").val() ==""){
        $("#gateway_name_error").text("Please Enter Payment Gateway Name");
       $("#gateway_name").focus();
      return false;
    }else{
        $("#gateway_name_error").text("");
    } 

    if($("#gateway_country").val() =="0"){
        $("#gateway_country_error").text("Please Select Payment Gateway Country");
        $("#gateway_country").focus();
        return false;
    }else{
        $("#gateway_country_error").text("");
    }  
   

    if($("#gateway_folder").val() ==""){
        $("#gateway_folder_error").text("Enter Payment Gateway Folder Name");
        $("#gateway_folder").focus();
      return false;
    }else{
        $("#gateway_folder_error").text("");
    }
    
    if($("#gateway_page_path").val() ==""){
        $("#gateway_page_path_error").text("Please Enter Payment Gateway Page Path");
        $("#gateway_page_path").focus();
      return false;
    }else{
        $("#gateway_page_path_error").text("");
    }

    if($("#profileimg").val() ==""){
        $("#profileimg_error").text("Please Select Payment Gateway Logo");
        $("#profileimg").focus();
      return false;
    }else{
        $("#profileimg_error").text("");
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

    
    });
    
    function updatestatus(id, upstatus){
       
        $.post("ajax_upaymentgatestatus.php", {id: id,upstatus:upstatus}, function(resultdata){
            console.log("response data : ",resultdata);
            if(resultdata == 1 && upstatus == 0){
               alert("Payment gateway details activated successfully");
               location.reload();
            }else if(resultdata == 1 && upstatus == 1){
               alert("Payment gateway details deleted successfully");
               location.reload();
            }else{
               alert("Something went wrong"); 
               return false;
            }
        });
        
    }

    function showmodal(ids){
        $("#gname").val($("#gname"+ids).val());  
        $("#gfolder").val($("#gfolder"+ids).val()); 
        $("#gpagepath").val($("#gpagepath"+ids).val()); 
        $("#gcountrycode").val($("#gcountry"+ids).val()); 
        $("#paymentgatewayid").val(ids); 
         
        $("#schecularModal").modal('show');
        $('#schecularModal').modal({backdrop: 'static', keyboard: false}) ;     
    }
 
  function updatevalidate(){
     
    if($("#gname").val() ==""){
        $("#gname_error").text("Please Enter Payment Gateway Name");
       $("#gname").focus();
      return false;
    }else{
        $("#gname_error").text("");
    } 

    if($("#gcountrycode").val() ==""){
        
        if($("#gcountry").val() ==""){
            $("#gcountry_error").text("Please Select Payment Gateway Country");
            $("#gcountry").focus();
            return false;
        }       

    }else{
        $("#gcountry_error").text("");
    }  
   
    if($("#gfolder").val() ==""){
        $("#gfolder_error").text("Please Enter Payment Gateway Folder Name");
        $("#gfolder").focus();
        return false;
    }else{
        $("#gfolder_error").text("");
    }
    
    if($("#gpagepath").val() ==""){
        $("#gpagepath_error").text("Please Enter Payment Gateway Page Path");
        $("#gpagepath").focus();
        return false;
    }else{
        $("#gpagepath_error").text("");
    }
   
   var paygatwayid = $("#paymentgatewayid").val();
   var gname = $("#gname").val();
   var gcountrycode = $("#gcountry").val();
   if(gcountrycode ==""){
      var countryid = $("#gcountrycode").val(); 
   }else{
      var countryid = $("#gcountry").val();   
   }
   var gfolder = $("#gfolder").val();   
   var gpagepath = $("#gpagepath").val();   
   
         $.post("ajax_upaymentgate.php", {id: paygatwayid,gname:gname,gfolder:gfolder, gpagepath: gpagepath, countryid:countryid}, function(updatedata){
            console.log("response data : ",updatedata);
            if(updatedata == 1 ){
               alert("Payment gateway details updated successfully");
               location.reload();
            }else{
               alert("Something went wrong"); 
               return false;
            }
        });  
   
    
 }
 
    
</script>
 </body>
 </html>