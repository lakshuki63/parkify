<?php
session_start();


if (!isset($_SESSION['username'])) {
    header("Location: ../registration/register.php");
    exit();
}

$username = $_SESSION['username'];
echo "Session username: " . $_SESSION['username'] . "<br>";

// Connect to database
$conn = new mysqli("localhost", "root", "", "parkify");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user details
$sql = "SELECT firstName, lastName, phoneNo, email, carNumber FROM user_form WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    $firstName = $user['firstName'];
    $lastName = $user['lastName'];
    $fullName = $firstName . " " . $lastName;
    $phone = $user['phoneNo'];
    $email = $user['email'];
    $carNumber = $user['carNumber'];
} else {
    echo "User details not found.";
    exit();
}

$stmt->close();

// Get parking details from URL
$parkingName = $_GET['name'] ?? '';
$state = $_GET['state'] ?? '';
$city = $_GET['city'] ?? '';
$area = $_GET['area'] ?? '';
$available = $_GET['available'] ?? '';
$total = $_GET['total'] ?? '';
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

      <form method="POST" action="submit_booking.php">
        <label>Username:</label>
        <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" readonly>

        <label>Full Name:</label>
        <input type="text" name="fullname" value="<?php echo htmlspecialchars($fullName); ?>" readonly>

        <label>Email:</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly>

        <label>Phone:</label>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>" readonly>

        <label>Car Number:</label>
        <input type="text" name="car_number" value="<?php echo htmlspecialchars($carNumber); ?>" readonly>

        <label>Parking Spot:</label>
        <input type="text" name="parking_name" value="<?php echo htmlspecialchars($parkingName); ?>" readonly>

        <label>State:</label>
        <input type="text" name="state" value="<?php echo htmlspecialchars($state); ?>" readonly>

        <label>City:</label>
        <input type="text" name="city" value="<?php echo htmlspecialchars($city); ?>" readonly>

        <label>Area:</label>
        <input type="text" name="area" value="<?php echo htmlspecialchars($area); ?>" readonly>

        <label>Available Slots:</label>
        <input type="text" name="available" value="<?php echo htmlspecialchars($available); ?>" readonly>

        <label>Total Slots:</label>
        <input type="text" name="total" value="<?php echo htmlspecialchars($total); ?>" readonly>

        <button type="submit">✅ Confirm Booking</button>
      </form>
    </div>
  </div>
</body>
</html>
