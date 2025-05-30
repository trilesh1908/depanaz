<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Track My Towing</title>

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <style>
    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
    }
    #map {
      width: 100%;
      height: 100vh;
    }
  </style>
</head>
<body>
  <div id="map"></div>

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script>
    const urlParams = new URLSearchParams(window.location.search);
    const garageLat = parseFloat(urlParams.get('garageLat'));
    const garageLon = parseFloat(urlParams.get('garageLon'));

    if (!garageLat || !garageLon) {
      alert("Garage location not provided.");
    }

    const map = L.map('map').setView([garageLat, garageLon], 13);

    // Add base map
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Add garage marker
    const garageMarker = L.marker([garageLat, garageLon]).addTo(map)
      .bindPopup('Garage Location').openPopup();

    // Get user location and draw route
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(async position => {
        const userLat = position.coords.latitude;
        const userLon = position.coords.longitude;

        // Add user marker
        const userMarker = L.marker([userLat, userLon]).addTo(map)
          .bindPopup('Your Location').openPopup();

        // Fit map to route bounds
        const bounds = L.latLngBounds([
          [userLat, userLon],
          [garageLat, garageLon]
        ]);
        map.fitBounds(bounds, { padding: [50, 50] });

        // Fetch route from OSRM
        const routeUrl = `https://router.project-osrm.org/route/v1/driving/${userLon},${userLat};${garageLon},${garageLat}?overview=full&geometries=geojson`;

        const res = await fetch(routeUrl);
        const data = await res.json();

        const routeCoords = data.routes[0].geometry.coordinates.map(([lon, lat]) => [lat, lon]);

        const routeLine = L.polyline(routeCoords, { color: 'blue', weight: 4 }).addTo(map);
      }, error => {
        alert("Could not get your location.");
      });
    } else {
      alert("Geolocation not supported.");
    }
  </script>
</body>
</html>
