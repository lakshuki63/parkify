<?php
// Start session
session_start();
$conn = new mysqli("localhost", "root", "", "parkify");



// Check if the button was clicked and process the query
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add_slots'])) {
    // Get the selected date from the form
    $new_date = $_POST['new_date'];

    // SQL query to add the slots for the new date
    $set_sql = "SET @new_date = ?";
    $insert_sql = "
        INSERT INTO daily_slot_availability (
            area_id, date,
            slot1, slot2, slot3, slot4, slot5, slot6,
            slot7, slot8, slot9, slot10, slot11
        )
        SELECT 
            id, @new_date,
            total_slots, total_slots, total_slots, total_slots, total_slots, total_slots,
            total_slots, total_slots, total_slots, total_slots, total_slots
        FROM parkingspots
        WHERE id NOT IN (
            SELECT area_id FROM daily_slot_availability WHERE date = @new_date
        );
    ";

    // First, execute the SET statement
    if ($stmt = $conn->prepare($set_sql)) {
        $stmt->bind_param("s", $new_date);
        $stmt->execute();
        $stmt->close();
    }

    // Then, execute the INSERT statement
    if ($stmt = $conn->prepare($insert_sql)) {
        if ($stmt->execute()) {
            echo "<script>alert('Slots added successfully for $new_date!');</script>";
        } else {
            echo "<script>alert('Error: Could not add slots for $new_date.');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('SQL preparation failed.');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel - Smart Parking</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f0f4f8;
    }

    header {
      background-color: #2c3e50;
      color: white;
      padding: 20px;
      text-align: center;
      font-size: 24px;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 80vh;
    }

    .panel {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
      text-align: center;
    }

    .panel h2 {
      margin-bottom: 25px;
      color: #333;
    }

    .btn {
      display: block;
      width: 220px;
      margin: 15px auto;
      padding: 14px;
      background-color: #3498db;
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s;
      text-decoration: none;
    }
    .btn2 {
      display: block;
      width: 100px;
      margin: 15px auto;
      padding: 14px;
      background-color:rgb(0, 248, 132);
      color: black;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s;
      text-decoration: none;
    }

    .btn:hover {
      background-color: #2980b9;
    }
  </style>
</head>
<body>


  <header>Admin Panel - Smart Parking System</header>

  

  <div class="container">
    <div class="panel">
      <h1>Choose an Action</h1>
      <div class="form-box">
    Add Parking Slots for New Date
    <form method="POST">
            <label for="new_date">Select Date:</label>
            <br>
            <input type="date" id="new_date" name="new_date" required>
            <br>
            <input  class="btn2" type="submit" name="add_slots" value="Add Slots">
    </form>
</div>

      <a href="all_users.php" class="btn">All Users</a>
      <a href="admin.php" class="btn">Add Parking Slot</a>
      <a href="booking_history.php" class="btn">Show Booking History</a>
      <a href="statistics.php" class="btn">Statistics</a>
    </div>
  </div>

</body>
</html>
