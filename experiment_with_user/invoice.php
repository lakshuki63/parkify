<?php
session_start();
$conn = new mysqli("localhost", "root", "", "parkify");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

$user_id = $_SESSION['user_id'];

$user_sql = "SELECT firstName, lastName, email, phoneNo FROM user_form WHERE id = ?";
$user_stmt = $conn->prepare($user_sql);
$user_stmt->bind_param("i", $user_id);
$user_stmt->execute();
$user_stmt->bind_result($firstName, $lastName, $email, $phoneNo);
$user_stmt->fetch();
$user_stmt->close();

$fullName = $firstName . ' ' . $lastName;

$sql = "SELECT bh.booking_date, bh.booking_time, bh.slot_number, ps.name AS parking_name, ps.area AS parking_area
        FROM booking_history bh
        JOIN parkingspots ps ON bh.area_id = ps.id
        WHERE bh.user_id = ?
        ORDER BY bh.booking_time DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $booking_date = $row['booking_date'];
    $booking_time = $row['booking_time'];
    $slot_number = $row['slot_number'];
    $parking_name = $row['parking_name'];
    $parking_area = $row['parking_area'];
} else {
    die("No booking found.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Booking Invoice</title>
    <link rel="stylesheet" href="invoice.css">
</head>
<body>
<div class="invoice-box">
    <img src="logo.png" alt="Parkify Logo" class="logo">
    <h1>Parking Invoice</h1>

    <div class="details">
    <div class="detail-row"><span class="label">Full Name:</span> <span><?php echo htmlspecialchars($fullName); ?></span></div>
    <div class="detail-row"><span class="label">Email:</span> <span><?php echo htmlspecialchars($email); ?></span></div>
    <div class="detail-row"><span class="label">Phone:</span> <span><?php echo htmlspecialchars($phoneNo); ?></span></div>
    <div class="detail-row"><span class="label">Parking Area:</span> <span><?php echo htmlspecialchars($parking_name); ?></span></div>
    <div class="detail-row"><span class="label">Location:</span> <span><?php echo htmlspecialchars($parking_area); ?></span></div>
    <div class="detail-row"><span class="label">Slot Number:</span> <span><?php echo htmlspecialchars($slot_number); ?></span></div>
    <div class="detail-row"><span class="label">Date:</span> <span><?php echo htmlspecialchars($booking_date); ?></span></div>
    <div class="detail-row"><span class="label">Time:</span> <span><?php echo htmlspecialchars($booking_time); ?></span></div>
</div>

    <img src="qr_placeholder.png" alt="QR Code" class="qr-code"><br>
    <button class="print-btn" onclick="window.print()">🖨️ Print Ticket</button>
</div>
</body>
</html>
