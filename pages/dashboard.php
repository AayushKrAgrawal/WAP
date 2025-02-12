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
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-[#B82132] text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-lg font-bold">Welcome, <?php echo $user_first_name; ?>!</h1>
            <a href="logout.php" class="text-white hover:underline">Logout</a>
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
