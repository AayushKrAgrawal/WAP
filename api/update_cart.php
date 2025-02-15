<?php
session_start();
include('../includes/db_connect.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get cart_id and new quantity
    $cartId = $_POST['cart_id'];
    $quantity = $_POST['quantity'];

    // Validate quantity input
    if (!is_numeric($quantity) || $quantity <= 0) {
        echo "Invalid quantity. Please enter a valid number.";
        exit();
    }

    // Update the cart based on the item type (product, box, or package)
    $sql = "SELECT product_id, boxes_id, package_id FROM cart WHERE cart_id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $cartId, $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Update the quantity based on the item type
        if ($row['product_id'] > 0) {
            // Update product quantity
            $sqlUpdate = "UPDATE cart SET product_quantity = ? WHERE cart_id = ? AND user_id = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("iii", $quantity, $cartId, $userId);
            $stmtUpdate->execute();
        } elseif ($row['boxes_id'] > 0) {
            // Update box quantity
            $sqlUpdate = "UPDATE cart SET product_quantity = ? WHERE cart_id = ? AND user_id = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("iii", $quantity, $cartId, $userId);
            $stmtUpdate->execute();
        } elseif ($row['package_id'] > 0) {
            // Update package quantity
            $sqlUpdate = "UPDATE cart SET product_quantity = ? WHERE cart_id = ? AND user_id = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("iii", $quantity, $cartId, $userId);
            $stmtUpdate->execute();
        }

        // Redirect to the cart page after updating
        header("Location: ../pages/cart.php");
        exit();
    } else {
        echo "Invalid cart item.";
        exit();
    }
}
?>
