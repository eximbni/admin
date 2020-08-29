<?php
$message="";
if(isset($_POST['submit']))
{
    include("config.php");
    date_default_timezone_set("Asia/Calcutta");
    $date = date('Y-m-d');
    $country_id = $_POST['country_id'];
    $policy_type=$_POST['policy_type'];
    $category_id = $_POST['category'];
    $chapter_id=$_POST['chapter'];
    $hsn_code = $_POST['hsn_code'];
    $wef = $_POST['wef'];
    $desc = $_POST['desc'];
    $comment = $_POST['comment'];
    if($policy_type="imp")
    {
        $sql_policy = "UPDATE `hsncodes_$country_id` SET `imp_policy`='$desc', `wef`='$wef', `comment`='$comment' where `id`='$hsn_code'";
    }
    else
    {
        $sql_policy = "UPDATE `hsncodes_$country_id` SET `exp_policy`='$desc', `wef`='$wef', `comment`='$comment' where `id`='$hsn_code'";
    }
    
    $res_policy = mysqli_query($conn,$sql_policy);
    if($res_policy)
    {
    	$message = "<div class='alert alert-success'>Policy Updated Successfully.</div>";
    }
    else
    {
    	//echo "Lead insert failed";
    	$message = "<div class='alert alert-danger'>Failed to update policy.</div>";
    }
}
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
	<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
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
	<div class="content-wrapper">
		<section class="content-header">
		  <div class="container-fluid">
			<div class="row mb-2">
			  <div class="col-sm-12">
				<ol class="breadcrumb float-sm-left">
				  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
				  <li class="breadcrumb-item active">Add Policy</li>
				</ol>
				
			  </div>
			</div>
			<div class="row mb-2">
			  <div class="col-sm-9">
				<h4 style="text-align:center;"><b>Add Policy</b></h4>
			  </div>
			  <div class="col-sm-3">
			  
			  </div>
			</div>
		  </div><!-- /.container-fluid -->

		</section>
				
			<?php echo $message; ?>
			
	    <section class="content">
    
	        <div class="card p-3">
							
	            <div class="container">
	
                	<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="box-body">
                		    <div class="row">
                			<div class="col-md-6">
                			    <div class="form-group">
                				  <label>Country</label>
                				  <select class="form-control" name="country_id" required>
                					<option>select</option>
                					<?php include("config.php");
                						$get = "select * from countries";
                						$res = mysqli_query($conn,$get);
                						if($res){
                							while($row=mysqli_fetch_assoc($res)){
                						?>
                							<option value="<?php echo $row['country_id'];?>"><?php echo $row['name'];?></option>
                					<?php }} ?>
                				  </select>
                			    </div>
                			    
                			    <div class="form-group">
                				  <label>Select Chapter</label>
                				  <select class="form-control" id="chapter" name="chapter" required>
                					<!--option>select</option>
                					<option>option 1</option>
                					<option>option 2</option-->
                				  </select>
                    			</div>
                    			
                    			<div class="form-group">
                    			  <label>Policy type</label>
                    			  <select class="form-control" name="policy_type">
                    				<option>select</option>
                    				<option value="imp">Import</option>
                    				<option value="exp">Export</option>
                    			  </select>
                    			</div>
                		
                			</div>
                			
                			<div class="col-md-6">
                			    <div class="form-group">
                        		    <label>Select Category</label>
                        			    <select class="form-control" name="category" id="category" required>
                        				<option>select</option>
                            			<?php include("config.php");
                            				$get = "select * from categories";
                            				$res = mysqli_query($conn,$get);
                            				if($res){
                            					while($row=mysqli_fetch_assoc($res)){
                            				?>
                            					<option value="<?php echo $row['id'];?>"><?php echo $row['category_name'];?></option>
                            			<?php }} ?>	
                        				
                        			  </select>
                        		</div>
                        		<div class="form-group">
                				  <label>Select HSN Code</label>
                				  <select class="form-control" name="hsn_code" id="hsn_code" required>
                					<!--option>select</option>
                					<option>option 1</option>
                					<option>option 2</option-->
                				  </select>
                			    </div>
                			    <div class="form-group">
                    			  <label for="">With Effect From</label>
                    			  <input type="date" class="form-control" id="" placeholder="WEF" name="wef" required>
                    			</div>
                			</div>
                			<div class="col-md-12">
                			    <div class="form-group">
                    			    <label for="exampleInputPassword1">Description</label>
                    				<textarea class="form-control" placeholder="Type Here" name="desc" required></textarea>
                    			</div>
                			</div>
                			<div class="col-md-12">
                			    <div class="form-group">
                    			    <label for="exampleInputPassword1">Comment</label>
                    				<textarea class="form-control" placeholder="Type Here" name="comment" required></textarea>
                    			</div>
                			</div>
                		  <!-- /.box-body -->
                		</div>
                		  <div class="box-footer text-right mb-3" >
                			<button type="submit" class="btn btn-outline-primary" name="submit">Submit</button>
                		  </div>
                	</form>
            </div>
        </div>
    </div>
</div>

<script>
$('#category').on('change', function() {
  var a = $('#category').val();
  $.ajax({
		type:"POST",
		url:"get_chapter.php",
		data:{
			id:a
		},
		dataType:'json',
		success:function(response)
		{
			//alert(response);
			$("#chapter").empty;
			$("#chapter").append(response);
		},
		error:function(error)
		{
			alert(error);
		},
	});
});

$('#chapter').on('change', function() {
  var a = $('#chapter').val();
  $.ajax({
		type:"POST",
		url:"get_hsncode.php",
		data:{
			id:a
		},
		dataType:'json',
		success:function(response)
		{
			//alert(response);
			$("#hsn_code").empty;
			$("#hsn_code").append(response);
		},
		error:function(error)
		{
			alert(error);
		},
	});
});

$('#hsn_code').on('change', function() {
  var a = $('#hsn_code').val();
  $.ajax({
		type:"POST",
		url:"get_hsncode_desc.php",
		data:{
			id:a
		},
		dataType:'json',
		success:function(response)
		{
			//alert(response);
			$("#product").empty;
			$("#product").append(response);
		},
		error:function(error)
		{
			alert(error);
		},
	});
});

$('#continent').on('change', function() {
  var a = $('#continent').val();
  $.ajax({
		type:"POST",
		url:"get_countries.php",
		data:{
			id:a
		},
		dataType:'json',
		success:function(response)
		{
			//alert(response);
			$("#country").empty;
			$("#country").append(response);
		},
		error:function(error)
		{
			alert(error);
		},
	});
});
</script>
<script>
 $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
 });
 
 $('form').on('focus', 'input[type=number]', function (e) {
  $(this).on('wheel.disableScroll', function (e) {
    e.preventDefault()
  })
})
$('form').on('blur', 'input[type=number]', function (e) {
  $(this).off('wheel.disableScroll')
})
</script>
</body>
</html>