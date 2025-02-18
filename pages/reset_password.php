<?php
session_start();
include('../includes/db_connect.php');

$token = $_GET['token'] ?? '';

if (empty($token)) {
    die("Invalid token.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    if (empty($newPassword) || empty($confirmPassword)) {
        $_SESSION['error_message'] = "All fields are required.";
    } elseif ($newPassword !== $confirmPassword) {
        $_SESSION['error_message'] = "Passwords do not match.";
    } else {
        try {
            $sql = "SELECT * FROM users WHERE reset_token = :token AND reset_expires > NOW() LIMIT 1";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':token', $token);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                $newPasswordHash = password_hash($newPassword, PASSWORD_BCRYPT);

                $updateSql = "UPDATE users SET password_hash = :newPasswordHash, reset_token = NULL, reset_expires = NULL WHERE user_id = :userId";
                $updateStmt = $conn->prepare($updateSql);
                $updateStmt->bindParam(':newPasswordHash', $newPasswordHash);
                $updateStmt->bindParam(':userId', $user['user_id']);
                $updateStmt->execute();

                $_SESSION['success_message'] = "Password reset successful! You can now log in.";
                header("Location: login.php");
                exit;
            } else {
                $_SESSION['error_message'] = "Invalid or expired token.";
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
    <title>Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-3xl font-semibold text-center text-gray-700 mb-6">Reset Password</h2>
        
        <form action="" method="POST">
            <div class="mb-4">
                <label for="newPassword" class="block text-sm font-medium text-gray-600">New Password</label>
                <input type="password" id="newPassword" name="newPassword" required 
                    class="mt-2 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="confirmPassword" class="block text-sm font-medium text-gray-600">Confirm New Password</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required 
                    class="mt-2 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <button type="submit" class="w-full bg-[#B82132] text-white py-3 rounded-full hover:bg-[#9f1e2c] focus:outline-none focus:ring-2 focus:ring-[#9f1e2c]">
                Reset Password
            </button>
        </form>
    </div>

</body>
</html>
