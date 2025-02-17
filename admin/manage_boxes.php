<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: /hamroPratibha/pages/login.php");
    exit();
}

// Include the database connection file
include '../includes/db_connect.php';

// Fetch all boxes from database using PDO
$sql = "SELECT * FROM boxes";
$stmt = $conn->prepare($sql);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Boxes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    <!-- Header Section -->
    <section class="text-center py-12 bg-gradient-to-r from-indigo-500 to-purple-600 text-white">
        <h1 class="text-4xl font-bold">Manage Boxes</h1>
        <a href="add_box.php" class="mt-6 inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300">Add New Box</a>
    </section>

    <!-- Back to Dashboard Button -->
    <div class="text-center py-4">
        <a href="admin_dashboard.php" class="inline-block bg-gray-700 text-white px-6 py-3 rounded-lg hover:bg-gray-800 transition duration-300">Back to Admin Dashboard</a>
    </div>

    <!-- Box List Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            <?php
            // Check if there are any boxes returned
            if ($stmt->rowCount() > 0) {
                // Loop through all the boxes and display them
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300 transform hover:scale-105">';
                    echo '<img src="' . $row['image_url'] . '" alt="' . $row['name'] . '" class="w-full h-64 object-cover">';
                    echo '<div class="p-6 text-center">';
                    echo '<h2 class="text-2xl font-semibold text-gray-800">' . $row['name'] . '</h2>';
                    echo '<p class="text-gray-600 mt-2">' . $row['description'] . '</p>';
                    echo '<p class="text-lg font-semibold text-gray-800 mt-4">Price: Rs ' . number_format($row['price'], 2) . '</p>'; // Display the price
                    echo '<div class="mt-4 flex justify-center gap-4">';
                    echo '<a href="edit_box.php?id=' . $row['id'] . '" class="bg-yellow-500 text-white px-6 py-2 rounded-lg hover:bg-yellow-600 transition duration-300">Edit</a>';
                    echo '<a href="delete_box.php?id=' . $row['id'] . '" class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition duration-300" onclick="return confirm(\'Are you sure?\')">Delete</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p class="text-center text-xl text-gray-700 col-span-3">No boxes available. Please add some boxes.</p>';
            }
            ?>
        </div>
    </section>

</body>
</html>

<?php
// Close the database connection
$conn = null;
?>
