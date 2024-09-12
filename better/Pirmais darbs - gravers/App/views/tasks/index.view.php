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
        #weather-container {
            align-items: center;
            justify-content: center;
            font-size: 24px;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="container">
        <div class="box">
            <div class="palette"></div>
            <img src="vtdt.png" style="width: 200px; height: 200px" alt="Attēls">
        </div>
        <div class="box">
            <div class="confetti"></div>
            <div class="confetti"></div>
            <div class="confetti"></div>
            <div class="confetti"></div>
            <div class="confetti"></div>
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
            <div id="weather-container">
                <h2>Current Weather in Cēsis, Latvia</h2>
                <div id="weather-info">Loading...</div>
            </div>
        </div>
        <div class="box">
        <form id="data-form" method="POST" action="submit.php">
            <label for="name">Vārds:</label>
            <input type="text" id="name" name="name" required pattern="[A-Za-zĀ-Žā-ž\s]+" title="Vārds var saturēt tikai burtus un atstarpes">
            <br>
            <label for="surname">Uzvārds:</label>
            <input type="text" id="surname" name="surname" required pattern="[A-Za-zĀ-Žā-ž\s]+" title="Uzvārds var saturēt tikai burtus un atstarpes">
            <br>
            <label for="phone">Telefona numurs:</label>
            <input type="tel" id="phone" name="phone" required pattern="\d{8}" title="EXAMPLE: 29332536">
            <br>
            <label for="personal_code">Personas kods:</label>
            <input type="text" id="personal_code" name="personal_code" required pattern="\d{6}-\d{5}" title="Personas kods jābūt formātā 121212-20928" oninput="formatPersonalCode(event)">
            <br>
            <button type="submit">Iesniegt</button>
        </form>
    </div>
    <div class="box">

    <select name="cars" id="cars">
    <option value="volvo">names</option>
    <option value="volvo">names</option>
  </select>

        <form id="edit-user-form" method="POST" action="update.php">
            <input type="hidden" id="user_id" name="user_id" value="<?php echo htmlspecialchars($user['id']); ?>">
            
            <label for="name">Vārds:</label>
            <input type="text" id="name" name="name" required pattern="[A-Za-zĀ-Žā-ž\s]+" title="Vārds var saturēt tikai burtus un atstarpes" value="<?php echo htmlspecialchars($user['name']); ?>">
            <br>
            
            <label for="surname">Uzvārds:</label>
            <input type="text" id="surname" name="surname" required pattern="[A-Za-zĀ-Žā-ž\s]+" title="Uzvārds var saturēt tikai burtus un atstarpes" value="<?php echo htmlspecialchars($user['surname']); ?>">
            <br>
            
            <label for="phone">Telefona numurs:</label>
            <input type="tel" id="phone" name="phone" required pattern="\d{8}" title="EXAMPLE: 29332536" value="<?php echo htmlspecialchars($user['phone_number']); ?>">
            <br>
            
            <label for="personal_code">Personas kods:</label>
            <input type="text" id="personal_code" name="personal_code" required pattern="\d{6}-\d{5}" title="Personas kods jābūt formātā 121212-20928" value="<?php echo htmlspecialchars($user['personal_code']); ?>" oninput="formatPersonalCode(event)">
            <br>
            
            <button type="submit">Update</button>
        </form>
    </div>
        <div class="box">
        <select name="cars" id="cars">
            <option value="volvo">names</option>
            <option value="volvo">names</option>
        </select>

        <button>Delete</button>
        </div>
    </div>

    <script>
        function formatPersonalCode(event) {
            const input = event.target;
            let value = input.value.replace(/\D/g, ''); // Remove non-numeric characters

            if (value.length > 6) {
                value = value.slice(0, 6) + '-' + value.slice(6, 11);
            }

            input.value = value;
        }

        let rotated = false;

        function rotatePage() {
            document.body.style.transform = rotated ? "rotate(0deg)" : "rotate(360deg)";
            rotated = !rotated;
        }

        function activateLink(event) {
            const links = document.querySelectorAll('.link-container a');
            links.forEach(link => link.classList.remove('active'));

            // Add the active class to the clicked link
            event.target.classList.add('active');
        }

        async function fetchWeather() {
            const latitude = 57.314;  // Latitude for Cēsis
            const longitude = 25.291; // Longitude for Cēsis
            const url = `https://api.open-meteo.com/v1/forecast?latitude=${latitude}&longitude=${longitude}&current_weather=true`;

            try {
                const response = await fetch(url);
                const data = await response.json();

                if (data.current_weather) {
                    const weatherInfo = `
                        <p><strong>Temperature:</strong> ${data.current_weather.temperature}°C</p>
                        <p><strong>Wind Speed:</strong> ${data.current_weather.windspeed} km/h</p>
                    `;
                    document.getElementById('weather-info').innerHTML = weatherInfo;
                } else {
                    document.getElementById('weather-info').innerHTML = 'Weather data not available.';
                }
            } catch (error) {
                document.getElementById('weather-info').innerHTML = 'Error fetching weather data.';
                console.error('Error fetching weather data:', error);
            }
        }

        fetchWeather(); // Call the function to fetch and display weather data
    </script>
</body>
</html>
