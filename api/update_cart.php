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

    try {
        // Prepare the SQL statement to select the cart item based on cart_id and user_id
        $sql = "SELECT product_id, boxes_id, package_id FROM cart WHERE cart_id = :cart_id AND user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cart_id', $cartId, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // Update the quantity based on the item type
            if ($row['product_id'] > 0) {
                // Update product quantity
                $sqlUpdate = "UPDATE cart SET product_quantity = :quantity WHERE cart_id = :cart_id AND user_id = :user_id";
                $stmtUpdate = $conn->prepare($sqlUpdate);
                $stmtUpdate->bindParam(':quantity', $quantity, PDO::PARAM_INT);
                $stmtUpdate->bindParam(':cart_id', $cartId, PDO::PARAM_INT);
                $stmtUpdate->bindParam(':user_id', $userId, PDO::PARAM_INT);
                $stmtUpdate->execute();
            } elseif ($row['boxes_id'] > 0) {
                // Update box quantity
                $sqlUpdate = "UPDATE cart SET boxes_quantity = :quantity WHERE cart_id = :cart_id AND user_id = :user_id";
                $stmtUpdate = $conn->prepare($sqlUpdate);
                $stmtUpdate->bindParam(':quantity', $quantity, PDO::PARAM_INT);
                $stmtUpdate->bindParam(':cart_id', $cartId, PDO::PARAM_INT);
                $stmtUpdate->bindParam(':user_id', $userId, PDO::PARAM_INT);
                $stmtUpdate->execute();
            } elseif ($row['package_id'] > 0) {
                // Update package quantity
                $sqlUpdate = "UPDATE cart SET package_quantity = :quantity WHERE cart_id = :cart_id AND user_id = :user_id";
                $stmtUpdate = $conn->prepare($sqlUpdate);
                $stmtUpdate->bindParam(':quantity', $quantity, PDO::PARAM_INT);
                $stmtUpdate->bindParam(':cart_id', $cartId, PDO::PARAM_INT);
                $stmtUpdate->bindParam(':user_id', $userId, PDO::PARAM_INT);
                $stmtUpdate->execute();
            }

            // Redirect to the cart page after updating
            header("Location: ../pages/cart.php");
            exit();
        } else {
            echo "Invalid cart item.";
            exit();
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
