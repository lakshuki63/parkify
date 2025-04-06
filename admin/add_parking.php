<?php
$conn = new mysqli("localhost", "root", "", "parkingspots");

$name = $_POST['name'];
$city = $_POST['city'];
$area = $_POST['area'];
$lat = $_POST['lat'];
$lon = $_POST['lon'];
$total = $_POST['total_slots'];
$available = $_POST['available_slots'];

$sql = "INSERT INTO ParkingSpots (name, lat, lon, total_slots, available_slots, city, area)
VALUES ('$name', '$lat', '$lon', '$total', '$available', '$city', '$area')";

if ($conn->query($sql)) {
  echo "✅ Parking spot added!";
} else {
  echo "❌ Error: " . $conn->error;
}
?>
