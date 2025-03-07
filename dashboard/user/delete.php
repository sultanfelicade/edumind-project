<?php
session_start();
include '../../config/koneksi.php';

// Pastikan user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: ../../login.php");
    exit;
}

// Pastikan parameter id dan table ada di URL
if (!isset($_GET['id']) || !isset($_GET['table'])) {
    echo "Parameter id atau table tidak ada!";
    exit;
}

$id = $_GET['id'];
$table = $_GET['table']; // Nama tabel (matkul, materi, submateri)

// Validasi tabel yang dapat dipilih
$valid_tables = ['matkul', 'materi', 'submateri', 'dumb'];

if (in_array($table, $valid_tables)) {
    // Query untuk menghapus data dari tabel yang dipilih
    $query = "DELETE FROM $table WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        // Jika berhasil menghapus data, arahkan kembali ke halaman yang sesuai
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        // Jika gagal menghapus data
        echo "Error deleting record: " . mysqli_error($conn);
        exit;
    }
} else {
    // Jika tabel tidak valid
    echo "Tabel tidak valid!";
    exit;
}
?>
