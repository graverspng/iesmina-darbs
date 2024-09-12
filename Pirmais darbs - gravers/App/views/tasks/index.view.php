<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3x3 Tabula ar Animāciju</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            transition: transform 1s;
        }
        .container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: repeat(3, 1fr);
            width: 1500px;
            height: 1000px;
            border: 1px solid black;
        }
        .box {
            border: 1px solid black;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        .box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .palette {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, red, orange, yellow, green, blue, indigo, violet);
            animation: movePalette 5s linear infinite;
            opacity: 0.5;
        }
        @keyframes movePalette {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: red;
            animation: fall 5s linear infinite, spin 2s linear infinite;
            opacity: 0.8;
        }
        @keyframes fall {
            0% { top: -10px; left: 50%; opacity: 1; }
            100% { top: 110%; left: calc(50% + 100px); opacity: 0; }
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .confetti:nth-child(odd) {
            background-color: blue;
        }
        .confetti:nth-child(even) {
            background-color: green;
        }
        .confetti:nth-child(1) { width: 8px; height: 8px; animation-duration: 3s; }
        .confetti:nth-child(2) { width: 12px; height: 12px; animation-duration: 4s; }
        .confetti:nth-child(3) { width: 10px; height: 10px; animation-duration: 5s; }
        .confetti:nth-child(4) { width: 15px; height: 15px; animation-duration: 4.5s; }
        .confetti:nth-child(5) { width: 6px; height: 6px; animation-duration: 3.5s; }

        /* Styles for the button */
        .rotate-btn {
            padding: 10px 20px;
            font-size: 18px;
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .rotate-btn:hover {
            background-color: #0056b3;
        }

        /* Breathing bubble animation */
        .bubble {
            width: 100px;
            height: 100px;
            background-color: black;
            border-radius: 50%;
            animation: breathe 6s ease-in-out infinite;
        }
        .bubble2 {
            width: 100px;
            height: 100px;
            background-color: darkred;
            border-radius: 50%;
            animation: breathe 6s ease-in-out infinite;
        }

        @keyframes breathe {
            0% {
                transform: scale(1);
                opacity: 0.7;
            }
            50% {
                transform: scale(1.5);
                opacity: 1;
            }
            100% {
                transform: scale(1);
                opacity: 0.7;
            }
        }

        /* Styles for links in the 5th container */
        .link-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .link-container a {
            color: blue;
            text-decoration: none;
            font-size: 20px;
            transition: color 1s;
        }
        .link-container a:hover {
            color: lightblue;
            transition: color 0.5s;
        }
        .link-container a.active {
            color: red !important;
        }



        .weather-container {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
            border: 1px solid black;
        }
        .weather-container h2 {
            margin: 0;
        }
        .weather-container p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="box">
            <div class="palette"></div>
            <img src="https://mintprint.lv/wp-content/uploads/2021/03/LOGO.jpg" alt="Attēls">
        </div>
        <div class="box">
            <div class="confetti"></div>
            <div class="confetti"></div>
            <div class="confetti"></div>
            <div class="confetti"></div>
            <div class="confetti"></div>
        </div>
        <div class="box">
            <button class="rotate-btn" onclick="rotatePage()">Rotate Page</button>
        </div>
        <div class="box">
            <div class="bubble2">
            <div class="bubble"></div>
            </div>
        </div>
        <div class="box">
            <div class="link-container">
                <a href="https://www.youtube.com" onclick="activateLink(event)">YouTube</a>
                <a href="https://www.facebook.com" onclick="activateLink(event)">Facebook</a>
                <a href="https://www.instagram.com" onclick="activateLink(event)">Instagram</a>
            </div>
        </div>
        <div class="box">
        <div class="box weather-container">
            <h2>Weather in Cēsis</h2>
            <p id="weather-description">Loading...</p>
            <p id="temperature"></p>
            <p id="humidity"></p>
        </div>
        </div>
        <div class="box">7</div>
        <div class="box">8</div>
        <div class="box">9</div>
    </div>

    <script>
        let rotated = false;

        function rotatePage() {
            document.body.style.transform = rotated ? "rotate(0deg)" : "rotate(360deg)";
            rotated = !rotated;
        }

        function activateLink(event) {
            // Prevent default action (navigation)
            event.preventDefault();

            // Remove the active class from all links
            const links = document.querySelectorAll('.link-container a');
            links.forEach(link => link.classList.remove('active'));

            // Add the active class to the clicked link
            event.target.classList.add('active');
        }

        const apiKey = 'YOUR_API_KEY';
        const city = 'Cesis';
        const apiUrl = `api.openweathermap.org/data/2.5/forecast?lat={lat}&lon={lon}&appid={API key}`;

        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                const description = data.weather[0].description;
                const temperature = data.main.temp;
                const humidity = data.main.humidity;

                document.getElementById('weather-description').textContent = `Conditions: ${description}`;
                document.getElementById('temperature').textContent = `Temperature: ${temperature}°C`;
                document.getElementById('humidity').textContent = `Humidity: ${humidity}%`;
            })
            .catch(error => {
                console.error('Error fetching weather data:', error);
                document.getElementById('weather-description').textContent = 'Unable to load weather data';
            });
    </script>
</body>
</html>
