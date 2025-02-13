<?php
// Include the database connection
include '../includes\db_connect.php';
include '../includes\header.php';

// Fetch all boxes from the database
$sql = "SELECT * FROM boxes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Your Box</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body style="background-color: #F5EFFF;">

    <!-- Header Section -->
    <header class="text-center py-12">
        <h1 class="text-4xl font-bold text-gray-800">Choose Your Box</h1>
        <p class="text-lg text-gray-600">Select the box that suits your needs and customize your package.</p>
    </header>

    <!-- Boxes Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <?php
            // Display each box as a card
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300 transform hover:scale-105">';
                    echo '<img src="' . $row['image_url'] . '" alt="' . $row['name'] . '" class="w-full h-64 object-cover">';
                    echo '<div class="p-6 text-center">';
                    echo '<h2 class="text-2xl font-semibold text-gray-800">' . $row['name'] . '</h2>';
                    echo '<p class="text-gray-600 mt-2">' . $row['description'] . '</p>';
                    echo '<a href="customizePackage.php?box_id=' . $row['id'] . '" class="mt-4 inline-block bg-blue-500 text-white px-6 py-3 rounded-lg">Customize</a>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p class="text-center text-xl text-gray-700">No boxes available at the moment. Please check back later.</p>';
            }
            ?>
        </div>
    </section>

</body>
</html>

<?php
// Close the connection
$conn->close();
?>
