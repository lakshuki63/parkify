<?php
$conn = new mysqli("localhost", "root", "", "parkingspots");

$sql = "SELECT * FROM ParkingSpots";
$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
  $data[] = $row;
}
echo json_encode($data);
?>
