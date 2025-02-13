<?php 
include '../includes/header.php'; 
include '../components/card.php'; 
include '../includes/db_connect.php'; // Make sure to connect to the database
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pre-Made Packages</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body style="background-color: #F5EFFF;">

<section class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl font-semibold text-center text-gray-800 mb-8">Choose a Pre-Made Box</h2>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php
        $query = "SELECT * FROM packages";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo renderCard([
                    "imageUrl" => $row['image_url'],
                    "link" => "#",
                    "title" => $row['title'],
                    "price" => $row['price']
                ]);
            }
        } else {
            echo "<p class='text-center text-gray-600'>No packages available at the moment.</p>";
        }
        ?>
    </div>
</section>

</body>
</html>

<?php include '../includes/footer.php'; ?>
