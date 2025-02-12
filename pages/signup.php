<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - eCommerce App</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="w-full max-w-lg p-8 space-y-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold text-center text-gray-800">Create Your Account</h2>

        <!-- Form for Signup -->
        <form action="../controllers/AuthController.php" method="POST">
            <!-- First Name and Last Name Section -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="firstName" class="block text-gray-700 font-semibold">First Name</label>
                    <input type="text" id="firstName" name="firstName" placeholder="Enter your first name" 
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label for="lastName" class="block text-gray-700 font-semibold">Last Name</label>
                    <input type="text" id="lastName" name="lastName" placeholder="Enter your last name" 
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>

            <!-- Email and Phone Section -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="email" class="block text-gray-700 font-semibold">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" 
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label for="phone" class="block text-gray-700 font-semibold">Phone</label>
                    <input type="text" id="phone" name="phone" placeholder="Enter your phone number" 
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>

            <!-- Date of Birth and Gender Section -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="dob" class="block text-gray-700 font-semibold">Date of Birth</label>
                    <input type="date" id="dob" name="dob" 
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold">Gender</label>
                    <div class="flex items-center space-x-4">
                        <label for="male" class="inline-flex items-center">
                            <input type="radio" id="male" name="gender" value="male" class="form-radio text-blue-500" required>
                            <span class="ml-2">Male</span>
                        </label>
                        <label for="female" class="inline-flex items-center">
                            <input type="radio" id="female" name="gender" value="female" class="form-radio text-blue-500">
                            <span class="ml-2">Female</span>
                        </label>
                        <label for="other" class="inline-flex items-center">
                            <input type="radio" id="other" name="gender" value="other" class="form-radio text-blue-500">
                            <span class="ml-2">Other</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Password and Re-enter Password Section -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="password" class="block text-gray-700 font-semibold">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" 
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label for="confirmPassword" class="block text-gray-700 font-semibold">Re-enter Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Re-enter your password" 
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>

            <!-- Terms and Conditions Section -->
            <div class="flex items-center mb-6">
                <input type="checkbox" id="terms" name="terms" class="form-checkbox text-blue-500" required>
                <label for="terms" class="ml-2 text-sm text-gray-700">I agree to the <a href="#" class="text-blue-500 hover:underline">Terms and Conditions</a></label>
            </div>

            <!-- Register Button -->
            <button type="submit" name="register" 
                    class="w-full bg-[#B82132] text-white py-3 rounded-full hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400">
                Sign Up
            </button>

            <!-- Already Have an Account? -->
            <div class="text-center mt-4">
                <span class="text-sm text-gray-600">Already have an account? </span>
                <a href="login.php" class="text-sm text-blue-500 hover:underline">Login</a>
            </div>
        </form>
    </div>

</body>
</html>
