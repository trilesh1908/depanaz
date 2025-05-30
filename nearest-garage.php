<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Nearest Garages</title>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- ✅ FIXED: Leaflet CSS (no integrity) -->
  <link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
  />

  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f9f9f9;
      margin: 0;
      padding: 0;
      text-align: center;
    }

    header {
            background-image: url('../assets/img/car-repair-garage.png');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 75px;
            text-align: center;
            border-bottom-left-radius: 30px;
            border-bottom-right-radius: 30px;
        }

    .container {
      padding: 20px;
    }

    button {
      padding: 10px 20px;
      font-size: 16px;
      margin-top: 10px;
      cursor: pointer;
      border-radius:20px;
    }

    #garage-list {
      list-style: none;
      padding: 0;
      max-width: 600px;
      margin: 20px auto;
      text-align: left;
    }

    #garage-list li {
      background: white;
      margin: 10px 0;
      padding: 15px;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    #see-more {
      margin-top: 10px;
    }

    #loader {
      margin-top: 20px;
      width: 50px;
      height: 50px;
      display: none;
    }

    #hidden-map {
      width: 0;
      height: 0;
      visibility: hidden;
    }
    .spinner {
    margin: 20px auto;
    width: 50px;
    height: 50px;
    border: 5px solid #ddd;
    border-top: 5px solid #3498db;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    }

    @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
    }
    .sticky-footer-menu {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: space-around;
            
            padding: 10px 0;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        .sticky-footer-menu a {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
        }

        .sticky-footer-menu a img {
            width: 40px;
            height: 40px;
            margin-bottom: 5px;
        }

        .sticky-footer-menu a:hover {
            color: #ccc;
        }
  </style>
</head>
<body>
  <header>
        <h1>GARAGES IN YOUR AREA</h1>
    </header>
  <div class="container">
    
    <button onclick="locateUser()"><i class="fa fa-map-marker" style="margin-right:20px; font-size:26px;"></i> LOCATE ME</button>

    <!-- ✅ Make sure this image exists in the same folder -->
   
    <p id="user-location" style="margin-top: 10px; font-size: 14px; color: #444;"></p>
    <ul id="garage-list"><center><div id="loader" class="spinner" style="display:none;"></div></center></ul>
    <button id="see-more" style="display:none;" onclick="showMore()">See more</button>
  </div>

  <div id="hidden-map"></div>

  <!-- ✅ FIXED: Leaflet JS (no integrity) -->
  <script
    src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
  ></script>

  <script>
  let garages = [];
  let visibleCount = 8;
  let userLat = 0;
  let userLon = 0;

  function getDistance(lat1, lon1, lat2, lon2) {
    const R = 6371; // Radius of Earth in km
    const dLat = (lat2 - lat1) * Math.PI / 180;
    const dLon = (lon2 - lon1) * Math.PI / 180;
    const a =
      Math.sin(dLat / 2) * Math.sin(dLat / 2) +
      Math.cos(lat1 * Math.PI / 180) *
      Math.cos(lat2 * Math.PI / 180) *
      Math.sin(dLon / 2) * Math.sin(dLon / 2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    return R * c;
  }

  // Display user location as readable address
const locationDisplay = document.getElementById('user-location');

async function getReadableAddress(lat, lon) {
  try {
    const url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lon}`;
    const response = await fetch(url);
    const data = await response.json();
    return data.display_name || "Unknown location";
  } catch (err) {
    console.error("Reverse geocoding failed:", err);
    return "Unknown location";
  }
}

function locateUser() {
  const loader = document.getElementById('loader');
  loader.style.display = 'inline-block';

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(async position => {
      userLat = position.coords.latitude;
      userLon = position.coords.longitude;

      // 🌍 Reverse geocode to readable address
      const readableLocation = await getReadableAddress(userLat, userLon);
      locationDisplay.textContent = `Your Location: ${readableLocation}`;

      // Hidden map init
      const map = L.map('hidden-map').setView([userLat, userLon], 13);

        const searchTerms = ['garage', 'Garage', 'auto', 'Auto', 'Quikfix', 'Tintex', 'Autoparts', 'Garages', 'garages', 'PKL', 'Garage Sakamoto', 'Auto World', 'Garage Michael Chan', 'Garage Reaz' , 'Garage Doyen', 'German Auto Service Ltd', 'Roshan Autoparts & Repairs Co Ltd', 'Amortech', 'GARAGE RHEMA', 'Garage Chand', 'Garage vikash', 'PKL Autoparts'];
        let allResults = [];

        const delta = 9;
    
        const viewbox = `${userLon - delta},${userLat + delta},${userLon + delta},${userLat - delta}`;

        for (const term of searchTerms) {
          const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(term)}&limit=50&bounded=1&viewbox=${viewbox}`;
          try {
            const response = await fetch(url, {
              headers: { 'Accept-Language': 'en' }
            });
            const data = await response.json();
            allResults = allResults.concat(data);
          } catch (error) {
            console.error(`Error fetching for term "${term}":`, error);
          }
        }

        // Remove duplicates by place_id
        const uniqueResults = Array.from(
          new Map(allResults.map(obj => [obj.place_id, obj])).values()
        );

        // Add distance and sort
        uniqueResults.forEach(g => {
          const gLat = parseFloat(g.lat);
          const gLon = parseFloat(g.lon);
          g.distance = getDistance(userLat, userLon, gLat, gLon);
        });

        uniqueResults.sort((a, b) => a.distance - b.distance);

        garages = uniqueResults;
        visibleCount = 8;

        if (garages.length === 0) {
          alert("No garages found within 1000 km.");
        }

        renderGarageList();
        loader.style.display = 'none';
      }, error => {
        loader.style.display = 'none';
        locationDisplay.textContent = '';
        console.error("Geolocation error:", error);
        alert("Failed to get your location.");
      });
    } else {
      loader.style.display = 'none';
      alert("Geolocation not supported.");
    }
  }

  function renderGarageList() {
    const list = document.getElementById('garage-list');
    list.innerHTML = '';

    const itemsToShow = garages.slice(0, visibleCount);
    itemsToShow.forEach(g => {
      const name = g.display_name.split(',')[0];
      const address = g.display_name;
      const distance = g.distance;

      const distanceText = distance < 1
        ? `${(distance * 1000).toFixed(0)} m`
        : `${distance.toFixed(2)} km`;

      const li = document.createElement('li');
      li.innerHTML = `<strong>${name}</strong><br>
                      <small>${address}</small><br>
                      <em>Distance: ${distanceText}</em>`;
        li.style.cursor = 'pointer';
        li.onclick = () => {
            const garageLat = g.lat;
  const garageLon = g.lon;
            window.location.href = `../success-garage.php?garageLat=${garageLat}&garageLon=${garageLon}`;
        };
      list.appendChild(li);
    });

    const seeMoreBtn = document.getElementById('see-more');
    seeMoreBtn.style.display = garages.length > visibleCount ? 'inline-block' : 'none';
  }

  function showMore() {
    visibleCount += 8;
    renderGarageList();
  }
</script>
<footer>
    <div class="sticky-footer-menu">
        <a href="../homepage.php">
            <img src="icon1.png" alt="Home">
            Option 1
        </a>
        <a href="#">
            <img src="icon2.png" alt="Icon 2">
            Option 2
        </a>
        <a href="#">
            <img src="icon3.png" alt="Icon 3">
            Option 3
        </a>
        <a href="#">
            <img src="icon4.png" alt="Icon 4">
            Option 4
        </a>
    </div>
    </footer>
</body>
</html>
