<?php
$conn = new mysqli("localhost", "root", "", "parkify");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$area_id = $_POST['area_id'];
$date = $_POST['date'];

$sql = "SELECT * FROM daily_slot_availability WHERE area_id = ? AND date = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $area_id, $date);
$stmt->execute();
$result = $stmt->get_result();

$data = $result->fetch_assoc();
echo json_encode($data);
?>
