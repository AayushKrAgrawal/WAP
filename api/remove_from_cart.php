<?php
include('../includes/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_id'])) {
    $cartId = $_POST['cart_id'];

    // Delete the item from the cart
    $sql = "DELETE FROM cart WHERE cart_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $cartId);

    if ($stmt->execute()) {
        header("Location: ../pages/cart.php");
        exit();
    } else {
        echo "Error removing item from cart.";
    }
} else {
    echo "Invalid request.";
}
?>
