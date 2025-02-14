<?php
include '../includes/db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Packages</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Container -->
    <div class="max-w-6xl mx-auto p-8 mt-10 bg-white shadow-lg rounded-lg">

        <!-- Header Section -->
        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Manage Packages</h2>

        <!-- Add Package Button -->
        <div class="text-right mb-4">
            <a href="add_package.php" class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-600 transition duration-300">Add New Package</a>
        </div>

        <!-- Packages Table -->
        <table class="w-full table-auto border-collapse">
            <thead>
                <tr>
                    <th class="py-3 px-4 border-b text-left text-lg text-gray-700">Title</th>
                    <th class="py-3 px-4 border-b text-left text-lg text-gray-700">Price</th>
                    <th class="py-3 px-4 border-b text-left text-lg text-gray-700">Image</th>
                    <th class="py-3 px-4 border-b text-left text-lg text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM packages";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "
                    <tr class='hover:bg-gray-50'>
                        <td class='py-3 px-4 border-b text-gray-800'>{$row['title']}</td>
                        <td class='py-3 px-4 border-b text-gray-800'>{$row['price']}</td>
                        <td class='py-3 px-4 border-b'>
                            <img src='{$row['image_url']}' width='100' class='rounded-md'>
                        </td>
                        <td class='py-3 px-4 border-b'>
                            <a href='edit-package.php?id={$row['id']}' class='bg-yellow-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-yellow-600 transition duration-300'>Edit</a>
                            <a href='delete_package.php?id={$row['id']}' class='bg-red-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-red-600 transition duration-300 ml-2' onclick=\"return confirm('Are you sure?')\">Delete</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>

    </div>

</body>
</html>

<?php include '../includes/footer.php'; ?>
