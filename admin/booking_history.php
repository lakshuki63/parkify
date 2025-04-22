<?php
$mysqli = new mysqli("localhost", "root", "", "parkify");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch unique areas
$areas = [];
$area_query = $mysqli->query("SELECT DISTINCT area FROM parkingspots");
while ($row = $area_query->fetch_assoc()) {
    $areas[] = $row['area'];
}

// Fetch unique usernames
$usernames = [];
$user_query = $mysqli->query("SELECT DISTINCT user_name FROM booking_history");
while ($row = $user_query->fetch_assoc()) {
    $usernames[] = $row['user_name'];
}

// Get selected filters
$selected_area = isset($_GET['area']) ? $_GET['area'] : '';
$selected_user = isset($_GET['user_name']) ? $_GET['user_name'] : '';

// Dynamic query
$query = "SELECT * FROM booking_history WHERE 1=1";
$params = [];
$types = "";

if (!empty($selected_area)) {
    $query .= " AND area = ?";
    $params[] = $selected_area;
    $types .= "s";
}

if (!empty($selected_user)) {
    $query .= " AND user_name = ?";
    $params[] = $selected_user;
    $types .= "s";
}

$stmt = $mysqli->prepare($query);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Booking History</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #000;
      margin: 0;
      padding: 0;
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
      background-color: #34495e;
      color: white;
      padding: 20px;
      text-align: center;
    }

    .container {
      padding: 30px;
    }

    form {
      margin-bottom: 20px;
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 15px;
    }

    select, button {
      padding: 10px;
      font-size: 16px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: white;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    th, td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #2ecc71;
      color: white;
    }

    tr:hover {
      background-color: #f1f1f1;
    }
  </style>
</head>
<body>

<header>Booking History - Filter by Area & Username</header>
<a href="admin_panel.php" style="display: inline-block; margin-bottom: 20px; text-decoration: none;">
  <button style="padding: 10px 20px; font-size: 16px; background-color: #3498db; color: white; border: none; border-radius: 5px; cursor: pointer;">
    ← Back to Admin Panel
  </button>
</a>

<div class="container">

  <form method="GET" action="booking_history.php">
    <label><strong>Area:</strong></label>
    <select name="area">
      <option value="">-- All Areas --</option>
      <?php foreach ($areas as $area): ?>
        <option value="<?= $area ?>" <?= $selected_area == $area ? 'selected' : '' ?>>
          <?= htmlspecialchars($area) ?>
        </option>
      <?php endforeach; ?>
    </select>

    <label><strong>User:</strong></label>
    <select name="user_name">
      <option value="">-- All Users --</option>
      <?php foreach ($usernames as $user): ?>
        <option value="<?= $user ?>" <?= $selected_user == $user ? 'selected' : '' ?>>
          <?= htmlspecialchars($user) ?>
        </option>
      <?php endforeach; ?>
    </select>

    <button type="submit">Search</button>
  </form>

  <table>
    <tr>
      <th>User ID</th>
      <th>User</th>
      <th>Parking Area ID</th>
      <th>Slot No</th>
      <th>Date</th>
      <th>Booking Time</th>
      <th>Area</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
      <tr>
        <td><?= $row['user_id']; ?></td>
        <td><?= $row['user_name']; ?></td>
        <td><?= $row['area_id']; ?></td>
        <td><?= $row['slot_number']; ?></td>
        <td><?= $row['booking_date']; ?></td>
        <td><?= $row['booking_time']; ?></td>
        <td><?= $row['area']; ?></td>
      </tr>
    <?php } ?>
  </table>

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
