<?php 
session_start();
include '../../config/koneksi.php';
$title = 'Dashboard Admin';

// Pastikan pengguna sudah login
if (!isset($_SESSION['username'])) {  
    header("Location: ../../login.php");
    exit;
}
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../login.html"); // Halaman untuk akses ditolak
    exit;
}

// Query untuk menghitung jumlah user
$query = "SELECT COUNT(*) as total_user FROM user";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$total_user = $row['total_user'];

include '../../layout/header.php';
?>

<main class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <h1 class="text-center mb-4">Hallo, <?php echo $_SESSION['nama']; ?></h1>
            <p class="text-center">Anda login sebagai <?php echo $_SESSION['role']; ?></p>
            
            <!-- Card to show total users -->
            <h3 class="mt-4">Data Statistics Users</h3>
            <div class="card shadow-sm mt-4">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text" style="font-size: 2rem; font-weight: bold;"><?php echo $total_user; ?></p>
                </div>
            </div>

            <!-- You can add more dashboard widgets here -->
        </div>
    </div>
</main>

<?php include '../../layout/footer.php' ?>
