<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../registration/register.php");
    exit();
}

$username = $_SESSION['username'];

// Connect to database
$conn = new mysqli("localhost", "root", "", "parkify");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$slot = $_GET['slot'] ?? '';
$area = $_GET['area'] ?? '';
$city = $_GET['city'] ?? '';
$parkingName = $_GET['name'] ?? '';
$date = $_GET['date'] ?? '';
// Fetch user and booking details
$sql = "
SELECT 
    u.firstName, 
    u.lastName, 
    u.phoneNo, 
    u.email, 
    u.carNumber, 
    bh.booking_date, 
    bh.booking_time, 
    bh.slot_number, 
    ps.name AS parking_name, 
    ps.area AS parking_area, 
    ps.city 
FROM user_form u
LEFT JOIN booking_history bh ON bh.username = u.username
LEFT JOIN parkingspots ps ON bh.area_name = ps.name
WHERE u.username = ?
ORDER BY bh.booking_time DESC LIMIT 1";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("SQL error: " . $conn->error);
}
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();

    $fullName = $row['firstName'] . " " . $row['lastName'];
    $phone = $row['phoneNo'];
    $email = $row['email'];
    $carNumber = $row['carNumber'];
    $bookingTime = $row['booking_time'];

   

    // Time slot mapping
    function getTimeSlot($slot) {
        $slots = [
            1 => "7:00 AM – 8:00 AM",
            2 => "8:00 AM – 9:00 AM",
            3 => "9:00 AM – 10:00 AM",
            4 => "10:00 AM – 11:00 AM",
            5 => "11:00 AM – 12:00 PM",
            6 => "12:00 PM – 1:00 PM",
            7 => "1:00 PM – 2:00 PM",
            8 => "2:00 PM – 3:00 PM",
            9 => "3:00 PM – 4:00 PM",
            10 => "4:00 PM – 5:00 PM",
            11 => "5:00 PM – 6:00 PM"
        ];
        return $slots[$slot] ?? "Unknown Slot";
    }

    $timeSlotText = getTimeSlot($slot);
} else {
    echo "User or booking details not found.";
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Booking Page - Parkify</title>
  <link rel="stylesheet" href="booking.css">
  <link href="https://fonts.googleapis.com/css2?family=Bahnschrift&display=swap" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="session-info">
      🚘 Logged in as: <strong><?php echo htmlspecialchars($username); ?></strong>
    </div>

    <div class="glass-card">
      <h2>Book Your Parking Slot</h2>

      <form method="POST" action="invoice.php">
        <label>Username:</label>
        <input type="text" name="username" value="<?= htmlspecialchars($username) ?>" readonly>

        <label>Full Name:</label>
        <input type="text" name="fullname" value="<?= htmlspecialchars($fullName) ?>" readonly>

        <label>Email:</label>
        <input type="text" name="email" value="<?= htmlspecialchars($email) ?>" readonly>

        <label>Phone:</label>
        <input type="text" name="phone" value="<?= htmlspecialchars($phone) ?>" readonly>

        <label>Car Number:</label>
        <input type="text" name="car_number" value="<?= htmlspecialchars($carNumber) ?>" readonly>

        <label>Parking Spot:</label>
        <input type="text" name="parking_name" value="<?= htmlspecialchars($parkingName) ?>" readonly>

        <label>Area:</label>
        <input type="text" name="area" value="<?= htmlspecialchars($area) ?>" readonly>

        <label>City:</label>
        <input type="text" name="city" value="<?= htmlspecialchars($city) ?>" readonly>

        <label>Slot Number:</label>
        <input type="text" name="slot" value="<?= htmlspecialchars($slot) ?>" readonly>

        <label>Time Slot:</label>
        <input type="text" name="time_slot_text" value="<?= htmlspecialchars($timeSlotText) ?>" readonly>

        <label>Booking Date:</label>
        <input type="text" name="date" value="<?= htmlspecialchars($date) ?>" readonly>

        <label>Booking Time:</label>
        <input type="text" name="time" value="<?= htmlspecialchars($bookingTime) ?>" readonly>

        <button type="submit">✅ Confirm Booking</button>
      </form>
    </div>
  </div>
</body>
</html>
