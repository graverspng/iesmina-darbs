<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pirmais_darbs";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['user_id'];


$stmt = $conn->prepare("DELETE FROM users WHERE id=?");
$stmt->bind_param("i", $id);


if ($stmt->execute()) {
    header("Location: index.view.php?message=User%20deleted%20successfully!");
} else {
    header("Location: index.view.php?message=Error:%20" . urlencode($stmt->error));
}


$stmt->close();
$conn->close();
?>
