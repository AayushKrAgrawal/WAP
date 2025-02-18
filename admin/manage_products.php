<?php
session_start();
include('../includes/db_connect.php'); // Make sure the db_connect.php file uses PDO to establish connection

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/login.php");
    exit();
}

// Add Product
if (isset($_POST['add_product'])) {
    $productName = trim($_POST['product_name']);
    $description = trim($_POST['description']);
    $price = $_POST['price'];

    // Handling image upload
    if (isset($_FILES['image']['name']) && $_FILES['image']['error'] == 0) {
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        $imageExt = pathinfo($imageName, PATHINFO_EXTENSION);
        
        // Validate image extension (only allow certain types)
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array(strtolower($imageExt), $allowedExt)) {
            echo "Invalid image type. Only JPG, JPEG, PNG, and GIF are allowed.";
            exit;
        }

        // Generate a unique name for the image to avoid conflicts
        $imageNewName = uniqid('', true) . "." . $imageExt;
        $imageUploadPath = "../assets/images/" . $imageNewName;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($imageTmpName, $imageUploadPath)) {
            try {
                // Insert product into the database using PDO
                $sql = "INSERT INTO products (product_name, description, price, image_url) VALUES (:product_name, :description, :price, :image_url)";
                $stmt = $conn->prepare($sql);
                $imageUrl = '../assets/images/' . $imageNewName; // Relative path to store in database
                $stmt->bindParam(':product_name', $productName);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':price', $price);
                $stmt->bindParam(':image_url', $imageUrl);

                if ($stmt->execute()) {
                    echo "<p class='text-green-500'>Product added successfully!</p>";
                } else {
                    echo "Error: " . $stmt->errorInfo()[2];
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "Error uploading the image.";
            exit;
        }
    } else {
        echo "No image file selected!";
        exit;
    }
}

// Edit Product
if (isset($_POST['edit_product'])) {
    $productId = $_POST['product_id'];
    $productName = trim($_POST['product_name']);
    $description = trim($_POST['description']);
    $price = $_POST['price'];
    $imageUrl = trim($_POST['image_url']);  // Keep existing image URL if no new image is uploaded

    if (empty($productName) || empty($description) || empty($price)) {
        echo "All fields are required!";
        exit;
    }

    // Check if a new image is uploaded
    if (isset($_FILES['image']['name']) && $_FILES['image']['error'] == 0) {
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        $imageExt = pathinfo($imageName, PATHINFO_EXTENSION);

        // Validate image extension
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array(strtolower($imageExt), $allowedExt)) {
            echo "Invalid image type. Only JPG, JPEG, PNG, and GIF are allowed.";
            exit;
        }

        // Generate a unique name for the image to avoid conflicts
        $imageNewName = uniqid('', true) . "." . $imageExt;
        $imageUploadPath = "../assets/images/" . $imageNewName;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($imageTmpName, $imageUploadPath)) {
            $imageUrl = 'assets/images/' . $imageNewName;
        } else {
            echo "Error uploading the image.";
            exit;
        }
    }

    try {
        // Update product information in the database using PDO
        $sql = "UPDATE products SET product_name = :product_name, description = :description, price = :price, image_url = :image_url WHERE product_id = :product_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':product_name', $productName);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image_url', $imageUrl);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "<p class='text-green-500'>Product updated successfully!</p>";
        } else {
            echo "Error: " . $stmt->errorInfo()[2];
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Delete Product
if (isset($_GET['delete_product'])) {
    $productId = $_GET['delete_product'];

    try {
        // Delete the product from the database using PDO
        $sql = "DELETE FROM products WHERE product_id = :product_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "<p class='text-red-500'>Product deleted successfully!</p>";
        } else {
            echo "Error: " . $stmt->errorInfo()[2];
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Fetch all products to display for admin
try {
    $sql = "SELECT * FROM products ORDER BY created_at DESC";
    $stmt = $conn->query($sql);

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
    <title>Manage Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <!-- Navbar -->
    <nav class="bg-indigo-600 p-4 shadow-lg">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="text-white text-2xl font-semibold">
                <a href="admin_dashboard.php">Admin Dashboard</a>
            </div>
            <div class="space-x-6 text-white">
                <a href="profile.php" class="hover:bg-indigo-500 p-2 rounded-md transition">Profile</a>
                <a href="../pages/login.php" class="hover:bg-red-500 p-2 rounded-md transition">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-8 px-4">

        <!-- Add New Product Form -->
        <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Add New Product</h2>
            <form method="POST" action="" enctype="multipart/form-data" class="space-y-4">
                <div class="flex flex-col">
                    <label for="product_name" class="text-gray-700">Product Name</label>
                    <input type="text" name="product_name" required class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
                </div>
                <div class="flex flex-col">
                    <label for="description" class="text-gray-700">Description</label>
                    <textarea name="description" required class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600"></textarea>
                </div>
                <div class="flex flex-col">
                    <label for="price" class="text-gray-700">Price</label>
                    <input type="number" name="price" required class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
                </div>
                <div class="flex flex-col">
                    <label for="image" class="text-gray-700">Product Image</label>
                    <input type="file" name="image" required class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600">
                </div>
                <button type="submit" name="add_product" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition">Add Product</button>
            </form>
        </div>

        <!-- Existing Products Section -->
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Existing Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php
            if (!empty($products)) {
                foreach ($products as $product) {
                    ?>
                    <div class="bg-white p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105 hover:shadow-xl">
                        <img src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['product_name']; ?>" class="w-full h-48 object-cover rounded-md mb-4">
                        <h3 class="text-xl font-semibold text-gray-800"><?php echo $product['product_name']; ?></h3>
                        <p class="text-gray-600 mb-4"><?php echo substr($product['description'], 0, 100); ?>...</p>
                        <p class="text-lg font-bold text-indigo-600">Rs.<?php echo number_format($product['price'], 2); ?></p>
                        <div class="mt-4 space-x-4">
                            <a href="?delete_product=<?php echo $product['product_id']; ?>" class="text-red-500 hover:underline">Delete</a>
                            <a href="edit_product.php?product_id=<?php echo $product['product_id']; ?>" class="text-indigo-600 hover:underline">Edit</a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p class='col-span-4 text-center text-gray-500'>No products available.</p>";
            }
            ?>
        </div>
    </div>

</body>
</html>
