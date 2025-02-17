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
            <div class="flex justify-between items-center h-16">
                <!-- Left Section: Logo and Company Name -->
                <div class="flex items-center space-x-4">
                    <a href="dashboard.php" class="flex items-center space-x-2 text-indigo-700 font-bold text-2xl">
                        <img src="../assets/images/logo2_transparent_Craiyon.png" alt="Logo" class="h-10 w-10 rounded-full">
                        <span>Hamro Pratibha</span>
                    </a>
                </div>

                <!-- Center Section: Navigation Links -->
                <div class="hidden md:flex space-x-8">
                    <a href="dashboard.php" class="text-gray-700 hover:text-indigo-600 transition">Home</a>
                    <a href="products.php" class="text-gray-700 hover:text-indigo-600 transition">Products</a>
                    <a href="my_orders.php" class="text-gray-700 hover:text-indigo-600 transition">My Orders</a>

                    <a href="#" class="text-gray-700 hover:text-indigo-600 transition">About Us</a>

                    <a href="#" class="text-gray-700 hover:text-indigo-600 transition">Return & Refund Policy</a>
                    <a href="#" class="text-gray-700 hover:text-indigo-600 transition">Contact Us</a>
                </div>

                <!-- Right Section: Search, Cart, Profile, Logout -->
                <div class="flex items-center space-x-4">
                    <!-- Search Bar -->
                    <div class="relative hidden md:block">
                        <input type="text" placeholder="Search..." class="px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <button class="absolute right-1 top-1 text-gray-600 hover:text-indigo-600 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1116.65 3a7.5 7.5 0 010 15z" />
                            </svg>
                        </button>
                    </div>

                    <!-- Cart Icon -->
                    <a href="cart.php" class="text-gray-600 hover:text-indigo-600 transition relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1 5h12l-1-5M9 21h6m-3-3v3" />
                        </svg>
                    </a>

                    <!-- Profile Dropdown -->
                    <div class="relative group">
                        <button class="text-gray-600 hover:text-indigo-600 transition focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9.955 9.955 0 0112 15c2.21 0 4.265.716 5.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 mt-2 w-48 bg-white border rounded-md shadow-lg hidden group-hover:block">
                            <a href="profile.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                            <a href="logout.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
