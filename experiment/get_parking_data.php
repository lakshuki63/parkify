<?php
$conn = new mysqli("localhost", "root", "", "parkify");
if ($conn->connect_error) {
    die(json_encode(["error" => $conn->connect_error]));
}

$sql = "SELECT * FROM parkingspots";
$result = $conn->query($sql);

$spots = [];
while ($row = $result->fetch_assoc()) {
    $spots[] = $row;
}

header('Content-Type: application/json');
echo json_encode($spots);
$conn->close();
?>
