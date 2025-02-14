<?php
include('../includes/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_id']) && isset($_POST['quantity'])) {
    $cartId = $_POST['cart_id'];
    $quantity = $_POST['quantity'];

    // Update the quantity in the cart
    $sql = "UPDATE cart SET quantity = ? WHERE cart_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $quantity, $cartId);

    if ($stmt->execute()) {
        header("Location: ../pages/cart.php");
        exit();
    } else {
        echo "Error updating cart.";
    }
} else {
    echo "Invalid request.";
}
?>
