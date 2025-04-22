<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin = $_POST['admin'];
    $password = $_POST['password'];

    if ($admin === "farziies" && $password === "1234") {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_panel.php");
        exit();
    } else {
        $error = "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #000;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
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

    .login-box {
      background-color: white;
      padding: 30px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.2);
      border-radius: 8px;
      width: 300px;
    }

    h2 {
      text-align: center;
      color: #2c3e50;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin: 10px 0 20px;
      border: 1px solid #bdc3c7;
      border-radius: 4px;
    }

    input[type="submit"] {
      background-color:rgb(0, 174, 248);
      color: white;
      padding: 10px;
      border: none;
      width: 100%;
      border-radius: 4px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #219150;
    }

    .error {
      color: red;
      text-align: center;
    }
  </style>
</head>
<body>

<div class="login-box">
  <h2>Admin Login</h2>
  <form method="POST">
    <input type="text" name="admin" placeholder="Admin username" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="submit" value="Go">
  </form>
  <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
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
