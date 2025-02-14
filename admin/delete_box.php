<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: admin_login.php");
    exit();
}

// Database connection
$host = 'localhost';
$db = 'your_database';
$user = 'your_username';
$pass = 'your_password';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM boxes WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: manage_boxes.php");
        exit();
    } else {
        die("Error: " . $conn->error);
    }
}

$conn->close();
?>
