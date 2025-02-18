<?php
// Include the database connection
include('../includes/db_connect.php');

// Start session to manage logged-in users
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get the logged-in user's ID
$userId = $_SESSION['user_id'];

// Fetch the user's current details
try {
    $sql = "SELECT * FROM users WHERE user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "<p>User not found.</p>";
        exit();
    }
} catch (PDOException $e) {
    echo "<p>Error fetching user details: " . $e->getMessage() . "</p>";
    exit();
}

// Handle the profile update request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update Profile
    if (isset($_POST['update_profile'])) {
        $newFirstName = $_POST['first_name'];
        $newLastName = $_POST['last_name'];
        $newEmail = $_POST['email'];
        $newPhone = $_POST['phone'];
        $newGender = $_POST['gender'];
        $newDob = $_POST['dob'];

        // Update the user's details in the database
        try {
            $updateSql = "UPDATE users SET first_name = :first_name, last_name = :last_name, email = :email, phone = :phone, gender = :gender, dob = :dob WHERE user_id = :user_id";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bindParam(':first_name', $newFirstName);
            $updateStmt->bindParam(':last_name', $newLastName);
            $updateStmt->bindParam(':email', $newEmail);
            $updateStmt->bindParam(':phone', $newPhone);
            $updateStmt->bindParam(':gender', $newGender);
            $updateStmt->bindParam(':dob', $newDob);
            $updateStmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $updateStmt->execute();
            header('Location: profile.php'); // Refresh the page to reflect changes
            exit();
        } catch (PDOException $e) {
            echo "<p>Error updating profile: " . $e->getMessage() . "</p>";
        }
    }

    // Delete Account
if (isset($_POST['delete_account'])) {
    try {
        // 1. Delete from `cart` first
        $deleteCartSql = "DELETE FROM cart WHERE user_id = :user_id";
        $deleteCartStmt = $conn->prepare($deleteCartSql);
        $deleteCartStmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $deleteCartStmt->execute();

        // 2. Delete from `order_items` linked to user's orders
        $deleteOrderItemsSql = "DELETE FROM order_items WHERE order_id IN (SELECT order_id FROM orders WHERE user_id = :user_id)";
        $deleteOrderItemsStmt = $conn->prepare($deleteOrderItemsSql);
        $deleteOrderItemsStmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $deleteOrderItemsStmt->execute();

        // 3. Delete from `orders` to maintain referential integrity
        $deleteOrdersSql = "DELETE FROM orders WHERE user_id = :user_id";
        $deleteOrdersStmt = $conn->prepare($deleteOrdersSql);
        $deleteOrdersStmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $deleteOrdersStmt->execute();

        // 4. Finally, delete the user from `users` table
        $deleteSql = "DELETE FROM users WHERE user_id = :user_id";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $deleteStmt->execute();

        // 5. Destroy session and redirect to registration page
        session_destroy();
        header('Location: login.php');
        exit();
    } catch (PDOException $e) {
        echo "<p>Error deleting account: " . $e->getMessage() . "</p>";
    }
}



}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Additional styling for profile page */
        .profile-card {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            background: #f7f7f7;
            padding: 20px;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans tracking-wide">

    <!-- Navbar -->
    <nav class="bg-blue-600 p-4 text-white">
        <div class="container mx-auto flex justify-between items-center">
            <a href="dashboard.php" class="text-xl">Dashboard</a>
            <a href="logout.php" class="hover:text-gray-300">Logout</a>
        </div>
    </nav>

    <!-- User Profile Section -->
    <div class="container mx-auto px-4 py-10">
        <div class="profile-card max-w-lg mx-auto">
            <h2 class="text-2xl font-semibold mb-4">User Profile</h2>
            
            <form method="POST" action="profile.php">
                <!-- Display user details -->
                <div class="mb-4">
                    <label for="first_name" class="block text-gray-700">First Name</label>
                    <input type="text" name="first_name" id="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="last_name" class="block text-gray-700">Last Name</label>
                    <input type="text" name="last_name" id="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="phone" class="block text-gray-700">Phone</label>
                    <input type="text" name="phone" id="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md">
                </div>

                <div class="mb-4">
                    <label for="gender" class="block text-gray-700">Gender</label>
                    <select name="gender" id="gender" class="w-full px-4 py-2 border border-gray-300 rounded-md">
                        <option value="male" <?php echo $user['gender'] == 'male' ? 'selected' : ''; ?>>Male</option>
                        <option value="female" <?php echo $user['gender'] == 'female' ? 'selected' : ''; ?>>Female</option>
                        <option value="other" <?php echo $user['gender'] == 'other' ? 'selected' : ''; ?>>Other</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="dob" class="block text-gray-700">Date of Birth</label>
                    <input type="date" name="dob" id="dob" value="<?php echo htmlspecialchars($user['dob']); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Update Profile Button -->
                <button type="submit" name="update_profile" class="w-full py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Update Profile</button>
            </form>

            <form method="POST" action="profile.php" class="mt-4">
                <!-- Delete Account Button -->
                <button type="submit" name="delete_account" class="w-full py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Delete Account</button>
            </form>
        </div>
    </div>
</body>
</html>
