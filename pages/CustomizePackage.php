<?php
include '../includes/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customize Package</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html, body {
            background-color: #F5EFFF !important;
        }
    </style>
</head>
<body class="min-h-screen">
    <div class="container mx-auto px-4 text-center mt-20">
        <!-- Title -->
        <h1 class="text-3xl font-bold text-[#B82132] mb-4">Customize Your Package</h1>
        <!-- Description -->
        <p class="text-gray-600 mb-10">Choose your preferred options and create a personalized package for any occasion.</p>
        <!-- Cards Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 justify-items-center mx-auto max-w-5xl">
            <!-- Card 1 -->
            <div class="flex flex-col items-center w-3/4 mb-6">
                <a href="../pages/chooseBox.php" class="block w-full">
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform transition duration-500 hover:scale-105 hover:shadow-2xl">
                        <img class="w-full h-96 object-cover" src="../assets/images/packaging.jpg">
                    </div>
                </a>
                <h2 class="text-xl font-semibold text-gray-800 mt-4">Packaging</h2>
            </div>
            <!-- Card 2 -->
            <div class="flex flex-col items-center w-3/4 mb-6">
                <a href="../pages/products.php" class="block w-full">
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform transition duration-500 hover:scale-105 hover:shadow-2xl">
                        <img class="w-full h-96 object-cover" src="../assets/images/customizee.jpg">
                    </div>
                </a>
                <h2 class="text-xl font-semibold text-gray-800 mt-4">Items</h2>
            </div>
        </div>
    </div>    
    <!-- Footer -->
    <?php include '../includes/footer.php'; ?>
</body>
</html>