<?php
session_start();
include('../includes/db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Registration Logic
    if (isset($_POST['register'])) {
        $firstName = trim($_POST['firstName']);
        $lastName = trim($_POST['lastName']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $termsAgreed = isset($_POST['terms']) ? 1 : 0;
        $role = 'user';

        if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($confirmPassword) || empty($dob) || !$termsAgreed) {
            $_SESSION['error_message'] = "All fields are required and you must agree to the terms and conditions.";
            header("Location: /hamroPratibha/pages/signup.php");
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error_message'] = "Invalid email format.";
            header("Location: /hamroPratibha/pages/signup.php");
            exit;
        }

        if ($password !== $confirmPassword) {
            $_SESSION['error_message'] = "Passwords do not match.";
            header("Location: /hamroPratibha/pages/signup.php");
            exit;
        }

        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (first_name, last_name, email, phone, dob, gender, password_hash, terms_agreed, role)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sssssssss", $firstName, $lastName, $email, $phone, $dob, $gender, $passwordHash, $termsAgreed, $role);

            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Registration successful! Please log in.";
                header("Location: /hamroPratibha/pages/login.php");
                exit;
            } else {
                $_SESSION['error_message'] = "Error: " . $stmt->error;
                header("Location: /hamroPratibha/pages/signup.php");
                exit;
            }

            $stmt->close();
        } else {
            $_SESSION['error_message'] = "Error preparing the statement: " . $conn->error;
            header("Location: /hamroPratibha/pages/signup.php");
            exit;
        }
    }

    // Login Logic
    if (isset($_POST['login'])) {
        $emailOrPhone = trim($_POST['emailOrPhone']);
        $password = $_POST['password'];

        if (empty($emailOrPhone) || empty($password)) {
            $_SESSION['error_message'] = "Both fields are required.";
            header("Location: /hamroPratibha/pages/login.php");
            exit;
        }

        $sql = "SELECT * FROM users WHERE email = ? OR phone = ? LIMIT 1";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ss", $emailOrPhone, $emailOrPhone);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                if (password_verify($password, $user['password_hash'])) {
                    session_regenerate_id();  // Regenerate session ID to prevent session fixation
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['first_name'] = $user['first_name'];
                    $_SESSION['last_name'] = $user['last_name'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['role'] = $user['role'];

                    if ($user['role'] == 'admin') {
                        header("Location: ../admin/admin_dashboard.php");
                    } else {
                        header("Location: /hamroPratibha/pages/dashboard.php");
                    }
                    exit;
                } else {
                    $_SESSION['error_message'] = "Incorrect password!";
                    header("Location: /hamroPratibha/pages/login.php");
                    exit;
                }
            } else {
                $_SESSION['error_message'] = "No user found with that email or phone number.";
                header("Location: /hamroPratibha/pages/login.php");
                exit;
            }

            $stmt->close();
        } else {
            $_SESSION['error_message'] = "Error preparing the statement: " . $conn->error;
            header("Location: /hamroPratibha/pages/login.php");
            exit;
        }
    }

    $conn->close();
}
?>
