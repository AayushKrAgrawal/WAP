<?php
function renderCard($props) {
    // Default values
    $imageUrl = $props['imageUrl'] ?? 'https://source.unsplash.com/random/400x300';
    $link = $props['link'] ?? '#';
    $title = $props['title'] ?? 'Default Title';
    $price = $props['price'] ?? 'N/A';
    return <<<HTML
    <div class="w-64 mx-auto">
        <a href="{$link}" class="block">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform transition duration-500 hover:scale-105 hover:shadow-2xl">
                <img class="w-full h-48 object-cover" src="{$imageUrl}" >
            </div>
        </a>
        <div class="mt-3 flex justify-between items-start"> <!-- Flex container for left and right alignment -->
            <div class="text-left">
                <p class="text-sm text-gray-600">Rs. {$price}</p> <!-- Price on the left -->
                <h3 class="text-lg font-semibold text-gray-800 mt-1">{$title}</h3> <!-- Title on the left -->
            </div>
            <!-- Heart Icon (Initially darker border) -->
            <button class="heart-btn text-gray-400 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6">
                    <path class="heart-path transition-all duration-300" 
                          d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linecap="round"
                          stroke-linejoin="round" />
                </svg>
            </button>
        </div>
    </div>
HTML;
}
?>