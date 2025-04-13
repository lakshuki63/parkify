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
      <select name="location" required>
        <option value="">Select</option>
        <option value="Sitabuldi">Sitabuldi</option>
        <option value="Dharampeth">Dharampeth</option>
        <!-- add more -->
      </select>

      <label>Slot:</label>
      <select name="slot" required>
        <option value="">Select</option>
        <option value="1">Slot 1</option>
        <option value="2">Slot 2</option>
        <!-- add more -->
      </select>

      <label>Date & Time:</label>
      <input type="datetime-local" name="time" required>

      <label>Vehicle Number:</label>
      <input type="text" name="vehicle" placeholder="XY00WZ0000" required>

      <label>Payment Method:</label>
      <select name="payment" required>
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
