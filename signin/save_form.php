<?php
// 1. Connect to DB
$host = "localhost";
$user = "root";
$pass = "";
$db = "user_info";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// 2. Get data from POST
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$phoneNo = $_POST['phoneNo'];
$email = $_POST['email'];
$state = $_POST['state'];
$city = $_POST['city'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$dob = $_POST['dob'];
$aadharNumber = $_POST['aadharNumber'];
$carNumber = $_POST['carNumber'];
$dlNumber = $_POST['dlNumber'];

// 3. Upload files
$aadharFile = $_FILES['aadharFile']['name'];
$dlFile = $_FILES['dlFile']['name'];

$aadharTemp = $_FILES['aadharFile']['tmp_name'];
$dlTemp = $_FILES['dlFile']['tmp_name'];

$aadharPath = "uploads/" . $aadharFile;
$dlPath = "uploads/" . $dlFile;

move_uploaded_file($aadharTemp, $aadharPath);
move_uploaded_file($dlTemp, $dlPath);

// 4. Insert into DB
$sql = "INSERT INTO user_form 
  (firstName, lastName, phoneNo, email, state, city, address1, address2, dob, aadharNumber, aadharFile, carNumber, dlNumber, dlFile)
  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssssss", $firstName, $lastName, $phoneNo, $email, $state, $city, $address1, $address2, $dob, $aadharNumber, $aadharPath, $carNumber, $dlNumber, $dlPath);

if ($stmt->execute()) {
  $last_id = $stmt->insert_id; // get the inserted user ID
  header("Location: ..\signin\profile.php?id=$last_id");
  exit();
} else {
  echo "❌ Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
