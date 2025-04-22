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

$parking_name = $_POST['parking_name'] ?? '';
$area = $_POST['area'] ?? '';
$city = $_POST['city'] ?? '';
$slot = $_POST['slot'] ?? '';
$area = $_POST['area'] ?? '';
$user_name=$_POST['username'] ?? '';
$parking_name = $_POST['parking_name'] ?? '';
$slot_time = $_POST['timeSlotText'] ?? '';
$date = $_POST['date'] ?? '';
$area_id=$_POST['area_id']?? '';
$booking_time = date('H:i:s');

$area_stmt = $conn->prepare("SELECT id FROM parkingspots WHERE name = ?");
$area_stmt->bind_param("s", $parking_name);
$area_stmt->execute();
$area_stmt->bind_result($area_id);
$area_stmt->fetch();
$area_stmt->close();
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
$stmt = $conn->prepare("INSERT INTO booking_history (user_id, slot_number, booking_date, booking_time, area, user_name, area_id) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("iissssi", $user_id, $slot, $date, $booking_time, $area, $user_name, $area_id);
$stmt->execute();
$stmt->close();

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
    <div class="detail-row"><span class="label"><label>Parking Spot:</label></span> <?= htmlspecialchars($parking_name) ?></div>
  <div class="detail-row"><span class="label"><label>Area:</label></span> <?= htmlspecialchars($area) ?></div>
  <div class="detail-row"><span class="label"><label>City:</label></span> <?= htmlspecialchars($city) ?></div>
  <div class="detail-row"><span class="label"><label>Slot Number:</label></span> <?= htmlspecialchars($slot) ?></div>
  <div class="detail-row"><span class="label"><label>Time Slot:</label></span> <?= htmlspecialchars($timeSlotText) ?></div>
  <div class="detail-row"><span class="label"><label>Date:</label></span> <?= htmlspecialchars($date) ?></div>
  <div class="detail-row"><span class="label"><label>Booking Time:</label></span> <?= htmlspecialchars($booking_time) ?></div>
</div>

    <img src="qr_placeholder.png" alt="QR Code" class="qr-code"><br>
<div class="buttons">
    <button class="print-btn" onclick="window.print()">🖨️ Print Ticket</button>
    <!-- Add this where you want the button to appear in invoice.php -->
    <a href="../userboard/ub1.php">
    <button class="print-btn">🏠 Go to Home</button>
    </a>
</div>

</div>
<div id="congratsText">🎉 Congratulations! Booking Successful 🎉</div>

<canvas id="particles"></canvas>
    <div class="animated-bg"></div>
<script src="particles.js"></script>

    <!-- Confetti Script -->
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
<script>
    window.onload = function() {
        const congrats = document.getElementById("congratsText");
            congrats.style.display = "block";
            setTimeout(() => {
            congrats.style.display = "none";
            }, 3000);


        // Run confetti for 2 seconds
        const duration = 2 * 1000;
        const end = Date.now() + duration;

        (function frame() {
            confetti({
                particleCount: 5,
                angle: 60,
                spread: 100,
                origin: { x: 0 },
                colors: ['#00f5ff', '#e600ff', '#7400ff']
            });
            confetti({
                particleCount: 5,
                angle: 120,
                spread: 100,
                origin: { x: 1 },
                colors: ['#00f5ff', '#e600ff', '#7400ff']
            });

            if (Date.now() < end) {
                requestAnimationFrame(frame);
            }
        }());
    };
</script>

</body>
</html>
