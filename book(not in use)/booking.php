<!-- booking.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Car Parking Slot Booking</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="book.css">
</head>
<body>

   <?php include 'userboard.html'; ?>
   
  <div class="container">
      
    <h2>Book Your Parking Slot</h2>
    <form action="book.php" method="POST">

       <label>Date:</label>
      <input type="date" name="date" required>
      <label>Timings:</label>

      <label for="time">Select Time</label>
                    <select id="time" name="time">
                        <option value=""> Choose a time </option>
                        <option value="08:00am-09:00am">08:00am-09:00am</option>
                        <option value="09:00am-10:00am">09:00am-10:00am</option>
                        <option value="10:00am-11:00am">10:00am-11:00am</option>
                        <option value="11:00am-12:00pm">11:00am-12:00pm</option>
                        <option value="12:00pm-01:00pm">12:00pm-01:00pm</option>
                        <option value="01:00pm-02:00pm">01:00pm-02:00pm</option>
                        <option value="02:00pm-03:00pm">02:00pm-03:00pm</option>
                        <option value="03:00pm-04:00pm">03:00pm-04:00pm</option>
                        <option value="04:00pm-05:00pm">04:00pm-05:00pm</option>
                        <option value="05:00pm-06:00pm">05:00pm-06:00pm</option>
                        <option value="06:00pm-07:00pm">06:00pm-07:00pm</option>
                        
                    </select>
     
     

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
  <script>
        function setTime(value) {
            document.getElementById('time').value = value;
        }
    </script>
</body>
</html>

<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "parkify");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
