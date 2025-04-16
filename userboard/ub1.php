<?php
session_start();
$conn = new mysqli("localhost", "root", "", "parkify");

$user_data = [
  'username' => 'JohnDoe',
  'name' => 'John Doe',
  'email' => 'johndoe@email.com'
];

if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];
    $sql = "SELECT username, firstName, lastName, email FROM user_form WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($username, $firstName, $lastName, $email);
    if ($stmt->fetch()) {
        $user_data['username'] = $username;
        $user_data['name'] = $firstName . ' ' . $lastName;
        $user_data['email'] = $email;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Parkify</title>
  <link rel="stylesheet" href="ub.css">
  <script src="ub.js" defer></script>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600&family=Poppins&display=swap" rel="stylesheet">
  <style>
    .center-wrapper {
      position: absolute;
      top: 200px; /* Adjusted for below rear view mirror */
      left: 780px;
      transform: translate(-50%, -50%);
      text-align: center;
      z-index: 1;
    }

    .brand-title {
      color: #b000f0;
      font-weight: 900;
      font-size: 42px;
      font-family: 'Orbitron', sans-serif;
      letter-spacing: 2px;
      text-shadow: 0 0 6px #9f00ff, 0 0 12px #cc33ff;
      animation: fadeIn 1.2s ease-in-out;
    }

    .brand-subtext {
      font-family: 'Poppins', sans-serif;
      font-size: 18px;
      color: #e1caff;
      opacity: 0;
      transform: translateY(20px);
      animation: slideUp 1.2s ease forwards;
      animation-delay: 0.8s;
      text-shadow: 0 0 6px #994fd1;
      font-weight: 600;
    }

    .map-button {
      margin-top: 25px;
      padding: 16px 36px;
      background: linear-gradient(135deg, #ff00cc, #3333ff);
      color: #fff;
      font-weight: bold;
      font-size: 18px;
      border: 2px solid rgba(255, 255, 255, 0.2);
      border-radius: 16px;
      box-shadow: 0 0 10px #ff00cc, 0 0 20px #6600cc;
      letter-spacing: 1px;
      transition: all 0.35s ease;
      animation: pulseRacer 2s infinite ease-in-out;
    }

    .map-button:hover {
      background: linear-gradient(135deg, #e600ac, #2200cc);
      box-shadow: 0 0 15px #ff00cc, 0 0 25px #6600cc;
      transform: scale(1.1);
    }

    @keyframes pulseRacer {
      0%, 100% {
        transform: scale(1);
      }
      50% {
        transform: scale(1.05) translateY(-2px);
      }
    }

    @keyframes slideUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: scale(0.9);
      }
      to {
        opacity: 1;
        transform: scale(1);
      }
    }
  </style>
</head>
<body>
  <div class="dashboard-wrapper">
    <div class="sidebar">
      <div class="menu-item" onclick="openPanel('personal')">👤 Personal</div>
      <div class="menu-item" onclick="openPanel('history')">📜 History</div>
      <div class="menu-item" onclick="openPanel('settings')">⚙️ Settings</div>
    </div>

    <div class="center-wrapper">
      <h1 class="brand-title">Parkify</h1>
      <p class="brand-subtext">Your GTA-style parking assistant.</p>
      <button class="map-button">Find a Parking Slot</button>
    </div>
  </div>

  <div id="slidePanel" class="slide-panel">
    <span class="close-btn" onclick="closePanel()">&times;</span>
    <div id="panelContent"></div>
  </div>

  
  <div class="sidebar">
    <div class="menu-item" onclick="openPanel('personal')">👤</div>
    <div class="menu-item" onclick="openPanel('history')">📜</div>
    <div class="menu-item" onclick="openPanel('settings')">⚙️</div>
  </div>

  
  <div class="hero fade-in">
    <h1>PARKIFY</h1>
    <p>Smart, Effortless & Secure Parking, Anytime</p>
    <a href="../book/booking.php" class="map-button">Find a Parking Spot</a>
  </div>

  <script>
  // JS object created from PHP session data
  const userData = {
    username: "<?php echo $user_data['username']; ?>",
    name: "<?php echo $user_data['name']; ?>",
    email: "<?php echo $user_data['email']; ?>"
  };

  function openPanel(type) {
    const panel = document.getElementById('slidePanel');
    const content = document.getElementById('panelContent');
    
    if (type === 'personal') {
      content.innerHTML = `
        <h2 style="color: #fff;">👤 User Info</h2>
        <p style="color: #ccc;"><strong>Name:</strong> ${userData.name}</p>
        <p style="color: #ccc;"><strong>Email:</strong> ${userData.email}</p>
        <p style="color: #ccc;"><strong>Username:</strong> ${userData.username}</p>
      `;
    } else if (type === 'history') {
      content.innerHTML = `<h2 style="color: #fff;">📜 Booking History</h2><p style="color: #ccc;">(Coming soon...)</p>`;
    } else if (type === 'settings') {
      content.innerHTML = `<h2 style="color: #fff;">⚙️ Settings</h2><p style="color: #ccc;">(Customize your experience...)</p>`;
    }

    panel.style.right = '0';
  }

  function closePanel() {
    document.getElementById('slidePanel').style.right = '-400px';
  }
</script>


</body>
</html>
