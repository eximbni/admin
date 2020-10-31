<?php
include("config.php");
$message='';

if(isset($_POST['activate'])){
    $adminuserid = $_POST['act_adminuserid'];
    
    $update_sql = "UPDATE messages SET status='1' WHERE id ='$adminuserid' ";
    $update_res = mysqli_query($conn,$update_sql);
	if($update_res){
		$message = "<h4 style='color:green'> Admin User Message Activated Successfully </h4>";
	}
	else{
		$message = "<h4 style='color:red'> Error activating admin user Message </h4>";
		echo mysqli_error($conn);
	}    
    
}

if(isset($_POST['delete'])){
    $adminuserid = $_POST['del_adminuserid'];
    
    $update_sql = "UPDATE messages SET status='0' WHERE id ='$adminuserid' ";
    $update_res = mysqli_query($conn,$update_sql);
	if($update_res){
		$message = "<h4 style='color:green'> Admin User Message Deleted Successfully </h4>";
	}
	else{
		$message = "<h4 style='color:red'> Error deleting admin user Message </h4>";
		echo mysqli_error($conn);
	}    
    
}

if(isset($_POST['submit'])){
    
	$subject = $_POST['subject'];
	$username=$_POST['username'];
	$desc= $_POST['description'];

	$sql_ins = "insert into messages (user_id,subject,description) values('$username','$subject','$desc')";  
	
	$res_ins = mysqli_query($conn,$sql_ins);
	if($res_ins){
		$message = "<h4 style='color:green'> Message Added Successfully </h4>";
	}
	else{
		$message = "<h4 style='color:red'> Error adding Message </h4>";
		echo mysqli_error($conn);
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
            <h1 class="m-0 text-dark">Send Admin Users Message </h1>
             <?= $message; ?>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item">Admin User </li>
              <li class="breadcrumb-item active">Send Admin Users Message</li>
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
									     <label> Select User</label>
									     <select class="form-control" id="username" name="username" required>
										    <option>Select User</option>
										    <?php 
										        $sql_user="select * from admin_users WHERE status='1'";
										        $res_user=mysqli_query($conn,$sql_user);
										        while($row_user=mysqli_fetch_array($res_user))
										        {
										    ?>
										        <option value="<?php echo $row_user['id'] ?>"><?php echo $row_user['name'] ?></option>
										    <?php } ?>
									      </select>
									</div>
									    
									<div class="col-6 form-group">
									     <label for="">Subject</label>
									     <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject Here" required>
									</div>
								</div>
								<div class="row">	
							        <div class="col-6 form-group">
									   <label for="exampleInputPassword1">Description </label>
									   <textarea placeholder="Description Here" rows="3" class="form-control" id="description" name="description" required></textarea>
								    </div>
								    <div class="col-5">
								        <label for=""> &nbsp;</label>
								    </div>
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
                <div class="card-body"> 
                        <div class="table-responsive">
            				<table id="example1" class="table table-bordered table-striped">
        						<thead>
        						<tr>
        						  <th>Sr.No</th>
        						  <th>Admin User</th>
        						  <th>Subject</th>
        						  <th>Description</th>
        						  <th>Status</td>
        						  <th>Action</th>
        						</tr>
        						</thead>
        						<tbody>
        						<?php
        						$sql_chk = "SELECT messages.*,admin_users.name FROM messages, admin_users WHERE admin_users.id = messages.user_id ORDER BY messages.id DESC";
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
        							  <td align="left"><?= $rows1['subject']; ?></td>
        							  <td align="left"><?= $rows1['description']; ?></td>
        							  <td align="center"><?= $status; ?></td>
        							  <td>
        							    <a class="btn btn-warning  btn-sm" href="edit_message.php?id=<?php echo $rows1['id']; ?>">Edit</a>
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
 