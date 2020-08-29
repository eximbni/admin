<?php
	include("config.php");
	$franid = $_POST['franid'];
	$country_id = $_POST['counid'];
	$state_id = $_POST['staeid']; 
	
    $sqlcheck = "SELECT * FROM franchise_users WHERE franchise_type ='$franid' AND country_id ='$country_id' AND state_id = '$state_id' AND status='1' ";			
    $resquery = mysqli_query($conn, $sqlcheck);	
    $rescnt =  mysqli_num_rows($resquery);
    if($rescnt == 0){
        $outp=1;
    }else{
        $outp= 0;
    }
    			
    $outp=json_encode($outp);
    echo $outp;
	$conn->close();

?>