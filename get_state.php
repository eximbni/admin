<?php 
	include("config.php");
	$id = $_POST['id'];
	$get_state = "SELECT * FROM `state` WHERE country_id = $id";
	$res_state = mysqli_query($conn,$get_state);
	$div = "<option value=''>--Select State--</option>";
	while($row_state=mysqli_fetch_array($res_state))
	{
		$div .= "<option value='".$row_state['zone_id']."'>".$row_state['name']."</option>";
	} 
	echo json_encode($div);
	//echo $div;
?>