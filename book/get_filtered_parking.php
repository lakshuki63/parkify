<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "parkify");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get parameters from the URL
$city = $_GET['city'] ?? '';
$area = $_GET['area'] ?? '';

// Prepare SQL with filtering
if ($city && $area && $area !== 'all') {
  $stmt = $conn->prepare("SELECT * FROM parkingspots WHERE city = ? AND area = ?");
  $stmt->bind_param("ss", $city, $area);
} else {
  $stmt = $conn->prepare("SELECT * FROM parkingspots WHERE city = ?");
  $stmt->bind_param("s", $city);
}

$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
  $data[] = $row;
}

// Output as JSON
echo json_encode($data);
?>
