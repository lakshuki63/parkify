<?php
$mysqli = new mysqli("localhost", "root", "", "parkify");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$result = $mysqli->query("SELECT * FROM user_form");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All Users</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8fafc;
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #2c3e50;
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
      background-color: #3498db;
      color: white;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    .edit-btn {
      background-color: #27ae60;
      color: white;
      padding: 8px 14px;
      text-decoration: none;
      border-radius: 6px;
    }

    .edit-btn:hover {
      background-color: #1e8449;
    }
  </style>
</head>
<body>


<header>All Registered Users</header>
<a href="admin_panel.php" style="display: inline-block; margin-bottom: 20px; text-decoration: none;">
  <button style="padding: 10px 20px; font-size: 16px; background-color: #3498db; color: white; border: none; border-radius: 5px; cursor: pointer;">
    ← Back to Admin Panel
  </button>
</a>
<div class="container">
  <table>
    <tr>
      <th>ID</th>
      <th>Username</th>
      <th>Email</th>
      <th>Phone</th>
      <th>state</th>
      <th>city</th>
      <th>adress1</th>
      <th>address2</th>
      <th>car number</th>
      <th>created date</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
      <tr>
        <td><?= $row['id']; ?></td>
        <td><?= htmlspecialchars($row['username']); ?></td>
        <td><?= htmlspecialchars($row['email']); ?></td>
        <td><?= htmlspecialchars($row['phoneNo']); ?></td>
        <td><?= htmlspecialchars($row['state']); ?></td>
        <td><?= htmlspecialchars($row['city']); ?></td>
        <td><?= htmlspecialchars($row['address1']); ?></td>
        <td><?= htmlspecialchars($row['address2']); ?></td>
        <td><?= htmlspecialchars($row['carNumber']); ?></td>
        <td><?= htmlspecialchars($row['created_at']); ?></td>
        <td><a href="edit_user.php?id=<?= $row['id']; ?>" class="edit-btn">Edit</a></td>
      </tr>
    <?php } ?>
  </table>
</div>

</body>
</html>
