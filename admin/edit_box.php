<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: admin_login.php");
    exit();
}

// Database connection
$host = 'localhost';
$db = 'your_database';
$user = 'your_username';
$pass = 'your_password';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM boxes WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $box = $result->fetch_assoc();
    } else {
        die("Box not found");
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];

    $sql = "UPDATE boxes SET name='$name', description='$description', image_url='$image_url' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: manage_boxes.php");
        exit();
    } else {
        $error = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Box</title>
</head>
<body>
    <h2>Edit Box</h2>
    <form method="POST">
        <label>Name: </label><br>
        <input type="text" name="name" value="<?php echo $box['name']; ?>" required><br>
        <label>Description: </label><br>
        <textarea name="description" required><?php echo $box['description']; ?></textarea><br>
        <label>Image URL: </label><br>
        <input type="text" name="image_url" value="<?php echo $box['image_url']; ?>" required><br>
        <button type="submit">Update Box</button>
    </form>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
</body>
</html>

<?php
$conn->close();
?>
