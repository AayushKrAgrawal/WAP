<?php 
include '../includes/header.php'; 
include '../components/card.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body style="background-color: #F5EFFF;"> <!-- Test inline style -->

<!-- Our Packages Section -->
<section class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl font-semibold text-center text-gray-800 mb-8">Our Packages</h2>
    
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Sidebar Filters -->
        <aside class="w-full md:w-1/4 bg-white rounded-lg shadow-md p-6 flex flex-col">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Filters <span class="text-sm text-gray-500 cursor-pointer">Clear filters</span></h3>
            <div>
                <h4 class="font-medium text-gray-700 mb-2">Categories</h4>
                <div class="space-y-2">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="form-checkbox text-blue-600"> <span class="text-gray-700">Itar</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="form-checkbox text-blue-600"> <span class="text-gray-700">Kafan</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="form-checkbox text-blue-600"> <span class="text-gray-700">Caps</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="form-checkbox text-blue-600"> <span class="text-gray-700">Food</span>
                    </label>
                </div>
            </div>
            <div class="mt-4">
                <h4 class="font-medium text-gray-700 mb-2">Price-range</h4>
                <div class="flex items-center space-x-2">
                    <input type="text" placeholder="Minimum" class="border px-2 py-1 w-1/2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <input type="text" placeholder="Maximum" class="border px-2 py-1 w-1/2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>
            </div>
        </aside>

        <!-- Packages Grid -->
        <div class="w-full md:w-3/4">
            <div class="flex justify-between items-center mb-6">
                <p class="text-gray-600">Showing 1003 Products</p>
                <div>
                    <label class="text-gray-600 mr-2">Sort By</label>
                    <select class="border px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                        <option>Popular</option>
                        <option>Newest</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                    </select>
                </div>
            </div>
            
            <!-- Packages Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php
                    echo renderCard(["imageUrl" => "https://i0.wp.com/handicraftsinnepal.com/wp-content/uploads/2020/07/traditional-buddhist-incense.jpg?fit=1800%2C1581&ssl=1", "link" => "#"]);
                    echo renderCard(["imageUrl" => "https://m.media-amazon.com/images/I/8106YOV4hrL.jpg", "link" => "#"]);
                    echo renderCard(["imageUrl" => "https://m.media-amazon.com/images/I/41S9netEKyL._AC_UY580_.jpg", "link" => "#"]);
                    echo renderCard(["imageUrl" => "https://i0.wp.com/handicraftsinnepal.com/wp-content/uploads/2017/06/ankhi-jyal-wooden.jpg?resize=1020%2C735&ssl=1", "link" => "#"]);
                    echo renderCard(["imageUrl" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTFfPJKRrDt108MiOBc-BeQQZizbRJFWjh-wg&s", "link" => "#"]);
                    echo renderCard(["imageUrl" => "https://swodeshi.com/wp-content/uploads/2024/05/Dhara-4-600x686.webp", "link" => "#"]);
                ?>
            </div>
        </div>
    </div>
</section>
</body>
</html>

<?php include '../includes/footer.php'; ?>
