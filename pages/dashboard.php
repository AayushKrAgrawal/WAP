<?php
session_start();
include('../includes/db_connect.php');

// Fetch all products from the database
$sql = "SELECT * FROM products ORDER BY created_at DESC LIMIT 3";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

<!-- Navbar -->
<nav class="bg-white shadow-md fixed w-full z-10">
    <div class="max-w-7xl mx-auto flex justify-between items-center p-4">
        <!-- Logo and Company Name -->
        <div class="flex items-center space-x-3">
            <img src="../assets/images/logo2_transparent_Craiyon.png" alt="Logo" class="w-12 h-12">
            <a href="dashboard.php" class="text-indigo-700 text-3xl font-bold hover:text-indigo-600 transition">Hamro Pratibha</a>
        </div>
        
        <!-- Navigation Links -->
        <div class="hidden md:flex space-x-6">
            <a href="dashboard.php" class="text-gray-700 hover:text-indigo-600 transition">Home</a>
            <a href="products.php" class="text-gray-700 hover:text-indigo-600 transition">Products</a>
            <a href="about.php" class="text-gray-700 hover:text-indigo-600 transition">About Us</a>
            <a href="policy.php" class="text-gray-700 hover:text-indigo-600 transition">Return and Refund Policy</a>
            <a href="contact.php" class="text-gray-700 hover:text-indigo-600 transition">Contact Us</a>
        </div>
        
        <!-- Search and Icons -->
        <div class="flex items-center space-x-4">
            <!-- Search -->
            <div class="relative">
                <input type="text" placeholder="Search..." class="border rounded-full pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M15 11a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
            
            <!-- Cart Icon -->
            <a href="cart.php" class="relative text-gray-700 hover:text-indigo-600 transition">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L6 6H4m3 13a1 1 0 100-2 1 1 0 000 2zm10 0a1 1 0 100-2 1 1 0 000 2z" />
                </svg>
            </a>
            
            <!-- Profile Dropdown -->
            <div class="relative group">
                <button class="text-gray-700 hover:text-indigo-600 transition focus:outline-none">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A4.992 4.992 0 0112 15c1.657 0 3.156.672 4.121 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </button>
                <!-- Dropdown Menu -->
                <div class="absolute right-0 mt-2 w-48 bg-white border rounded-md shadow-lg opacity-0 group-hover:opacity-100 transition duration-300">
                    <a href="profile.php" class="block px-4 py-2 text-gray-600 hover:bg-indigo-50 hover:text-indigo-700 transition">Profile</a>
                    <a href="logout.php" class="block px-4 py-2 text-red-600 hover:bg-red-50 transition">Logout</a>
                </div>
            </div>
        </div>
    </div>
</nav>


    <!-- Banner -->
    <div class="w-full h-[500px] bg-cover bg-center" style="background-image: url('../assets/images/banner.jpg');">
        <div class="w-full h-full bg-black bg-opacity-40 flex items-center justify-center">
            <h1 class="text-white text-5xl font-bold">Welcome to Hamro Pratibha</h1>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="max-w-7xl mx-auto py-16 text-center">
        <h2 class="text-4xl font-bold text-gray-800">Categories</h2>
        <p class="text-gray-600 mt-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at justo nec arcu suscipit dictum.</p>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mt-8">
            <!-- Our Packages -->
            <a href="preMadePackages.php" class="block">
                <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-transform transform hover:scale-105">
                    <img src="../assets\images\Pre-Made.jpg" alt="Our Packages" class="w-full h-52 object-cover">
                    <div class="p-4 text-center">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-2">Our Packages</h3>
                    </div>
                </div>
            </a>
            
            <!-- Customize Your Package -->
            <a href="CustomizePackage.php" class="block">
                <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-transform transform hover:scale-105">
                    <img src="../assets\images\gift basket.jpg" alt="Customize Your Package" class="w-full h-52 object-cover">
                    <div class="p-4 text-center">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-2">Customize Your Own Package</h3>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Our Products Section -->
    <div class="max-w-7xl mx-auto py-16 text-center">
        <h2 class="text-4xl font-bold text-gray-800">Our Products</h2>
        <p class="text-gray-600 mt-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consequat lacus ac turpis lacinia, a pretium lectus facilisis.</p>
        
        <a href="allProducts.php" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-md transition mt-6">Shop Now</a>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 mt-10">
            <?php
            if ($result->num_rows > 0) {
                while ($product = $result->fetch_assoc()) {
                    ?>
                    <a href="product_detail.php?id=<?php echo $product['product_id']; ?>" class="block">
                        <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-transform transform hover:scale-105">
                            <img src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['product_name']; ?>" class="w-full h-52 object-cover">
                            <div class="p-4 text-center">
                                <h3 class="text-xl font-semibold text-gray-800 mb-2"><?php echo $product['product_name']; ?></h3>
                            </div>
                        </div>
                    </a>
                    <?php
                }
            } else {
                echo "<p class='col-span-3 text-center text-gray-500'>No products available at the moment.</p>";
            }
            ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="max-w-7xl mx-auto text-center">
            <p>&copy; <?php echo date('Y'); ?> MyStore. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
