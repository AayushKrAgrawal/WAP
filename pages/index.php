<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Add custom background color to Tailwind config
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'custom-bg': '#F5EFFF',
                    },
                },
            },
        }
    </script>
    <style>
        /* Removed scroll animation styles */
        /* Ensure the image covers the full height of the container */
        .image-cover {
            height: 100%;
            width: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body class="bg-custom-bg">
    <!-- Image Slider with Navigation on Top -->
    <div class="relative w-full h-[600px] overflow-hidden">
        <!-- Navigation Bar Overlay with Padding -->
        <div class="absolute top-0 left-0 right-0 p-4 flex justify-between items-center z-20" style="padding-left: 8rem; padding-right: 8rem;">
            <div class="text-2xl font-bold">
                <span class="text-white">Hamro</span>
                <span class="text-[#B82132]">Pratibha</span>
            </div>
            <div class="space-x-4">
                <a href="../pages/login.php" class="text-white">Log In</a>
                <a href="../pages/signup.php" class="text-white">Sign Up</a>
            </div>
        </div>

        <!-- Image Slider -->
        <div x-data="{
            activeSlide: 0,
            slides: [
                {
                    image: '../assets/images/gift1.jpg',  /* Ensure correct image paths */
                    title: 'Welcome to Hamro Pratibha',
                    description: 'Discover Nepal\'s rich craftsmanship through curated, customizable gift boxes that make every occasion special.'
                },
                {
                    image: '../assets/images/gift2.jpg',  /* Ensure correct image paths */
                    title: 'Gifts with a Personal Touch',
                    description: 'Discover Nepal\'s rich craftsmanship through curated, customizable gift boxes that make every occasion special.'
                },
                {
                    image: '../assets/images/gift3.jpg',  /* Ensure correct image paths */
                    title: 'Gifts for Every Occasion',
                    description: 'Discover Nepal\'s rich craftsmanship through curated, customizable gift boxes that make every occasion special.'
                }
            ],
            nextSlide() {
                this.activeSlide = (this.activeSlide + 1) % this.slides.length;
            },
            prevSlide() {
                this.activeSlide = (this.activeSlide - 1 + this.slides.length) % this.slides.length;
            },
            autoSlide() {
                setInterval(() => {
                    this.nextSlide();
                }, 2000);  // Change every 2 seconds
            }
        }" x-init="autoSlide()" class="relative w-full h-full flex transition-transform duration-700 ease-in-out">
            <div class="relative w-full h-full flex transition-transform duration-700 ease-in-out"
                :style="`transform: translateX(-${activeSlide * 100}%)`">
                <template x-for="(slide, index) in slides" :key="index">
                    <div class="w-full flex-shrink-0">
                        <!-- Image and overlay -->
                        <div class="relative h-full">
                            <img :src="slide.image" class="w-full h-full object-cover object-center">
                            <div class="absolute inset-0 bg-black/40"></div>

                            <!-- Content overlay -->
                            <div class="absolute inset-0 flex flex-col items-center justify-center text-white px-4 md:px-20">
                                <h1 class="text-4xl md:text-6xl font-bold mb-6 text-center" x-text="slide.title"></h1>
                                <p class="text-center max-w-3xl text-lg mb-8" x-text="slide.description"></p>
                                <a href="../pages/login.php">
                                <button class="px-6 py-2 border-2 border-white rounded-full hover:bg-white hover:text-black transition-colors">
                                    Shop Now
                                </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Navigation Buttons -->
            <button @click="prevSlide()"
                    class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white px-4 py-2 rounded-full z-10">
                &#10094;
            </button>
            <button @click="nextSlide()"
                    class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white px-4 py-2 rounded-full z-10">
                &#10095;
            </button>

            <!-- Dot navigation -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-2 z-10">
                <template x-for="(slide, index) in slides" :key="index">
                    <button @click="activeSlide = index"
                            :class="{'bg-white': activeSlide === index, 'bg-white/50': activeSlide !== index}"
                            class="w-3 h-3 rounded-full transition-colors duration-300">
                    </button>
                </template>
            </div>
        </div>
    </div>

    <!-- About Us Section  -->
    <div class="py-16 px-4 md:px-20 transition-transform transform hover:scale-105 duration-300 ease-in-out">
        <div class="max-w-7xl mx-auto flex items-center justify-between space-x-8">
            <!-- Text on the left -->
            <div class="w-1/2">
                <h2 class="text-4xl font-bold text-[#B82132] mb-6">About Us</h2>
                <p class="text-lg text-gray-600 mb-8">
                At Hamro Pratibha, we are dedicated to celebrating Nepal’s rich craftsmanship through thoughtfully curated and customizable gift boxes. Our mission is to share the beauty of Nepali artistry with the world while supporting local artisans and promoting sustainable practices.

Each of our gift boxes combines traditional Nepali crafts, such as handwoven pashmina, intricate woodwork, and colorful pottery, with modern aesthetics. We offer two unique gift experiences: pre-curated boxes for those looking for a ready-made gift, and customizable options that allow customers to select packaging and items to create a personalized gift.

Our commitment to ethical sourcing ensures that every product we offer is crafted with care and respect for the environment. By empowering local artisans, we preserve Nepal’s cultural heritage while making it accessible to a global audience.

At Hamro Pratibha, we believe gifting is about connection, and we aim to provide an exceptional experience that brings joy and meaning to every occasion
                </p>
            </div>
            <!-- Image on the right -->
            <div class="w-1/2">
               <!-- Image with fade-in animation -->
               <img src="../assets/images/aboutUs.jpg" alt="About Us" class="image-cover rounded-lg shadow-lg ">
            </div>
        </div>
    </div>

    <!-- Our Services Section -->
<div class="py-16 px-4 md:px-20 bg-custom-bg">
    <div class="max-w-7xl mx-auto text-center">
        <h2 class="text-4xl font-bold text-[#B82132] mb-8">Our Services</h2>
        <p class="text-lg text-gray-600 mb-12">
            At Hamro Pratibha, we offer two unique gift selection options to help you create the perfect gift experience for any occasion. Whether you prefer ready-made gifts or enjoy personalizing your selections, we have something special for you.
        </p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Pre-curated Gift Boxes -->
            <div class="relative flex flex-col items-center text-center bg-white p-6 rounded-lg shadow-md transition-transform transform hover:scale-105">
                <!-- Image at the top -->
                <div class="w-full h-72 bg-cover bg-center rounded-lg mb-4" style="background-image: url('../assets/images/pre-curated.jpg');"></div>
                <!-- Text at the bottom -->
                <h3 class="text-2xl font-bold text-[#B82132] mb-4">Pre-curated Gift Boxes</h3>
                <p class="text-gray-600 mb-6">
                    Browse our selection of beautifully crafted gift boxes, each containing handpicked Nepali-made products. These pre-curated sets are perfect for quick and meaningful gifts, offering a delightful mix of traditional and modern items.
                </p>
                <a href="../pages/login.php" class="text-[#B82132] font-semibold">View More &rarr;</a>
            </div>

            <!-- Custom Gift Boxes -->
            <div class="relative flex flex-col items-center text-center bg-white p-6 rounded-lg shadow-md transition-transform transform hover:scale-105">
                <!-- Image at the top -->
                <div class="w-full h-72 bg-cover bg-center rounded-lg mb-4" style="background-image: url('../assets/images/customizing.jpg');"></div>
                <!-- Text at the bottom -->
                <h3 class="text-2xl font-bold text-[#B82132] mb-4">Custom Gift Boxes</h3>
                <p class="text-gray-600 mb-6">
                    Personalize your gift box by selecting from a variety of packaging styles and items that reflect your recipient's preferences. Whether it's for a birthday, wedding, or any special occasion, our custom gift boxes are sure to leave a lasting impression.
                </p>
                <a href="../pages/login.php" class="text-[#B82132] font-semibold">Create Your Box &rarr;</a>
            </div>
        </div>
    </div>
</div>
<!-- Customer review -->
<div class="py-16 px-4 md:px-20 transition-transform transform hover:scale-105 duration-300 ease-in-out">
    <div class="max-w-7xl mx-auto text-center">
        <h2 class="text-4xl font-bold text-[#B82132] mb-8">What Our Customers Say</h2>
        <div class="flex space-x-8 justify-center">
            <!-- Testimonial 1 -->
            <div class="max-w-md p-6 bg-white shadow-lg rounded-lg">
                <p class="text-lg italic text-gray-600">"Hamro Pratibha’s gift box was a big hit at my friend's wedding! The craftsmanship is exquisite, and the personal touch made it even more special."</p>
                <h3 class="text-xl font-bold mt-4">Anita Sharma</h3>
            </div>
            <!-- Testimonial 2 -->
            <div class="max-w-md p-6 bg-white shadow-lg rounded-lg">
                <p class="text-lg italic text-gray-600">"I love the idea of customizing my own gift box! It's a thoughtful gift that reflects Nepali culture, and the products are high-quality."</p>
                <h3 class="text-xl font-bold mt-4">Rajesh Thapa</h3>
            </div>
        </div>
    </div>
</div>
<!-- FAQ -->
<div class="py-16 px-4 md:px-20 ">
    <div class="max-w-7xl mx-auto text-center">
        <h2 class="text-4xl font-bold text-[#B82132] mb-8">Frequently Asked Questions</h2>
        <div class="space-y-6">
            <!-- FAQ Item 1 -->
            <div x-data="{ open: false }">
                <h3 @click="open = !open" class="cursor-pointer text-xl font-semibold text-left p-4 bg-white shadow-md rounded-lg transition-all duration-300 hover:bg-[#B82132] hover:text-white">
                    What is the lead time for customized gift boxes?
                </h3>
                <p x-show="open" x-transition class="text-gray-600 p-4 bg-gray-50 rounded-lg">
                    Custom orders take 3-5 business days to process before shipping, depending on the complexity of the order.
                </p>
            </div>

            <!-- FAQ Item 2 -->
            <div x-data="{ open: false }">
                <h3 @click="open = !open" class="cursor-pointer text-xl font-semibold text-left p-4 bg-white shadow-md rounded-lg transition-all duration-300 hover:bg-[#B82132] hover:text-white">
                    Can I return a customized gift box?
                </h3>
                <p x-show="open" x-transition class="text-gray-600 p-4 bg-gray-50 rounded-lg">
                    Customized gift boxes can only be returned if the goods are damaged or there was a mistake on our part. Please provide a video of the unboxing as proof within 7 days to process your return.
                </p>
            </div>

            <!-- FAQ Item 3 -->
            <div x-data="{ open: false }">
                <h3 @click="open = !open" class="cursor-pointer text-xl font-semibold text-left p-4 bg-white shadow-md rounded-lg transition-all duration-300 hover:bg-[#B82132] hover:text-white">
                    Do you offer international shipping?
                </h3>
                <p x-show="open" x-transition class="text-gray-600 p-4 bg-gray-50 rounded-lg">
                    Currently, we do not offer international shipping. However, if we start offering it in the future, we will announce it on our website and social media channels.
                </p>
            </div>
        </div>
    </div>
</div>
<!-- Thank You & Feedback Section -->
<!-- Thank You & Feedback Section -->
<div class="py-16 px-4 md:px-20 bg-[#F5EFFF]">
    <div class="max-w-7xl mx-auto text-center">
        <h2 class="text-4xl font-bold text-[#B82132] mb-4">Thank You for Visiting!</h2>
        <p class="text-lg text-gray-600 mb-8">
            Have any thoughts on this? Don't hesitate to give your feedback!
          </p>
    </div>
</div>
<!-- footer -->
<footer class="bg-[#B82132] text-white py-6">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <!-- Copyright -->
        <div>&copy; 2025 Hamro Pratibha. All rights reserved.</div>
        <div class="space-x-4">
            <span>Privacy Policy</span>
            <span>Terms of Service</span>
            <span>Contact Us</span>
        </div>
        <div class="space-x-4">
            <span>Facebook</span>
            <span>Instagram</span>
            <span>Twitter</span>
        </div>
    </div>
</footer>


</body>
</html>