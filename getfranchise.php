<?php
include ("config.php");

$countryid = $_POST['countryid'];
$fr_type = $_POST['fr_type'];
$chapter_id = $_POST['chapter_id'];

$sql_chk = "select * from franchise_users where country_id='$countryid' and franchise_type='$fr_type' and chapter_id='$chapter_id' and status='1' ";
$query_chkres = mysqli_query($conn,$sql_chk);
if(mysqli_num_rows($query_chkres)>0){

	echo $dropdownlist = '<option value=""> --Select User-- </option>';
	while($row = mysqli_fetch_array($query_chkres)){

		echo $dropdownlist = '<option value="'.$row['id'].'"> '.$row['name'].'</option>';
	}
	}else{
		echo $dropdownlist = '<option value=""> --Select User-- </option>';
}	

?>