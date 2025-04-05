<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "smart_parking";

// Connect to DB
$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch bookings
$sql = "SELECT * FROM bookings ORDER BY time DESC";
$result = $conn->query($sql);

echo "<h2>All Bookings</h2>";
echo "<table border='1' cellpadding='10'>";
echo "<tr><th>ID</th><th>Location</th><th>Slot</th><th>Time</th><th>Vehicle</th><th>Payment</th></tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['location']}</td>
                <td>{$row['slot']}</td>
                <td>{$row['time']}</td>
                <td>{$row['vehicle']}</td>
                <td>{$row['payment_method']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No bookings found</td></tr>";
}
echo "</table>";

$conn->close();
?>
