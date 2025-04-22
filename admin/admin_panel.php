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

    .btn:hover {
      background-color: #2980b9;
    }
  </style>
</head>
<body>

  <header>Admin Panel - Smart Parking System</header>

  <div class="container">
    <div class="panel">
      <h2>Choose an Action</h2>
      <a href="all_users.php" class="btn">All Users</a>
      <a href="admin.php" class="btn">Add Parking Slot</a>
      <a href="booking_history.php" class="btn">Show Booking History</a>
      <a href="statistics.php" class="btn">Statistics</a>
    </div>
  </div>

</body>
</html>
