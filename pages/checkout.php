<?php
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans">
    <div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-extrabold text-gray-800 mb-8">Checkout</h1>

        <?php if ($address): ?>
            <div class="bg-white shadow-md rounded-lg p-6 mb-8">
                <h2 class="text-xl font-bold text-gray-800">Shipping Address</h2>
                <p class="text-gray-700 mt-2"><?php echo $address['address']; ?></p>
                <p class="text-gray-700"><?php echo $address['city']; ?>, <?php echo $address['province']; ?></p>
                <p class="text-gray-700"><?php echo $address['postal_code']; ?></p>
                <p class="text-gray-700"><?php echo "Lat: " . $address['latitude'] . ", Long: " . $address['longitude']; ?></p>
            </div>
        <?php else: ?>
            <div class="bg-white shadow-md rounded-lg p-6 mb-8">
                <p class="text-lg text-gray-600">No default address found. Please add an address.</p>
                <a href="add_address.php" class="inline-block mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Add Address
                </a>
            </div>
        <?php endif; ?>

        <div class="shadow-md rounded-lg overflow-hidden">
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
                                    <h2 class="text-lg font-medium text-gray-800"><?php echo $itemName; ?></h2>
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
                    <form method="post" action="payment.php">
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-md focus:outline-none focus:shadow-outline">
                            Proceed to Payment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
