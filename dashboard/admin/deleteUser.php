<?php
session_start();
include '../../config/koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../../login.html");
    exit;
}

$id = $_GET['id'];
$query = "DELETE FROM user WHERE id = $id";

if (mysqli_query($conn, $query)) {
    header("Location: user.php");
    exit;
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
?>