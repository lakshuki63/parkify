<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Panel</title>
  <link rel="stylesheet" href="ub.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>

<a href="userDashboardMap.php" class="map-button">
  🚗 Search Nearby Parking
</a>

<div class="dashboard-wrapper">
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="menu-item" onclick="openPanel('personal')" title="Profile">👤</div>
    <div class="menu-item" onclick="openPanel('history')" title="History">📜</div>
    <div class="menu-item" onclick="openPanel('settings')" title="Settings">⚙️</div>
  </div>

  <!-- Overlay -->
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
