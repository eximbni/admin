<?php

	include("config.php"); 

	$region = $_POST['region'];

        $sql = "SELECT * FROM `countries` WHERE `region` ='$region' ORDER BY name ASC";

		$result = mysqli_query($conn,$sql);

		$div = "<option value=''>Select Country</option>";

		while($rows=mysqli_fetch_array($result))

		{

			$div .= "<option value=".$rows['country_id'].">".$rows['name']."</option>";

		} 

		echo $div;	

?> 