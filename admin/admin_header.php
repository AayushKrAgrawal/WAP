<?php
session_start();
include('../includes/db_connect.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

    <!-- Admin Header (Navigation) -->
    <header class="bg-gray-800 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Admin Panel</h1>
            <nav class="flex space-x-6">
                <a href="manage_users.php" class="text-white hover:bg-gray-700 hover:text-gray-200 px-4 py-2 rounded-md transition">👥 Manage Users</a>
                <a href="manage_products.php" class="text-white hover:bg-gray-700 hover:text-gray-200 px-4 py-2 rounded-md transition">📦 Manage Products</a>
                <a href="manage_orders.php" class="text-white hover:bg-gray-700 hover:text-gray-200 px-4 py-2 rounded-md transition">📑 Manage Orders</a>
                <a href="manage_packages.php" class="text-white hover:bg-gray-700 hover:text-gray-200 px-4 py-2 rounded-md transition">📦 Manage Packages</a>
                <a href="manage_boxes.php" class="text-white hover:bg-gray-700 hover:text-gray-200 px-4 py-2 rounded-md transition">📦 Manage Boxes</a>
            </nav>
            <div>
                <a href="../pages/login.php" class="text-red-600 hover:text-red-500 font-semibold">🚪 Logout</a>
            </div>
        </div>
    </header>

</body>
</html>
