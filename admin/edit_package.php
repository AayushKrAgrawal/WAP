<?php
include '../includes/db_connection.php';

$id = $_GET['id'];
$query = "SELECT * FROM packages WHERE id = $id";
$result = mysqli_query($conn, $query);
$package = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $image_url = $_POST['image_url'];
    $description = $_POST['description'];

    $query = "UPDATE packages SET title='$title', price='$price', image_url='$image_url', description='$description' WHERE id=$id";
    mysqli_query($conn, $query);

    header('Location: manage-packages.php');
    exit();
}
?>

<h2>Edit Package</h2>
<form method="POST" action="">
    <input type="text" name="title" value="<?= $package['title']; ?>" required><br>
    <input type="number" name="price" value="<?= $package['price']; ?>" required><br>
    <input type="text" name="image_url" value="<?= $package['image_url']; ?>" required><br>
    <textarea name="description"><?= $package['description']; ?></textarea><br>
    <button type="submit">Update Package</button>
</form>
