<?php
include("config.php");
$message='';
if(isset($_POST['submit'])){
	$id         =   $_POST['id'];
 	$subject    =   $_POST['subject'];
	$username   =   $_POST['username'];
	$desc       =   $_POST['description'];
	
	$sql_insert = "update messages  set user_id='$username' , subject='$subject' , description ='$desc'  where id='$id'";
//echo $sql;
	$res_insert = mysqli_query($conn,$sql_insert);
	if($res_insert){
		$message = "<h4 style='color:green'> Admin User Message Update Successfully </h4>";
	}
	else{
		$message = "<h4 style='color:red'> Error updating Admin User Message </h4>";
		echo mysqli_error($conn);
	}
    //header("location: edit_message.php?id=".$id."");
	header("location: message.php");	
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
            <h1 class="m-0 text-dark">Update Admin User Message</h1>
            <?php echo $message; ?> 
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item">Admin User </li>
              <li class="breadcrumb-item active">Update Admin User Message</li>
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
								<?php
									$id = $_GET['id'];
									$sql_get = "select * from messages where id='$id' AND status='1'";
									$res_get = mysqli_query($conn,$sql_get);
									if($res_get){
									$row_roles_get = mysqli_fetch_assoc($res_get); 
								?>
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
										           if($row_user['id'] == $row_roles_get['user_id']){
										               $statustxt = 'selected';
										           }else{
										               $statustxt = '';
										           } 
										            
										            
										    ?>
										        <option value="<?php echo $row_user['id'] ?>" <?= $statustxt; ?>><?php echo $row_user['name'] ?></option>
										    <?php } ?>
									      </select>
									</div>
									    
									<div class="col-6 form-group">
									     <label for="">Subject</label>
									     <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject Here" value="<?= $row_roles_get['subject']; ?>" required>
									     <input type="hidden" class="form-control" name="id" value="<?= $row_roles_get['id']; ?>">
									</div>
								</div>
								<div class="row">	
							        <div class="col-6 form-group">
									   <label for="exampleInputPassword1">Description </label>
									   <textarea placeholder="Description Here" rows="3" class="form-control" id="description" name="description" required><?= $row_roles_get['description']; ?></textarea>
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
								<?php
									}else{
								?>
								    <div class="col-12 form-group">
									  <label style="color:red;"> Meassge is Inactive </label> 
									</div>
								<?php
									}
								?>
            				</div> 
                            </form>
                        </div>  
                </div>
                
            </div>
        </div>
    </section>
    
    </div>
    
<?php
    require "footer1.php";
?>