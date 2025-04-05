<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "user_info";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$user_id = $_POST['user_id'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Securely hash password

$sql = "INSERT INTO user_info (user_id, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $user_id, $password);

if ($stmt->execute()) {
  echo "<script>alert('✅ Password saved successfully!'); window.location.href='profile.php?id=$user_id';</script>";
} else {
  echo "❌ Error: " . $stmt->error;
}
?>
