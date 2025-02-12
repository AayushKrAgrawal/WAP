<?php
// Include the product card function
require_once('../components/description_item.php');

// Example product details (these can be fetched dynamically from a database)
$product = [
    'imageUrls' => [ '../assets/images/item.jpg',
    'https://i.pinimg.com/736x/6b/5d/13/6b5d13e581d6a0eadea6891d2acc7bc1.jpg',
    '../assets/images/item.jpg',
    'https://i.pinimg.com/736x/1b/53/06/1b53064b602bcb184d52d93384099001.jpg' ],
    'title' => 'Awesome Product', // Product title
    'price' => '1999', // Product price
    'description' => 'This beautiful Nepali Silver Bracelet is a true testament to the artistry of Nepali craftsmanship. Handcrafted by skilled artisans, each bracelet features intricate silver designs inspired by traditional Nepali patterns, offering a unique and timeless look. Made with high-quality sterling silver, it is durable and perfect for both everyday wear and special occasions. Whether you’re dressing up for a party or looking for a meaningful gift, this bracelet makes a perfect accessory for both men and women. Its delicate yet bold design brings a touch of elegance to any outfit, making it a versatile addition to your jewelry collection.' // Product description
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Description</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Main container -->
    <div class="max-w-screen-xl mx-auto p-8">
        <!-- Heading -->
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Product Description</h1>

        <!-- Call the renderProductCard function to display the product -->
        <div class="flex justify-center">
            <?php
            // Call the function with the product array
            echo renderProductCard($product);
            ?>
        </div>
    </div>
</body>
</html>
