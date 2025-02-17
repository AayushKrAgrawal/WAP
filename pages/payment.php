<?php
ob_start(); // Start output buffering

session_start();

include('../includes/db_connect.php');
include('../includes/header.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Fetch the default address for the user using PDO
$sql = "SELECT * FROM user_addresses WHERE user_id = :user_id AND is_default = 1 LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
$stmt->execute();
$address = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch the cart items for the user using PDO
$sqlCart = "SELECT c.cart_id, c.product_quantity, c.boxes_quantity, c.package_quantity,
                   p.product_name, p.price AS product_price, 
                   b.name AS box_name, b.price AS box_price, 
                   pkg.title AS package_title, pkg.price AS package_price
            FROM cart c
            LEFT JOIN products p ON c.product_id = p.product_id
            LEFT JOIN boxes b ON c.boxes_id = b.id
            LEFT JOIN packages pkg ON c.package_id = pkg.id
            WHERE c.user_id = :user_id";
$stmtCart = $conn->prepare($sqlCart);
$stmtCart->bindParam(':user_id', $userId, PDO::PARAM_INT);
$stmtCart->execute();
$resultCart = $stmtCart->fetchAll(PDO::FETCH_ASSOC);

$totalCost = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if payment method is selected
    if (isset($_POST['payment_method'])) {
        $paymentMethod = $_POST['payment_method'];

        // Insert the order into the orders table
        $sqlOrder = "INSERT INTO orders (user_id, shipping_address, city, province, postal_code, latitude, longitude, total_cost, payment_method) 
                     VALUES (:user_id, :shipping_address, :city, :province, :postal_code, :latitude, :longitude, :total_cost, :payment_method)";
        $stmtOrder = $conn->prepare($sqlOrder);
        $stmtOrder->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmtOrder->bindParam(':shipping_address', $address['address'], PDO::PARAM_STR);
        $stmtOrder->bindParam(':city', $address['city'], PDO::PARAM_STR);
        $stmtOrder->bindParam(':province', $address['province'], PDO::PARAM_STR);
        $stmtOrder->bindParam(':postal_code', $address['postal_code'], PDO::PARAM_STR);
        $stmtOrder->bindParam(':latitude', $address['latitude'], PDO::PARAM_STR);
        $stmtOrder->bindParam(':longitude', $address['longitude'], PDO::PARAM_STR);
        $stmtOrder->bindParam(':total_cost', $totalCost, PDO::PARAM_STR);
        $stmtOrder->bindParam(':payment_method', $paymentMethod, PDO::PARAM_STR);
        $stmtOrder->execute();

        // Get the last inserted order ID
        $orderId = $conn->lastInsertId();

        // Insert each cart item into the order_items table
        foreach ($resultCart as $item) {
            if ($item['product_name']) {
                $itemPrice = $item['product_price'];
                $itemName = $item['product_name'];
                $itemQuantity = $item['product_quantity'];
            } elseif ($item['box_name']) {
                $itemPrice = $item['box_price'];
                $itemName = $item['box_name'];
                $itemQuantity = $item['boxes_quantity'];
            } elseif ($item['package_title']) {
                $itemPrice = $item['package_price'];
                $itemName = $item['package_title'];
                $itemQuantity = $item['package_quantity'];
            }
            $itemTotal = $itemPrice * $itemQuantity;
            $totalCost += $itemTotal;

            // Insert the item into the order_items table
            $sqlOrderItem = "INSERT INTO order_items (order_id, product_id, box_id, package_id, product_name, quantity, price, total) 
                             VALUES (:order_id, :product_id, :box_id, :package_id, :product_name, :quantity, :price, :total)";
            $stmtOrderItem = $conn->prepare($sqlOrderItem);
            $stmtOrderItem->bindParam(':order_id', $orderId, PDO::PARAM_INT);
            $stmtOrderItem->bindParam(':product_id', $item['product_id'], PDO::PARAM_INT);
            $stmtOrderItem->bindParam(':box_id', $item['boxes_id'], PDO::PARAM_INT);
            $stmtOrderItem->bindParam(':package_id', $item['package_id'], PDO::PARAM_INT);
            $stmtOrderItem->bindParam(':product_name', $itemName, PDO::PARAM_STR);
            $stmtOrderItem->bindParam(':quantity', $itemQuantity, PDO::PARAM_INT);
            $stmtOrderItem->bindParam(':price', $itemPrice, PDO::PARAM_STR);
            $stmtOrderItem->bindParam(':total', $itemTotal, PDO::PARAM_STR);
            $stmtOrderItem->execute();
        }

        // Redirect to order received page after payment processing
        header("Location: order_received.php");
        exit();
    } else {
        // If no payment method is selected, show an error message
        $errorMessage = "Please select a payment method.";
    }
}
ob_end_flush(); // Send output buffer content to browser

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans">
    <div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-extrabold text-gray-800 mb-8">Payment</h1>

        <?php if (isset($errorMessage)): ?>
            <div class="bg-red-100 text-red-800 p-4 rounded mb-8">
                <p class="font-bold">Error: <?php echo htmlspecialchars($errorMessage); ?></p>
            </div>
        <?php endif; ?>

        <?php if ($address): ?>
            <div class="bg-white shadow-md rounded-lg p-6 mb-8">
                <h2 class="text-xl font-bold text-gray-800">Shipping Address</h2>
                <p class="text-gray-700 mt-2"><?php echo htmlspecialchars($address['address']); ?></p>
                <p class="text-gray-700"><?php echo htmlspecialchars($address['city']); ?>, <?php echo htmlspecialchars($address['province']); ?></p>
                <p class="text-gray-700"><?php echo htmlspecialchars($address['postal_code']); ?></p>
                <p class="text-gray-700"><?php echo "Lat: " . htmlspecialchars($address['latitude']) . ", Long: " . htmlspecialchars($address['longitude']); ?></p>
            </div>
        <?php else: ?>
            <div class="bg-white shadow-md rounded-lg p-6 mb-8">
                <p class="text-lg text-gray-600">No default address found. Please add an address.</p>
                <a href="add_address.php" class="inline-block mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Add Address
                </a>
            </div>
        <?php endif; ?>

        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h2 class="text-xl font-bold text-gray-800">Order Summary</h2>
            <ul class="divide-y divide-gray-200">
                <?php foreach ($resultCart as $item): ?>
                    <?php
                        if ($item['product_name']) {
                            $itemPrice = $item['product_price'];
                            $itemName = $item['product_name'];
                            $itemQuantity = $item['product_quantity'];
                        } elseif ($item['box_name']) {
                            $itemPrice = $item['box_price'];
                            $itemName = $item['box_name'];
                            $itemQuantity = $item['boxes_quantity'];
                        } elseif ($item['package_title']) {
                            $itemPrice = $item['package_price'];
                            $itemName = $item['package_title'];
                            $itemQuantity = $item['package_quantity'];
                        }
                        $itemTotal = $itemPrice * $itemQuantity;
                        $totalCost += $itemTotal;
                    ?>
                    <li class="px-4 py-6 sm:px-6">
                        <div class="flex items-center space-x-4">
                            <div class="flex-grow">
                                <div class="flex justify-between">
                                    <h2 class="text-lg font-medium text-gray-800"><?php echo htmlspecialchars($itemName); ?></h2>
                                    <p class="text-gray-600">Rs. <?php echo number_format($itemPrice, 2); ?></p>
                                </div>
                                <div class="mt-2 flex items-center justify-between">
                                    <div>
                                        <p class="text-gray-700 font-medium">Total: Rs. <?php echo number_format($itemTotal, 2); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="bg-gray-100 px-4 py-6 sm:px-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-gray-800">Total: Rs. <?php echo number_format($totalCost, 2); ?></h2>
                </div>
            </div>
        </div>

        <form method="POST">
            <div class="bg-white shadow-md rounded-lg p-6 mb-8">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Payment Method</h2>
                <div class="space-y-4">
                    <label class="block">
                        <input type="radio" name="payment_method" value="Cash on Delivery" class="mr-2"> Cash on Delivery
                    </label>
                    <label class="block">
                        <input type="radio" name="payment_method" value="Credit/Debit Card" class="mr-2"> Credit/Debit Card
                    </label>
                    <label class="block">
                        <input type="radio" name="payment_method" value="Bank Transfer" class="mr-2"> Bank Transfer
                    </label>
                </div>
                <div class="mt-8">
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Confirm Payment</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
