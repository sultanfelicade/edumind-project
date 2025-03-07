<?php 
session_start();
include 'config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validasi input username dan password
    if (empty($_POST['username']) || empty($_POST['password'])) {
        echo "<script>alert('Silakan isi username dan password.'); window.location.href = 'login.html';</script>";
        exit;
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Menggunakan prepared statement untuk keamanan
    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verifikasi password
        if ($password === $row['password']) { // Ganti dengan password_verify jika menggunakan hashing
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];
            $_SESSION['nama'] = $row['nama'];

            if ($row['role'] == 'admin') {
                header("Location: dashboard/admin/index.php");
            } else if ($row['role'] == 'user') {
                header("Location: dashboard/user/index.php");
            }
            exit;
        } else {
            // Password salah
            echo "<script>alert('Password salah.'); window.location.href = 'login.html';</script>";
            exit;
        }
    } else {
        // Username tidak ditemukan
        echo "<script>alert('Username tidak ditemukan.'); window.location.href = 'login.html';</script>";
        exit;
    }
} else {
    // Jika bukan metode POST
    header("Location: login.html");
    exit;
}
?>
