<?php
// Start session
session_start();
$conn = new mysqli("localhost", "root", "", "parkify");



// Check if the button was clicked and process the query
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add_slots'])) {
    // Get the selected date from the form
    $new_date = $_POST['new_date'];

    // SQL query to add the slots for the new date
    $set_sql = "SET @new_date = ?";
    $insert_sql = "
        INSERT INTO daily_slot_availability (
            area_id, date,
            slot1, slot2, slot3, slot4, slot5, slot6,
            slot7, slot8, slot9, slot10, slot11
        )
        SELECT 
            id, @new_date,
            total_slots, total_slots, total_slots, total_slots, total_slots, total_slots,
            total_slots, total_slots, total_slots, total_slots, total_slots
        FROM parkingspots
        WHERE id NOT IN (
            SELECT area_id FROM daily_slot_availability WHERE date = @new_date
        );
    ";

    // First, execute the SET statement
    if ($stmt = $conn->prepare($set_sql)) {
        $stmt->bind_param("s", $new_date);
        $stmt->execute();
        $stmt->close();
    }

    // Then, execute the INSERT statement
    if ($stmt = $conn->prepare($insert_sql)) {
        if ($stmt->execute()) {
            echo "<script>alert('Slots added successfully for $new_date!');</script>";
        } else {
            echo "<script>alert('Error: Could not add slots for $new_date.');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('SQL preparation failed.');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel - Smart Parking</title>
  <style>
      body {
        margin: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #000;
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
    .animated-bg {
      position: fixed;
      top: 0;
      left: 0;
      z-index: -10;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle at 20% 30%, #00f5ff88 0%, transparent 40%),
                  radial-gradient(circle at 70% 60%, #e600ff88 0%, transparent 40%),
                  radial-gradient(circle at 40% 80%, #ff000066 0%, transparent 40%);
      animation: moveGradient 15s infinite linear;
      filter: blur(100px);
      opacity: 0.7;
    }

    @keyframes moveGradient {
      0% { transform: translate(0, 0) scale(1); }
      50% { transform: translate(-25%, -25%) scale(1.2); }
      100% { transform: translate(0, 0) scale(1); }
    }
    header {
      background-color:rgba(44, 62, 80, 0);
      color: white;
      padding: 20px;
      text-align: center;
      font-size: 24px;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 80vh;
    }

    .panel {
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(15px);
      border: 1px solid rgba(255, 255, 255, 0.15);
      box-shadow: 0 0 15px rgba(0, 255, 255, 0.2);
      border-radius: 16px;
      padding: 40px 30px;
      width: 320px;
      color: white;
    }

    .panel h2 {
      margin-bottom: 25px;
      color: #333;
    }
    h1{
      text-align: center;
    margin-bottom: 25px;
    font-weight: 600;
    font-size: 2em;
    color: #00f5ff;
    text-shadow: 0 0 10px #00f5ff99;
    }

    #new_date{
      width: auto;
      margin-top: 10px;
      margin-left: 20px;
      margin-right: 20px;
      flex: 1;
      padding: 10px;
      border-radius: 10px;
      border: none;
    font-size: 17px;
    background: rgba(0, 0, 0, 0.4);
    color: rgb(255, 255, 255);
    box-shadow: 0 0 10px #0ff;
    }

    #date{
      display: flex;
      align-items: center;
    }

    #date_label {
      color: #0ff;
      font-size: 16px;
      margin-bottom: 10px;
      margin-left: 25px;
      text-align: center;
      font-weight: 500;
    }

    #add{
      display: block;
    margin-bottom: 10px;
    font-size: 18px;
    color: rgb(255, 0, 0);
    margin-left: 25px;
    margin-right: 25px;
    }

    .btn {
      display: block;
      width: 220px;
      margin: 15px auto;
      padding: 14px;
      background-color: #3498db;
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s;
      text-decoration: none;
    }
    .btn2 {
      display: block;
      width: 100px;
      margin: -2px auto;
      margin-bottom: 27px;
      padding: 14px;
      background-color:rgb(0, 248, 132);
      color: black;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s;
      text-decoration: none;
    }
    .btn2:hover {
      background-color:rgb(3, 78, 18);
      color:white;
    }

    .btn:hover {
      background-color:rgb(10, 36, 53);
      
    }
  </style>
</head>
<body>
<div class="animated-bg"></div>


  <header>Admin Panel</header>

  

  <div class="container">
    <div class="panel">
      <h1>Choose an Action</h1>
      <div class="form-box">
      <div id="add"><b>Add Parking Slots for New Date</b></div>
    <form method="POST">
            <label for="new_date" id="date_label">Select Date:</label>
            <br>
            <div id="date"><input type="date" id="new_date" name="new_date" required></div>
            <br>
            <input  class="btn2" type="submit" name="add_slots" value="Add Slots">
    </form>
</div>

      <a href="all_users.php" class="btn">All Users</a>
      <a href="admin.php" class="btn">Add Parking Slot</a>
      <a href="booking_history.php" class="btn">Show Booking History</a>
      <a href="statistics.php" class="btn">Statistics</a>
    </div>
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
