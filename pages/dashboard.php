
<?php
session_start();
include('../includes/db_connect.php');
include('../includes/header.php');

// Use PDO to fetch all products from the database
try {
    $sql = "SELECT * FROM products ORDER BY created_at DESC LIMIT 3";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
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



<!-- Banner -->
<div class="w-full h-[600px] bg-cover bg-center" style="background-image: url('../assets/images/dashboard.jpg');">
    <div class="w-full h-full bg-black bg-opacity-40 flex items-center justify-center">
        <h1 class="text-white text-5xl font-bold">Welcome to Hamro Pratibha</h1>
    </div>
</div>

<!-- Categories Section -->
<div class="max-w-7xl mx-auto py-16 text-center">
    <h2 class="text-4xl font-bold text-[#B82132]">Categories</h2>
    <p class="text-gray-600 mt-4">Discover curated gift boxes featuring Nepali craftsmanship. Choose from pre-made selections or customize your own for any occasion.</p>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mt-8">
        <a href="preMadePackages.php" class="block">
            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-transform transform hover:scale-105">
                <img src="../assets/images/Pre-Made.jpg" alt="Our Packages" class="w-full h-72 object-cover">
                <div class="p-4 text-center">
                    <h3 class="text-2xl font-semibold text-[#B82132] mb-2">Our Packages</h3>
                </div>
            </div>
        </a>
        
        <a href="CustomizePackage.php" class="block">
            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-transform transform hover:scale-105">
                <img src="../assets/images/gift basket.jpg" alt="Customize Your Package" class="w-full h-72 object-cover">
                <div class="p-4 text-center">
                    <h3 class="text-2xl font-semibold text-[#B82132] mb-2">Customize Your Own Package</h3>
                </div>
            </div>
        </a>
    </div>
</div>

<!-- Our Products Section -->
<div class="max-w-7xl mx-auto py-16 text-center">
    <h2 class="text-4xl font-bold text-[#B82132]">Our Products</h2>
    <p class="text-gray-600 mt-4">Discover our thoughtfully curated gift boxes, each showcasing the rich artistry of Nepali craftsmanship. Whether you choose from our pre-made selections or customize your own, our gifts are perfect for any occasion, offering a personal and meaningful touch that celebrates Nepal's heritage.</p>
    
    <a href="products.php" class="inline-block bg-[#B82132] hover:bg-[#9F1E28] text-white px-6 py-3 rounded-full transition mt-6">Shop Now</a>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 mt-10">
        <?php
        if (count($products) > 0) {
            foreach ($products as $product) {
                ?>
                <a href="product_detail.php?id=<?php echo htmlspecialchars($product['product_id']); ?>" class="block">
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-transform transform hover:scale-105">
                        <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" class="w-full h-52 object-cover">
                        <div class="p-4 text-center">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2"><?php echo htmlspecialchars($product['product_name']); ?></h3>
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
        <p>&copy; <?php echo date('Y'); ?> Hamro Pratibha. All rights reserved.</p>
    </div>
</footer>

</body>
</html>
