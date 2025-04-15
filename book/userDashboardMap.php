<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Filtered Parking Map - Parkify</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <style>
    /* === BACKGROUND & BODY === */
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(-45deg, #000000, #1f0033, #000814, #220044);
      background-size: 400% 400%;
      animation: bgMove 15s ease infinite;
      color: #eee;
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;
    }

    @keyframes bgMove {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    /* === HEADER === */
    h2 {
      text-align: center;
      margin-top: 30px;
      font-size: 2rem;
      color: #00eaff;
      font-weight: bold;
      text-shadow: 0 0 8px rgba(0, 234, 255, 0.5);
    }

    /* === SELECT DROPDOWNS === */
    select {
  padding: 10px 16px;
  margin: 10px 8px;
  background: rgba(255, 255, 255, 0.05);
  color: #fff;
  border: 1px solid #00eaff;
  border-radius: 8px;
  outline: none;
  backdrop-filter: blur(5px);
  font-weight: 500;
  box-shadow: 0 0 12px rgba(0, 234, 255, 0.3);
  transition: all 0.3s ease;
  /** ADD THIS LINE **/
  background-color: #111; /* dark bg so text stays visible */
}


    select:hover {
      transform: scale(1.03);
      box-shadow: 0 0 16px rgba(0, 234, 255, 0.5);
    }

    /* === MAP CONTAINER === */
    #map {
      width: 90%;
      max-width: 1000px;
      height: 500px;
      margin: 30px 0 60px;
      border-radius: 20px;
      overflow: hidden;
      border: 2px solid #00eaff;
      box-shadow: 0 0 20px rgba(0, 234, 255, 0.4);
    }

    /* === LEAFLET DEFAULTS OVERRIDE === */
    .leaflet-popup-content-wrapper {
      background: rgba(0, 0, 0, 0.8);
      color: #00eaff;
      font-size: 14px;
      font-weight: 500;
      border-radius: 10px;
      backdrop-filter: blur(5px);
    }

    .leaflet-popup-tip {
      background: rgba(0, 0, 0, 0.8);
    }

    a {
      color: #00d4ff;
      text-decoration: underline;
    }

    a:hover {
      color: #ff00ff;
    }
  </style>
</head>
<body>
  <h2>Find Parking by State, City, and Area</h2>

  <div>
    <select id="stateSelect">
      <option value="">-- Select State --</option>
    </select>

    <select id="citySelect">
      <option value="">-- Select City --</option>
    </select>

    <select id="areaSelect">
      <option value="">-- Select Area --</option>
    </select>
  </div>

  <div id="map"></div>

  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script>
    const stateSelect = document.getElementById("stateSelect");
    const citySelect = document.getElementById("citySelect");
    const areaSelect = document.getElementById("areaSelect");

    const map = L.map('map').setView([20.5937, 78.9629], 5);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    fetch("https://api.npoint.io/07b0da5498305e48d161")
      .then(response => response.json())
      .then(data => {
        for (const state in data) {
          const option = document.createElement("option");
          option.value = state;
          option.textContent = state;
          stateSelect.appendChild(option);
        }

        stateSelect.addEventListener("change", () => {
          const selectedState = stateSelect.value;
          citySelect.innerHTML = '<option value="">-- Select City --</option>';
          areaSelect.innerHTML = '<option value="">-- Select Area --</option>';

          if (data[selectedState]) {
            const cities = data[selectedState];
            for (const city in cities) {
              const option = document.createElement("option");
              option.value = city;
              option.textContent = city;
              citySelect.appendChild(option);
            }
          }
        });

        citySelect.addEventListener("change", () => {
          const selectedState = stateSelect.value;
          const selectedCity = citySelect.value;
          areaSelect.innerHTML = '<option value="">-- Select Area --</option>';

          const areas = data[selectedState]?.[selectedCity];
          if (areas) {
            const allOpt = document.createElement("option");
            allOpt.value = "all";
            allOpt.textContent = "All Areas";
            areaSelect.appendChild(allOpt);

            areas.forEach(area => {
              const option = document.createElement("option");
              option.value = area;
              option.textContent = area;
              areaSelect.appendChild(option);
            });
          }
        });

        areaSelect.addEventListener("change", () => {
          const city = citySelect.value;
          const area = areaSelect.value;
          const state = stateSelect.value;
          if (city && area) {
            loadMarkers(city, area, state);
          }
        });
      });

    function loadMarkers(city = "", area = "", state = "") {
      const url = (city && area && area !== "all")
        ? `get_filtered_parking.php?state=${state}&city=${city}&area=${area}`
        : 'get_all_parking.php';

      fetch(url)
        .then(res => res.json())
        .then(data => {
          map.eachLayer(layer => {
            if (layer instanceof L.Marker) {
              map.removeLayer(layer);
            }
          });

          if (data.length > 0 && data[0].lat && data[0].lon) {
            map.setView([data[0].lat, data[0].lon], 14);
          }

          data.forEach(p => {
            const marker = L.marker([p.lat, p.lon]).addTo(map);
            const popupContent = `
              <b>${p.name}</b><br>
              ${p.area}, ${p.city}<br>
              Available: ${p.available_slots}/${p.total_slots}<br>
              <a href="../booking/booking.php?name=${encodeURIComponent(p.name)}&city=${encodeURIComponent(p.city)}&area=${encodeURIComponent(p.area)}&state=${encodeURIComponent(state)}&available=${p.available_slots}&total=${p.total_slots}">Book Now</a>
            `;
            marker.bindPopup(popupContent);
          });
        });
    }

    window.onload = () => {
      loadMarkers();
    };
  </script>
</body>
</html>
