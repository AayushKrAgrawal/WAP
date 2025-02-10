<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit;
}

// Get the user's information from the session
$user_first_name = $_SESSION['first_name'];
$user_last_name = $_SESSION['last_name'];
$user_email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - eCommerce App</title>
    <!-- Link to Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-purple-50 border-b border-gray-300">
        <div class="container mx-auto px-4 py-2 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <span class="font-bold text-black">Hamro Pratibha</span>
                <a href="#" class="text-black">Home</a>
                <a href="#" class="text-black">Shop</a>
                <a href="#" class="text-black">About Us</a>
                <a href="#" class="text-black">Return and Refund Policy</a>
                <a href="#" class="text-black">Contact Us</a>
            </div>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-1">
                    <i class="fas fa-search text-black"></i>
                    <span class="text-black">Search</span>
                </div>
                <div class="flex items-center space-x-1">
                    <i class="fas fa-shopping-bag text-black"></i>
                    <span class="text-black">3</span>
                </div>
                <a href="profile.php" class="text-black hover:underline">Profile</a> <!-- Replaced Login with Profile -->
            </div>
        </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="container mx-auto mt-8 p-8 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Your Dashboard</h2>

        <div class="space-y-4">
            <p><strong>Full Name:</strong> <?php echo $user_first_name . ' ' . $user_last_name; ?></p>
            <p><strong>Email:</strong> <?php echo $user_email; ?></p>
            <p><strong>Phone Number:</strong> <?php echo isset($_SESSION['phone']) ? $_SESSION['phone'] : 'Not Available'; ?></p>
        </div>

        <div class="mt-6">
            <a href="profile.php" class="text-blue-500 hover:underline">Edit Profile</a>
        </div>
    </div>

</body>
</html>
