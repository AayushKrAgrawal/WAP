<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - eCommerce App</title>
    <!-- Link to Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <!-- Card Container -->
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">

        <!-- Title -->
        <h2 class="text-3xl font-semibold text-center text-gray-700 mb-6">Login</h2>
        
        <!-- Login Form -->
        <form action="../controllers/AuthController.php" method="POST">

            <!-- Email or Phone -->
            <div class="mb-4">
                <label for="emailOrPhone" class="block text-sm font-medium text-gray-600">Email or Phone Number</label>
                <input type="text" id="emailOrPhone" name="emailOrPhone" required 
                    class="mt-2 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
                <input type="password" id="password" name="password" required 
                    class="mt-2 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Forgot Password Link -->
            <div class="mb-6 text-right">
                <a href="#" class="text-sm text-blue-500 hover:underline">Forgot Password?</a>
            </div>

            <!-- Login Button -->
            <button type="submit" name="login" class="w-full bg-[#B82132] text-white py-3 rounded-full hover:bg-[#9f1e2c] focus:outline-none focus:ring-2 focus:ring-[#9f1e2c]">
                Login
            </button>
        </form>

        <!-- Sign Up Redirect -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">Don't have an account? 
                <a href="signup.php" class="text-blue-500 hover:underline">Sign Up</a>
            </p>
        </div>
    </div>

</body>
</html>
