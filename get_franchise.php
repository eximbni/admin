<?php 
	include("config.php");
	$id = $_POST['id'];
	$get_franch = "SELECT * FROM `franchise_users` WHERE franchise_type = '$id'";
	$res_franch = mysqli_query($conn,$get_franch);
	$div = "<option value=''>Select Franchise</option>";
	while($row_franch=mysqli_fetch_array($res_franch))
	{
		$div .= "<option value=".$row_franch['id'].">".$row_franch['name']."</option>";
	} 
	echo json_encode($div);
?>