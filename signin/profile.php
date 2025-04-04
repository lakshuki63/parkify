<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "user_info"; // use your real DB name

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the user ID from URL
$id = $_GET['id'] ?? 0;

$sql = "SELECT * FROM user_form WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
  echo "User not found!";
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>User Profile</title>
  <style>
    body { font-family: Arial; padding: 20px; }
    .card {
      background: #f4f4f4;
      padding: 20px;
      border-radius: 8px;
      width: 500px;
      margin: auto;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 { text-align: center; }
  </style>
</head>
<body>
  <div class="card">
    <h2>Welcome, <?php echo htmlspecialchars($user['firstName']); ?>!</h2>
    <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
    <p><strong>Phone:</strong> <?php echo $user['phoneNo']; ?></p>
    <p><strong>Date of Birth:</strong> <?php echo $user['dob']; ?></p>
    <p><strong>City, State:</strong> <?php echo $user['city'] . ", " . $user['state']; ?></p>
    <p><strong>Car Number:</strong> <?php echo $user['carNumber']; ?></p>

    <p><strong>Aadhar Card:</strong><br>
      <img src="<?php echo $user['aadharFile']; ?>" width="200">
    </p>

    <p><strong>Driving Licence:</strong><br>
      <img src="<?php echo $user['dlFile']; ?>" width="200">
    </p>
  </div>


  <div style="text-align: center; margin-top: 20px;">
  <button onclick="window.location.href='../signin/signin.php'">Edit</button>
  <button onclick="document.getElementById('passwordModal').style.display='block'">Confirm</button>
</div>

<!-- Password Modal -->
<div id="passwordModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.6);">
  <div style="background:#fff; padding:20px; border-radius:10px; width:300px; margin:100px auto; text-align:center;">
    <h3>Enter Password</h3>
    <form method="POST" action="save_password.php">
      <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
      <input type="password" name="password" required><br><br>
      <button type="submit">Submit</button>
      <button type="button" onclick="document.getElementById('passwordModal').style.display='none'">Cancel</button>
    </form>
  </div>
</div>
  </form>
</body>
</html>

