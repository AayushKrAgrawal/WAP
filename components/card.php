<?php
function renderCard($props) {
    // Default values
    $imageUrl = $props['imageUrl'] ?? 'https://source.unsplash.com/random/400x300';
    $link = $props['link'] ?? '#';
    return <<<HTML
    <a href="{$link}" class="block">
        <div class="max-w-sm bg-white rounded-2xl shadow-lg overflow-hidden transform transition duration-500 hover:scale-105 hover:shadow-2xl">
            <img class="w-full h-48 object-cover" src="{$imageUrl}" >
        </div>
    </a>
HTML;
}
?>