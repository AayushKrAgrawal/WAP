<?php
session_start();
include('../includes/db_connect.php');

// Ensure the user is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Fetch all orders from the database
$sqlOrders = "SELECT o.order_id, o.user_id, o.total_cost, o.payment_method, o.status, 
                     a.address AS shipping_address, a.city, a.province, a.postal_code
              FROM orders o
              LEFT JOIN user_addresses a ON o.user_id = a.user_id
              ORDER BY o.order_id DESC";

$stmtOrders = $conn->prepare($sqlOrders);
$stmtOrders->execute();
$orders = $stmtOrders->fetchAll(PDO::FETCH_ASSOC);

// Fetch the products ordered for each order
function getOrderItems($orderId) {
    global $conn;
    $sqlItems = "SELECT oi.product_name, oi.quantity, oi.price, oi.total
                 FROM order_items oi
                 WHERE oi.order_id = :order_id";
    $stmtItems = $conn->prepare($sqlItems);
    $stmtItems->bindParam(':order_id', $orderId, PDO::PARAM_INT);
    $stmtItems->execute();
    return $stmtItems->fetchAll(PDO::FETCH_ASSOC);
}

// Update order status if requested
if (isset($_GET['update_status']) && isset($_GET['order_id'])) {
    $newStatus = $_GET['update_status'];
    $orderId = $_GET['order_id'];

    // Ensure the status is valid
    $validStatuses = ['pending', 'processing', 'completed', 'cancelled'];
    if (in_array($newStatus, $validStatuses)) {
        $sqlUpdateStatus = "UPDATE orders SET status = :status WHERE order_id = :order_id";
        $stmtUpdateStatus = $conn->prepare($sqlUpdateStatus);
        $stmtUpdateStatus->bindParam(':status', $newStatus, PDO::PARAM_STR);
        $stmtUpdateStatus->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $stmtUpdateStatus->execute();
        header("Location: manage_orders.php");
        exit();
    } else {
        echo "Error: Invalid status.";
    }
}

// Cancel order if requested
if (isset($_GET['cancel_order_id'])) {
    $orderIdToCancel = $_GET['cancel_order_id'];
    $sqlCancelOrder = "UPDATE orders SET status = 'cancelled' WHERE order_id = :order_id";
    $stmtCancelOrder = $conn->prepare($sqlCancelOrder);
    $stmtCancelOrder->bindParam(':order_id', $orderIdToCancel, PDO::PARAM_INT);
    $stmtCancelOrder->execute();
    header("Location: manage_orders.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto px-6 py-8">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Manage Orders</h1>

    <?php if (count($orders) > 0): ?>
        <div class="space-y-6">
            <?php foreach ($orders as $order): ?>
                <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold">Order #<?php echo $order['order_id']; ?></h2>
                        <span class="text-sm text-gray-500"><?php echo ucfirst($order['status']); ?></span>
                    </div>

                    <h3 class="text-lg font-semibold mt-4 mb-2">Shipping Address</h3>
                    <p class="text-gray-700"><?php echo $order['shipping_address']; ?>, <?php echo $order['city']; ?>, <?php echo $order['province']; ?>, <?php echo $order['postal_code']; ?></p>

                    <h3 class="text-lg font-semibold mt-4 mb-2">Products Ordered</h3>
                    <ul class="list-disc pl-5 space-y-2">
                        <?php 
                        $items = getOrderItems($order['order_id']);
                        if (count($items) > 0): 
                            foreach ($items as $item): 
                        ?>
                                <li class="text-gray-700">
                                    <strong><?php echo $item['product_name']; ?></strong> (x<?php echo $item['quantity']; ?>) - 
                                    <?php echo number_format($item['price'], 2); ?> Rs.
                                    <br>
                                    <span class="text-sm text-gray-500">Total: <?php echo number_format($item['total'], 2); ?> Rs.</span>
                                </li>
                        <?php endforeach; ?>
                        <?php else: ?>
                            <li class="text-gray-700">No products found for this order.</li>
                        <?php endif; ?>
                    </ul>

                    <div class="flex justify-between items-center mt-6">
                        <!-- Order status update -->
                        <form action="manage_orders.php" method="get" class="inline-block">
                            <label for="status" class="mr-2">Update Status: </label>
                            <select name="update_status" id="status" class="p-2 border border-gray-300 rounded">
                                <option value="pending" <?php echo $order['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                <option value="processing" <?php echo $order['status'] == 'processing' ? 'selected' : ''; ?>>Processing</option>
                                <option value="completed" <?php echo $order['status'] == 'completed' ? 'selected' : ''; ?>>Completed</option>
                                <option value="cancelled" <?php echo $order['status'] == 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                            </select>
                            <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded mt-2">Update Status</button>
                        </form>

                        <!-- Cancel order -->
                        <a href="manage_orders.php?cancel_order_id=<?php echo $order['order_id']; ?>" 
                           class="bg-red-600 text-white py-2 px-4 rounded mt-2 hover:bg-red-700"
                           onclick="return confirm('Are you sure you want to cancel this order?')">Cancel Order</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-gray-700 text-center">No orders found.</p>
    <?php endif; ?>
    <!-- Go Back to Admin Dashboard Button -->
    <div class="mt-6 text-center">
        <a href="admin_dashboard.php" class="bg-gray-600 text-white py-2 px-6 rounded hover:bg-gray-700">Go Back to Admin Dashboard</a>
    </div>
</div>

</body>
</html>
