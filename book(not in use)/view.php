<!DOCTYPE html>
<html>
<head>
  <title>All Bookings</title>
  <link rel="stylesheet" href="book.css">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
      background-image: url('car.jpg');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      color: white;
    }

    .container {
      max-width: 95%;
      margin: 40px auto;
      text-align: center;
    }

    h2 {
      font-family: 'Castellar', serif;
      color: white;
      text-shadow: 0 0 5px cyan;
      margin-bottom: 30px;
    }

    table {
      width: 100%;
      margin: 0 auto;
      border-collapse: collapse;
      border-radius: 10px;
      overflow: hidden;
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      background: rgba(255, 255, 255, 0.1);
      box-shadow: 0 0 20px rgba(0, 255, 255, 0.2);
    }

    th, td {
      padding: 12px;
      text-align: center;
      border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    th {
      background-color: rgba(0, 255, 255, 0.15);
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>All Bookings</h2>

    <?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "parkify";

    $conn = new mysqli($host, $user, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM smart_parking ORDER BY time DESC";
    $result = $conn->query($sql);

    echo "<table>";
    echo "<tr><th>ID</th><th>Location</th><th>Slot</th><th>Time</th><th>Vehicle</th><th>Payment</th></tr>";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['Sr_no.']}</td>
                    <td>{$row['location']}</td>
                    <td>{$row['slot']}</td>
                    <td>{$row['time']}</td>
                    <td>{$row['vehicle']}</td>
                    <td>{$row['payment']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No bookings found</td></tr>";
    }
    echo "</table>";

    $conn->close();
    ?>
  </div>
</body>
</html>
