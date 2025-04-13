<?php
$conn = new mysqli("localhost", "root", "", "parkify");

$sql = "SELECT * FROM parkingspots";
$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
  $data[] = $row;
}
echo json_encode($data);
?>
