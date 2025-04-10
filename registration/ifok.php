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

session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['userName'];
    $password = $_POST['password'];

    // Prepare and execute the query
    $sql = "SELECT * FROM user_passwords WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            // ✅ Password is correct
            $_SESSION['username'] = $username;
            header("Location: ../userboard/ub.php"); // redirect to dashboard
            exit();
        } else {
            echo "<script>
                alert('Incorrect password ❌');
                window.location.href = '../registration/register.php';
                </script>";
        }
    } else {
        echo "<script>
            alert('User not found ❌');
            window.location.href = '../registration/register.php';
            </script>";
    }

    $stmt->close();
}

$conn->close();
?>
