<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Parkify Login</title>
  <link rel="stylesheet" href="reg.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  />
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Michroma&display=swap" rel="stylesheet">
 
</head>
<body>
<div class="animated-bg"></div>

  <div class="top">
    <header class="hero">
      <!-- <div class="brand">
        <i class="fa-solid fa-car-side car-icon"></i>
        <h1 class="hero-title">Parkify</h1>
      </div>
      <p class="hero-subtitle">Smart, Effortless & Secure Parking, Anytime</p> -->
      <div class="logo-container">
    <img src="logo.png" class="logo-img" alt="Parkify Logo" />
  </div>
    </header>
    
  </div>
  <div class="car-radar-container">
    <span class="radar-ping"></span>
    
  </div>
  

  <form action="ifok.php" method="POST">
    <div class="box">
      <label for="userName">USERNAME:</label>
      <input type="text" name="userName" id="userName" placeholder="Enter Username" />

      <br /><br /><br />

      <label for="password">PASSWORD:</label>
      <input type="password" name="password" id="password" placeholder="Enter Password"/>

      <p><a href="..\forgetpassword page\fg.php">Forgot Password?</a></p>

      <button id="submit">SUBMIT</button>
    </div>

    <p class="signup">
      <span class="new">New User?</span>
      <a href="..\userName\userName.php" class="signup-link">Sign Up Here</a>
      <br />

    </p>
    <span class="or">Or login using</span>
    <div class="icon">
      <a href="https://google.com/" target="_blank"><i class="fa-brands fa-google" id="google"></i></a>
      <a href="https://facebook.com/" target="_blank"><i class="fa-brands fa-facebook" id="facebook"></i></a>
      <a href="https://apple.com/" target="_blank"><i class="fa-brands fa-apple" id="apple"></i></a>
    </div>
  </form>
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

  initParticles(200);
  animate();
</script>

</body>
</html>