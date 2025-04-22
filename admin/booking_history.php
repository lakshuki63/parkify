<?php
$mysqli = new mysqli("localhost", "root", "", "parkify");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$result = $mysqli->query("SELECT * FROM booking_history");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Booking History</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f6f8;
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #34495e;
      color: white;
      padding: 20px;
      text-align: center;
    }

    .container {
      padding: 30px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: white;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    th, td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #2ecc71;
      color: white;
    }

    tr:hover {
      background-color: #f1f1f1;
    }
  </style>
</head>
<body>

<header>All Booking History</header>

<div class="container">
  <table>
    <tr>
      <th>user ID</th>
      <th>User</th>
      <th>Parking Area ID</th>
      <th>Slot No</th>
      <th>Date</th>
      <th>booking Time</th>
      <th>area</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
      <tr>
        <td><?= $row['user_id']; ?></td>
        <td><?= $row['user_name']; ?></td>
        <td><?= $row['area_id']; ?></td>
        <td><?= $row['slot_number']; ?></td>
        <td><?= $row['booking_date']; ?></td>
        <td><?= $row['booking_time']; ?></td>
        <td><?= $row['area']; ?></td>
      </tr>
    <?php } ?>
  </table>
</div>

</body>
</html>
