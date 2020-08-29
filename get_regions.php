<?php

	include("config.php"); 

	$get_continents = $_POST['continent_id'];

        $sql = "SELECT * FROM `continents` WHERE `main_continentid` ='$get_continents' ORDER BY continent ASC";

		$result = mysqli_query($conn,$sql);

		$div = "<option value=''>Select Region</option>";

		while($rows=mysqli_fetch_array($result))

		{

			$div .= "<option value=".$rows['id'].">".$rows['continent']."</option>";

		} 

		echo $div;	

?> 