<?php
include('../includes/db_connect.php');

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['product_name']); ?> - Product Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Inline custom CSS for more personalized design */
        .product-card {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1), 0 6px 12px rgba(0, 0, 0, 0.07);
            border-radius: 12px;
            background: #f8f8f8;
        }
        .product-image {
            transition: transform 0.3s ease-in-out;
        }
        .product-image:hover {
            transform: scale(1.1);
        }
        .button {
            padding: 12px 20px;
            background-color: #B82132; /* Updated button color */
            color: white;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #9B1E2F; /* Darker shade on hover */
        }
        .quantity-controls button {
            background-color: #ccc;
            padding: 6px 12px;
            border-radius: 5px;
            margin: 0 5px;
            font-size: 16px;
            transition: background-color 0.2s ease;
        }
        .quantity-controls button:hover {
            background-color: #999;
        }
        .navbar {
            background-color: #4CAF50;
            padding: 10px 20px;
            position: sticky;
            top: 0;
            width: 100%;
            z-index: 100;
        }
        .navbar a {
            color: white;
            margin-right: 20px;
            font-weight: 500;
            text-decoration: none;
        }
        .navbar a:hover {
            color: #f1f1f1;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans tracking-wide">

    <!-- Navbar -->
    <nav class="navbar">
        <div class="container mx-auto flex justify-between items-center">
            <a href="dashboard.php" class="text-xl font-semibold">Product Dashboard</a>
            <div class="flex">
                <a href="products.php">Products</a>
                <a href="#">Cart</a>
                <a href="#">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Product Details Section -->
    <div class="container mx-auto px-4 py-10">
        <div class="product-card overflow-hidden lg:flex shadow-xl">
            <!-- Product Image -->
            <div class="lg:w-1/2 p-6">
                <img class="w-full h-auto object-cover product-image rounded-xl" src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" />
            </div>

            <!-- Product Information -->
            <div class="lg:w-1/2 p-6">
                <h1 class="text-4xl font-semibold text-gray-800 leading-tight mb-4"><?php echo htmlspecialchars($product['product_name']); ?></h1>
                <p class="text-lg text-gray-600 mb-6"><?php echo htmlspecialchars($product['description']); ?></p>
                <p class="text-3xl font-bold text-gray-800 mb-6">Rs. <?php echo htmlspecialchars($product['price']); ?></p>
                
                <!-- Quantity Control -->
                <div class="flex items-center mb-6">
                    <span class="text-lg font-semibold mr-4">Quantity:</span>
                    <div class="quantity-controls flex items-center">
                        <button class="decrement button">-</button>
                        <input type="number" id="quantity" value="1" min="1" class="w-16 text-center border border-gray-400 rounded-md mx-2 p-2">
                        <button class="increment button">+</button>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between items-center">
                    <a href="dashboard.php" class="button hover:bg-red-600">Back to Product List</a>
                    <button class="button hover:bg-blue-600">Add to Cart</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Quantity Control Logic
        const decrementBtn = document.querySelector('.decrement');
        const incrementBtn = document.querySelector('.increment');
        const quantityInput = document.getElementById('quantity');

        decrementBtn.addEventListener('click', () => {
            let quantity = parseInt(quantityInput.value);
            if (quantity > 1) {
                quantityInput.value = quantity - 1;
            }
        });

        incrementBtn.addEventListener('click', () => {
            let quantity = parseInt(quantityInput.value);
            quantityInput.value = quantity + 1;
        });
    </script>

</body>
</html>
