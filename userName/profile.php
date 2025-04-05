<?php
// DB connect
$conn = new mysqli("localhost", "root", "", "user_info");

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM user_form WHERE id = $id");
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Confirm Your Details</title>
  <style>
    .container { max-width: 600px; margin: auto; }
    button { padding: 10px 20px; margin: 10px; }
    .password-box { display: none; margin-top: 20px; }
  </style>
</head>
<body>
  <div class="container">
    <h2>Hello, <?= $user['firstName'] ?>. Please confirm your details:</h2>
    <ul>
      <li><strong>Username:</strong> <?= $user['username'] ?></li>
      <li><strong>Email:</strong> <?= $user['email'] ?></li>
      <li><strong>Phone:</strong> <?= $user['phoneNo'] ?></li>
      <li><strong>City:</strong> <?= $user['city'] ?></li>
      <!-- Add more details as needed -->
    </ul>

    <button onclick="window.location.href='../userName/userName.php'">✏️ Edit</button>
    <button onclick="document.getElementById('passwordBox').style.display='block'">✅ Confirm</button>

    <div class="password-box" id="passwordBox">
      <form action="save_password.php" method="POST">
        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
        <label>Enter Password: </label>
        <input type="password" name="password" required>
        <button type="submit">Save Password</button>
      </form>
    </div>
  </div>
</body>
</html>
