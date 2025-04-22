<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Step 1: Save initial form data in session
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['card_number'])) {
    $_SESSION['booking'] = [
        'city' => $_POST['city'],
        'location' => $_POST['location'],
        'slot' => $_POST['slot'],
        'time' => $_POST['time'],
        'vehicle' => $_POST['vehicle'],
        'payment' => $_POST['payment'],
    ];
    // Show credit card form
    ?>
    <!DOCTYPE html>
    <html>
    <head>
      <title>Enter Card Details</title>
      <link rel="stylesheet" href="book.css">
    </head>
    <body>
      <div class="container">
        <h2>Payment Gateway</h2>
        <form method="POST" action="book.php">
          <label>Credit Card Number:</label>
          <input type="text" name="card_number" required>

          <label>PIN:</label>
          <input type="password" name="pin" required>

          <button type="submit">Pay</button>
        </form>
      </div>
    </body>
    </html>
    <?php
    exit;
}

// Step 2: On payment form submit, insert into database
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['card_number'])) {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "parkify";

    $conn = new mysqli($host, $user, $pass, $dbname);
    if ($conn->connect_error) {
        die("DB Connection Failed: " . $conn->connect_error);
    }

    $booking = $_SESSION['booking'];
    $city = $booking['city'];
    $location = $booking['location'];
    $slot = $booking['slot'];
    $time = $booking['time'];
    $vehicle = $booking['vehicle'];
    $payment = $booking['payment'];

    $sql = "INSERT INTO smart_parking (city, location, slot, time, vehicle, payment) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $city, $location, $slot, $time, $vehicle, $payment);

    if ($stmt->execute()) {
      session_destroy();
      ?>
      <!DOCTYPE html>
      <html>
      <head>
        <title>Booking Successful</title>
        <link rel="stylesheet" href="book.css">
        <style>
          canvas#confetti-canvas {
              position: fixed;
              top: 0;
              left: 0;
              width: 100%;
              height: 100%;
              pointer-events: none;
              z-index: 999;
          }
        </style>
      </head>
      <body>
        <canvas id="confetti-canvas"></canvas>
        <div class="container">
          <h2>✅ Booking Successful!</h2>
          <div class="success-box">
            <p><strong>City:</strong> <?= htmlspecialchars($city) ?></p>
            <p><strong>Location:</strong> <?= htmlspecialchars($location) ?></p>
            <p><strong>Slot:</strong> <?= htmlspecialchars($slot) ?></p>
            <p><strong>Time:</strong> <?= htmlspecialchars($time) ?></p>
            <p><strong>Vehicle:</strong> <?= htmlspecialchars($vehicle) ?></p>
            <p><strong>Payment Method:</strong> <?= htmlspecialchars($payment) ?></p>
            <a href="booking.php">Book Another Slot</a>
          </div>
        </div>
  
        <script>
          // Confetti generator
          const canvas = document.getElementById("confetti-canvas");
          const ctx = canvas.getContext("2d");
          let particles = [];
  
          function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
          }
  
          window.addEventListener("resize", resizeCanvas);
          resizeCanvas();
  
          function createParticle() {
            return {
              x: Math.random() * canvas.width,
              y: Math.random() * -canvas.height,
              speed: Math.random() * 3 + 2,
              radius: Math.random() * 6 + 4,
              color: `hsl(${Math.random() * 360}, 100%, 60%)`,
              tilt: Math.random() * 10 - 5,
              tiltAngle: 0,
              tiltSpeed: Math.random() * 0.1 + 0.05
            };
          }
  
          function drawParticle(p) {
            ctx.beginPath();
            ctx.lineWidth = p.radius / 2;
            ctx.strokeStyle = p.color;
            ctx.moveTo(p.x + p.tilt, p.y);
            ctx.lineTo(p.x + p.tilt + p.radius / 2, p.y + p.radius);
            ctx.stroke();
          }
  
          function updateParticle(p) {
            p.y += p.speed;
            p.tiltAngle += p.tiltSpeed;
            p.tilt = Math.sin(p.tiltAngle) * 15;
  
            if (p.y > canvas.height) {
              Object.assign(p, createParticle());
              p.y = -10;
            }
          }
  
          function loop() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            particles.forEach(p => {
              updateParticle(p);
              drawParticle(p);
            });
            requestAnimationFrame(loop);
          }
  
          for (let i = 0; i < 150; i++) {
            particles.push(createParticle());
          }
  
          loop();
        </script>
      </body>
      </html>
      <?php
  }
  
else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
