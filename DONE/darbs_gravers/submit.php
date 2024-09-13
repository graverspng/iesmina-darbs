<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pirmais_darbs";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$name = $_POST['name'];
$surname = $_POST['surname'];
$phone = $_POST['phone'];
$personal_code = $_POST['personal_code'];


$stmt = $conn->prepare("INSERT INTO users (name, surname, phone_number, personal_code) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $surname, $phone, $personal_code);


if ($stmt->execute()) {
    header("Location: index.view.php?message=New%20user%20created%20successfully!");
} else {
    header("Location: index.view.php?message=Error:%20" . urlencode($stmt->error));
}


$stmt->close();
$conn->close();
?>
