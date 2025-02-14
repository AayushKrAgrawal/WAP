<?php
session_start();
include('../includes/db_connect.php');

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: /hamroPratibha/pages/login.php");
    exit;
}

if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];

    // Fetch product details
    $sql = "SELECT * FROM products WHERE product_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
        } else {
            echo "Product not found.";
            exit;
        }
    } else {
        echo "Error preparing statement.";
        exit;
    }

    // Process form submission to update product details
    if (isset($_POST['edit_product'])) {
        $productName = trim($_POST['product_name']);
        $description = trim($_POST['description']);
        $price = $_POST['price'];
        $imageUrl = trim($_POST['image_url']);

        if (empty($productName) || empty($description) || empty($price)) {
            echo "All fields are required!";
            exit;
        }

        $sql = "UPDATE products SET product_name = ?, description = ?, price = ?, image_url = ? WHERE product_id = ?";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssssi", $productName, $description, $price, $imageUrl, $productId);
            if ($stmt->execute()) {
                header("Location: manage_products.php");
            } else {
                echo "Error: " . $stmt->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <!-- Correct TailwindCSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans">

    <!-- Container -->
    <div class="flex items-center justify-center min-h-screen bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl p-8">

            <!-- Title -->
            <h1 class="text-3xl font-semibold text-gray-800 text-center mb-8">Edit Product</h1>

            <!-- Form -->
            <form method="POST" action="" class="space-y-6">
                
                <!-- Product Name -->
                <div>
                    <label for="product_name" class="block text-sm font-medium text-gray-700">Product Name</label>
                    <input type="text" id="product_name" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>" required class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description" required class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"><?php echo htmlspecialchars($product['description']); ?></textarea>
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                </div>

                <!-- Image URL -->
                <div>
                    <label for="image_url" class="block text-sm font-medium text-gray-700">Image URL</label>
                    <input type="text" id="image_url" name="image_url" value="<?php echo htmlspecialchars($product['image_url']); ?>" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" name="edit_product" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200">Update Product</button>
                </div>

            </form>
        </div>
    </div>

</body>
</html>
