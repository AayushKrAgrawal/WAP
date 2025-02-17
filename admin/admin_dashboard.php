<?php
session_start();
include('../includes/db_connect.php');

// Check if admin is logged in correctly
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white flex flex-col p-5 space-y-6">
        <h2 class="text-2xl font-bold text-center">Admin Panel</h2>
        <nav class="flex flex-col space-y-3">
            <a href="manage_users.php" class="block py-2 px-4 rounded-lg bg-gray-700 hover:bg-gray-600 transition">👥 Manage Users</a>
            <a href="manage_products.php" class="block py-2 px-4 rounded-lg bg-gray-700 hover:bg-gray-600 transition">📦 Manage Products</a>
            <a href="manage_orders.php" class="block py-2 px-4 rounded-lg bg-gray-700 hover:bg-gray-600 transition">📑 Manage Orders</a>
            <a href="manage_packages.php" class="block py-2 px-4 rounded-lg bg-gray-700 hover:bg-gray-600 transition">📦 Manage Packages</a>
            <a href="manage_boxes.php" class="block py-2 px-4 rounded-lg bg-gray-700 hover:bg-gray-600 transition">📦 Manage Boxes</a>

            <a href="../pages/login.php" class="block py-2 px-4 rounded-lg bg-red-600 hover:bg-red-500 transition">🚪 Logout</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-10">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-3xl font-semibold text-gray-800">Welcome, <?php echo $_SESSION['first_name']; ?> 👋</h2>
            <p class="text-gray-600 mt-2">Manage your website efficiently from the dashboard.</p>
        </div>

        <!-- Dashboard Cards (Clickable) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            <!-- Users Card -->
            <a href="manage_users.php" class="bg-white p-6 rounded-lg shadow-md flex items-center hover:bg-blue-50 transition">
                <div class="text-3xl bg-blue-500 text-white p-4 rounded-lg">👥</div>
                <div class="ml-4">
                    <h3 class="text-xl font-semibold text-gray-700">Users</h3>
                    <p class="text-gray-500">Manage all registered users.</p>
                </div>
            </a>

            <!-- Products Card -->
            <a href="manage_products.php" class="bg-white p-6 rounded-lg shadow-md flex items-center hover:bg-green-50 transition">
                <div class="text-3xl bg-green-500 text-white p-4 rounded-lg">📦</div>
                <div class="ml-4">
                    <h3 class="text-xl font-semibold text-gray-700">Products</h3>
                    <p class="text-gray-500">Manage product listings.</p>
                </div>
            </a>

            <!-- Orders Card -->
            <a href="manage_orders.php" class="bg-white p-6 rounded-lg shadow-md flex items-center hover:bg-yellow-50 transition">
                <div class="text-3xl bg-yellow-500 text-white p-4 rounded-lg">📑</div>
                <div class="ml-4">
                    <h3 class="text-xl font-semibold text-gray-700">Orders</h3>
                    <p class="text-gray-500">View and process orders.</p>
                </div>
            </a>

            <!-- Packages Card -->
            <a href="manage_packages.php" class="bg-white p-6 rounded-lg shadow-md flex items-center hover:bg-purple-50 transition">
                <div class="text-3xl bg-purple-500 text-white p-4 rounded-lg">📦</div>
                <div class="ml-4">
                    <h3 class="text-xl font-semibold text-gray-700">Packages</h3>
                    <p class="text-gray-500">Manage available packages.</p>
                </div>
            </a>

            <!-- Boxes Card -->
            <a href="manage_boxes.php" class="bg-white p-6 rounded-lg shadow-md flex items-center hover:bg-pink-50 transition">
                <div class="text-3xl bg-pink-500 text-white p-4 rounded-lg">📦</div>
                <div class="ml-4">
                    <h3 class="text-xl font-semibold text-gray-700">Boxes</h3>
                    <p class="text-gray-500">Manage the available boxes.</p>
                </div>
            </a>
        </div>
    </main>

</body>
</html>
