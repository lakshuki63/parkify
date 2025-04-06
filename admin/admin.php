<!DOCTYPE html>
<html>
<head>
  <title>Admin Add Parking</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <style>
    #map { height: 400px; }
    form { margin-top: 10px; }
    input, button { display: block; margin: 5px 0; padding: 5px; width: 100%; }
  </style>
</head>
<body>
  <h2>Click on the map to add a parking spot</h2>
  <div id="map"></div>

  <form id="parkingForm">
    <input type="text" name="name" placeholder="Parking Name" required />
    <input type="text" name="city" placeholder="City" required />
    <input type="text" name="area" placeholder="Area" required />
    <input type="number" name="total_slots" placeholder="Total Slots" required />
    <input type="number" name="available_slots" placeholder="Available Slots" required />
    <input type="hidden" name="lat" />
    <input type="hidden" name="lon" />
    <button type="submit">Add Parking Spot</button>
  </form>

  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script>
    const map = L.map('map').setView([20.5937, 78.9629], 5); // Centered on India

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    let marker;

    map.on('click', function(e) {
      const { lat, lng } = e.latlng;
      document.querySelector('[name="lat"]').value = lat;
      document.querySelector('[name="lon"]').value = lng;

      if (marker) {
        marker.setLatLng(e.latlng);
      } else {
        marker = L.marker(e.latlng).addTo(map);
      }
    });

    document.getElementById('parkingForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const formData = new FormData(this);

      fetch('add_parking.php', {
        method: 'POST',
        body: formData
      })
      .then(res => res.text())
      .then(msg => {
        alert(msg);
        this.reset();
        if (marker) map.removeLayer(marker);
      });
    });
  </script>
</body>
</html>
