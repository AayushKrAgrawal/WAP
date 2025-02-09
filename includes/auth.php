<?php
// Include database connection file
include('db_connect.php');

// Collect form data
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$password = $_POST['password'];  // User's plain password

// Hash the password
$passwordHash = password_hash($password, PASSWORD_BCRYPT);

// Check if user agreed to terms
$termsAgreed = isset($_POST['terms']) ? 1 : 0;

// Insert into the database
$sql = "INSERT INTO users (first_name, last_name, email, phone, dob, gender, password_hash, terms_agreed)
        VALUES ('$firstName', '$lastName', '$email', '$phone', '$dob', '$gender', '$passwordHash', '$termsAgreed')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>
