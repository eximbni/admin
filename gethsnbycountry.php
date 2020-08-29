<?php 
	include("config.php");
	$countryid = $_POST['countryid'];
	$table_name = 'hsncodes_'.$countryid;
	echo $get_hsn = "SELECT hs.id,hs.hscode, hs.english as hsndescription, ca.category_name, ch.chapter_name FROM $table_name hs, categories ca, chapters ch where hs.chapter_id=ch.id and ch.category_id=ca.id";
	$res_hsn = mysqli_query($conn,$get_hsn);
	while($row_hsn=mysqli_fetch_array($res_hsn))
	{
	    $data.='<tr><td>'.$row_hsn['id'].'</td><td>'.$row_hsn['category_name'].'</td><td>'.$row_hsn['chapter_name'].'</td><td>'.$row_hsn['hscode'].'</td><td>'.$row_hsn['hsndescription'].'</td></tr>';
	}
	echo $data;
?>