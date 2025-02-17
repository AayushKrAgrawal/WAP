<?php
session_start();
ob_start(); // Start output buffering
include('../includes/header.php');
include('../includes/db_connect.php'); // Assuming the db_connect.php file is using PDO for database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get the package ID from the URL
if (isset($_GET['id'])) {
    $packageId = $_GET['id'];

    // Fetch package details
    $sql = "SELECT * FROM packages WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $packageId, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $package = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "<p>Package not found.</p>";
        exit();
    }
} else {
    echo "<p>No package ID specified.</p>";
    exit();
}

// Add to cart logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $packageId = $_POST['package_id'];
    $quantity = $_POST['quantity'];
    $userId = $_SESSION['user_id'];

    // Check if package is already in cart
    $checkSql = "SELECT * FROM cart WHERE user_id = :user_id AND package_id = :package_id";
    $stmt = $conn->prepare($checkSql);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->bindParam(':package_id', $packageId, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // If package already in cart, update quantity
        $updateSql = "UPDATE cart SET package_quantity = package_quantity + :quantity WHERE user_id = :user_id AND package_id = :package_id";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $updateStmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $updateStmt->bindParam(':package_id', $packageId, PDO::PARAM_INT);
        $updateStmt->execute();
    } else {
        // If package not in cart, insert new record
        $insertSql = "INSERT INTO cart (user_id, package_id, package_quantity) VALUES (:user_id, :package_id, :package_quantity)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $insertStmt->bindParam(':package_id', $packageId, PDO::PARAM_INT);
        $insertStmt->bindParam(':package_quantity', $quantity, PDO::PARAM_INT);
        $insertStmt->execute();
    }

    // Set session flash message and redirect
    $_SESSION['cart_message'] = 'Added to cart';
    header("Location: preMadePackage_detail.php?id=$packageId");
    exit();
}

// Fetch related packages (random or based on category)
$relatedPackagesSql = "SELECT * FROM packages WHERE id != :id LIMIT 4";
$relatedStmt = $conn->prepare($relatedPackagesSql);
$relatedStmt->bindParam(':id', $packageId, PDO::PARAM_INT);
$relatedStmt->execute();
$relatedPackagesResult = $relatedStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($package['title']); ?> - Package Details</title>
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

    <!-- Package Details Section -->
    <div class="max-w-7xl mx-auto py-10 px-4">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden lg:flex">
            <div class="lg:w-1/3 p-4">
                <img class="w-full h-64 object-cover rounded-md transition transform hover:scale-105" 
                     src="<?php echo htmlspecialchars($package['image_url']); ?>" 
                     alt="<?php echo htmlspecialchars($package['title']); ?>" />
            </div>

            <div class="lg:w-2/3 p-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-4"><?php echo htmlspecialchars($package['title']); ?></h1>
                <p class="text-gray-600 mb-6"><?php echo htmlspecialchars($package['description']); ?></p>
                <p class="text-2xl font-bold text-indigo-600 mb-6">Rs. <?php echo htmlspecialchars($package['price']); ?></p>

                <div class="flex items-center mb-6">
                    <span class="text-lg font-semibold mr-4">Quantity:</span>
                    <div class="flex items-center space-x-2">
                        <button type="button" class="decrement bg-gray-300 px-3 py-1 rounded-md hover:bg-gray-400 transition">-</button>
                        <input type="number" id="quantity" name="quantity" value="1" min="1" max="20" class="w-16 text-center border border-gray-300 rounded-md p-2">
                        <button type="button" class="increment bg-gray-300 px-3 py-1 rounded-md hover:bg-gray-400 transition">+</button>
                    </div>
                </div>

                <p id="total_price" class="text-xl font-bold text-gray-800 mb-6">Total Price: Rs. <?php echo htmlspecialchars($package['price']); ?></p>

                <form method="post">
                    <input type="hidden" name="package_id" value="<?php echo $packageId; ?>">
                    <input type="hidden" name="quantity" id="hidden_quantity" value="1">
                    <button type="submit" name="add_to_cart" 
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md transition">
                        Add to Cart
                    </button>
                </form>

                <a href="preMadePackages.php" class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-md transition mt-4 inline-block">Back to Package List</a>
            </div>
        </div>
    </div>

    <script>
        const decrementBtn = document.querySelector('.decrement');
        const incrementBtn = document.querySelector('.increment');
        const quantityInput = document.getElementById('quantity');
        const hiddenQuantityInput = document.getElementById('hidden_quantity');
        const totalPriceDisplay = document.getElementById('total_price');
        const packagePrice = <?php echo $package['price']; ?>;

        decrementBtn.addEventListener('click', () => {
            let quantity = parseInt(quantityInput.value);
            if (quantity > 1) {
                quantityInput.value = quantity - 1;
                hiddenQuantityInput.value = quantity - 1;
                totalPriceDisplay.innerHTML = "Total Price: Rs. " + (packagePrice * (quantity - 1));
            }
        });

        incrementBtn.addEventListener('click', () => {
            let quantity = parseInt(quantityInput.value);
            if (quantity < 20) {
                quantityInput.value = quantity + 1;
                hiddenQuantityInput.value = quantity + 1;
                totalPriceDisplay.innerHTML = "Total Price: Rs. " + (packagePrice * (quantity + 1));
            }
        });

        quantityInput.addEventListener('input', () => {
            hiddenQuantityInput.value = quantityInput.value;
            totalPriceDisplay.innerHTML = "Total Price: Rs. " + (packagePrice * quantityInput.value);
        });
    </script>

</body>
</html>
