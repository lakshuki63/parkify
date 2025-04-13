<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Smart Car Parking</title>
  <link rel="stylesheet" href="ub.css">
  <script src="ub.js" defer></script>
  <style>
    .hero {
      text-align: center;
      padding-top: 120px;
      max-width: 700px;
      margin: auto;
      z-index: 1;
      position: relative;
    }

    .hero h1 {
  color: #00ffff;
  font-family: 'Times New Roman', Times, serif;
  font-size: 3rem;
  text-align: center;
  text-shadow:
    0 0 5px #00ffff,
    0 0 10px #00ffff,
    0 0 20px #00ffff,
    0 0 30px #00ffff;
  animation: glowPulse 2s ease-in-out infinite alternate;
}

@keyframes glowPulse {
  0% {
    text-shadow: 0 0 5px #00ffff, 0 0 10px #00ffff, 0 0 20px #00ffff;
  }
  50% {
    text-shadow: 0 0 20px #00ffff, 0 0 30px #00ffff, 0 0 40px #00ccff;
  }
  100% {
    text-shadow: 0 0 5px #00ffff, 0 0 10px #00ffff, 0 0 20px #00ffff;
  }
}

    .hero p {
      font-size: 22px;
      font-family: Georgia, 'Times New Roman', Times, serif;
      color: #ddd;
      margin-bottom: 40px;
    }

    .fade-in {
      opacity: 0;
      transform: translateY(20px);
      animation: fadeInUp 1.2s ease forwards;
    }

    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }


    html, body {
      height: 100%;
    }
  </style>
</head>
<body>


  <div id="overlay" class="overlay" onclick="closePanel()"></div>
  <div id="slidePanel" class="slide-panel">
    <span class="close-btn" onclick="closePanel()">×</span>
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
    <a href="userDashboardMap.php" class="map-button">Find a Parking Slot</a>
  </div>

</body>
</html>
