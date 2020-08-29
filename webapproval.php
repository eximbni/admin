<?php 
include("config.php");

$message ="";
if(isset($_GET['id'])){
	$webid = $_GET['id'];
	$sqlupdate = "UPDATE webinar SET status='1' WHERE id= '$webid'";
	$sqlquery = mysqli_query($conn, $sqlupdate);
	if($sqlquery){
		header("Location: webinarlist.php");
 		exit;
	}

}

?>  
