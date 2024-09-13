<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="script.js" defer></script>
    <link rel="stylesheet" href="style.css">
    <title>3x3 Tabula ar Animāciju</title>
</head>
<body>
    <div class="container">
        <div class="box">
            <div class="palette"></div>
            <img src="vtdt.png" style="width: 200px; height: 200px" alt="Attēls">
        </div>
        <div class="box">
            <?php for ($i = 2; $i < 20; $i++): ?>
                <div class="confetti"></div>
            <?php endfor; ?>
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

        <!-- SUBMIT FORM -->
        <div class="box2">
            <h2>Add a user</h2>
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

        <!-- EDIT FORM -->
        <div class="box2">
            <h2>Edit User</h2>
            <select name="user_id" id="user_id" onchange="populateEditForm()">
                <option value="">Select a user</option>
                <?php

                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "pirmais_darbs";


                $conn = new mysqli($servername, $username, $password, $dbname);


                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch user data
                $sql = "SELECT id, name, surname FROM users";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['name']) . " " . htmlspecialchars($row['surname']) . "</option>";
                    }
                } else {
                    echo "<option>No users found</option>";
                }

                $conn->close();
                ?>
            </select>
            <br><br>
            <form id="edit-user-form" method="POST" action="update.php" onsubmit="return validateEditForm()">
                <input type="hidden" id="edit_user_id" name="user_id" value="">
                <label for="edit_name">Vārds:</label>
                <input type="text" id="edit_name" name="name" required pattern="[A-Za-zĀ-Žā-ž\s]+" title="Vārds var saturēt tikai burtus un atstarpes">
                <br>
                <label for="edit_surname">Uzvārds:</label>
                <input type="text" id="edit_surname" name="surname" required pattern="[A-Za-zĀ-Žā-ž\s]+" title="Uzvārds var saturēt tikai burtus un atstarpes">
                <br>
                <label for="edit_phone">Telefona numurs:</label>
                <input type="tel" id="edit_phone" name="phone" required pattern="\d{8}" title="EXAMPLE: 29332536">
                <br>
                <label for="edit_personal_code">Personas kods:</label>
                <input type="text" id="edit_personal_code" name="personal_code" required pattern="\d{6}-\d{5}" title="Personas kods jābūt formātā 121212-20928" oninput="formatPersonalCode(event)">
                <br>
                <button type="submit">Update</button>
            </form>
        </div>

        <!-- DELETE FORM -->
        <div class="box2">
            <h2>Delete User</h2>
            <form id="delete-user-form" method="POST" action="delete.php">
                <label for="delete_user_id">Select User to Delete:</label>
                <select name="user_id" id="delete_user_id">
                    <option value="">Select a user</option>
                    <?php

                    $conn = new mysqli($servername, $username, $password, $dbname);


                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT id, name, surname FROM users";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['name'] . " " . $row['surname'] . "</option>";
                        }
                    } else {
                        echo "<option>No users found</option>";
                    }

                    $conn->close();
                    ?>
                </select>
                <br>
                <button type="submit">Delete</button>
            </form>
        </div>
        
        <!-- MESSAGE DISPLAY -->
        <?php
        if (isset($_GET['message'])) {
            echo '<div class="message" id="message-box">'
                . htmlspecialchars($_GET['message'])
                . '<button onclick="closeMessage()">OK</button></div>';
        }
        ?>

    </div>

    <script>
        function closeMessage() {
            document.getElementById('message-box').style.display = 'none';
        }
    </script>
</body>
</html>