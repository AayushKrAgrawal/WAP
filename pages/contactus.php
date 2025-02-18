<?php
session_start();
include('../includes/db_connect.php');
include('../includes/header.php');

// Use PDO to fetch all products from the database

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Hamro Pratibha</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #a855f7 0%, #7e22ce 100%); /* Purple Gradient */
        }

        .form-input {
            border: 1px solid #ddd;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            transition: border-color 0.3s ease;
        }

        .form-input:focus {
            border-color: #3b82f6;
            outline: none;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        }
    </style>
</head>
<body class="bg-gray-50 font-sans leading-normal tracking-normal">

    <!-- Header -->
    

    <!-- Hero Section -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-6 text-gray-800">Get in Touch</h1>
            <p class="text-xl text-gray-600 mb-8">
                We'd love to hear from you! Whether you have a question about our gift boxes, need assistance with customization, or just want to share your feedback, please don't hesitate to reach out.
            </p>
        </div>
    </section>

    <!-- Contact Form and Information -->
    <section class="bg-gray-50 py-12">
        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Contact Form -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">Send us a Message</h2>
                <form action="#" method="POST"> <!-- Replace "#" with your form submission URL -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Your Name</label>
                        <input type="text" name="name" id="name" class="form-input" placeholder="Enter your name" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Your Email</label>
                        <input type="email" name="email" id="email" class="form-input" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-4">
                        <label for="subject" class="block text-gray-700 text-sm font-bold mb-2">Subject</label>
                        <input type="text" name="subject" id="subject" class="form-input" placeholder="Enter the subject" required>
                    </div>
                    <div class="mb-6">
                        <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Message</label>
                        <textarea name="message" id="message" rows="5" class="form-input" placeholder="Enter your message" required></textarea>
                    </div>
                    <button type="submit" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded-full">
                        Send Message
                    </button>
                </form>
            </div>

            <!-- Contact Information -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">Contact Information</h2>
                <p class="text-gray-700 mb-4">
                    We are available to assist you during our business hours.
                </p>
                <div class="mb-4">
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Address</h3>
                    <p class="text-gray-600">
                        Kathmandu,Nepal<br>
                        Near IIMS college, Putalisadak<br>
                        Nepal
                    </p>
                </div>
                <div class="mb-4">
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Email</h3>
                    <p class="text-gray-600">
                        <a href="mailto:support@hamropratibha.com">support@hamropratibha.com</a>
                    </p>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Phone</h3>
                    <p class="text-gray-600">
                        9876543210
                    </p>
                </div>

                <div class="mt-6">
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Connect With Us</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-500 hover:text-purple-500">
                            <i class="fab fa-facebook-square fa-2x"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-purple-500">
                            <i class="fab fa-instagram fa-2x"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-purple-500">
                            <i class="fab fa-twitter-square fa-2x"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Footer -->
    <footer class="gradient-bg text-white py-4">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2025 Hamro Pratibha. All rights reserved.</p>
            <div class="mt-2">
                <a href="/privacy" class="text-gray-200 hover:text-white">Privacy Policy</a>
                <span class="mx-2">|</span>
                <a href="/terms" class="text-gray-200 hover:text-white">Terms of Service</a>
            </div>
        </div>
    </footer>

</body>
</html>
