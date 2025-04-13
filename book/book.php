<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Step 1: Save initial form data in session
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['card_number'])) {
    $_SESSION['booking'] = [
        'city' => $_POST['city'],
        'location' => $_POST['location'],
        'slot' => $_POST['slot'],
        'time' => $_POST['time'],
        'vehicle' => $_POST['vehicle'],
        'payment' => $_POST['payment'],
    ];
    // Show credit card form
    ?>
    <!DOCTYPE html>
    <html>
    <head>
      <title>Enter Card Details</title>
      <link rel="stylesheet" href="book.css">
    </head>
    <body>
      <div class="container">
        <h2>Payment Gateway</h2>
        <form method="POST" action="book.php">
          <label>Credit Card Number:</label>
          <input type="text" name="card_number" required>

          <label>PIN:</label>
          <input type="password" name="pin" required>

          <button type="submit">Pay</button>
        </form>
      </div>
    </body>
    </html>
    <?php
    exit;
}

// Step 2: On payment form submit, insert into database
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['card_number'])) {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "parkify";

    $conn = new mysqli($host, $user, $pass, $dbname);
    if ($conn->connect_error) {
        die("DB Connection Failed: " . $conn->connect_error);
    }

    $booking = $_SESSION['booking'];
    $city = $booking['city'];
    $location = $booking['location'];
    $slot = $booking['slot'];
    $time = $booking['time'];
    $vehicle = $booking['vehicle'];
    $payment = $booking['payment'];

    $sql = "INSERT INTO smart_parking (city, location, slot, time, vehicle, payment) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $city, $location, $slot, $time, $vehicle, $payment);

    if ($stmt->execute()) {
        echo '<div class="container">';
        echo '<h2>✅ Booking Successful!</h2>';
        echo '<div class="success-box">';
        echo "<p><strong>City:</strong> $city</p>";
        echo "<p><strong>Location:</strong> $location</p>";
        echo "<p><strong>Slot:</strong> $slot</p>";
        echo "<p><strong>Time:</strong> $timing</p>";
        echo "<p><strong>Vehicle:</strong> $vehicle</p>";
        echo "<p><strong>Payment Method:</strong> $payment</p>";
        echo '<a href="booking.php">Book Another Slot</a>';
        echo '</div>';
        echo '</div>';
        
        session_destroy();
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
