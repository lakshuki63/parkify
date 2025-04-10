<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "user_info";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM user_passwords";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>All User Passwords</title>
  <style>
    table {
      width: 70%;
      margin: 30px auto;
      border-collapse: collapse;
    }
    th, td {
      padding: 10px;
      border: 1px solid #aaa;
      text-align: center;
    }
    h2 {
      text-align: center;
      margin-top: 40px;
    }
  </style>
</head>
<body>
  <h2>All Stored User Passwords (hashed)</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>User ID</th>
      <th>Password (Hashed)</th>
      <th>Created At</th>
    </tr>

    <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['user_id'] ?></td>
        <td><?= $row['password'] ?></td>
        <td><?= $row['created_at'] ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
