<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customize Packaging</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>
  body {
    background-color: #F5EFFF;
  }
</style>
<body class="min-h-screen flex items-center justify-center">
    <div class="w-full max-w-4xl text-center">
        <!-- Main heading section -->
        <div class="mb-20"> <!-- Increased margin bottom from mb-16 to mb-20 -->
            <h1 class="text-3xl font-bold text-gray-800">Customize Your Package</h1>
            <p class="mt-2 text-gray-600">Select your preferred option below</p>
        </div>
        <!-- Cards section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-20"> <!-- Increased gap from gap-6 to gap-12 -->
            <!-- Card 1 -->
            <div class="flex flex-col items-center space-y-4 w-full pb-6">
                <a href="packaging.php" class="block w-full">
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform transition duration-500 hover:scale-105 hover:shadow-2xl">
                        <img class="w-full h-80 object-cover" src="../assets/images/customize_box.webp">
                    </div>
                </a>
                <h2 class="text-xl font-semibold text-gray-800">Packaging</h2>
            </div>
            <!-- Card 2 -->
            <div class="flex flex-col items-center space-y-4 w-full pb-6">
                <a href="somepage2.php" class="block w-full">
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform transition duration-500 hover:scale-105 hover:shadow-2xl">
                        <img class="w-full h-80 object-cover" src="../assets/images/customize_items.webp"> <!-- Changed h-74 to h-80 to match first card -->
                    </div>
                </a>
                <h2 class="text-xl font-semibold text-gray-800">Items</h2>
            </div>
        </div>
    </div>
</body>
</html>