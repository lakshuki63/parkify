<!-- booking.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Car Parking Slot Booking</title>
  <link rel="stylesheet" href="book.css">
</head>
<body>
  <div class="container">
    <h2>Book Your Parking Slot</h2>
    <form action="book.php" method="POST">
      <label>City:</label>
      <input type="text" name="city" placeholder="Enter city" required>

      <label>Location:</label>
      <select name="location" id="location">
    <?php
    // Database connection
    $conn = new mysqli("localhost", "root", "", "smartparking");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch unique locations from parkingspots
    $sql = "SELECT DISTINCT location FROM parkingspots WHERE location IS NOT NULL";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<option value='" . htmlspecialchars($row['location']) . "'>" . htmlspecialchars($row['location']) . "</option>";
        }
    } else {
        echo "<option value=''>No locations found</option>";
    }

    $conn->close();
    ?>
</select>


      <label>Slot:</label>
      <select name="slot" required>
        <option value="">Select</option>
        <option value="1">Slot 1{07:00am-08:00am}</option>
        <option value="2">Slot 2{08:00am-09:00am}</option>
        <option value="3">Slot 3{09:00am-10:00am}</option>
        <option value="4">Slot 4{10:00am-11:00am}</option>
        <option value="5">Slot 5{11:00am-12:00pm}</option>
        <option value="6">Slot 6{12:00pm-01:00pm}</option>
        <option value="7">Slot 7{01:00pm-02:00pm}</option>
        <option value="8">Slot 8{02:00pm-03:00pm}</option>
        <option value="9">Slot 9{03:00pm-04:00pm}</option>
        <option value="10">Slot 10{04:00pm-05:00pm}</option>
        <option value="11">Slot 11{05:00pm-06:00pm}</option>
        <option value="12">Slot 12{06:00pm-07:00pm}</option>

       
      </select>

      <label>Date & Time:</label>
      <input type="date" name="date" required>

      <label>Vehicle Number:</label>
      <input type="text" name="vehicle" placeholder="XY00WZ0000" required>

      <label>Payment Method:</label>
      <select name="payment" required>
        <option value="">Select</option>
        <option value="credit">Credit Card</option>
        <option value="debit">Debit Card</option>
        <option value="upi">UPI</option>
        <option value="netbanking">Net Banking</option>
      </select>

      <button type="submit">Proceed to Payment</button>
    </form>
  </div>
</body>
</html>
