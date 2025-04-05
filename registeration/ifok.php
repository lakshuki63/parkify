<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "user_info";

// Connect to DB
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$username = $_POST['userName'];
$password = $_POST['password'];

// Check if user exists
$sql = "SELECT * FROM user_passwords WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();

    // Verify the password
    if (password_verify($password, $row['password'])) {
        echo "✅ Login successful! Welcome, " . $username;
        // You can start a session here if needed
        // session_start();
        // $_SESSION['username'] = $username;
        // header("Location: dashboard.php");
    } else {
        echo "❌ Incorrect password.";
    }
} else {
    echo "❌ User not found.";
}

$stmt->close();
$conn->close();
?>
