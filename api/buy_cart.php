<?php
session_start();
include('../includes/db_connect.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Assuming you'd want to create an order and remove cart items after the purchase
// You can store the order details in an "orders" table or similar
$sql = "SELECT c.cart_id, c.product_id, c.quantity, p.price 
        FROM cart c 
        JOIN products p ON c.product_id = p.product_id 
        WHERE c.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Process the purchase
    while ($item = $result->fetch_assoc()) {
        // Insert the item into an orders table (example)
        $orderSql = "INSERT INTO orders (user_id, product_id, quantity, price) 
                     VALUES (?, ?, ?, ?)";
        $orderStmt = $conn->prepare($orderSql);
        $orderStmt->bind_param("iiii", $userId, $item['product_id'], $item['quantity'], $item['price']);
        $orderStmt->execute();
    }

    // Optionally, clear the cart after purchase
    $deleteSql = "DELETE FROM cart WHERE user_id = ?";
    $deleteStmt = $conn->prepare($deleteSql);
    $deleteStmt->bind_param("i", $userId);
    $deleteStmt->execute();

    // Redirect to a confirmation or thank-you page
    header("Location: confirmation.php");
    exit();
} else {
    // If no cart items found
    header("Location: cart.php");
    exit();
}
?>
