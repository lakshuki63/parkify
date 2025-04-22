<?php
session_start();
$conn = new mysqli("localhost", "root", "", "parkify");

// Make sure user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ub1.php");
    exit();
}

$username = $_SESSION['username'];

// Fetch current user data
$sql = "SELECT * FROM user_form WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Handle update
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phoneNo = $_POST['phoneNo'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $carNumber = $_POST['carNumber'];

    $update_sql = "UPDATE user_form SET username= ?, email = ?, firstName = ?, lastName = ?, phoneNo = ?, address1 = ?, address2 = ?, carNumber = ? WHERE username = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssssssss", $name, $email, $firstName, $lastName, $phoneNo, $address1, $address2, $carNumber, $username);
    $update_stmt->execute();

    echo "<script>alert('Profile updated successfully!'); window.location.href='ub1.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
        /* === Spider Particle Background + Animated Gradient Background === */
        body {
        margin: 0;
        font-family: 'Poppins', sans-serif;
        background: #000;
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        color: #eee;
        overflow-x: hidden;
        position: relative;
        }


        .form-box {
            max-width: 400px;
            background-color: white;
            padding: 30px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-box h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"], 
        input[type="email"], 
        input[type="phone"], 
        input[type="carNumber"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #27ae60;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #219150;
        }

        .form-box .input-field {
            margin-bottom: 15px;
        }
        #particles {
        position: fixed;
        top: 0;
        left: 0;
        z-index: -1;
        width: 100%;
        height: 100%;
        pointer-events: none;
        }
    </style>
</head>
<body>

<div class="form-box">
    <h2>Edit Your Profile</h2>
    <form method="POST">
        <div class="input-field">
            <label for="name">Name:</label>
            <input type="text" id="name" name="username" value="<?= $user['username'] ?>" required>
        </div>

        <div class="input-field">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= $user['email'] ?>" required>
        </div>

        <div class="input-field">
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" value="<?= $user['firstName'] ?>" required>
        </div>

        <div class="input-field">
            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" value="<?= $user['lastName'] ?>" required>
        </div>

        <div class="input-field">
            <label for="phoneNo">Phone Number:</label>
            <input type="text" id="phoneNo" name="phoneNo" value="<?= $user['phoneNo'] ?>" required>
        </div>

        <div class="input-field">
            <label for="address1">Address 1:</label>
            <input type="text" id="address1" name="address1" value="<?= $user['address1'] ?>" required>
        </div>

        <div class="input-field">
            <label for="address2">Address 2:</label>
            <input type="text" id="address2" name="address2" value="<?= $user['address2'] ?>" required>
        </div>

        <div class="input-field">
            <label for="carNumber">Car Number:</label>
            <input type="text" id="carNumber" name="carNumber" value="<?= $user['carNumber'] ?>" required>
        </div>

        <input type="submit" value="Update Profile">
    </form>
</div>
<canvas id="particles"></canvas>
  <script>
  const canvas = document.getElementById('particles');
  const ctx = canvas.getContext('2d');
  let particles = [];
  let mouse = { x: null, y: null };

  function resizeCanvas() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
  }

  window.addEventListener('resize', resizeCanvas);
  resizeCanvas();

  document.addEventListener('mousemove', (e) => {
    mouse.x = e.clientX;
    mouse.y = e.clientY;
  });

  class Particle {
    constructor() {
      this.reset();
    }

    reset() {
      this.x = Math.random() * canvas.width;
      this.y = Math.random() * canvas.height;
      this.size = Math.random() * 2 + 1;
      this.speedX = (Math.random() - 0.5) * 0.5;
      this.speedY = (Math.random() - 0.5) * 0.5;
      this.alpha = Math.random() * 0.5 + 0.3;
      this.color = ['#00f5ff', '#e600ff', '#7400ff'][Math.floor(Math.random() * 3)];
    }

    update() {
      this.x += this.speedX;
      this.y += this.speedY;

      // bounce
      if (this.x < 0 || this.x > canvas.width) this.speedX *= -1;
      if (this.y < 0 || this.y > canvas.height) this.speedY *= -1;
    }

    draw() {
      ctx.beginPath();
      ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
      ctx.fillStyle = this.color;
      ctx.globalAlpha = this.alpha;
      ctx.fill();
      ctx.globalAlpha = 1;
    }
  }

  function drawLines() {
    for (let i = 0; i < particles.length; i++) {
      for (let j = i + 1; j < particles.length; j++) {
        const dx = particles[i].x - particles[j].x;
        const dy = particles[i].y - particles[j].y;
        const distance = Math.sqrt(dx * dx + dy * dy);

        if (distance < 100) {
          ctx.beginPath();
          ctx.moveTo(particles[i].x, particles[i].y);
          ctx.lineTo(particles[j].x, particles[j].y);
          ctx.strokeStyle = 'rgba(255, 255, 255, 0.1)';
          ctx.lineWidth = 1;
          ctx.stroke();
        }
      }

      // line from particle to cursor
      if (mouse.x && mouse.y) {
        const dx = particles[i].x - mouse.x;
        const dy = particles[i].y - mouse.y;
        const dist = Math.sqrt(dx * dx + dy * dy);

        if (dist < 120) {
          ctx.beginPath();
          ctx.moveTo(particles[i].x, particles[i].y);
          ctx.lineTo(mouse.x, mouse.y);
          ctx.strokeStyle = 'rgba(0, 255, 255, 0.2)';
          ctx.lineWidth = 1;
          ctx.stroke();
        }
      }
    }
  }

  function initParticles(count) {
    particles = [];
    for (let i = 0; i < count; i++) {
      particles.push(new Particle());
    }
  }

  function animate() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    particles.forEach(p => {
      p.update();
      p.draw();
    });
    drawLines();
    requestAnimationFrame(animate);
  }

  initParticles(250);
  animate();
</script>

</body>
</html>
