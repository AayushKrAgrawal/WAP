<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include('../includes/db_connect.php');
include('../includes/header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Received</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans">
    <div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-3xl font-extrabold text-gray-800 mb-6">Thank You for Your Order!</h1>
            <p class="text-lg text-gray-700 mb-6">Your order has been received and is being processed. You will receive an email confirmation shortly.</p>
            
            <div class="flex justify-center">
                <a href="dashboard.php" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Go Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</body>
</html>
