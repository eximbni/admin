<?php
include("config.php");
$lead_id = $_POST['lead_id'];
$mob_num = "select l.id,u.mobile from leads l, users u where l.posted_by=u.id and l.id='$lead_id'";
$res_mob_num = mysqli_query($conn, $mob_num);
$row_no = mysqli_fetch_assoc($res_mob_num);
$mobile = $row_no['mobile'];
echo json_encode($mobile);
?>