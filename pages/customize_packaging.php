<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customize Packaging</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>
  body{
    background-color: #F5EFFF;
  }
</style>
<body class="min-h-screen">
    <!-- Main heading section -->
    <div class="text-center py-8">
        <h1 class="text-3xl font-bold text-gray-800">Customize Your Package</h1>
        <p class="mt-2 text-gray-600">Select your preferred option below</p>
    </div>

    <!-- Cards section -->
    <div class="flex items-center justify-center p-4">
        <div class="w-full max-w-4xl">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Card 1 with heading -->
                <div class="flex flex-col space-y-4">
                    <?php
                    require_once('../components/card.php');
                    echo renderCard([
                        'imageUrl' => '../assets/images/customize_box.webp',
                        'link' => 'packaging.php'
                    ]);
                    ?>
                    <h2 class="text-xl font-semibold text-gray-800 text-center">Packaging</h2>
                </div>

                <!-- Card 2 with heading -->
                <div class="flex flex-col space-y-4">
                    <?php
                    echo renderCard([
                        'imageUrl' => '../assets/images/customize_items.webp',
                        'link' => 'somepage2.php'
                    ]);
                    ?>
                    <h2 class="text-xl font-semibold text-gray-800 text-center">Items</h2>
                </div>
            </div>
        </div>
    </div>
</body>
</html>