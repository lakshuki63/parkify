<?php
$conn = new mysqli("localhost", "root", "", "parkify");

$user_id = $_POST['user_id'];
$password = $_POST['password'];

// Get username from user_form
$res = $conn->query("SELECT username FROM user_form WHERE id = $user_id");
$row = $res->fetch_assoc();
$username = $row['username'];

// Hash password before saving
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO user_passwords (user_id, username, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $user_id, $username, $hashedPassword);

if ($stmt->execute()) {
    echo "✅ Password saved securely!";
} else {
    echo "❌ Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
