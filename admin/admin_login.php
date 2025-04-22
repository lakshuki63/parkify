<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin = $_POST['admin'];
    $password = $_POST['password'];

    if ($admin === "farziies" && $password === "1234") {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_panel.php");
        exit();
    } else {
        $error = "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #ecf0f1;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-box {
      background-color: white;
      padding: 30px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.2);
      border-radius: 8px;
      width: 300px;
    }

    h2 {
      text-align: center;
      color: #2c3e50;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin: 10px 0 20px;
      border: 1px solid #bdc3c7;
      border-radius: 4px;
    }

    input[type="submit"] {
      background-color:rgb(0, 174, 248);
      color: white;
      padding: 10px;
      border: none;
      width: 100%;
      border-radius: 4px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #219150;
    }

    .error {
      color: red;
      text-align: center;
    }
  </style>
</head>
<body>

<div class="login-box">
  <h2>Admin Login</h2>
  <form method="POST">
    <input type="text" name="admin" placeholder="Admin username" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="submit" value="Go">
  </form>
  <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
</div>

</body>
</html>
