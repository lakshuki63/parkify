<?php
$conn = new mysqli("localhost", "root", "", "parkify");
$data = json_decode(file_get_contents("php://input"), true);

$username = $conn->real_escape_string($data['username']);
$date = $data['date'];
$area_id = (int)$data['area_id'];
$slot_key = $data['slot_key'];
$area_name = $conn->real_escape_string($data['area_name']);

// 1. Decrease availability
$update = $conn->query("UPDATE daily_slot_availability SET $slot_key = $slot_key - 1 WHERE area_id = $area_id AND date = '$date'");

// 2. Log booking
$now = date('H:i:s');
$log = $conn->query("INSERT INTO booking_history (username, booking_date, booking_time, slot_number, area_name, area_id)
                     VALUES ('$username', '$date', '$now', '$slot_key', '$area_name', $area_id)");

if ($update && $log) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => $conn->error]);
}
$conn->close();
?>
