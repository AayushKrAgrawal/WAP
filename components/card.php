<?php
function renderCard($props) {
    // Default values
    $imageUrl = $props['imageUrl'] ?? 'https://source.unsplash.com/random/400x300';
    $link = $props['link'] ?? '#';
    $title = $props['title'] ?? 'Default Title';
    $price = $props['price'] ?? 'N/A';
    return <<<HTML
    <div class="max-w-sm mx-auto">
        <a href="{$link}" class="block">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform transition duration-500 hover:scale-105 hover:shadow-2xl relative">
                <img class="w-full h-48 object-cover" src="{$imageUrl}" >
            </div>
        </a>
        <div class="mt-3 text-center">
            <h3 class="text-lg font-semibold">{$title}</h3>
            <p class="text-xl font-bold text-gray-800 mt-2">Rs. {$price}</p>
        </div>
        <!-- Heart Icon -->
        <div class="flex justify-end mt-2">
            <button class="like-btn text-gray-400 hover:text-red-500 transition duration-300">
                ❤️
            </button>
        </div>
    </div>
    <script>
        document.querySelectorAll('.like-btn').forEach(button => {
            button.addEventListener('click', function () {
                this.classList.toggle('text-red-500');
            });
        });
    </script>
HTML;
}
?>