<!-- success.html -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Garage Booking Success</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      height: 100vh;
      margin: 0;
      background: linear-gradient(135deg, #f0f9ff, #c9f0ff);
      animation: fadeIn 1.2s ease-in-out;
    }

    h1 {
      font-size: 3em;
      color: #10b981;
      margin-bottom: 10px;
    }

    p {
      font-size: 1.2em;
      color: #333;
      margin-bottom: 30px;
      animation: slideUp 1s ease;
    }

    button {
      padding: 12px 20px;
      margin: 10px;
      border: none;
      border-radius: 8px;
      font-size: 1em;
      cursor: pointer;
      transition: background 0.3s;
    }

    .track {
      background-color: #3b82f6;
      color: white;
    }

    .track:hover {
      background-color: #2563eb;
    }

    .share {
      background-color: #10b981;
      color: white;
    }

    .share:hover {
      background-color: #059669;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to   { opacity: 1; }
    }

    @keyframes slideUp {
      from { transform: translateY(20px); opacity: 0; }
      to   { transform: translateY(0); opacity: 1; }
    }
  </style>
</head>
<body>
  <h1>SUCCESS</h1>
  <p>YOUR GARAGE SLOT IS BOOKED</p>
  <button class="share" onclick="shareLocation()">SHARE MY LOCATION</button>
  <a href="track.php?garageLat=<?= $_GET['garageLat'] ?>&garageLon=<?= $_GET['garageLon'] ?>">
  <button>Track My Towing</button>
</a>

  <script>
    function shareLocation() {
      alert("Sharing your location... (mock)");
    }

    function trackTowing() {
      alert("Tracking feature coming soon!");
    }
  </script>
</body>
</html>
