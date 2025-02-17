<?php
include '../includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Image upload logic
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

        // Set the allowed image extensions
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif','webp'];

        // Check if the uploaded file is a valid image
        if (in_array($image_ext, $allowed_extensions)) {
            // Define the upload directory
            $upload_dir = '../assets/images/';
            $image_path = $upload_dir . uniqid() . '.' . $image_ext;

            // Move the uploaded image to the assets/images folder
            if (move_uploaded_file($image_tmp, $image_path)) {
                // Using Prepared Statement to Insert Data
                $stmt = $conn->prepare("INSERT INTO packages (title, price, image_url, description) VALUES (?, ?, ?, ?)");

                if ($stmt) {
                    // Bind parameters (s = string, i = integer)
                    $stmt->bind_param("siss", $title, $price, $image_path, $description);

                    // Execute the statement
                    if ($stmt->execute()) {
                        header('Location: manage_packages.php');
                        exit();
                    } else {
                        $error = "Database error: " . $stmt->error;
                    }
                    $stmt->close();
                } else {
                    $error = "Failed to prepare statement: " . $conn->error;
                }
            } else {
                $error = "Error uploading image.";
            }
        } else {
            $error = "Invalid image file type.";
        }
    } else {
        $error = "Please choose an image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Package</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Container -->
    <div class="max-w-3xl mx-auto p-8 bg-white shadow-lg rounded-lg mt-10">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Add New Package</h2>

        <!-- Error Message -->
        <?php if (isset($error)) { echo "<p class='text-red-500 mb-4'>$error</p>"; } ?>

        <!-- Form -->
        <form method="POST" enctype="multipart/form-data">
            <!-- Title Field -->
            <div class="mb-4">
                <label for="title" class="block text-lg font-medium text-gray-700">Package Title</label>
                <input type="text" name="title" id="title" class="mt-1 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Price Field -->
            <div class="mb-4">
                <label for="price" class="block text-lg font-medium text-gray-700">Package Price</label>
                <input type="number" name="price" id="price" class="mt-1 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Description Field -->
            <div class="mb-4">
                <label for="description" class="block text-lg font-medium text-gray-700">Package Description</label>
                <textarea name="description" id="description" class="mt-1 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
            </div>

            <!-- Image Upload Field -->
            <div class="mb-6">
                <label for="image" class="block text-lg font-medium text-gray-700">Upload Package Image</label>
                <input type="file" name="image" id="image" accept="image/*" class="mt-1 p-3 w-full border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full py-3 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                Add Package
            </button>
        </form>
    </div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
