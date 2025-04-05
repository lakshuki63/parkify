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
// Database connection
$host = "localhost";
$user = "root";
$password = "";
$dbname = "smart_parking";

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Receive form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $location = isset($_POST['location']) ? $_POST['location'] : '';
    $slot = isset($_POST['slot']) ? $_POST['slot'] : '';
    $time = isset($_POST['time']) ? $_POST['time'] : '';
    $vehicle = isset($_POST['vehicle']) ? $_POST['vehicle'] : '';
    $payment = isset($_POST['payment']) ? $_POST['payment'] : '';

    // Validation
    if (empty($location) || empty($slot) || empty($time) || empty($vehicle) || empty($payment)) {
        echo "Please fill in all the required fields properly.";
        exit;
    }

    // Prevent slot clash at same location and time
    $check_sql = "SELECT * FROM bookings WHERE location = ? AND slot = ? AND time = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("sss", $location, $slot, $time);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        echo '<link rel="stylesheet" href="book.css">';
        echo "<h2 style='color:red;'>❌ Slot $slot at $location on $time is already booked!</h2>";
        echo '<a href="book.html">Go back to Booking Page</a>';
        exit;
    }

    // Safe to insert booking
    $insert_sql = "INSERT INTO bookings (location, slot, time, vehicle, payment_method) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param("sssss", $location, $slot, $time, $vehicle, $payment);

    if ($stmt->execute()) {
        echo '<link rel="stylesheet" href="book.css">';
        echo "<h2>✅ Booking Confirmed!</h2>";
        echo "<p>You booked <strong>$location</strong> (Slot $slot) at <strong>$time</strong>.</p>";
        echo "<p>Vehicle: $vehicle | Payment: $payment</p>";
        echo '<br><a href="book.html">Back to Booking Page</a>';
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $check_stmt->close();
    $conn->close();
}
?>


