<?php
include("config.php");
$message='';

if(isset($_POST['activate'])){
    $adminuserid = $_POST['act_adminuserid'];
    
    $update_sql = "UPDATE admin_users SET status='1' WHERE id ='$adminuserid' ";
    $update_res = mysqli_query($conn,$update_sql);
	if($update_res){
		$message = "<h4 style='color:green'> Admin User Activated Successfully </h4>";
	}
	else{
		$message = "<h4 style='color:red'> Error activating admin user </h4>";
		echo mysqli_error($conn);
	}    
    
}

if(isset($_POST['delete'])){
    $adminuserid = $_POST['del_adminuserid'];
    
    $update_sql = "UPDATE admin_users SET status='0' WHERE id ='$adminuserid' ";
    $update_res = mysqli_query($conn,$update_sql);
	if($update_res){
		$message = "<h4 style='color:green'> Admin User Deleted Successfully </h4>";
	}
	else{
		$message = "<h4 style='color:red'> Error deleting admin user </h4>";
		echo mysqli_error($conn);
	}    
    
}

if(isset($_POST['submit'])){
    
	$username=$_POST['username'];
	$mobile=$_POST['mobile'];
	$email=$_POST['email'];
	$password=md5($_POST['password']);
    $role = $_POST['role'];
    $designation = $_POST['designation'];
	$join_date = $_POST['join_date'];
	$aleternate_number = $_POST['aleternate_number'];
	$checkbox1=$_POST['permission'];  
	$count = count($_POST['permission']);
	$selected1="";
	if($role=='3')
	{
	    $country_id=$_POST['country_id'];
	    $state_id=$_POST['state_id'];
	}
	else
    {
	    $country_id='0';
	    $state_id='0';
	}
	
	foreach($checkbox1 as $selected)  
	{  
		$selected1 .= $selected.",";  
	}
	$selected1 = rtrim($selected1, ",");
	$chk = "select * from admin_users where email='$email'";
	$chkres = mysqli_query($conn,$chk);
	if(mysqli_num_rows($chkres)>0){
		$message="User Already Exists";
	}
	else{
	$sql = "insert into admin_users(name,mobile,email,password,role,designation,joining,aleternate_number,permissions,country_id,state_id) values('$username','$mobile','$email','$password','$role','$designation','$join_date','$aleternate_number','$selected1','$country_id','$state_id')";
	//echo $sql;
	$res = mysqli_query($conn,$sql);
	if($res){
		$message = "<h4 style='color:green'> User Added Successfully </h4>";
	}
	else{
		$message = "<h4 style='color:red'> Error adding User </h4>";
		echo mysqli_error($conn);
	}
	}
}
require "header1.php";
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add New Admin User</h1>
            <?php echo $message; ?> 
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item">Admin User </li>
              <li class="breadcrumb-item active">Add New Admin User</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body"> 
                        <div class="  ">
            				<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
            				<input type="hidden" name="country_id" class="form-control" value="<?php echo $_SESSION['country']; ?>">
                            <div class="box-body">
                                <div class="row">
									<div class="col-6 form-group">
									  <label for="">Username </label>
									  <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
									</div>
									<div class="col-6 form-group">
									  <label for="">Mobile No </label>
									  <input type="number" class="form-control" id="" name="mobile" placeholder="Mobile No" required>
									</div>
									<div class="col-6 form-group">
									  <label for="">Email </label>
									  <input type="email" class="form-control" id="" name="email" placeholder="Email" required>
									</div>
									<div class="col-6 form-group">
									  <label for="">Password </label>
									  <input type="password" class="form-control" name="password" id="" placeholder="******" required>
									</div>
									<div class="col-6 form-group">
									  <label>Role</label>
									  <select class="form-control" name="role" id="role" required onchange="checkrole();">
										<option>select</option>
									<?php include("config.php");
										$get = "select * from admin_user_roles";
										$res = mysqli_query($conn,$get);
										if($res){
											while($row=mysqli_fetch_assoc($res)){
										?>
											<option value="<?php echo $row['id'];?>"><?php echo $row['role_name'];?></option>
									<?php }} ?>	
										
									  </select>
									</div>
									<div class="col-6 form-group" id="country" style="display:none;">
									  <label for="">Country</label>
									  <select class="form-control" name="country_id" id="country_id" onchange="getState();" required>
											<option>Select</option>
											<?php 
                    						$get = "select * from countries";
                    						$res = mysqli_query($conn,$get);
                    						if ($res){
                    							while($row=mysqli_fetch_assoc($res)){
                    						?>
                    										<option value="<?php echo $row['country_id'];?>"><?php echo $row['name'];?></option>
                    						<?php }} ?>	
										  </select>
									</div>
									<div class="col-6 form-group" id="state" style="display:none;">
									  <label>Select State</label>
									  <select class="form-control" name="state_id" id="state_id">
										
									  </select>
									</div>
									<div class="col-6 form-group">
									  <label for="">User Designation</label>
									  <input type="text" class="form-control" id="" name="designation" placeholder="User Designation" required>
									</div>
									<div class="col-6 form-group">
									  <label for="">Joining Date</label>
									  <input type="date" class="form-control" id="" data-date-format="YYYY-MM-DD" name="join_date" placeholder="Join Date" required>
									</div>
									<div class="col-6 form-group">
									  <label for="">Alternate No </label>
									  <input type="number" class="form-control" id="" name="aleternate_number" placeholder="Alternate Number"required>
									</div>
									<div class="col-12 form-group">
										<label>Permissions</label>
										<br>
										<input type="checkbox" name="permission[]" value="franchise" unchecked> Franchise Module
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="checkbox" name="permission[]" value="ad_user" unchecked> Addmin User Module
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="checkbox" name="permission[]" value="leads" unchecked> Leads Module
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="checkbox" name="permission[]" value="package" unchecked> Packages Module&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="checkbox" name="permission[]" value="accounts" unchecked> Accounts Module&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="checkbox" name="permission[]" value="cms" unchecked> CMS Module&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="checkbox" name="permission[]" value="notification" unchecked> Notification Module<br/>
										<input type="checkbox" name="permission[]" value="banner" unchecked> Banner Module&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="checkbox" name="permission[]" value="schedular" unchecked> Schedular Module&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="checkbox" name="permission[]" value="system" unchecked> System Data&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									</div>
									<div class="col-11"> &nbsp; </div>
									 <div class="col-1">
    									<div class="form-group">
										    <label for=""> &nbsp;</label>
										    <div class="input-group">
										        <input type="submit" class="btn btn-primary btn-block" name="submit" value="Submit"> 
										    </div> 
										</div>
									</div>									
            					</div>
                            </div> 
                            </form>
                        </div>  
                </div>
                
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h5> Admin Users List</h5>
                </div>
                <div class="card-body"> 
                        <div class="table-responsive">
            				<table id="example1" class="table table-bordered table-striped">
        						<thead>
        						<tr>
        						  <th>Sr.No</th>
        						  <th>Name</th>
        						  <th>Mobile</th>
        						  <th>Email</th>
        						  <th>Designation</th>
        						  <th>Status</td>
        						  <th >Action</th>
        						</tr>
        						</thead>
        						<tbody>
        						<?php
        						$sql_chk = "SELECT * FROM `admin_users`";
        						//echo $sql_chk;
        						$query_chkres = mysqli_query($conn,$sql_chk);
        						if(mysqli_num_rows($query_chkres)>0){
        						$srno = 1;	
        							while($rows1 = mysqli_fetch_array($query_chkres)){
        							    if($rows1['status'] =='1'){
        							        $status ="Active";
        							    }else{
        							        $status= "Inactive";
        							    }
        						?>	
        						   	<tr>
        							  <td align="center"><?= $srno; ?></td>
        							  <td align="left"><?= $rows1['name']; ?></td>
        							  <td align="left"><?= $rows1['mobile']; ?></td>
        							  <td align="left"><?= $rows1['email']; ?></td>
        							  <td align="left"><?= $rows1['designation']; ?></td>
        							  <td align="center"><?= $status; ?></td>
        							  <td>
        							        <a class="btn btn-warning btn-sm" href="edit_user.php?id=<?php echo $rows1['id']; ?>">Edit</a> &nbsp;
        							    <?php
        							       if($rows1['status'] =='1'){
        							    ?>
        							        <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
        							            <input type="hidden" id="del_adminuserid"  name ="del_adminuserid" value="<?= $rows1['id']; ?>" >
        							            <input type="submit" class="btn btn-danger btn-sm"  name ="delete" value="Del" >
        							        </form>        							    
        							    <?php
        							    }else{
        							    ?>
        							        <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
        							            <input type="hidden" id="act_adminuserid"  name ="act_adminuserid" value="<?= $rows1['id']; ?>" >
        							            <input type="submit" class="btn btn-success btn-sm"  name ="activate" value="Activate" >
        							        </form>         							    
        							    <?php
        							    }
        							    ?> 
        							   </td>
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
               
            </div>
        </div>
    </section>    
    </div>
    
<?php
    require "footer1.php";
?> 
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

 <script>
 function getState()
 {
	var country_id = $("#country_id").val();
	//alert(country_id);
	$.ajax({
		type:"POST",
		url:"get_state.php",
		data:{
			id:country_id
		},
		dataType:'json',
		success:function(response)
		{
			//alert(response);
			$("#state_id").empty;
			$("#state_id").append(response);
		},
		error:function(error)
		{
			alert(error);
		},
	});
 }
 
 function checkrole()
 {
     var role = $("#role").val();
     if(role==3)
     {
         document.getElementById('country').style.display = "block";
         document.getElementById('state').style.display = "block";
     }
     else
     {
         document.getElementById('country').style.display = "none";
         document.getElementById('state').style.display = "none";
     }
 }
 </script> 