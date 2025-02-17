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

// Fetch cart items for the user, including products, boxes, and packages
$sql = "SELECT c.cart_id, 
                c.product_quantity, c.boxes_quantity, c.package_quantity,
                p.product_name, p.price AS product_price, p.image_url, 
                b.name AS box_name, b.price AS box_price, b.image_url AS box_image_url,
                pkg.title AS package_title, pkg.price AS package_price, pkg.image_url AS package_image_url
        FROM cart c
        LEFT JOIN products p ON c.product_id = p.product_id
        LEFT JOIN boxes b ON c.boxes_id = b.id
        LEFT JOIN packages pkg ON c.package_id = pkg.id
        WHERE c.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$totalCost = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-50 font-sans">
    <div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-extrabold text-gray-800 mb-8">Your Shopping Cart</h1>

        <?php if ($result->num_rows > 0): ?>
            <div class="shadow-md rounded-lg overflow-hidden">
                <ul class="divide-y divide-gray-200">
                    <?php while ($item = $result->fetch_assoc()): ?>
                        <?php
                            // Calculate cost for each item type
                            if ($item['product_name']) {
                                $itemPrice = $item['product_price'];
                                $itemName = htmlspecialchars($item['product_name']);
                                $itemImageUrl = htmlspecialchars($item['image_url']);
                                $itemQuantity = $item['product_quantity'];
                                $itemType = 'product';
                            } elseif ($item['box_name']) {
                                $itemPrice = $item['box_price'];
                                $itemName = htmlspecialchars($item['box_name']);
                                $itemImageUrl = htmlspecialchars($item['box_image_url']);
                                $itemQuantity = $item['boxes_quantity'];
                                $itemType = 'box';
                            } elseif ($item['package_title']) {
                                $itemPrice = $item['package_price'];
                                $itemName = htmlspecialchars($item['package_title']);
                                $itemImageUrl = htmlspecialchars($item['package_image_url']);
                                $itemQuantity = $item['package_quantity'];
                                $itemType = 'package';
                            }
                            $itemTotal = $itemPrice * $itemQuantity;
                            $totalCost += $itemTotal;
                        ?>
                        <li class="px-4 py-6 sm:px-6">
                            <div class="flex items-center space-x-4">
                                <img src="<?php echo $itemImageUrl; ?>" alt="<?php echo $itemName; ?>" class="w-20 h-20 rounded-lg object-cover flex-shrink-0">
                                <div class="flex-grow">
                                    <div class="flex justify-between">
                                        <h2 class="text-lg font-medium text-gray-800"><?php echo $itemName; ?></h2>
                                        <p class="text-gray-600">Rs. <?php echo number_format($itemPrice, 2); ?></p>
                                    </div>
                                    <div class="mt-2 flex items-center justify-between">
                                        <div class="flex items-center space-x-2">
                                            <span class="text-sm text-gray-500">Quantity:</span>
                                            <form method="post" action="../api/update_cart.php" class="inline-flex items-center">
                                                <input type="hidden" name="cart_id" value="<?php echo $item['cart_id']; ?>">
                                                <input type="hidden" name="item_type" value="<?php echo $itemType; ?>">
                                                <input type="number" name="quantity" value="<?php echo $itemQuantity; ?>" min="1" max="20" class="appearance-none w-20 text-center border border-gray-300 rounded-md py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                                <button type="submit" class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                                    Update
                                                </button>
                                            </form>
                                            <form method="post" action="../api/remove_from_cart.php" class="inline-flex items-center">
                                                <input type="hidden" name="cart_id" value="<?php echo $item['cart_id']; ?>">
                                                <input type="hidden" name="item_type" value="<?php echo $itemType; ?>">
                                                <button type="submit" class="ml-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                                     Remove
                                                </button>
                                            </form>
                                        </div>
                                        <div>
                                            <p class="text-gray-700 font-medium">Total: Rs. <?php echo number_format($itemTotal, 2); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php endwhile; ?>
                </ul>

                <div class="bg-gray-100 px-4 py-6 sm:px-6">
                    <div class="flex justify-between items-center">
                        <h2 class="text-2xl font-bold text-gray-800">Total: Rs. <?php echo number_format($totalCost, 2); ?></h2>
                        <form method="post" action="add_address.php">
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-md focus:outline-none focus:shadow-outline">
                                <i class="fas fa-shopping-cart mr-2"></i> Checkout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <p class="text-lg text-gray-600">Your cart is empty. Let's fill it with amazing items!</p>
                <a href="products.php" class="inline-block mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-arrow-left mr-2"></i> Continue Shopping
                </a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
