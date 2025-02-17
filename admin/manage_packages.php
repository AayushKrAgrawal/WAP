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

<body class="bg-gray-100 font-sans antialiased">

    <!-- Container -->
    <div class="max-w-6xl mx-auto p-8 mt-12 bg-white shadow-xl rounded-lg">

        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-4xl font-bold text-gray-800">Manage Packages</h2>
            <a href="admin_dashboard.php" class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-green-600 transition duration-300">Back to Dashboard</a>
        </div>

        <!-- Add Package Button -->
        <div class="text-right mb-6">
            <a href="add_package.php"
                class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-600 transition duration-300">Add New Package</a>
        </div>

        <!-- Packages Table -->
        <div class="overflow-x-auto bg-white rounded-lg shadow-md">
            <table class="min-w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 border-b">Title</th>
                        <th class="py-3 px-4 border-b">Price</th>
                        <th class="py-3 px-4 border-b">Image</th>
                        <th class="py-3 px-4 border-b">Description</th>
                        <th class="py-3 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Prepare the query to fetch packages with description
                    $query = "SELECT * FROM packages";
                    $stmt = $conn->prepare($query);
                    $stmt->execute();
                    
                    // Fetch results
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        // Trim the description to the first 50 characters and add ellipsis if needed
                        $shortDescription = strlen($row['description']) > 50 ? substr($row['description'], 0, 50) . '...' : $row['description'];
                        
                        echo "
                        <tr class='hover:bg-gray-50'>
                            <td class='py-4 px-6 border-b text-gray-800'>{$row['title']}</td>
                            <td class='py-4 px-6 border-b text-gray-800'>{$row['price']}</td>
                            <td class='py-4 px-6 border-b'>
                                <img src='{$row['image_url']}' width='100' class='rounded-md'>
                            </td>
                            <td class='py-4 px-6 border-b text-gray-800'>{$shortDescription}</td>
                            <td class='py-4 px-6 border-b'>
                                <a href='edit_package.php?id={$row['id']}' class='bg-yellow-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-yellow-600 transition duration-300'>Edit</a>
                                <a href='delete_package.php?id={$row['id']}' class='bg-red-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-red-600 transition duration-300 ml-2' onclick=\"return confirm('Are you sure?')\">Delete</a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>

</body>

</html>

<?php include '../includes/footer.php'; ?>
