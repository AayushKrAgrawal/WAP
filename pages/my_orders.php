<?php
session_start();
include('../includes/db_connect.php');

// Ensure no output before this point
include('../includes/header.php'); // Includes header after no output has been sent

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Cancel order if requested
if (isset($_GET['cancel_order_id'])) {
    $orderIdToCancel = $_GET['cancel_order_id'];

    // Update the status to 'cancelled' in the database
    $sqlCancelOrder = "UPDATE orders SET status = 'cancelled' WHERE order_id = :order_id AND user_id = :user_id";
    $stmtCancelOrder = $conn->prepare($sqlCancelOrder);
    $stmtCancelOrder->bindParam(':order_id', $orderIdToCancel, PDO::PARAM_INT);
    $stmtCancelOrder->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmtCancelOrder->execute();

    // Redirect to refresh the page and show the updated status
    header("Location: my_orders.php");
    exit();
}

$sqlOrders = "SELECT o.order_id, o.total_cost, o.payment_method, o.status, 
                     a.address AS shipping_address, a.city, a.province, a.postal_code
              FROM orders o
              LEFT JOIN user_addresses a ON o.user_id = a.user_id
              WHERE o.user_id = :user_id AND o.status != 'cancelled'
              ORDER BY o.order_id DESC";  

$stmtOrders = $conn->prepare($sqlOrders);
$stmtOrders->bindParam(':user_id', $userId, PDO::PARAM_INT);
$stmtOrders->execute();
$orders = $stmtOrders->fetchAll(PDO::FETCH_ASSOC);

// Fetch the products ordered for each order
function getOrderItems($orderId, $userId) {
    global $conn;
    $sqlItems = "SELECT oi.product_name, oi.quantity, oi.price, oi.total
                 FROM order_items oi
                 JOIN orders o ON oi.order_id = o.order_id
                 WHERE oi.order_id = :order_id AND o.user_id = :user_id";
    $stmtItems = $conn->prepare($sqlItems);
    $stmtItems->bindParam(':order_id', $orderId, PDO::PARAM_INT);
    $stmtItems->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmtItems->execute();
    $items = $stmtItems->fetchAll(PDO::FETCH_ASSOC);

    // Return items for this order
    return $items;
}
?>

<!-- HTML Content -->
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">My Orders</h1>

    <?php if (count($orders) > 0): ?>
        <div class="space-y-6">
            <?php foreach ($orders as $order): ?>
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold">Order #<?php echo $order['order_id']; ?></h2>
                        <span class="text-sm text-gray-500"><?php echo ucfirst($order['status']); ?></span>
                    </div>

                    <h3 class="text-lg font-semibold mt-4 mb-2">Shipping Address</h3>
                    <p class="text-gray-700"><?php echo $order['shipping_address']; ?>, <?php echo $order['city']; ?>, <?php echo $order['province']; ?>, <?php echo $order['postal_code']; ?></p>

                    <h3 class="text-lg font-semibold mt-4 mb-2">Products Ordered</h3>
                    <ul class="list-disc pl-5 space-y-2">
                        <?php 
                        $items = getOrderItems($order['order_id'], $userId);
                        if (count($items) > 0): 
                            foreach ($items as $item): 
                        ?>
                                <li class="text-gray-700">
                                    <strong><?php echo $item['product_name']; ?></strong> (x<?php echo $item['quantity']; ?>) - 
                                    <?php echo number_format($item['price'], 2); ?> Rs.
                                    <br>
                                    <span class="text-sm text-gray-500">Total: <?php echo number_format($item['total'], 2); ?> Rs. </span>
                                </li>
                        <?php endforeach; ?>
                        <?php else: ?>
                            <li class="text-gray-700">No products found for this order.</li>
                        <?php endif; ?>
                    </ul>

                    <div class="flex justify-between items-center mt-6">
                        <?php if ($order['status'] != 'cancelled'): ?>
                            <a href="my_orders.php?cancel_order_id=<?php echo $order['order_id']; ?>" 
                               class="text-white bg-red-600 hover:bg-red-700 py-2 px-4 rounded-full"
                               onclick="return confirm('Are you sure you want to cancel this order?')">Cancel Order</a>
                        <?php else: ?>
                            <span class="text-sm text-gray-500">Order Cancelled</span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-gray-700">You have no active orders.</p>
    <?php endif; ?>
</div>

<?php include('../includes/footer.php'); ?>
