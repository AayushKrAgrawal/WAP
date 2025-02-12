<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans tracking-wide">

    <div class="container mx-auto px-4 py-10">
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <h1 class="text-3xl font-semibold text-green-600 mb-4">Thank You for Your Order!</h1>
            <p class="text-xl text-gray-700 mb-4">We have received your order. A confirmation will be sent to your email shortly.</p>
            <p class="text-lg text-gray-600">If you have any questions, feel free to contact us.</p>
            <div class="mt-6">
                <a href="../pages/dashboard.php" class="bg-blue-600 text-white px-6 py-3 rounded-md">Back to Home Page</a>
            </div>
        </div>
    </div>

</body>
</html>
