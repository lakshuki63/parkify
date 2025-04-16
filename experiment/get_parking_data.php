<?php
$conn = new mysqli("localhost", "root", "", "parkify");

if ($conn->connect_error) {
    die(json_encode(["error" => $conn->connect_error]));
}

$sql = "SELECT id, name, lat, lon, total_slots, available_slots, city, area FROM parkingspots";
$result = $conn->query($sql);

$spots = [];
while ($row = $result->fetch_assoc()) {
    $spots[] = [
        "id" => $row['id'],
        "name" => $row['name'],
        "lat" => $row['lat'],
        "lon" => $row['lon'],
        "total_slots" => $row['total_slots'],
        "available_slots" => $row['available_slots'],
        "city" => $row['city'],
        "area" => $row['area']
    ];
}

header('Content-Type: application/json');
echo json_encode($spots);
$conn->close();
?>
