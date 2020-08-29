<?php
	include ("config.php");
	$trans_type = $_POST['trans_type'];
	$country_id = $_POST['country_id'];
	$srno = 0;	
	$total_income = 0;
	echo $admin_income ="SELECT ai.*, u.name as username, c.name as country_name FROM admin_income ai, users u, countries c WHERE ai.txn_for='$trans_type' and ai.txn_date>='$start_date' and ai.txn_date<='$last_date' and ai.user_id=u.id and ai.txn_type<>'credits' and u.country_id='$country_id' and u.country_id=c.country_id ORDER BY ai.id DESC";
	$res_admin_income = mysqli_query($conn, $admin_income);
	$count_admin_income = mysqli_num_rows($res_admin_income);
	if($count_admin_income > 0){
	while($row_admin_income = mysqli_fetch_array($res_admin_income)) {
		
		$srno++;
		$txn_amount = $row_admin_income['txn_amount'];
		$username = $row_admin_income['username'];
		$txn_type = $row_admin_income['txn_type'];
		$txn_for = $row_admin_income['txn_for'];
		$txn_id = $row_admin_income['txn_id'];
		$txn_date = $row_admin_income['txn_date'];
		$status = $row_admin_income['status'];
		if($status==1){ $status_txt="Success"; }else{ $status_txt="Failed"; }
		//$total_income = $total_income + $txn_amount;
		$data.="<tr><td align='center'>".$srno."</td><td align='left'>".$username."</td><td align='center'>".$txn_amount."</td><td align='center'>".$txn_type."</td><td align='right'>".$txn_for."</td><td align='center'>".$txn_id."</td><td align='center'>".$txn_date."</td><td align='right'>".$status_txt."</td></tr>";
		}
	}
	else
	{
		$data = "<tr><td colspan='9' align='center'>No Record Found</td></tr>";
	}
	echo $data;
?>