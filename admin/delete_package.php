<?php
include '../includes/db_connect.php';

if (isset($_GET['id'])) {
    // Get the package ID from the URL
    $package_id = $_GET['id'];

    // Delete the package from the database
    $delete_query = "DELETE FROM packages WHERE id = :id";
    $delete_stmt = $conn->prepare($delete_query);
    $delete_stmt->bindParam(':id', $package_id);

    if ($delete_stmt->execute()) {
        // If deletion is successful, redirect to the manage packages page
        header("Location: manage_packages.php");
        exit;
    } else {
        echo "Error deleting the package.";
    }
} else {
    // If no ID is passed, redirect to the manage packages page
    header("Location: manage_packages.php");
    exit;
}
?>
