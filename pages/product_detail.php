<?php
session_start();
ob_start(); // Start output buffering
include('../includes/header.php');
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
    $sql = "SELECT * FROM products WHERE product_id = :productId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        echo "<p>Product not found.</p>";
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
    $checkSql = "SELECT * FROM cart WHERE user_id = :userId AND product_id = :productId";
    $stmt = $conn->prepare($checkSql);
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
    $stmt->execute();
    $cartItem = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cartItem) {
        // If product already in cart, update quantity
        $updateSql = "UPDATE cart SET product_quantity = product_quantity + :quantity WHERE user_id = :userId AND product_id = :productId";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $updateStmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $updateStmt->bindParam(':productId', $productId, PDO::PARAM_INT);
        $updateStmt->execute();
    } else {
        // If product not in cart, insert new record
        $insertSql = "INSERT INTO cart (user_id, product_id, product_quantity) VALUES (:userId, :productId, :quantity)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $insertStmt->bindParam(':productId', $productId, PDO::PARAM_INT);
        $insertStmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $insertStmt->execute();
    }

    // Set session flash message and redirect
    $_SESSION['cart_message'] = 'Added to cart';
    header("Location: product_detail.php?id=$productId");
    exit();
}

// Fetch related products (same category or random products)
$relatedProductsSql = "SELECT * FROM products WHERE product_id != :productId LIMIT 4";
$relatedStmt = $conn->prepare($relatedProductsSql);
$relatedStmt->bindParam(':productId', $productId, PDO::PARAM_INT);
$relatedStmt->execute();
$relatedProducts = $relatedStmt->fetchAll(PDO::FETCH_ASSOC);
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

    <!-- Toast Notification -->
    <?php
    if (isset($_SESSION['cart_message'])) {
        echo '
        <div id="cart-toast" class="fixed top-5 right-5 bg-green-500 text-white py-2 px-4 rounded-md shadow-md transition transform opacity-0">
            ' . $_SESSION['cart_message'] . '
        </div>
        <script>
            // Show toast notification
            const cartToast = document.getElementById("cart-toast");
            cartToast.style.opacity = "1";
            cartToast.style.transform = "translateY(0)";
            
            // Hide after 3 seconds
            setTimeout(() => {
                cartToast.style.opacity = "0";
                cartToast.style.transform = "translateY(-20px)";
            }, 3000);
        </script>';
        unset($_SESSION['cart_message']);
    }
    ?>

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

                <!-- Total Price Display -->
                <p id="total_price" class="text-xl font-bold text-gray-800 mb-6">Total Price: Rs. <?php echo htmlspecialchars($product['price']); ?></p>

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

        <!-- More Products Section -->
        <div class="mt-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">You may also like</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
                <?php foreach ($relatedProducts as $relatedProduct) : ?>
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <!-- Make the image clickable and redirect to product details page -->
                        <a href="product_detail.php?id=<?php echo $relatedProduct['product_id']; ?>">
                            <img class="w-full h-48 object-cover" src="<?php echo htmlspecialchars($relatedProduct['image_url']); ?>" alt="<?php echo htmlspecialchars($relatedProduct['product_name']); ?>">
                        </a>
                        <div class="p-4">
                            <!-- Make the product name clickable and redirect to product details page -->
                            <a href="product_detail.php?id=<?php echo $relatedProduct['product_id']; ?>" class="text-xl font-semibold text-gray-800 hover:text-indigo-600">
                                <?php echo htmlspecialchars($relatedProduct['product_name']); ?>
                            </a>
                            <p class="text-gray-600 mb-4"><?php echo htmlspecialchars($relatedProduct['description']); ?></p>
                            <p class="text-xl font-bold text-indigo-600">Rs. <?php echo htmlspecialchars($relatedProduct['price']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>

    <script>
        // Quantity Control Logic
        const decrementBtn = document.querySelector('.decrement');
        const incrementBtn = document.querySelector('.increment');
        const quantityInput = document.getElementById('quantity');
        const hiddenQuantityInput = document.getElementById('hidden_quantity');
        const totalPriceDisplay = document.getElementById('total_price');
        const productPrice = <?php echo $product['price']; ?>;

        decrementBtn.addEventListener('click', () => {
            let quantity = parseInt(quantityInput.value);
            if (quantity > 1) {
                quantityInput.value = quantity - 1;
                hiddenQuantityInput.value = quantity - 1;
                totalPriceDisplay.innerHTML = "Total Price: Rs. " + (productPrice * (quantity - 1));
            }
        });

        incrementBtn.addEventListener('click', () => {
            let quantity = parseInt(quantityInput.value);
            if (quantity < 20) {
                quantityInput.value = quantity + 1;
                hiddenQuantityInput.value = quantity + 1;
                totalPriceDisplay.innerHTML = "Total Price: Rs. " + (productPrice * (quantity + 1));
            }
        });
    </script>

</body>
</html>
