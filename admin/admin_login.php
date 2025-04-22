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
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      overflow: hidden;
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
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(4px);
      border: 1px solid rgba(255, 255, 255, 0.15);
      box-shadow: 0 0 15px rgba(0, 255, 255, 0.2);
      border-radius: 16px;
      padding: 40px 30px;
      width: 320px;
      color: white;
    }

    h2 {
      text-align: center;
      margin-bottom: 40px;
      margin-top: -10px;
      font-weight: 600;
      font-size: 32px;
      color: #00f5ff;
      /* text-shadow: 0 0 10px #00f5ff99; */
    }

    input[type="text"],
    input[type="password"] {
      width: 93%;
      padding: 12px;
      margin-bottom: 20px;
      border: none;
      border-radius: 8px;
      background: rgba(255, 255, 255, 0.1);
      color: #fff;
      outline: none;
      font-size: 14px;
    }

    input[type="submit"] {
      background: linear-gradient(145deg, #00f5ff, #e600ff);
      color: #fff;
      border: none;
      padding: 12px;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
      width: 100%;
      transition: 0.3s;
    }

    input[type="submit"]:hover {
      background: linear-gradient(145deg, #e600ff, #00f5ff);
      transform: scale(1.03);
    }

    .error {
      color: #ff5555;
      text-align: center;
      margin-top: 15px;
      font-weight: bold;
      text-shadow: 0 0 5px red;
    }
  </style>
</head>
<body>

<!-- <div class="animated-bg"></div> -->

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
