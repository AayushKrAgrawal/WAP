<?php
session_start();
include('../includes/db_connect.php');

// Fetch all products from the database
$sql = "SELECT * FROM products ORDER BY created_at DESC";
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
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-indigo-600 p-4 shadow-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="text-white text-xl font-semibold">
                <a href="dashboard.php">MyStore</a>
            </div>
            <div class="space-x-6 text-white">
                <a href="profile.php" class="hover:bg-indigo-500 p-2 rounded-md transition">Profile</a>
                <a href="logout.php" class="hover:bg-red-500 p-2 rounded-md transition">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="max-w-7xl mx-auto py-8 px-4">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Welcome to your Dashboard</h1>

        <!-- Product Cards Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php
            if ($result->num_rows > 0) {
                while ($product = $result->fetch_assoc()) {
                    ?>
                    <div class="bg-white p-4 rounded-lg shadow-lg transition transform hover:scale-105 hover:shadow-xl">
                        <img src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['product_name']; ?>" class="w-full h-48 object-cover rounded-md mb-4">
                        <h3 class="text-xl font-semibold text-gray-800"><?php echo $product['product_name']; ?></h3>
                        <p class="text-gray-600 mb-4"><?php echo substr($product['description'], 0, 100); ?>...</p>
                        <p class="text-lg font-bold text-indigo-600">Rs.<?php echo number_format($product['price'], 2); ?></p>
                        <div class="mt-4">
                            <a href="product_detail.php?id=<?php echo $product['product_id']; ?>" class="text-indigo-600 hover:bg-indigo-100 px-4 py-2 rounded-md">View Details</a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p class='col-span-4 text-center text-gray-500'>No products available at the moment.</p>";
            }
            ?>
        </div>
    </div>

</body>
</html>
