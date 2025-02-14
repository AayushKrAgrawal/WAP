<?php
// Include the product card function
require_once('../components/gift_box_description.php');

// Example product details (these can be fetched dynamically from a database)
$product = [
    'imageUrls' => [ 'https://i.pinimg.com/736x/e4/d7/2f/e4d72f3be0a2673c396cb6030bd04089.jpg',
    'https://i.pinimg.com/736x/78/ed/6e/78ed6eee0f8620aa297d2774b0dd93ae.jpg',
    '../assets/images/item.jpg',
    'https://i.pinimg.com/736x/1b/53/06/1b53064b602bcb184d52d93384099001.jpg' ],
    'title' => 'Awesome Product', // Product title
    'price' => '1999', // Product price
    'description' => 'This beautiful Nepali Silver Bracelet is a true testament to the artistry of Nepali craftsmanship. Handcrafted by skilled artisans, each bracelet features intricate silver designs inspired by traditional Nepali patterns, offering a unique and timeless look. Made with high-quality sterling silver, it is durable and perfect for both everyday wear and special occasions. Whether you’re dressing up for a party or looking for a meaningful gift, this bracelet makes a perfect accessory for both men and women. Its delicate yet bold design brings a touch of elegance to any outfit, making it a versatile addition to your jewelry collection.',
    'contents' => ['Silver Bracelet', 'Gift Box', 'Certificate of Authenticity'] // 
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
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Gift Box Description</h1>

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
