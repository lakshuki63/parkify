<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../registration/register.php");
    exit();
}

$username = $_SESSION['username'];

// Connect to database
$conn = new mysqli("localhost", "root", "", "parkify");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$slot = $_GET['slot'] ?? '';
$area = $_GET['area'] ?? '';
$city = $_GET['city'] ?? '';
$parkingName = $_GET['name'] ?? '';
$date = $_GET['date'] ?? '';

// Fetch user and booking details
$sql = "
SELECT 
    u.firstName, 
    u.lastName, 
    u.phoneNo, 
    u.email, 
    u.carNumber, 
    bh.booking_date, 
    bh.booking_time, 
    bh.slot_number, 
    ps.name AS parking_name, 
    ps.area AS parking_area, 
    ps.city 
FROM user_form u
LEFT JOIN booking_history bh ON bh.username = u.username
LEFT JOIN parkingspots ps ON bh.area_name = ps.name
WHERE u.username = ?
ORDER BY bh.booking_time DESC LIMIT 1";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("SQL error: " . $conn->error);
}
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();

    $fullName = $row['firstName'] . " " . $row['lastName'];
    $phone = $row['phoneNo'];
    $email = $row['email'];
    $carNumber = $row['carNumber'];
    $bookingTime = $row['booking_time'];

   

    // Time slot mapping
    function getTimeSlot($slot) {
        $slots = [
            1 => "7:00 AM – 8:00 AM",
            2 => "8:00 AM – 9:00 AM",
            3 => "9:00 AM – 10:00 AM",
            4 => "10:00 AM – 11:00 AM",
            5 => "11:00 AM – 12:00 PM",
            6 => "12:00 PM – 1:00 PM",
            7 => "1:00 PM – 2:00 PM",
            8 => "2:00 PM – 3:00 PM",
            9 => "3:00 PM – 4:00 PM",
            10 => "4:00 PM – 5:00 PM",
            11 => "5:00 PM – 6:00 PM"
        ];
        return $slots[$slot] ?? "Unknown Slot";
    }

    $timeSlotText = getTimeSlot($slot);
} else {
    echo "User or booking details not found.";
    exit();
}
$slotNumber = $_POST['slot'] ?? $_GET['slot'] ?? null;
$date = $_POST['date'] ?? $_GET['date'] ?? null;
$area_id = $_POST['area_id'] ?? $_GET['area_id'] ?? null;



$slotNumber = intval($slotNumber);
$area_id = intval($area_id);
$slotColumn = "slot" . $slotNumber;

// Validate slot column
$allowedSlots = ["slot1", "slot2", "slot3", "slot4", "slot5", "slot6", "slot7", "slot8", "slot9", "slot10", "slot11"];
if (!in_array($slotColumn, $allowedSlots)) {
    die("Invalid slot selected.");
}

$area_id = $_POST['area_id'] ?? $_GET['area_id'] ?? null;

$check = $conn->prepare("SELECT $slotColumn FROM daily_slot_availability WHERE area_id = ? AND date = ?");
if (!$check) {
    die("Query failed: " . $conn->error);
}
$check->bind_param("is", $area_id, $date);
$check->execute();
$result = $check->get_result();
$row = $result->fetch_assoc();

if ($row && $row[$slotColumn] > 0) {
    $update = $conn->prepare("UPDATE daily_slot_availability SET $slotColumn = $slotColumn - 1 WHERE area_id = ? AND date = ?");
    $update->bind_param("is", $area_id, $date);
    if ($update->execute()) {
        echo "✅ Slot $slotNumber booked for $date.";
    } else {
        echo "❌ Failed to update slot.";
    }
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Booking Page - Parkify</title>
  <link rel="stylesheet" href="booking.css">
  <link href="https://fonts.googleapis.com/css2?family=Bahnschrift&display=swap" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="session-info">
      🚘 Logged in as: <strong><?php echo htmlspecialchars($username); ?></strong>
    </div>

    <div class="glass-card">
      <h2>Book Your Parking Slot</h2>

      <form method="POST" action="invoice.php">
        <label>Username:</label>
        <input type="text" name="username" value="<?= htmlspecialchars($username) ?>" readonly>

        <label>Full Name:</label>
        <input type="text" name="fullname" value="<?= htmlspecialchars($fullName) ?>" readonly>

        <label>Email:</label>
        <input type="text" name="email" value="<?= htmlspecialchars($email) ?>" readonly>

        <label>Phone:</label>
        <input type="text" name="phone" value="<?= htmlspecialchars($phone) ?>" readonly>

        <label>Car Number:</label>
        <input type="text" name="car_number" value="<?= htmlspecialchars($carNumber) ?>" readonly>

        <label>Parking Spot:</label>
        <input type="text" name="parking_name" value="<?= htmlspecialchars($parkingName) ?>" readonly>

        <label>Area:</label>
        <input type="text" name="area" value="<?= htmlspecialchars($area) ?>" readonly>

        <label>City:</label>
        <input type="text" name="city" value="<?= htmlspecialchars($city) ?>" readonly>

        <label>Slot Number:</label>
        <input type="text" name="slot" value="<?= htmlspecialchars($slot) ?>" readonly>

        <label>Time Slot:</label>
        <input type="text" name="time_slot_text" value="<?= htmlspecialchars($timeSlotText) ?>" readonly>

        <label>Booking Date:</label>
        <input type="text" name="date" value="<?= htmlspecialchars($date) ?>" readonly>

        

        <button type="submit">✅ Confirm Booking</button>
      </form>
    </div>
  </div>
  <canvas id="particles"></canvas>
    <div class="animated-bg"></div>
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

        initParticles(500);
        animate();
    </script>
</body>
</html>
