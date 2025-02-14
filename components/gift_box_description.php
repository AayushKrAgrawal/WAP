<?php
function renderProductCard($props) {
    // Extract images from the array
    $imageUrls = $props['imageUrls'] ?? ['https://source.unsplash.com/random/400x300', 'https://source.unsplash.com/random/400x300', 'https://source.unsplash.com/random/400x300', 'https://source.unsplash.com/random/400x300'];
    $title = $props['title'] ?? 'Product Title';
    $price = $props['price'] ?? 'N/A';
    $description = $props['description'] ?? 'Product description goes here';
    $contents = $props['contents'] ?? ['Contents not available']; // New "What It Contains" section

    // Start generating "What It Contains" list
    $contentList = "";
    foreach ($contents as $item) {
        $contentList .= "<li>{$item}</li>";
    }

    return <<<HTML
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden relative flex flex-col md:flex-row">
        <!-- Left: Image Slider -->
        <div class="slider-container relative w-full md:w-1/2 h-96 bg-black bg-opacity-40">
            <div class="slider">
                <img src="{$imageUrls[0]}" class="slider-image">
                <img src="{$imageUrls[1]}" class="slider-image">
                <img src="{$imageUrls[2]}" class="slider-image">
                <img src="{$imageUrls[3]}" class="slider-image">
            </div>
            <!-- Navigation Arrows -->
            <button class="prev-btn" onclick="moveSlide(-1)">&#10094;</button>
            <button class="next-btn" onclick="moveSlide(1)">&#10095;</button>
        </div>

        <!-- Right: Product Details -->
        <div class="p-6 flex flex-col justify-between w-full md:w-1/2">
            <div class="relative space-y-4">
                <h3 class="text-2xl font-semibold text-gray-800">
                    {$title}
                    <button class="wishlist-btn absolute top-0 right-0 text-gray-400 hover:text-red-500 transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="w-6 h-6">
                            <path fill="currentColor" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                    </button>
                </h3>
                <p class="text-lg text-purple-600 font-medium">Rs. {$price}</p>
                <p class="text-gray-600">{$description}</p>

                <!-- What It Contains Section -->
                <div class="mt-4">
                    <h4 class="text-lg font-semibold text-gray-800">What It Contains:</h4>
                    <ul class="list-disc list-inside text-gray-600 mt-2">
                        {$contentList}
                    </ul>
                </div>
            </div>

            <!-- Size Options -->
            <div class="mt-4">
                <span class="text-lg font-semibold text-gray-800">Size:</span>
                <div class="size-container flex space-x-4 mt-2">
                    <button class="size-btn bg-gray-200 text-gray-600 px-4 py-2 rounded-md hover:bg-gray-300 transition">S</button>
                    <button class="size-btn bg-gray-200 text-gray-600 px-4 py-2 rounded-md hover:bg-gray-300 transition">M</button>
                    <button class="size-btn bg-gray-200 text-gray-600 px-4 py-2 rounded-md hover:bg-gray-300 transition">L</button>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-between">
                <button class="w-2/4 bg-[#B82132] text-white py-3 px-6 rounded-lg font-semibold hover:bg-[#801723] transition duration-300">
                    Add to Cart
                </button>

                <div class="flex items-center space-x-2 ml-4">
                    <span class="text-lg font-semibold text-gray-800">Quantity:</span>
                    <button class="decrease-btn bg-gray-200 text-gray-600 px-2 py-1 rounded-md hover:bg-gray-300 transition">-</button>
                    <span id="quantity" class="text-lg font-semibold">1</span>
                    <button class="increase-btn bg-gray-200 text-gray-600 px-2 py-1 rounded-md hover:bg-gray-300 transition">+</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let slideIndex = 0;

        function moveSlide(n) {
            showSlide(slideIndex += n);
        }

        function showSlide(n) {
            const slides = document.querySelectorAll('.slider-image');
            if (n >= slides.length) slideIndex = 0;
            if (n < 0) slideIndex = slides.length - 1;
            slides.forEach(slide => slide.style.display = "none");
            slides[slideIndex].style.display = "block";
        }

        showSlide(slideIndex);
    </script>

    <style>
        .slider-container {
            position: relative;
            height: 100%;
        }

        .prev-btn, .next-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 2.5rem;
            background: rgba(67, 66, 66, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            z-index: 10;
        }

        .prev-btn { left: 10px; }
        .next-btn { right: 10px; }

        .slider-image {
            display: none;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .slider-image:first-child {
            display: block;
        }

        .size-container {
            display: flex;
            gap: 1rem;
        }

        .size-btn {
            background-color: #f0f0f0;
            border-radius: 0.375rem;
            padding: 0.5rem 1rem;
            text-transform: uppercase;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .size-btn:hover {
            background-color: #ddd;
        }
    </style>
HTML;
}
?>
