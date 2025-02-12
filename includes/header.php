<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Navbar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-purple-300 border-b border-gray-300">
        <div class="container max-w-5xl mx-auto px-4 py-2 flex justify-between items-center">
            
            <!-- Logo -->
            <div class="flex items-center space-x-4">
                <img src="../assets/images/finalLogo.png" class="w-14 rounded-full" alt="HamroPratibha Logo" />
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex space-x-4 items-center">
                <a href="#" class="text-black">Home</a>
                <a href="#" class="text-black">Shop</a>
                <a href="#" class="text-black">About Us</a>
                <a href="#" class="text-black">Return and Refund Policy</a>
                <a href="#" class="text-black">Contact Us</a>
            </div>

            <!-- Icons & Login (Always Visible) -->
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-1">
                    <i class="fas fa-search text-black"></i>
                    <span class="text-black">Search</span>
                </div>
                <div class="flex items-center space-x-1">
                    <i class="fas fa-shopping-bag text-black"></i>
                    <span class="text-black">3</span>
                </div>
                <a href="../pages/login.php" class="text-black">Login</a>
            </div>

            <!-- Burger Menu Button (Hidden on Large Screens) -->
            <button id="burger-menu" class="lg:hidden text-black focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

        <!-- Mobile Menu (Hidden by Default) -->
        <div id="mobile-menu" class="hidden bg-purple-200 py-2 lg:hidden">
            <a href="#" class="block px-4 py-2 text-black">Home</a>
            <a href="#" class="block px-4 py-2 text-black">Shop</a>
            <a href="#" class="block px-4 py-2 text-black">About Us</a>
            <a href="#" class="block px-4 py-2 text-black">Return and Refund Policy</a>
            <a href="#" class="block px-4 py-2 text-black">Contact Us</a>
        </div>
    </nav>

    <!-- JavaScript for Burger Menu Toggle -->
    <script>
        const burgerMenu = document.getElementById("burger-menu");
        const mobileMenu = document.getElementById("mobile-menu");

        burgerMenu.addEventListener("click", () => {
            mobileMenu.classList.toggle("hidden");
        });
    </script>

</body>
</html>
