<?php
session_start();
include('../includes/header.php');
include('../includes/db_connect.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get the box ID from the URL
if (isset($_GET['id'])) {
    $boxId = $_GET['id'];

    // Fetch box details from the 'boxes' table
    $sql = "SELECT * FROM boxes WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $boxId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $box = $result->fetch_assoc();
        } else {
            echo "<p>Box not found.</p>";
            exit();
        }
    } else {
        echo "<p>Error fetching box details.</p>";
        exit();
    }
} else {
    echo "<p>No box ID specified.</p>";
    exit();
}

// Add to cart logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $boxId = $_POST['box_id'];
    $quantity = $_POST['quantity'];
    $userId = $_SESSION['user_id'];

    // Check if box is already in cart
    $checkSql = "SELECT * FROM cart WHERE user_id = ? AND box_id = ?";
    $stmt = $conn->prepare($checkSql);
    $stmt->bind_param("ii", $userId, $boxId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // If box already in cart, update quantity
        $updateSql = "UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND box_id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("iii", $quantity, $userId, $boxId);
        $updateStmt->execute();
    } else {
        // If box not in cart, insert new record
        $insertSql = "INSERT INTO cart (user_id, box_id, quantity) VALUES (?, ?, ?)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("iii", $userId, $boxId, $quantity);
        $insertStmt->execute();
    }

    echo "<script>alert('Box added to cart!');</script>";
    echo "<script>window.location.href = 'box_detail.php?id=$boxId';</script>";
}

// Fetch related boxes (same category or random boxes)
$relatedBoxesSql = "SELECT * FROM boxes WHERE id != ? LIMIT 4";
$relatedStmt = $conn->prepare($relatedBoxesSql);
$relatedStmt->bind_param("i", $boxId);
$relatedStmt->execute();
$relatedBoxesResult = $relatedStmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($box['name']); ?> - Box Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Box Details Section -->
    <div class="max-w-7xl mx-auto py-10 px-4">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden lg:flex">
            <!-- Box Image -->
            <div class="lg:w-1/3 p-4">
                <img class="w-full h-64 object-cover rounded-md transition transform hover:scale-105" 
                     src="<?php echo htmlspecialchars($box['image_url']); ?>" 
                     alt="<?php echo htmlspecialchars($box['name']); ?>" />
            </div>

            <!-- Box Information -->
            <div class="lg:w-2/3 p-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-4"><?php echo htmlspecialchars($box['name']); ?></h1>
                <p class="text-gray-600 mb-6"><?php echo htmlspecialchars($box['description']); ?></p>
                <p class="text-2xl font-bold text-indigo-600 mb-6">Rs. <?php echo htmlspecialchars($box['price']); ?></p>

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
                <p id="total_price" class="text-xl font-bold text-gray-800 mb-6">Total Price: Rs. <?php echo htmlspecialchars($box['price']); ?></p>

                <!-- Add to Cart Form -->
                <form method="post">
                    <input type="hidden" name="box_id" value="<?php echo $boxId; ?>">
                    <input type="hidden" name="quantity" id="hidden_quantity" value="1">
                    <button type="submit" name="add_to_cart" 
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md transition">
                        Add to Cart
                    </button>
                </form>

                <!-- Back to Boxes -->
                <a href="dashboard.php" class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-md transition mt-4 inline-block">Back to Box List</a>
            </div>
        </div>

        <!-- More Boxes Section -->
        <div class="mt-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">You may also like</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
                <?php while ($relatedBox = $relatedBoxesResult->fetch_assoc()) : ?>
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <!-- Make the image clickable and redirect to box details page -->
                        <a href="box_detail.php?id=<?php echo $relatedBox['id']; ?>">
                            <img class="w-full h-48 object-cover" src="<?php echo htmlspecialchars($relatedBox['image_url']); ?>" alt="<?php echo htmlspecialchars($relatedBox['name']); ?>">
                        </a>
                        <div class="p-4">
                            <!-- Make the box name clickable and redirect to box details page -->
                            <a href="box_detail.php?id=<?php echo $relatedBox['id']; ?>" class="text-xl font-semibold text-gray-800 hover:text-indigo-600">
                                <?php echo htmlspecialchars($relatedBox['name']); ?>
                            </a>
                            <p class="text-gray-600 mb-4"><?php echo htmlspecialchars($relatedBox['description']); ?></p>
                            <p class="text-xl font-bold text-indigo-600">Rs. <?php echo htmlspecialchars($relatedBox['price']); ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
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
        const boxPrice = <?php echo $box['price']; ?>;

        decrementBtn.addEventListener('click', () => {
            let quantity = parseInt(quantityInput.value);
            if (quantity > 1) {
                quantityInput.value = quantity - 1;
                hiddenQuantityInput.value = quantity - 1;
                totalPriceDisplay.innerHTML = "Total Price: Rs. " + (boxPrice * (quantity - 1));
            }
        });

        incrementBtn.addEventListener('click', () => {
            let quantity = parseInt(quantityInput.value);
            if (quantity < 20) {
                quantityInput.value = quantity + 1;
                hiddenQuantityInput.value = quantity + 1;
                totalPriceDisplay.innerHTML = "Total Price: Rs. " + (boxPrice * (quantity + 1));
            }
        });

        quantityInput.addEventListener('input', () => {
            hiddenQuantityInput.value = quantityInput.value;
            totalPriceDisplay.innerHTML = "Total Price: Rs. " + (boxPrice * quantityInput.value);
        });
    </script>

</body>
</html>
