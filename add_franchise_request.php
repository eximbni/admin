<?php 
include("config.php");
$message='';

if(isset($_POST['submit'])){

	$country_id = $_POST['country_id'];

	$name=$_POST['name'];

	$mobile=$_POST['mobile'];

	$email=$_POST['email'];

	$state_id = $_POST['state_id'];

	$chapter_id = $_POST['chapter_id'];

	$commission = $_POST['commission'];

	$amount = $_POST['amount'];

	$created_date = date("Y-m-d");

	$expiry_date = $_POST['expiry_date'];

	$frcode = "sf.".$country_id.".".$chapter_id;

	$chk = "select * from franchise_users where frcode='$frcode'";

	$chkres = mysqli_query($conn,$chk);

	if(mysqli_num_rows($chkres)>0){

		$message="Franchise Already exists for this chapter";

	}

	else{

	$sql = "insert into franchise_users(name,mobile,email,franchise_type,continent_id,region_id,country_id,chapter_id,created_date,expiry_date,commission,amount,frcode,status) values('$name','$mobile','$email','sf','$continent_id','$region_id','$country_id','$chapter_id','$created_date','$expiry_date','$commission','$amount','$frcode','1')";

	$res = mysqli_query($conn,$sql);

	if($res){

		$message = "Franchise Added Successfully";

	}

	else{

		$message = "Error Adding Franchise";

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
            <h1 class="m-0 text-dark">Add Franchise</h1>
            <h4 style="color:red"><?php echo $message; ?></h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item">Franchise </li>
              <li class="breadcrumb-item active">Add Franchise </li>
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
            					    <div class="col-md-6">
            						    <div class="form-group">
            							    <label for="">mobile</label>
             							    <input type="number" name="mobile" class="form-control" onkeydown="return event.keyCode != 69" id="" placeholder="Mobile" required>
                                        </div>
										<div class="form-group">

										  <label>Select Franchise Type</label>

										  <select class="form-control" name="franchise_type" id="franchise_type" required>

											<option>Select Type</option>

											<?php include("config.php");

											$get = "select * from franchise_type";

											$res = mysqli_query($conn,$get);

											if ($res){

												while($row=mysqli_fetch_assoc($res)){

											?>

															<option value="<?php echo $row['code'];?>"><?php echo $row['franchise'];?></option>

											<?php }} ?>	

										  </select>

										</div>
										<div class="form-group" id="continent" style="display:none;"> 

										  <label>Select Continent</label>

										  <select class="form-control" name="continent_id" id="continent_id" required>

											<option>Select</option>

											<?php include("config.php");

											$get = "select * from sevencontinents";

											$res = mysqli_query($conn,$get);

											if ($res){

												while($row=mysqli_fetch_assoc($res)){

											?>

															<option value="<?php echo $row['id'];?>"><?php echo $row['gcontinent'];?></option>

											<?php }} ?>	

										  </select>

										</div>
										<div class="form-group" id="regional" style="display:none;"> 

										  <label>Select Region</label>

										  <select class="form-control" name="region_id" id="region_id" required>


										  </select>

										</div>
										<div class="form-group">

										  <label>Select Country</label>

										  <select class="form-control" name="country_id" id="country_id" onchange="getState();" required>

											<option>Select</option>

											<?php include("config.php");

											$get = "select * from countries";

											$res = mysqli_query($conn,$get);

											if ($res){

												while($row=mysqli_fetch_assoc($res)){

											?>

															<option value="<?php echo $row['country_id'];?>"><?php echo $row['name'];?></option>

											<?php }} ?>	

										  </select>

										</div>
										<div class="form-group">

										  <label>Select Chapter</label>

										  <select class="form-control" name="chapter_id" required>

											<option>select</option>

											<?php include("config.php");

											$get = "select * from chapters";

											$res = mysqli_query($conn,$get);

											if ($res){

												while($row=mysqli_fetch_assoc($res)){

											?>

												<option value="<?php echo $row['id'];?>"><?php echo $row['chapter_name'];?></option>

											<?php }} ?>	

										  </select>

										</div>
										<div class="form-group">

										  <label for="">Name</label>

										  <input type="text" name="name" class="form-control" onkeydown="return event.keyCode != 69" id="" placeholder="Name" required>

										</div>
                                    </div>
            						<div class="col-md-6">
    									<div class="form-group">
                                            <label for="">email</label>
                                            <input type="text" name="email" class="form-control" onkeydown="return event.keyCode != 69" id="" placeholder="email" required>
                                        </div>
                                        <div class="form-group">

										  <label>Select State</label>

										  <select class="form-control" name="state_id" id="state_id" required>

											

										  </select>

										</div>
										<div class="form-group">

										  <label for="">Commission</label>

										  <input type="number" name="commission" class="form-control" onkeydown="return event.keyCode != 69" id="" placeholder="Commission" required>

										</div>
										<div class="form-group">

										  <label for="">Franchise Amount</label>

										  <input type="number"name="amount" class="form-control" onkeydown="return event.keyCode != 69" id="" placeholder="Franchise Amount" required>

										</div>
										<div class="form-group">

										  <label for="">Expiry Date</label>

										  <input type="date" name="expiry_date" class="form-control" onkeydown="return event.keyCode != 69" id="" placeholder="Name" required>

										</div>

            						</div>
            					</div>
                            </div>
            				<div class="box-footer text-right">
            					<input type="submit" name="submit"class="btn btn-outline-primary" value="submit">
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
 <script>

$('#franchise_type').on('change', function() {
  var a = $('#franchise_type').val();
 // alert(a);
  if(a=="CNTF")
  {
	  $('#continent').css('display','block');
  }
  else if(a=="RF")
  {
	  $('#continent').css('display','block');
	  $('#regional').css('display','block');
	 
  }
  else{}
});

$('#continent_id').on('change', function() {
	var continent_id = $('#continent_id').val();
	$.ajax({
		type:"POST",
		url:"get_regions.php",
		data:{
			continent_id:continent_id
		},
		dataType:'json',
		success:function(response)
		{
			//alert(response);
			$("#region_id").empty();
			$("#region_id").append(response);
		},
		error:function(error)
		{
			alert(error);
		},
	});
});

 function getState()

 {

	var country_id = $("#country_id").val();

	alert(country_id);

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

 </script>
