<?php
include("config.php");
if(isset($_GET['id']))
{
	$id = $_GET['id'];
	$sql = "UPDATE banner SET status='1' where id='$id'";
	$res = mysqli_query($conn,$sql);
	header("location:banner_list.php");
}
?>