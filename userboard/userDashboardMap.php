 <!DOCTYPE html>
<html>
<head>
  <title>Filtered Parking Map - Parkify</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <style>
    #map { height: 500px; margin-top: 10px; }
    select { padding: 8px; margin: 10px 10px 0 0; }
  </style>
</head>
<body>
  <h2>Find Parking by State, City, and Area</h2>

  <select id="stateSelect">
    <option value="">-- Select State --</option>
  </select>

  <select id="citySelect">
    <option value="">-- Select City --</option>
  </select>

  <select id="areaSelect">
    <option value="">-- Select Area --</option>
  </select>

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
              <a href="../booking/booking.php?name=${encodeURIComponent(p.name)}&city=${encodeURIComponent(p.city)}&area=${encodeURIComponent(p.area)}&state=${encodeURIComponent(state)}&available=${p.available_slots}&total=${p.total_slots}" style="color:blue;">Book Now</a>
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
