<?php
// Start the session
session_start();

// Include the database connection
include('../includes/db_connect.php');

// Check if the form is submitted for registration or login
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Registration Logic
    if (isset($_POST['register'])) {
        // Collect form data from the signup form
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $password = $_POST['password'];  // User's plain password
        $confirmPassword = $_POST['confirmPassword'];  // Re-enter password
        $termsAgreed = isset($_POST['terms']) ? 1 : 0;
        $role = 'user'; // Default role for new users

        // Form validation
        if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($confirmPassword) || empty($dob) || !$termsAgreed) {
            echo "All fields are required and you must agree to the terms and conditions.";
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format.";
            exit;
        }

        if ($password !== $confirmPassword) {
            echo "Passwords do not match.";
            exit;
        }

        // Hash the password
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        // Use prepared statements to prevent SQL injection
        $sql = "INSERT INTO users (first_name, last_name, email, phone, dob, gender, password_hash, terms_agreed, role)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters to the prepared statement
            $stmt->bind_param("sssssssss", $firstName, $lastName, $email, $phone, $dob, $gender, $passwordHash, $termsAgreed, $role);

            // Execute the query
            if ($stmt->execute()) {
                // Redirect to login page after successful registration
                header("Location: /hamroPratibha/pages/login.php");
                exit;
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the prepared statement
            $stmt->close();
        } else {
            echo "Error preparing the statement: " . $conn->error;
        }
    }

    // Login Logic
    if (isset($_POST['login'])) {
        // Collect form data from the login form
        $emailOrPhone = $_POST['emailOrPhone'];  // Email or Phone number
        $password = $_POST['password'];  // User's plain password

        // Validate input
        if (empty($emailOrPhone) || empty($password)) {
            echo "Both fields are required.";
            exit;
        }

        // Use prepared statements to prevent SQL injection
        $sql = "SELECT * FROM users WHERE email = ? OR phone = ? LIMIT 1";

        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters to the prepared statement
            $stmt->bind_param("ss", $emailOrPhone, $emailOrPhone);

            // Execute the query
            $stmt->execute();

            // Get the result
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // User found, now verify the password
                $user = $result->fetch_assoc();
                if (password_verify($password, $user['password_hash'])) {
                    // Successful login - Store user information in session
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['first_name'] = $user['first_name'];
                    $_SESSION['last_name'] = $user['last_name'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['role'] = $user['role']; // Store role in session

                    // Redirect based on role
                    if ($user['role'] == 'admin') {
                        header("Location: ../admin\index.php");
                    } else {
                        header("Location: /hamroPratibha/pages/dashboard.php");
                    }
                    exit;
                } else {
                    echo "Incorrect password!";
                }
            } else {
                echo "No user found with that email or phone number.";
            }

            // Close the prepared statement
            $stmt->close();
        } else {
            echo "Error preparing the statement: " . $conn->error;
        }
    }

    // Close database connection
    $conn->close();
}
?>
