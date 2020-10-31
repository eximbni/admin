<?php
include("config.php");
$message='';
if(isset($_POST['submit'])){
	$id = $_POST['id'];
	$username=$_POST['user_name'];
	$mobile=$_POST['mobile'];
	$email=$_POST['email'];
	$user_type= $_POST['user_type'];
    $business_name = $_POST['business_name'];
    $business_address = $_POST['business_address'];
	$country_id = $_POST['country_id'];
	$mpin = $_POST['mpin'];
	$state_id=$_POST['state_id'];  
    $email_check = $_POST['email_check'];  
 
	$sql_ins = "update users  set name='$username',mobile='$mobile',email='$email',user_type='$user_type',business_name='$business_name',business_address='$business_address',country_id='$country_id',state_id='$state_id' ,email_check='$email_check', mpin='$mpin' where id='$id'";
	//echo $sql; exit;
	$res_ins = mysqli_query($conn,$sql_ins);
	if($res_ins){
		$message = "<h4 style='color:green'> User Details Update Successfully </h4>";
	}
	else{
		$message = "<h4 style='color:red'> Error updating User Details </h4>";
		echo mysqli_error($conn);
	}
	header("location: edit_subscriberuser.php?id=".$id."");
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
            <h1 class="m-0 text-dark">Update User Details</h1>
            <?php echo $message; ?> 
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item">Admin User </li>
              <li class="breadcrumb-item active">Update User</li>
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
            				<input type="hidden" name="country_id111" class="form-control" value="<?php echo $_SESSION['country']; ?>">
                            <div class="box-body">
                                <div class="row">
									<?php
									$id = $_GET['id'];
									$sql = "select * from users where id='$id' AND status='1' ";
									$res = mysqli_query($conn,$sql);
									$row = mysqli_fetch_assoc($res);
									 
									?>
									
									<div class="col-6 form-group">
									  <label for="">Name </label>
									  <input type="text" class="form-control" id="user_name" name="user_name" placeholder="User name" value="<?php echo $row['name']; ?>" required>
									  <input type="hidden" class="form-control" name="id" value="<?php echo $row['id']; ?>">
									</div>
									<div class="form-group">
									  <label for="">User Type </label>
									  <select class="form-control" name="user_type" required>
									      <option value=""> Select Usertype </option>
									      <?php
									        if($row['user_type'] !=''){
									           echo "<option value='".$row['user_type']."' selected>".$row['user_type']."</option>"; 
									        }
									      ?>
									      <option value="Buyer"> Buyer </option>
									      <option value="Seller"> Seller </option>
									      <option value="Both"> Both </option>
									  </select>
									</div>
									<div class="col-6 form-group">
									  <label for="">Mobile No </label>
									  <input type="number" class="form-control" id="mobile" name="mobile" placeholder="Mobile No" value="<?php echo $row['mobile']; ?>" readonly required>
									</div>
									<div class="col-6 form-group">
									  <label for="">Email / username </label>
									  <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $row['email']; ?>" readonly required>
									</div>
									<div class="col-6 form-group">
									  <label>Country</label>
									  <select class="form-control" name="country_id">
									   <option>Select Country</option>
    									<?php 
    										$get1 = "SELECT * FROM `countries` ORDER BY `countries`.`name` ASC";
    										$res1 = mysqli_query($conn,$get1);
    										if($res1){
    											while($row1=mysqli_fetch_assoc($res1)){
    											if($row1['country_id'] == $row['country_id'] ){
    											    $statsu="selected";
    											}else{
    											    $statsu="";
    											}    
    										?>
    										<option value="<?php echo $row1['country_id'];?>" <?= $statsu; ?>><?php echo $row1['name'];?></option>
    									<?php }} ?>	 
									  </select>
									</div>
									
									<div class="col-6 form-group">
									  <label>State</label>
									  <select class="form-control" name="state_id">
									   <option>Select State</option>
    									<?php 
    										$get11 = "SELECT * FROM `state` ORDER BY `state`.`name` ASC";
    										$res11 = mysqli_query($conn,$get11);
    										if($res11){
    											while($row11=mysqli_fetch_assoc($res11)){
    											if($row11['zone_id'] == $row['state_id'] ){
    											    $statsu1="selected";
    											}else{
    											    $statsu1="";
    											}    
    										?>
    										<option value="<?php echo $row11['zone_id'];?>" <?= $statsu1; ?>><?php echo $row11['name'];?></option>
    									<?php }} ?>	 
									  </select>
									</div>									
									
									<div class="col-6 form-group">
									  <label for="">Business Name</label>
									  <input type="text" class="form-control" id="business_name" name="business_name" placeholder="Business Name" value="<?php echo $row['business_name']; ?>" required>
									</div>
									<div class="col-6 form-group">
									  <label for="">Business Address</label>
									  <input type="text" class="form-control" id="business_address" name="business_address" placeholder="Business Address" value="<?php echo $row['business_address']; ?>" required>
									</div>
									<div class="col-6 form-group">
									  <label for="">MPIN </label>
									  <input type="text" class="form-control" id="mpin" name="mpin" placeholder="MPIN" value="<?php echo $row['mpin']; ?>" required>
									</div>
									<div class="form-group">
									  <label for="">Email Verification </label>
									  <select class="form-control" name="email_check" required>
									      <option value=""> Select Verification </option>
									      <?php
									        if($row['email_check'] =='1'){
									           echo "<option value='1' selected> Email Verified</option>"; 
									        }else{
									           echo "<option value='0' selected> Email Not Verified</option>"; 
									        }
									      ?>
									      <option value="1"> Email Verified </option>
									      <option value="0"> Email Not Verified </option>
									  </select>
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
    
    </div>
    
<?php
    require "footer1.php";
?>