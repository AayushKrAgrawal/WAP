<?php
session_start();
include('../includes/db_connect.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Fetch cart items for the user
$sql = "SELECT c.cart_id, c.quantity, p.product_name, p.price, p.image_url 
        FROM cart c 
        JOIN products p ON c.product_id = p.product_id 
        WHERE c.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
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
                    <div class="flex items-center bg-white p-4 rounded-xl shadow-md">
                        <img src="<?php echo $item['image_url']; ?>" alt="<?php echo $item['product_name']; ?>" class="w-24 h-24 rounded-lg object-cover mr-4">
                        <div class="flex-grow">
                            <h2 class="text-xl font-semibold"><?php echo $item['product_name']; ?></h2>
                            <p class="text-gray-600">Price: Rs. <?php echo $item['price']; ?></p>
                            <form method="post" action="../api/update_cart.php" class="mt-2">
                                <input type="hidden" name="cart_id" value="<?php echo $item['cart_id']; ?>">
                                <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" max="20" class="w-16 text-center border border-gray-400 rounded-md p-2">
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md ml-2">Update</button>
                            </form>
                        </div>
                        <form method="post" action="../api/remove_from_cart.php">
                            <input type="hidden" name="cart_id" value="<?php echo $item['cart_id']; ?>">
                            <button type="submit" class="text-red-600">Remove</button>
                        </form>
                    </div>
                <?php endwhile; ?>
            </div>

            <!-- Buy Button -->
            <div class="mt-6 text-right">
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
