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
$sql = "SELECT c.cart_id, c.product_quantity, 
                p.product_name, p.price, p.image_url, 
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
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans tracking-wide">
    <div class="container mx-auto px-4 py-10">
        <h1 class="text-4xl font-bold mb-6">Your Shopping Cart</h1>

        <?php if ($result->num_rows > 0): ?>
            <div class="grid grid-cols-1 gap-6">
                <?php while ($item = $result->fetch_assoc()): ?>
                    <?php
                        // Calculate cost for each item type
                        if ($item['product_name']) {
                            $itemPrice = $item['price'];
                        } elseif ($item['box_name']) {
                            $itemPrice = $item['box_price'];
                        } elseif ($item['package_title']) {
                            $itemPrice = $item['package_price'];
                        }
                        $itemTotal = $itemPrice * $item['product_quantity'];
                        $totalCost += $itemTotal;
                    ?>
                    <div class="flex items-center bg-white p-4 rounded-xl shadow-md">
                        <!-- Display Product -->
                        <?php if ($item['product_name']): ?>
                            <img src="<?php echo $item['image_url']; ?>" alt="<?php echo $item['product_name']; ?>" class="w-24 h-24 rounded-lg object-cover mr-4">
                            <div class="flex-grow">
                                <h2 class="text-xl font-semibold"><?php echo $item['product_name']; ?></h2>
                                <p class="text-gray-600">Price: Rs. <?php echo $item['price']; ?></p>
                                <p class="text-gray-600">Total: Rs. <?php echo $itemTotal; ?></p>
                                <form method="post" action="../api/update_cart.php" class="mt-2">
                                    <input type="hidden" name="cart_id" value="<?php echo $item['cart_id']; ?>">
                                    <input type="number" name="quantity" value="<?php echo $item['product_quantity']; ?>" min="1" max="20" class="w-16 text-center border border-gray-400 rounded-md p-2">
                                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md ml-2">Update</button>
                                </form>
                            </div>
                        <?php elseif ($item['box_name']): ?>
                            <img src="<?php echo $item['box_image_url']; ?>" alt="<?php echo $item['box_name']; ?>" class="w-24 h-24 rounded-lg object-cover mr-4">
                            <div class="flex-grow">
                                <h2 class="text-xl font-semibold"><?php echo $item['box_name']; ?></h2>
                                <p class="text-gray-600">Price: Rs. <?php echo $item['box_price']; ?></p>
                                <p class="text-gray-600">Total: Rs. <?php echo $itemTotal; ?></p>
                                <form method="post" action="../api/update_cart.php" class="mt-2">
                                    <input type="hidden" name="cart_id" value="<?php echo $item['cart_id']; ?>">
                                    <input type="number" name="quantity" value="<?php echo $item['product_quantity']; ?>" min="1" max="20" class="w-16 text-center border border-gray-400 rounded-md p-2">
                                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md ml-2">Update</button>
                                </form>
                            </div>
                        <?php elseif ($item['package_title']): ?>
                            <img src="<?php echo $item['package_image_url']; ?>" alt="<?php echo $item['package_title']; ?>" class="w-24 h-24 rounded-lg object-cover mr-4">
                            <div class="flex-grow">
                                <h2 class="text-xl font-semibold"><?php echo $item['package_title']; ?></h2>
                                <p class="text-gray-600">Price: Rs. <?php echo $item['package_price']; ?></p>
                                <p class="text-gray-600">Total: Rs. <?php echo $itemTotal; ?></p>
                                <form method="post" action="../api/update_cart.php" class="mt-2">
                                    <input type="hidden" name="cart_id" value="<?php echo $item['cart_id']; ?>">
                                    <input type="number" name="quantity" value="<?php echo $item['product_quantity']; ?>" min="1" max="20" class="w-16 text-center border border-gray-400 rounded-md p-2">
                                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md ml-2">Update</button>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>

            <!-- Display Total Cost -->
            <div class="mt-6 text-right">
                <h2 class="text-2xl font-bold">Total Cost: Rs. <?php echo $totalCost; ?></h2>
                <form method="post" action="../api/buy_cart.php">
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-md">Buy Now</button>
                </form>
            </div>
        <?php else: ?>
            <p class="text-xl text-gray-600">Your cart is empty.</p>
        <?php endif; ?>
    </div>
</body>
</html>
