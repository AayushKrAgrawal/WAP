<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: /hamroPratibha/pages/login.php");
    exit();
}

// Include the database connection file
include '../includes\db_connect.php';

// Fetch all boxes from database
$sql = "SELECT * FROM boxes";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Boxes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body style="background-color: #F5EFFF;">

    <!-- Manage Boxes Header -->
    <section class="text-center py-12">
        <h1 class="text-4xl font-bold text-gray-800">Manage Boxes</h1>
        <a href="add_box.php" class="mt-6 inline-block bg-blue-500 text-white px-6 py-3 rounded-lg">Add New Box</a>
    </section>

    <!-- Box List Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <?php
            if ($result->num_rows > 0) {
                // Loop through all the boxes and display them
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300 transform hover:scale-105">';
                    echo '<img src="' . $row['image_url'] . '" alt="' . $row['name'] . '" class="w-full h-64 object-cover">';
                    echo '<div class="p-6 text-center">';
                    echo '<h2 class="text-2xl font-semibold text-gray-800">' . $row['name'] . '</h2>';
                    echo '<p class="text-gray-600 mt-2">' . $row['description'] . '</p>';
                    echo '<a href="edit_box.php?id=' . $row['id'] . '" class="mt-4 inline-block bg-yellow-500 text-white px-6 py-3 rounded-lg">Edit</a>';
                    echo '<a href="delete_box.php?id=' . $row['id'] . '" class="mt-4 inline-block bg-red-500 text-white px-6 py-3 rounded-lg">Delete</a>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p class="text-center text-xl text-gray-700">No boxes available. Please add some boxes.</p>';
            }
            ?>
        </div>
    </section>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
