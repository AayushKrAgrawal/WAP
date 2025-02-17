<?php
include '../includes/db_connect.php';

if (isset($_GET['id'])) {
    // Get the package ID from the URL
    $package_id = $_GET['id'];

    // Fetch the package details from the database
    $query = "SELECT * FROM packages WHERE id = :id LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $package_id);
    $stmt->execute();
    $package = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$package) {
        // If the package does not exist, redirect to the manage packages page
        header("Location: manage_packages.php");
        exit;
    }
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];

    // Update the package details in the database
    $update_query = "UPDATE packages SET title = :title, price = :price, description = :description, image_url = :image_url WHERE id = :id";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bindParam(':title', $title);
    $update_stmt->bindParam(':price', $price);
    $update_stmt->bindParam(':description', $description);
    $update_stmt->bindParam(':image_url', $image_url);
    $update_stmt->bindParam(':id', $package_id);
    
    if ($update_stmt->execute()) {
        // If the update is successful, redirect to the manage packages page
        header("Location: manage_packages.php");
        exit;
    } else {
        $error = "There was an error updating the package.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Package</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="max-w-6xl mx-auto p-8 mt-12 bg-white shadow-xl rounded-lg">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-4xl font-bold text-gray-800">Edit Package</h2>
            <a href="manage_packages.php" class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-green-600 transition duration-300">Back to Manage Packages</a>
        </div>

        <?php if (isset($error)) { ?>
            <div class="bg-red-500 text-white p-4 mb-4 rounded-lg">
                <p><?= $error ?></p>
            </div>
        <?php } ?>

        <form action="edit_package.php?id=<?= $package_id ?>" method="POST" class="space-y-6">
            <div>
                <label for="title" class="block text-gray-700 font-medium">Package Title</label>
                <input type="text" id="title" name="title" value="<?= $package['title'] ?>" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="price" class="block text-gray-700 font-medium">Package Price</label>
                <input type="text" id="price" name="price" value="<?= $package['price'] ?>" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="description" class="block text-gray-700 font-medium">Description</label>
                <input type="text" id="description" name="description" value="<?= $package['description'] ?>" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="image_url" class="block text-gray-700 font-medium">Package Image URL</label>
                <input type="text" id="image_url" name="image_url" value="<?= $package['image_url'] ?>" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-600 transition duration-300">Update Package</button>
            </div>
        </form>
    </div>

</body>
</html>
