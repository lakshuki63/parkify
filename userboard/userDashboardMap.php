<!DOCTYPE html>
<html>
<head>
  <title>Filtered Parking Map</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <style>
    #map { height: 500px; margin-top: 10px; }
    select { padding: 8px; margin-right: 10px; }
  </style>
</head>
<body>
  <h2>Find Parking by City and Area</h2>

  <select id="citySelect">
    <option value="">--Select City--</option>
    <option value="Bengaluru">Bengaluru</option>
    <option value="Chennai">Chennai</option>
    <option value="Mumbai">Mumbai</option>
  </select>

  <select id="areaSelect">
    <option value="">--Select Area--</option>
  </select>

  <div id="map"></div>

  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script>
    const cityToAreas = {
      Bengaluru: ["MG Road", "Indiranagar", "Whitefield"],
      Chennai: ["T Nagar", "Guindy", "Velachery"],
      Mumbai: ["Andheri", "Bandra", "Colaba"]
    };

    const citySelect = document.getElementById("citySelect");
    const areaSelect = document.getElementById("areaSelect");

    const map = L.map('map').setView([20.5937, 78.9629], 5);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    function loadMarkers(city = "", area = "") {
      const url = city && area && area !== "all"
        ? `get_filtered_parking.php?city=${city}&area=${area}`
        : 'get_all_parking.php';

      fetch(url)
        .then(res => res.json())
        .then(data => {
          // Remove old markers
          map.eachLayer(layer => {
            if (layer instanceof L.Marker) {
              map.removeLayer(layer);
            }
          });

          if (data.length > 0) {
            map.setView([data[0].lat, data[0].lon], 14);
          }

          data.forEach(p => {
            L.marker([p.lat, p.lon])
              .addTo(map)
              .bindPopup(`<b>${p.name}</b><br>${p.area}, ${p.city}<br>Available: ${p.available_slots}/${p.total_slots}`);
          });
        });
    }

    // Load all parking slots on page load
    window.onload = () => {
      loadMarkers();
    };

    citySelect.addEventListener("change", () => {
      areaSelect.innerHTML = '';
      const areas = cityToAreas[citySelect.value] || [];

      const allOpt = document.createElement("option");
      allOpt.value = "all";
      allOpt.textContent = "All Areas";
      areaSelect.appendChild(allOpt);

      areas.forEach(area => {
        const opt = document.createElement("option");
        opt.value = area;
        opt.textContent = area;
        areaSelect.appendChild(opt);
      });
    });

    areaSelect.addEventListener("change", () => {
      const city = citySelect.value;
      const area = areaSelect.value;
      if (!city || !area) return;

      loadMarkers(city, area);
    });
  </script>
</body>
</html>
