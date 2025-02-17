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
        /* Custom hover effects */
        .card:hover img {
            transform: scale(1.1);
        }
        .card:hover h2 {
            color: #6D28D9; /* Purple color on hover */
        }
    </style>
</head>
<body style="background-color: #F5EFFF;">

    <!-- Heading -->
    <section class="text-center py-12">
        <h1 class="text-5xl font-extrabold text-gray-800">Customize Your Package Here:</h1>
        <p class="text-lg text-gray-600 mt-4">Select the perfect box and add your favorite gifts!</p>
    </section>

    <!-- Cards Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Choose Your Box Card -->
            <a href="chooseBox.php" class="card block bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300 transform hover:scale-105">
                <img src="https://i.pinimg.com/736x/14/d5/75/14d575aef399e9e5819a8aba80ab3893.jpg" 
                     alt="Choose Your Box" 
                     class="w-full h-80 object-cover transition-transform duration-500">
                <div class="p-8 text-center">
                    <h2 class="text-3xl font-semibold text-gray-800 transition-colors duration-300">Choose Your Box</h2>
                    <p class="text-gray-600 mt-4">Select from a variety of elegant boxes to suit your style.</p>
                </div>
            </a>

            <!-- Choose Your Gifts Card -->
            <a href="products.php" class="card block bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300 transform hover:scale-105">
                <img src="https://i.pinimg.com/236x/df/9b/80/df9b80a703566f7ac511550020bc197f.jpg" 
                     alt="Choose Your Gifts" 
                     class="w-full h-80 object-cover transition-transform duration-500">
                <div class="p-8 text-center">
                    <h2 class="text-3xl font-semibold text-gray-800 transition-colors duration-300">Choose Your Gifts</h2>
                    <p class="text-gray-600 mt-4">Add delightful gifts to create the perfect package.</p>
                </div>
            </a>
        </div>
    </section>

    <!-- Footer -->
    <?php include '../includes/footer.php'; ?>
</body>
</html>
