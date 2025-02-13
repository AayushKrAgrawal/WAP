<?php
include '../includes/db_connect.php';

$id = $_GET['id'];
$query = "DELETE FROM packages WHERE id = $id";
mysqli_query($conn, $query);

header('Location: manage_packages.php');
exit();
?>
