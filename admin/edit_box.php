<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: /hamroPratibha/pages/login.php");
    exit();
}

// Include the database connection file
include '../includes/db_connect.php';

// Check if the ID is set
if (isset($_GET['id'])) {
    $box_id = $_GET['id'];

    // Fetch the box details from the database
    $query = "SELECT * FROM boxes WHERE id = :id LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $box_id);
    $stmt->execute();
    $box = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$box) {
        // If box not found, redirect to the manage boxes page
        header("Location: manage_boxes.php");
        exit();
    }
}

// Handle form submission for updating box details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Check if a new image was uploaded
    if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] === 0) {
        $image_tmp = $_FILES['image_url']['tmp_name'];
        $image_name = $_FILES['image_url']['name'];
        $image_path = '../uploads/' . basename($image_name);

        // Move the uploaded file to the server's uploads directory
        if (move_uploaded_file($image_tmp, $image_path)) {
            // Update the image URL in the database
            $image_url = $image_path;
        } else {
            $error = "There was an error uploading the image.";
        }
    } else {
        // If no new image is uploaded, keep the old image URL
        $image_url = $box['image_url'];
    }

    // Update the box in the database
    if (empty($error)) {
        $update_query = "UPDATE boxes SET name = :name, description = :description, image_url = :image_url, price = :price WHERE id = :id";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bindParam(':name', $name);
        $update_stmt->bindParam(':description', $description);
        $update_stmt->bindParam(':image_url', $image_url);
        $update_stmt->bindParam(':price', $price);
        $update_stmt->bindParam(':id', $box_id);

        if ($update_stmt->execute()) {
            // If update is successful, redirect to manage boxes page
            header("Location: manage_boxes.php");
            exit();
        } else {
            $error = "There was an error updating the box.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Box</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    <!-- Header Section -->
    <section class="text-center py-12 bg-gradient-to-r from-indigo-500 to-purple-600 text-white">
        <h1 class="text-4xl font-bold">Edit Box</h1>
    </section>

    <!-- Back Button -->
    <div class="text-center py-4">
        <a href="manage_boxes.php" class="inline-block bg-gray-700 text-white px-6 py-3 rounded-lg hover:bg-gray-800 transition duration-300">Back to Manage Boxes</a>
    </div>

    <!-- Edit Box Form -->
    <div class="max-w-3xl mx-auto p-8 mt-12 bg-white shadow-xl rounded-lg">
        <form action="edit_box.php?id=<?= $box_id ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
            <?php if (isset($error)) { ?>
                <div class="bg-red-500 text-white p-4 mb-4 rounded-lg">
                    <p><?= $error ?></p>
                </div>
            <?php } ?>

            <div>
                <label for="name" class="block text-gray-700 font-medium">Box Name</label>
                <input type="text" id="name" name="name" value="<?= $box['name'] ?>" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="description" class="block text-gray-700 font-medium">Description</label>
                <input type="text" id="description" name="description" value="<?= $box['description'] ?>" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="image_url" class="block text-gray-700 font-medium">Image</label>
                <input type="file" id="image_url" name="image_url" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="mt-2 text-gray-500">Current Image: <a href="<?= $box['image_url'] ?>" class="text-blue-500" target="_blank">View</a></p>
            </div>

            <div>
                <label for="price" class="block text-gray-700 font-medium">Price</label>
                <input type="text" id="price" name="price" value="<?= $box['price'] ?>" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300">Update Box</button>
            </div>
        </form>
    </div>

</body>
</html>

<?php
// Close the database connection
$conn = null;
?>
