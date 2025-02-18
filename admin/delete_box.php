<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/login.php");
    exit();
}

// Include the database connection file
include '../includes/db_connect.php';

// Check if the ID is set
if (isset($_GET['id'])) {
    $box_id = $_GET['id'];

    // Delete the box from the database
    $delete_query = "DELETE FROM boxes WHERE id = :id";
    $delete_stmt = $conn->prepare($delete_query);
    $delete_stmt->bindParam(':id', $box_id);

    if ($delete_stmt->execute()) {
        // If delete is successful, redirect to manage boxes page
        header("Location: manage_boxes.php");
        exit();
    } else {
        // If delete fails, redirect with an error message
        header("Location: manage_boxes.php?error=There was an error deleting the box.");
        exit();
    }
} else {
    // If ID is not set, redirect back to manage boxes page
    header("Location: manage_boxes.php");
    exit();
}
?>

