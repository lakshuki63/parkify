<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


// Database connection
$host = "localhost";
$user = "root";
$password = "";
$dbname = "smart_parking";

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// Ensure the form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $location = isset($_POST['location']) ? $_POST['location'] : '';
    $slot = isset($_POST['slot']) ? $_POST['slot'] : '';
    $time = isset($_POST['time']) ? $_POST['time'] : '';
    $vehicle = isset($_POST['vehicle']) ? $_POST['vehicle'] : '';
    $payment = isset($_POST['payment']) ? $_POST['payment'] : '';

    if (empty($location) || empty($slot) || empty($time) || empty($vehicle) || empty($payment)) {
        echo "Please fill in all the required fields properly.";
        exit;
    }

    // Insert booking into database
    $sql = "INSERT INTO bookings (location, slot, time, vehicle, payment_method) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $location, $slot, $time, $vehicle, $payment);

    if ($stmt->execute()) {
        echo '<link rel="stylesheet" type="text/css" href="book.css">';
        echo "<h2>Booking Confirmed!</h2>";
        echo "<p>Thank you for booking at <strong>$location</strong> (Slot $slot) on <strong>$time</strong>.</p>";
        echo "<p>Vehicle: $vehicle | Payment: $payment</p>";
        echo '<br><a href="book.html">Back to Booking Page</a>';
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
