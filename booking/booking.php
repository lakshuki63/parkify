<!-- <?php
// Capture query parameters
$parkingName = $_GET['name'] ?? 'Unknown';
$city = $_GET['city'] ?? 'Not Provided';
$area = $_GET['area'] ?? 'Not Provided';
$state = $_GET['state'] ?? 'Not Provided';
$available = $_GET['available'] ?? 'N/A';
$total = $_GET['total'] ?? 'N/A';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Book Parking - <?php echo htmlspecialchars($parkingName); ?></title>
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; }
    h2 { color: #333; }
    .info { background: #f2f2f2; padding: 15px; margin-bottom: 20px; border-radius: 8px; }
    form { background: #e9ffe9; padding: 20px; border-radius: 8px; }
    label { display: block; margin: 10px 0 5px; }
    input, select { width: 100%; padding: 8px; }
    button { margin-top: 15px; padding: 10px 15px; background: green; color: white; border: none; border-radius: 5px; }
  </style>
</head>
<body>

<h2>Book Your Slot at <?php echo htmlspecialchars($parkingName); ?></h2>

<div class="info">
  <p><strong>State:</strong> <?php echo htmlspecialchars($state); ?></p>
  <p><strong>City:</strong> <?php echo htmlspecialchars($city); ?></p>
  <p><strong>Area:</strong> <?php echo htmlspecialchars($area); ?></p>
  <p><strong>Available Slots:</strong> <?php echo htmlspecialchars($available); ?> / <?php echo htmlspecialchars($total); ?></p>
</div>

<form action="confirm_booking.php" method="post">
  <input type="hidden" name="parkingName" value="<?php echo htmlspecialchars($parkingName); ?>">
  <input type="hidden" name="city" value="<?php echo htmlspecialchars($city); ?>">
  <input type="hidden" name="area" value="<?php echo htmlspecialchars($area); ?>">
  <input type="hidden" name="state" value="<?php echo htmlspecialchars($state); ?>">

  <label for="userName">Your Name:</label>
  <input type="text" id="userName" name="userName" required>

  <label for="phone">Phone Number:</label>
  <input type="tel" id="phone" name="phone" required>

  <label for="vehicle">Vehicle Type:</label>
  <select id="vehicle" name="vehicle">
    <option value="Car">Car</option>
    <option value="Bike">Bike</option>
    <option value="Scooter">Scooter</option>
  </select>

  <label for="slotTime">Select Date & Time:</label>
  <input type="datetime-local" id="slotTime" name="slotTime" required>

  <button type="submit">Confirm Booking</button>
</form>

</body>
</html> -->


<?php
$parkingName = $_GET['name'] ?? 'Unknown';
$city = $_GET['city'] ?? 'Not Provided';
$area = $_GET['area'] ?? 'Not Provided';
$state = $_GET['state'] ?? 'Not Provided';
$available = $_GET['available'] ?? 'N/A';
$total = $_GET['total'] ?? 'N/A';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Book Parking - <?php echo htmlspecialchars($parkingName); ?></title>
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; }
    h2 { color: #333; }
    .info { background: #f2f2f2; padding: 15px; margin-bottom: 20px; border-radius: 8px; }
    form { background: #e9ffe9; padding: 20px; border-radius: 8px; }
    label { display: block; margin: 10px 0 5px; }
    input, select { width: 100%; padding: 8px; }
    button { margin-top: 15px; padding: 10px 15px; background: green; color: white; border: none; border-radius: 5px; cursor: pointer; }
  </style>
</head>
<body>

<h2>Book Your Slot at <?php echo htmlspecialchars($parkingName); ?></h2>

<div class="info">
  <p><strong>State:</strong> <?php echo htmlspecialchars($state); ?></p>
  <p><strong>City:</strong> <?php echo htmlspecialchars($city); ?></p>
  <p><strong>Area:</strong> <?php echo htmlspecialchars($area); ?></p>
  <p><strong>Available Slots:</strong> <?php echo htmlspecialchars($available); ?> / <?php echo htmlspecialchars($total); ?></p>
</div>

<form action="confirm_booking.php" method="post">
  <input type="hidden" name="parkingName" value="<?php echo htmlspecialchars($parkingName); ?>">
  <input type="hidden" name="city" value="<?php echo htmlspecialchars($city); ?>">
  <input type="hidden" name="area" value="<?php echo htmlspecialchars($area); ?>">
  <input type="hidden" name="state" value="<?php echo htmlspecialchars($state); ?>">

  <label for="userName">Your Name:</label>
  <input type="text" id="userName" name="userName" required>

  <label for="phone">Phone Number:</label>
  <input type="tel" id="phone" name="phone" required>

  <label for="vehicle">Vehicle Type:</label>
  <select id="vehicle" name="vehicle" required>
    <option value="Car">Car</option>
    <option value="Bike">Bike</option>
    <option value="Scooter">Scooter</option>
  </select>

  <label for="slotTime">Select Date & Time:</label>
  <input type="datetime-local" id="slotTime" name="slotTime" required>

  <button type="submit">Confirm Booking</button>
</form>

</body>
</html>
