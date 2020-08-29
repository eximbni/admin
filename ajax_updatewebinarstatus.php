<?php 
include("config.php");
$id = $_POST['id'];
$status = $_POST['upstatus'];
if($status ==0){
   $status = 1; 
}else{
   $status = 0;  
}

$up_sql = "UPDATE `webinar` SET `status` = '$status' WHERE `id` = '$id'";
$res_sql = mysqli_query($conn,$up_sql);
if($res_sql)
{
	$x = 1;
	//echo "Updated";
}
else
{
	$x = 0;
	//echo "Not Updated";
}
echo json_encode($x);
?>