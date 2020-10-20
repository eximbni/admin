<?php

include("config.php");

if(isset($_GET['id']))

{

	$id = $_GET['id'];
	$status = $_GET['status'];

	if($status =='del'){
		$getstatus = '0';
	}else{
		$getstatus = '1';
	}

	$sql = "UPDATE banner SET status='$getstatus' where id='$id'";
 	$res = mysqli_query($conn,$sql);

	header("location:banner_list.php");

}

?>