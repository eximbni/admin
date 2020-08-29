<?php
include('config.php');
$sql = "DESC admin_income";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    print_r($row);echo"<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>