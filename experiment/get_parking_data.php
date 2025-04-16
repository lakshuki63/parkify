<?php
$conn = new mysqli("localhost", "root", "", "parkify");
if ($conn->connect_error) {
    die(json_encode(["error" => $conn->connect_error]));
}

// Join parkingspots with daily_slot_availability
$sql = "SELECT p.*, d.slot1, d.slot2, d.slot3, d.slot4, d.slot5, d.slot6, d.slot7, d.slot8, d.slot9, d.slot10, d.slot11 
        FROM parkingspots p
        LEFT JOIN daily_slot_availability d ON p.id = d.area_id";

$result = $conn->query($sql);

$spots = [];
while ($row = $result->fetch_assoc()) {
    $spots[] = $row;
}

header('Content-Type: application/json');
echo json_encode($spots);
$conn->close();
?>
