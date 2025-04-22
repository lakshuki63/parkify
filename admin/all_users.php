<?php
$mysqli = new mysqli("localhost", "root", "", "parkify");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$result = $mysqli->query("SELECT * FROM user_form");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All Users</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
      background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
      color: white;
      overflow-x: hidden;
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

    header {
      text-align: center;
      font-size: 28px;
      font-weight: bold;
      padding: 25px 0;
      background: rgba(0, 0, 0, 0.3);
      backdrop-filter: blur(0px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .container {
      max-width: 95%;
      margin: 30px auto;
      background: rgba(255, 255, 255, 0.05);
      border-radius: 16px;
      padding: 25px;
      backdrop-filter: blur(3px);
      box-shadow: 0 4px 30px rgba(0, 0, 0, 0.4);
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      border-radius: 10px;
      overflow: hidden;
    }

    th, td {
      padding: 14px 12px;
      text-align: left;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      color: #f0f0f0;
    }

    th {
      background: rgba(0, 255, 255, 0.1);
      font-weight: 600;
    }

    tr:hover {
      background-color: rgba(255, 255, 255, 0.05);
    }

    .edit-btn {
      background: rgba(0, 255, 255, 0.1);
      color: cyan;
      padding: 8px 14px;
      border-radius: 8px;
      text-decoration: none;
      transition: all 0.2s ease;
      border: 1px solid cyan;
    }

    .edit-btn:hover {
      background: rgba(0, 255, 255, 0.2);
      box-shadow: 0 0 10px cyan;
    }

    .back-btn {
      display: inline-block;
      margin: 16px auto;
      margin-bottom: 7px;
      padding: 10px 22px;
      font-size: 16px;
      background-color: rgba(0, 255, 255, 0.1);
      color: cyan;
      border: 1px solid cyan;
      border-radius: 8px;
      cursor: pointer;
      transition: 0.3s ease;
      text-decoration: none;
      text-align: center;
    }

    .back-btn:hover {
      background-color: rgba(0, 255, 255, 0.2);
      box-shadow: 0 0 10px cyan;
    }
  </style>
</head>
<body>
<canvas id="particles"></canvas>

<header>All Registered Users</header>

<div style="text-align: center;">
  <a href="admin_panel.php" class="back-btn">← Back to Admin Panel</a>
</div>

<div class="container">
  <table>
    <tr>
      <th>ID</th>
      <th>Username</th>
      <th>Email</th>
      <th>Phone</th>
      <th>State</th>
      <th>City</th>
      <th>Address 1</th>
      <th>Address 2</th>
      <th>Car Number</th>
      <th>Created Date</th>
      <th>Edit</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
      <tr>
        <td><?= $row['id']; ?></td>
        <td><?= htmlspecialchars($row['username']); ?></td>
        <td><?= htmlspecialchars($row['email']); ?></td>
        <td><?= htmlspecialchars($row['phoneNo']); ?></td>
        <td><?= htmlspecialchars($row['state']); ?></td>
        <td><?= htmlspecialchars($row['city']); ?></td>
        <td><?= htmlspecialchars($row['address1']); ?></td>
        <td><?= htmlspecialchars($row['address2']); ?></td>
        <td><?= htmlspecialchars($row['carNumber']); ?></td>
        <td><?= htmlspecialchars($row['created_at']); ?></td>
        <td><a href="edit_user.php?id=<?= $row['id']; ?>" class="edit-btn">Edit</a></td>
      </tr>
    <?php } ?>
  </table>
</div>

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
          ctx.strokeStyle = 'rgba(255, 255, 255, 0.05)';
          ctx.lineWidth = 1;
          ctx.stroke();
        }
      }

      if (mouse.x && mouse.y) {
        const dx = particles[i].x - mouse.x;
        const dy = particles[i].y - mouse.y;
        const dist = Math.sqrt(dx * dx + dy * dy);

        if (dist < 120) {
          ctx.beginPath();
          ctx.moveTo(particles[i].x, particles[i].y);
          ctx.lineTo(mouse.x, mouse.y);
          ctx.strokeStyle = 'rgba(0, 255, 255, 0.1)';
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

  initParticles(200);
  animate();
</script>
</body>
</html>
