<?php
$mysqli = new mysqli("localhost", "root", "", "parkify");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch unique areas
$areas = [];
$area_query = $mysqli->query("SELECT DISTINCT area FROM parkingspots");
while ($row = $area_query->fetch_assoc()) {
    $areas[] = $row['area'];
}

// Fetch unique usernames
$usernames = [];
$user_query = $mysqli->query("SELECT DISTINCT user_name FROM booking_history");
while ($row = $user_query->fetch_assoc()) {
    $usernames[] = $row['user_name'];
}

// Get selected filters
$selected_area = isset($_GET['area']) ? $_GET['area'] : '';
$selected_user = isset($_GET['user_name']) ? $_GET['user_name'] : '';

// Dynamic query
$query = "SELECT * FROM booking_history WHERE 1=1";
$params = [];
$types = "";

if (!empty($selected_area)) {
    $query .= " AND area = ?";
    $params[] = $selected_area;
    $types .= "s";
}

if (!empty($selected_user)) {
    $query .= " AND user_name = ?";
    $params[] = $selected_user;
    $types .= "s";
}

$stmt = $mysqli->prepare($query);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
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

    form {
      margin-bottom: 20px;
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 15px;
    }

    select, button {
      padding: 10px;
      font-size: 16px;
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

<header>Booking History - Filter by Area & Username</header>
<a href="admin_panel.php" style="display: inline-block; margin-bottom: 20px; text-decoration: none;">
  <button style="padding: 10px 20px; font-size: 16px; background-color: #3498db; color: white; border: none; border-radius: 5px; cursor: pointer;">
    ← Back to Admin Panel
  </button>
</a>

<div class="container">

  <form method="GET" action="booking_history.php">
    <label><strong>Area:</strong></label>
    <select name="area">
      <option value="">-- All Areas --</option>
      <?php foreach ($areas as $area): ?>
        <option value="<?= $area ?>" <?= $selected_area == $area ? 'selected' : '' ?>>
          <?= htmlspecialchars($area) ?>
        </option>
      <?php endforeach; ?>
    </select>

    <label><strong>User:</strong></label>
    <select name="user_name">
      <option value="">-- All Users --</option>
      <?php foreach ($usernames as $user): ?>
        <option value="<?= $user ?>" <?= $selected_user == $user ? 'selected' : '' ?>>
          <?= htmlspecialchars($user) ?>
        </option>
      <?php endforeach; ?>
    </select>

    <button type="submit">Search</button>
  </form>

  <table>
    <tr>
      <th>User ID</th>
      <th>User</th>
      <th>Parking Area ID</th>
      <th>Slot No</th>
      <th>Date</th>
      <th>Booking Time</th>
      <th>Area</th>
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
