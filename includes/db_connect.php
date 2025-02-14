<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hamroPratibha";

try {
    // Create a database connection using MySQLi with error mode enabled
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Set character encoding to UTF-8
    $conn->set_charset("utf8mb4");
} catch (Exception $e) {
    die("Database connection error: " . $e->getMessage());
}
?>
