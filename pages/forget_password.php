<?php
session_start();
include('../includes/db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailOrPhone = trim($_POST['emailOrPhone']);
    
    if (empty($emailOrPhone)) {
        $_SESSION['error_message'] = "Please enter your email or phone number.";
    } else {
        try {
            $sql = "SELECT * FROM users WHERE email = :emailOrPhone OR phone = :emailOrPhone LIMIT 1";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':emailOrPhone', $emailOrPhone);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                $resetToken = bin2hex(random_bytes(32));
                $resetExpires = date("Y-m-d H:i:s", strtotime('+1 hour'));

                $updateSql = "UPDATE users SET reset_token = :resetToken, reset_expires = :resetExpires WHERE user_id = :userId";
                $updateStmt = $conn->prepare($updateSql);
                $updateStmt->bindParam(':resetToken', $resetToken);
                $updateStmt->bindParam(':resetExpires', $resetExpires);
                $updateStmt->bindParam(':userId', $user['user_id']);
                $updateStmt->execute();

                $resetLink = "http://yourdomain.com/pages/reset_password.php?token=$resetToken";
                
                // Email the reset link (for demonstration, just echoing it)
                echo "Reset Link: <a href='$resetLink'>$resetLink</a>";
                exit;
            } else {
                $_SESSION['error_message'] = "No user found with that email or phone number.";
            }
        } catch (PDOException $e) {
            $_SESSION['error_message'] = "Database error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-3xl font-semibold text-center text-gray-700 mb-6">Forgot Password</h2>
        
        <form action="" method="POST">
            <div class="mb-4">
                <label for="emailOrPhone" class="block text-sm font-medium text-gray-600">Email or Phone Number</label>
                <input type="text" id="emailOrPhone" name="emailOrPhone" required 
                    class="mt-2 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <button type="submit" class="w-full bg-[#B82132] text-white py-3 rounded-full hover:bg-[#9f1e2c] focus:outline-none focus:ring-2 focus:ring-[#9f1e2c]">
                Send Reset Link
            </button>
        </form>
    </div>

</body>
</html>
