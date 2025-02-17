<?php
include('../includes/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_id'])) {
    $cartId = $_POST['cart_id'];

    try {
        // Prepare the SQL statement to delete the item from the cart
        $sql = "DELETE FROM cart WHERE cart_id = :cart_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cart_id', $cartId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: ../pages/cart.php");
            exit();
        } else {
            echo "Error removing item from cart.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
?>
