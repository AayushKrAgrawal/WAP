<?php 
include '../includes/header.php'; 
include '../components/card.php'; 
include '../includes/db_connect.php'; // Include your database connection file
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customized Gifts</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body style="background-color: #F5EFFF;"> 

<!-- Our Packages Section -->
<section class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl font-semibold text-center text-gray-800 mb-8">Choose your Customized Gift</h2>
    
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
                <p class="text-gray-600">Showing Products</p>
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
                    try {
                        // Set up PDO connection
                        $pdo = new PDO("mysql:host=localhost;dbname=hamroPratibha", "root", "");
                        // Set the PDO error mode to exception
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Query the products
                        $stmt = $pdo->query("SELECT * FROM products");

                        // Check if products are found
                        if ($stmt->rowCount() > 0) {
                            // Loop through each product and display it using the renderCard function
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo renderCard([
                                    "imageUrl" => $row['image_url'], 
                                    "link" => "product_detail.php?id=" . $row['product_id'], 
                                    "title" => $row['product_name'], 
                                    "description" => $row['description'], 
                                    "price" => "" . number_format($row['price'], 2)
                                ]);
                            }
                        } else {
                            echo "<p class='text-gray-600'>No products found.</p>";
                        }
                    } catch (PDOException $e) {
                        echo "<p class='text-red-500'>Error: " . $e->getMessage() . "</p>";
                    }
                ?>
            </div>
        </div>
    </div>
</section>
</body>
</html>

<?php include '../includes/footer.php'; ?>
