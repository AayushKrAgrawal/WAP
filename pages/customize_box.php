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
<body class="bg-gray-100">

<!-- Our Packages Section -->
<section class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl font-semibold text-center text-gray-800 mb-8">Choose your Cusomized Box</h2>
    
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Sidebar Filters -->
        <aside class="w-full md:w-1/4 bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Filters <span class="text-sm text-gray-500 cursor-pointer">Clear filters</span></h3>
            <div>
                <h4 class="font-medium text-gray-700 mb-2">Categories</h4>
                <div class="space-y-2">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="form-checkbox text-blue-600"> <span class="text-gray-700">Paper Bag</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="form-checkbox text-blue-600"> <span class="text-gray-700">Cloth Pouch</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="form-checkbox text-blue-600"> <span class="text-gray-700">Nanglo Board</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="form-checkbox text-blue-600"> <span class="text-gray-700">Mesh Cloth</span>
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
                <p class="text-gray-600">Showing 6 Products</p>
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
                    echo renderCard(["imageUrl" => "https://i.pinimg.com/236x/77/be/0a/77be0a1cb532e3012ff416e6f36936ee.jpg", "link" => "#"]);
                    echo renderCard(["imageUrl" => "https://i.pinimg.com/736x/14/d5/75/14d575aef399e9e5819a8aba80ab3893.jpg", "link" => "#"]);
                    echo renderCard(["imageUrl" => "https://i.pinimg.com/236x/b5/04/97/b50497b6d5bafd255ed9facae1460ac4.jpg", "link" => "#"]);
                    echo renderCard(["imageUrl" => "https://i.pinimg.com/236x/d9/75/33/d97533a4a84039916c28b3d32cfcfb2c.jpg", "link" => "#"]);
                    echo renderCard(["imageUrl" => "https://i.pinimg.com/236x/7c/80/a3/7c80a3902c1e1238aa7ed56f762e0500.jpg", "link" => "#"]);
                    echo renderCard(["imageUrl" => "https://i.pinimg.com/236x/df/9b/80/df9b80a703566f7ac511550020bc197f.jpg", "link" => "#"]);
                ?>
            </div>
        </div>
    </div>
</section>
</body>
</html>

<?php include '../includes/footer.php'; ?>
