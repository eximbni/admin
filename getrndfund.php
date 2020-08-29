<?php
	include ("config.php");
	$country_id = $_POST['country_id'];
	if(isset($_POST['state_id']))
	{
	    $state_id = "AND r.state='".$_POST['state_id']."'";
	}
	else
	{
	    $state_id = '';
	}
	$srno = 0;
	$admin_income ="SELECT r.*, c.name as countryname, s.name as statename, u.name as username FROM rndfund r, countries c, state s, users u where r.state=s.zone_id and c.country_id=r.country and u.id=r.user_id and r.country='$country_id' $state_id ";
	$res_admin_income = mysqli_query($conn, $admin_income);
	$count_admin_income = mysqli_num_rows($res_admin_income);
	if($count_admin_income > 0){
	while($row_admin_income = mysqli_fetch_array($res_admin_income)) {
		
		$srno++;
		$username = $row_admin_income['username'];
		$countryname = $row_admin_income['countryname'];
		$statename = $row_admin_income['statename'];
		$amount = $row_admin_income['amount'];
		$payment_for = $row_admin_income['payment_for'];
		$payment_date = $row_admin_income['payment_date'];
		$data.="<tr><td align='center'>".$srno."</td><td align='left'>".$username."</td><td align='center'>".$countryname."</td><td align='center'>".$statename."</td><td align='right'>".$amount."</td><td align='center'>".$payment_for."</td><td align='center'>".$payment_date."</td></tr>";
		}
	}
	else
	{
		$data = "<tr><td align='center' colspan='7'>No data available in table</td></tr>";
	}
	echo $data;
?>