<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Depanaz - Road Assistance</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }

        header {
            background-image: url('../assets/img/hero-image.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 50px;
            text-align: center;
            border-bottom-left-radius: 30px;
            border-bottom-right-radius: 30px;
        }

        .button-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .button-grid a {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #4e4e4e;
            color: white;
            text-decoration: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 25px;
            font-weight: bold;
            text-align: center;
        }

        .button-grid a img {
            width: 60px;
            height: 60px;
            margin-bottom: 15px;
        }

        .button-grid a:hover {
            background-color: #3c3c3c;
        }

        main {
            padding: 20px;
            text-align: center;
        }

        .call-button {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 20px auto;
            padding: 15px 20px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            text-decoration: none;
            font-size: 18px;
            width: 250px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .call-button img {
            width: 24px;
            height: 24px;
            margin-right: 10px;
        }

        .call-button:hover {
            background-color: #218838;
        }

        footer {
            margin-top: 30px;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            text-align: center;
        }

        .about{
            background: red;
            width: 100%;
            overflow: visible;
        }

        .registration-form {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .registration-form h2 {
            margin-bottom: 20px;
        }

        .registration-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .registration-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .registration-form button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .registration-form button:hover {
            background-color: #0056b3;
        }

        .sticky-footer-menu {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: space-around;
            background-color: #4e4e4e;
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

    @media (max-width: 600px) {

            header {
            background-image: url('../assets/img/hero-image.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 75px;
            text-align: center;
            border-bottom-left-radius: 30px;
            border-bottom-right-radius: 30px;
        }
        .header-logo{
            height: 150px;
            width: 200px;
        }

            .button-grid {
                display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            padding: 20px;
            background-color: #f5f5f5;
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

        .about {
            background: red;
            width: 100vw;
            margin-left: calc(-1 * ((100vw - 100%) / 2)); /* removes side gaps */
            padding: 40px 20px;
            box-sizing: border-box;
            color: white;
        }

        .about h2 {
            margin-bottom: 20px;
        }

        .about p {
            font-size: 16px;
            line-height: 1.6;
        }

        .emoji {
            display: inline-block;
            animation: fadeUp 1s ease-in-out;
        }

        @keyframes fadeUp {
            0% {
                opacity: 0;
                transform: translateY(10px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

    }

    #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #000; /* dark background */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease-out;
        }

        .preloader-logo {
            width: 150px;
            animation: fadeInScale 1.5s ease-in-out;
        }

        @keyframes fadeInScale {
            0% {
                opacity: 0;
                transform: scale(0.8);
            }
            50% {
                opacity: 1;
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        body.loaded #preloader {
            opacity: 0;
            pointer-events: none;
        }

        .phone-icon {
            display: inline-block;
            width: 20px;
            height: 20px;
            margin-right: 10px;
            position: relative;
        }

        .phone-icon::before {
            content: '';
            position: absolute;
            left: 6px;
            top: 1px;
            width: 8px;
            height: 14px;
            border: 2px solid white;
            border-radius: 2px 2px 6px 6px;
            transform: rotate(45deg);
            box-sizing: border-box;
        }
    </style>
</head>
<body>
<div id="preloader">
    <img src="../assets/img/depanaz-logo-white.png" alt="Depanaz Logo" class="preloader-logo">
</div>
<script>
    window.addEventListener('load', () => {
        setTimeout(() => {
            document.body.classList.add('loaded');
            setTimeout(() => {
                const preloader = document.getElementById('preloader');
                if (preloader) preloader.remove();
            }, 600); // remove element after fade out
        }, 2000); // show preloader for 2 seconds
    });
</script>
    <header>
        <img src="../assets/img/depanaz-logo-wesite.png" alt="Logo" class="header-logo">
    </header>
    <a class="call-button" href="tel:+23059884094">
            <i class="fa fa-phone" style="font-size:28px; color: white; margin-right: 20px;"></i> CALL FOR ASSISTANCE
        </a>
    <div class="button-grid">
        <a href="./nearest-garage.php">
            <img src="../assets/icons/automobile-with-wrench.png" alt="Nearest Garage">
            Nearest Garage
        </a>
        <a href="#">
            <img src="../assets/icons/tow-truck.png" alt="Request Towing">
            Request Towing
        </a>
        <a href="#">
            <img src="../assets/icons/car-breakdown.png" alt="Breakdown Assistance">
            Breakdown Assistance
        </a>
        <a href="#">
            <img src="../assets/icons/location (1).png" alt="Share My Location">
            Share My Location
        </a>
    </div>

    <main>
        <div class="about">
            <h2>About Us</h2>
            <img src="../assets/img/home-about.jpg" alt="About Image" style="max-width: 100%; border-radius: 10px; margin-bottom: 20px;">
            <p>
                <strong>Depanaz</strong> is your trusted partner on the road, committed to help drivers across the island when it matters most. Whether you’re facing a sudden breakdown, a road accident, or just need a nearby garage, we’re here 24/7 with the support you need.
            </p>
            <p>
                Founded with the mission of enhancing road safety and support road users in Mauritius, our platform connects you instantly with towing assistance, emergency garage services, verified nearby mechanics and other quick fix services all with a simple tap.
            </p>
            <p>
                <strong>Why Choose Us?</strong><br>
                <span class="emoji">✅</span> Rapid Emergency Response – One-tap SOS to dispatch help instantly.<br>
                <span class="emoji">✅</span> Reliable Towing Services – Quick and safe transport for your vehicle.<br>
                <span class="emoji">✅</span> Nearby Garage Locator – Find trusted repair centers wherever you are.<br>
                <span class="emoji">✅</span> Seamless Booking – Schedule repairs with ease, even from the roadside.<br>
                <span class="emoji">✅</span> Local Expertise – Proudly built in and for Mauritius.
            </p>
            <p>
                We believe no driver should be left stranded. With <strong>Depanaz Road Assistance</strong>, peace of mind is just a tap away.
            </p>
        </div>
        <div class="registration-form">
            <h2>Register Your Vehicle!</h2>
            <form action="register.php" method="post">
                <div class="input-group">
                    <input type="text" name="first_name" placeholder="👤   First Name" required />
                </div>
                <div class="input-group">
                    <input type="text" name="last_name" placeholder="👤   Last Name" required />
                </div>
                <div class="input-group">
                    <input type="text" name="vehicle_make" placeholder="🚗   Vehicle Make" required />
                </div>
                <div class="input-group">
                    <input type="text" name="vehicle_model" placeholder="🚙   Vehicle Model" required />
                </div>
                <div class="input-group">
                    <input type="text" name="vehicle_color" placeholder="🎨   Vehicle Color" required />
                </div>
                <div class="input-group">
                    <input type="text" name="registration_number" placeholder="🔢   Registration Number" required />
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="🔒   Password" required />
                </div>
                <div class="input-group">
                    <input type="password" name="confirm_password" placeholder="🔒   Confirm Password" required />
                </div>
                <div class="terms">
                    <label><input type="checkbox" required /> I accept the Terms and Privacy Policy</label>
                </div>
                <button type="submit">SIGN UP</button>
            </form>
        </div>
    </main>
    <div class="sticky-footer-menu">
        <a href="#">
            <img src="icon1.png" alt="Icon 1">
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
    <footer>
    <div class="sticky-footer-menu">
        <a href="#">
            <img src="icon1.png" alt="Icon 1">
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
