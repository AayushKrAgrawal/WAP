<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eCommerce App</title>
    <!-- Link to Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold text-center mb-6">Welcome to Hamro Pratibha</h2>
        
        <!-- Login Button -->
        <button class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 mb-4" 
                onclick="window.location.href='login.php'">
            Login
        </button>
        
        <!-- Sign Up Button -->
        <button class="w-full bg-green-500 text-white py-3 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-400" 
                onclick="window.location.href='signup.php'">
            Sign Up
        </button>
    </div>

</body>
</html>
