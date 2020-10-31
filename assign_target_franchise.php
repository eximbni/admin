<?php
include("config.php");
$message='';
if(isset($_POST['submit'])){
	$country = $_POST['country_id'];
	$franchise_type = $_POST['franchise_type'];
	$franchise=$_POST['franchise'];
	$tar_type=$_POST['target_type'];
	$tar_period=$_POST['target_period'];
	$target=$_POST['target'];
	$created_date = date("Y-m-d");
	
	if($tar_type==1)
	{
	    $sql = "INSERT INTO `franchise_target`(`franchise_id`, `country_id`, `franchise_type`, `target_type`, `year`, `target`, `created`, `status`) VALUES ('$franchise','$country','$franchise_type','$tar_type','$tar_period','$target','$created_date','1')";
	}
	else if($tar_type==2)
	{
	    $sql = "INSERT INTO `franchise_target`(`franchise_id`, `country_id`, `franchise_type`, `target_type`, `month`, `target`, `created`, `status`) VALUES ('$franchise','$country','$franchise_type','$tar_type','$tar_period','$target','$created_date','1')";
	}
	else
	{
	    $sql = "INSERT INTO `franchise_target`(`franchise_id`, `country_id`, `franchise_type`, `target_type`, `quarter`, `target`, `created`, `status`) VALUES ('$franchise','$country','$franchise_type','$tar_type','$tar_period','$target','$created_date','1')";
	}
	$res = mysqli_query($conn,$sql);
	if($res){
		$message = "Franchise Target Added Successfully";
	}
	else{
		$message = "Error Adding Franchise Target";
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
            <h1 class="m-0 text-dark">Franchise Assign Target</h1>
            <h4 style="color:red"><?php echo $message; ?></h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item">Franchise </li>
              <li class="breadcrumb-item active">Franchise Assign Target</li>
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
										  <label>Select Country</label>
										  <select class="form-control" name="country_id" required>
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
										  <label>Select Franchise</label>
										  <select class="form-control" name="franchise" id="franchise" required>
											
										  </select>
										</div>
										<div class="form-group">
										  <label for="">Target</label>
										  <input type="number" name="target" class="form-control" onkeydown="return event.keyCode != 69" id="" placeholder="Target" required>
										</div>
									</div>
									<div class="col-md-6">
    									<div class="form-group">
										  <label>Select Frachise Type</label>
										  <select class="form-control" name="franchise_type" id="franchise_type" required>
											<option>Select</option>
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
										
										<div class="form-group">
										  <label>Select Target Type</label>
										  <select class="form-control" name="target_type" id="target_type" required>
											<option>Select</option>
											<option value="1">Yearly</option>
											<option value="2">Monthly</option>
											<option value="3">Quarterly</option>
										  </select>
										</div>
										
										<div class="form-group">
										  <label>Select Target Period</label>
										  <select class="form-control" name="target_period" id="target_period" required>
											
                                          </select>
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
$('#target_type').on('change', function() {
    var a = $('#target_type').val();
    //alert(a);
    if(a==1)
    {
        var str = "<option value=''>--Select--</option><option value='2020'>2020</option><option value='2021'>2021</option><option value='2022'>2022</option><option value='2023'>2023</option><option value='2024'>2024</option><option value='2025'>2025</option><option value='2026'>2026</option><option value='2027'>2027</option><option value='2027'>2027</option><option value='2028'>2028</option><option value='2029'>2029</option><option value='2030'>2030</option>";
    }
    else if(a==2)
    {
        var str = "<option value=''>--Select--</option><option value='Janaury'>Janaury</option><option value='February'>February</option><option value='March'>March</option><option value='April'>April</option><option value='May'>May</option><option value='June'>June</option><option value='July'>July</option><option value='August'>August</option><option value='September'>September</option><option value='October'>October</option><option value='November'>November</option><option value='December'>December</option>";
    }
    else
    {
        var str = "<option value=''>--Select--</option><option value='1'>First</option><option value='2'>Second</option><option value='3'>Third</option><option value='4'>Fourth</option>";
    }
    $("#target_period").empty();
	$("#target_period").append(str);
});

$('#franchise_type').on('change', function() {
  var a = $('#franchise_type').val();
  $.ajax({
		type:"POST",
		url:"get_franchise.php",
		data:{
			id:a
		},
		dataType:'json',
		success:function(response)
		{
			//alert(response);
			$("#franchise").empty();
			$("#franchise").append(response);
		},
		error:function(error)
		{
			alert(error);
		},
	});
});
</script> 