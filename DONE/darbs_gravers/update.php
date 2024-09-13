<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pirmais_darbs";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $phone = $_POST['phone'];
    $personal_code = $_POST['personal_code'];


    $stmt = $conn->prepare("UPDATE users SET name=?, surname=?, phone_number=?, personal_code=? WHERE id=?");
    $stmt->bind_param("ssssi", $name, $surname, $phone, $personal_code, $id);


    if ($stmt->execute()) {
        header("Location: index.view.php?message=User%20edited%20successfully!");
    } else {
        header("Location: index.view.php?message=Error:%20" . urlencode($stmt->error));
    }


    $stmt->close();
} else {
    echo "Invalid request.";
}


$conn->close();
?>
