<?php
session_start();
include('../includes/db_connect.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get the product ID from the URL
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Fetch product details
    $sql = "SELECT * FROM products WHERE product_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
        } else {
            echo "<p>Product not found.</p>";
            exit();
        }
    } else {
        echo "<p>Error fetching product details.</p>";
        exit();
    }
} else {
    echo "<p>No product ID specified.</p>";
    exit();
}

// Add to cart logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $userId = $_SESSION['user_id'];

    // Check if product is already in cart
    $checkSql = "SELECT * FROM cart WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($checkSql);
    $stmt->bind_param("ii", $userId, $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // If product already in cart, update quantity
        $updateSql = "UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("iii", $quantity, $userId, $productId);
        $updateStmt->execute();
    } else {
        // If product not in cart, insert new record
        $insertSql = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("iii", $userId, $productId, $quantity);
        $insertStmt->execute();
    }

    echo "<script>alert('Product added to cart!');</script>";
    echo "<script>window.location.href = 'product_detail.php?id=$productId';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['product_name']); ?> - Product Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-indigo-600 p-4 shadow-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="text-white text-xl font-semibold">
                <a href="dashboard.php">Product Dashboard</a>
            </div>
            <div class="space-x-6 text-white">
                <a href="products.php" class="hover:text-indigo-300 transition">Products</a>
                <a href="cart.php" class="hover:text-indigo-300 transition">Cart</a>
                <a href="logout.php" class="hover:text-indigo-300 transition">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Product Details Section -->
    <div class="max-w-7xl mx-auto py-10 px-4">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden lg:flex">
            <!-- Product Image -->
            <div class="lg:w-1/3 p-4">
                <img class="w-full h-64 object-cover rounded-md transition transform hover:scale-105" 
                     src="<?php echo htmlspecialchars($product['image_url']); ?>" 
                     alt="<?php echo htmlspecialchars($product['product_name']); ?>" />
            </div>

            <!-- Product Information -->
            <div class="lg:w-2/3 p-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-4"><?php echo htmlspecialchars($product['product_name']); ?></h1>
                <p class="text-gray-600 mb-6"><?php echo htmlspecialchars($product['description']); ?></p>
                <p class="text-2xl font-bold text-indigo-600 mb-6">Rs. <?php echo htmlspecialchars($product['price']); ?></p>

                <!-- Quantity Control -->
                <div class="flex items-center mb-6">
                    <span class="text-lg font-semibold mr-4">Quantity:</span>
                    <div class="flex items-center space-x-2">
                        <button type="button" class="decrement bg-gray-300 px-3 py-1 rounded-md hover:bg-gray-400 transition">-</button>
                        <input type="number" id="quantity" name="quantity" value="1" min="1" max="20" 
                               class="w-16 text-center border border-gray-300 rounded-md p-2">
                        <button type="button" class="increment bg-gray-300 px-3 py-1 rounded-md hover:bg-gray-400 transition">+</button>
                    </div>
                </div>

                <!-- Add to Cart Form -->
                <form method="post">
                    <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                    <input type="hidden" name="quantity" id="hidden_quantity" value="1">
                    <button type="submit" name="add_to_cart" 
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md transition">
                        Add to Cart
                    </button>
                </form>

                <!-- Back to Products -->
                <a href="dashboard.php" class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-md transition mt-4 inline-block">Back to Product List</a>
            </div>
        </div>
    </div>

    <script>
        // Quantity Control Logic
        const decrementBtn = document.querySelector('.decrement');
        const incrementBtn = document.querySelector('.increment');
        const quantityInput = document.getElementById('quantity');
        const hiddenQuantityInput = document.getElementById('hidden_quantity');

        decrementBtn.addEventListener('click', () => {
            let quantity = parseInt(quantityInput.value);
            if (quantity > 1) {
                quantityInput.value = quantity - 1;
                hiddenQuantityInput.value = quantity - 1;
            }
        });

        incrementBtn.addEventListener('click', () => {
            let quantity = parseInt(quantityInput.value);
            if (quantity < 20) {
                quantityInput.value = quantity + 1;
                hiddenQuantityInput.value = quantity + 1;
            }
        });

        quantityInput.addEventListener('input', () => {
            hiddenQuantityInput.value = quantityInput.value;
        });
    </script>

</body>
</html>
