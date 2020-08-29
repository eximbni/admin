<?php 
include("config.php");
$id = $_POST['id'];
$gname = $_POST['gname'];
$gfolder = $_POST['gfolder'];
$gpagepath = $_POST['gpagepath'];
$countryid = $_POST['countryid'];


$up_sql = "UPDATE `payment_gateway` SET `gateway_name` = '$gname',`gateway_country` = '$countryid',`gateway_folder` = '$gfolder',`gateway_page_path` = '$gpagepath' WHERE `id` = '$id'";
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