<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Admin Add Parking</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: 'Inter', sans-serif;
      background: linear-gradient(-45deg, #080707, #1a0a2d, #001f3f, #0b0017);
      background-attachment: fixed;
      color: #fff;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 30px 20px;
      min-height: 100vh;
    }


    h2 {
      margin-bottom: 20px;
      font-size: 28px;
      text-align: center;
      animation: fadeInDown 1s ease;
      text-shadow: 0 0 8px rgba(255, 255, 255, 0.3);
    }

    #map {
      height: 400px;
      width: 100%;
      max-width: 1000px;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4), 0 0 12px rgba(173, 216, 230, 0.3);
      animation: fadeIn 1.2s ease;
    }

    form {
      margin-top: 30px;
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 20px;
      padding: 25px 30px;
      width: 100%;
      max-width: 500px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3), 0 0 10px rgba(255, 255, 255, 0.1);
      animation: fadeInUp 1.2s ease;
    }

    input,
    button {
      display: block;
      margin: 12px 0;
      padding: 12px 16px;
      border-radius: 10px;
      width: 100%;
      border: none;
      font-size: 16px;
      font-family: inherit;
      transition: all 0.3s ease;
    }

    input {
      background: rgba(255, 255, 255, 0.15);
      color: #fff;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    input::placeholder {
      color: #ddd;
      opacity: 0.8;
    }

    input:focus {
      outline: none;
      background: rgba(255, 255, 255, 0.25);
      transform: scale(1.02);
      box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
    }

    button {
      background: linear-gradient(135deg, #56ab2f, #a8e063);
      color: #000;
      font-weight: bold;
      cursor: pointer;
      box-shadow: 0 0 20px rgba(76, 175, 80, 0.4);
      animation: pulse 2s infinite ease-in-out;
    }

    button:hover {
      transform: scale(1.05);
      box-shadow: 0 0 25px rgba(144, 238, 144, 0.6);
    }

    /* Animations */
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: scale(0.98);
      }

      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    @keyframes fadeInDown {
      from {
        opacity: 0;
        transform: translateY(-30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes pulse {
      0% {
        box-shadow: 0 0 0 0 rgba(144, 238, 144, 0.4);
      }

      70% {
        box-shadow: 0 0 0 12px rgba(144, 238, 144, 0);
      }

      100% {
        box-shadow: 0 0 0 0 rgba(144, 238, 144, 0);
      }
    }

    @media (max-width: 600px) {
      #map {
        height: 300px;
      }

      form {
        padding: 20px;
      }

      h2 {
        font-size: 24px;
      }
    }
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
    <button type="submit">➕ Add Parking Spot</button>
  </form>

  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script>
    const map = L.map('map').setView([20.5937, 78.9629], 5); // Centered on India

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    let marker;

    map.on('click', function(e) {
      const {
        lat,
        lng
      } = e.latlng;
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