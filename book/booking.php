<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Parking Slot Booking</title>
    <link rel="stylesheet" href="book.css">
</head>
<body>
    <div class="container">
        <h2>Book Your Parking Slot</h2>
        <form action="book.php" method="POST">
            <label for="location">Select Location:</label>
            <select name="location" id="location">
                <option value="">Select</option>
                <option value="Sitabuldi">Sitabuldi</option>
                <option value="Dharampeth">Dharampeth</option>
                <option value="Sadar">Sadar</option>
                <option value="Ramdas Peth">Ramdas Peth</option>
                <option value="Itwari">Itwari</option>
                <option value="Mahal">Mahal</option>
            </select>
            <label for="slot">Select Slot:</label>
            <select name="slot" id="slot">
                <option value="">Select</option>
                <option value="1">Slot 1</option>
                <option value="2">Slot 2</option>
                <option value="3">Slot 3</option>
                <option value="4">Slot 4</option>
            </select>
            <label for="time">Select Timing:</label>
            <input type="datetime-local" name="time" id="time">
            <label for="vehicle">Enter Vehicle Number:</label>
            <input type="text" name="vehicle" id="vehicle" placeholder="XY00WZ0000">
            <label for="payment">Select Payment Method:</label>
            <select name="payment" id="payment">
                <option value="">Select</option>
                <option value="credit">Credit Card</option>
                <option value="debit">Debit Card</option>
                <option value="upi">UPI</option>
                <option value="paypal">PayPal</option>
            </select>
            <button type="submit">Proceed to Payment</button>
        </form>
    </div>
</body>
</html>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Step 1: Connect to MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smart_parking";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection error
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// Step 2: Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $location = $_POST['location'] ?? '';
    $slot = $_POST['slot'] ?? '';
    $time = $_POST['time'] ?? '';
    $vehicle = $_POST['vehicle'] ?? '';
    $payment = $_POST['payment'] ?? '';

    // Validate input
    if (empty($location) || empty($slot) || empty($time) || empty($vehicle) || empty($payment)) {
        echo "⚠️ Please fill all the required fields.";
        exit;
    }

    // Step 3: Insert into database
    $stmt = $conn->prepare("INSERT INTO bookings (location, slot, time, vehicle, payment_method) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("❌ SQL Error: " . $conn->error);
    }

  
    
    // Step 4: Execute and show confirmation
    if ($stmt->execute()) {
        echo '<link rel="stylesheet" href="book.css">';
        echo '<div class="container">';
        echo "<h2>✅ Booking Confirmed!</h2>";
        echo "<p>📍 <strong>$location</strong> — 🅿️ Slot <strong>$slot</strong></p>";
        echo "<p>⏰ <strong>$time</strong></p>";
        echo "<p>🚗 Vehicle: <strong>$vehicle</strong></p>";
        echo "<p>💳 Payment: <strong>$payment</strong></p>";
        echo '<br><a href="book.html"><button>🔙 Book Another Slot</button></a>';
        echo '</div>';
    } else {
        echo "❌ Booking failed: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>


