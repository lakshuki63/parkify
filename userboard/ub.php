<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard with Sliding Panel</title>
  <link rel="stylesheet" href="ub.css">
</head>
<body>

<a href="userDashboardMap.php">
  <button>Go map and search for nearby parking areas</button>
</a>
  <div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="menu-item" onclick="openPanel('personal')">👤</div>
      <div class="menu-item" onclick="openPanel('history')">📜</div>
      <div class="menu-item" onclick="openPanel('settings')">⚙️</div>
    </div>

    <!-- Overlay Panel -->
    <div class="overlay" id="overlay" onclick="closePanel()"></div>

    <!-- Sliding Panel -->
    <div class="slide-panel" id="slidePanel">
      <span class="close-btn" onclick="closePanel()">×</span>
      <div id="panelContent">
        <h2>Welcome!</h2>
        <p>Select an option from the sidebar.</p>
      </div>
    </div>
  </div>

  <script src="ub.js"></script>
</body>
</html>
