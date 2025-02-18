<?php
ob_start(); // Start output buffering

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hamro Pratibha</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-between items-center h-16">

                <!-- Left Section: Logo and Company Name -->
                <div class="flex items-center space-x-4 mb-2 md:mb-0"> <!-- Added margin-bottom on small screens -->
                    <a href="dashboard.php" class="flex items-center space-x-2 text-indigo-700 font-bold text-2xl">
                        <img src="../assets/images/logo2_transparent_Craiyon.png" alt="Logo" class="h-10 w-10 rounded-full">
                        <span>Hamro Pratibha</span>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobileMenuButton" class="md:hidden text-gray-600 hover:text-indigo-600 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <!-- Center Section: Navigation Links (Initially Hidden on Small Screens) -->
                <div id="mobileMenu" class="w-full md:w-auto hidden md:flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-8 mt-4 md:mt-0">  <!-- Added mobile menu id -->
                    <a href="dashboard.php" class="text-gray-700 hover:text-indigo-600 transition">Home</a>
                    <a href="products.php" class="text-gray-700 hover:text-indigo-600 transition">Products</a>
                    <a href="my_orders.php" class="text-gray-700 hover:text-indigo-600 transition">My Orders</a>
                    <a href="#" class="text-gray-700 hover:text-indigo-600 transition">About Us</a>
                    <a href="refund.php" class="text-gray-700 hover:text-indigo-600 transition">Return & Refund Policy</a>
                    <a href="contactus.php" class="text-gray-700 hover:text-indigo-600 transition">Contact Us</a>
                </div>

                <!-- Right Section: Search, Cart, Profile, Logout -->
                <div class="flex items-center space-x-4">

                    <!-- Search Bar -->
                    <div class="relative hidden md:block">
                        <input type="text" placeholder="Search..." class="px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <button class="absolute right-2 top-1/2 transform -translate-y-1/2">
                            <img src="../assets/images/search.png" alt="Search" class="h-4 w-4 cursor-pointer">
                        </button>
                    </div>

                    <!-- Cart Icon -->
                    <a href="cart.php" class="text-gray-600 hover:text-indigo-600 transition relative">
                        <img src="../assets/images/cart.png" alt="cart" class="h-6 w-6 cursor-pointer">
                    </a>

                    <!-- Profile Dropdown -->
                    <div class="relative group">
                        <button class="text-gray-600 hover:text-indigo-600 transition focus:outline-none">
                            <img src="../assets/images/account.png" alt="profile" class="h-8 w-8 rounded-full cursor-pointer">
                        </button>
                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 mt-2 w-48 bg-white border rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 delay-200">
                            <a href="profile.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                            <a href="logout.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <script>
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>

</body>
</html>
