<?php
session_start();
include '../../config/koneksi.php';
$title = 'Add Materi';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: ../../login.html");
    exit;
}

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: ../../login.html"); // Halaman untuk akses ditolak
    exit;
}

// Pastikan `id_matkul` tersedia di URL
if (!isset($_GET['id_matkul'])) {
    header("Location: ../../dashboard/user/materi.php?status=failed&message=" . urlencode('ID Mata Kuliah tidak ditemukan.'));
    exit;
}

$id_matkul = intval($_GET['id_matkul']); // Ambil ID Mata Kuliah dari URL

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $minggu = intval($_POST['minggu']);
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $tujuan = mysqli_real_escape_string($conn, $_POST['tujuan']);

    // Insert data tanpa memeriksa duplikasi
    $insertQuery = "INSERT INTO materi (id_matkul, minggu, judul, tujuan) VALUES ('$id_matkul', '$minggu', '$judul', '$tujuan')";
    if (mysqli_query($conn, $insertQuery)) {
        // Jika berhasil, arahkan ke halaman materi dengan status success
        header("Location: materi.php?id_matkul=$id_matkul&status=success");
        exit;
    } else {
        // Jika gagal, arahkan kembali dengan status failed
        header("Location: addMateri.php?id_matkul=$id_matkul&status=failed&message=" . urlencode('Materi gagal ditambahkan.'));
        exit;
    }
}

include '../../layout/header.php';
?>

<main style="background-color: #e9f7ef;">
    <h2 class="text-center">Tambah Materi</h2>
    <div style="background-color:rgba(194, 253, 18, 0.38);" class="card mb-3 shadow-sm bg-opacity-50 align-items-center justify-content-center">     
        <a href="materi.php?id_matkul=<?= $id_matkul ?>" class="btn btn-warning btn-lg m-5 w-50 rounded-pill">
            <i class="fa-solid fa-chevron-left"></i> Kembali
        </a>
    </div>
    <div class="card bg-light m-5 p-5 " >
        <form method="POST">
            <div class="form-group">
                <label for="minggu">Target Berapa Minggu?</label>
                <input type="number" class="form-control" id="minggu" name="minggu" required>
            </div>
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" required>
            </div>
            <div class="form-group">
                <label for="tujuan">Tujuan Belajar</label>
                <textarea class="form-control" id="tujuan" name="tujuan" required></textarea>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <button type="submit" class="btn btn-lg btn-primary mt-5">Tambah</button>
            </div>
        </form>
    </div>
</main>

<?php
// Menampilkan pesan berdasarkan status di URL
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    $message = isset($_GET['message']) ? urldecode($_GET['message']) : '';

    if ($status == 'failed') {
        // Tampilkan pesan error menggunakan SweetAlert
        echo "<script>
                Swal.fire({
                    title: 'Gagal!',
                    text: '$message',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
              </script>";
    } elseif ($status == 'success') {
        // Tampilkan pesan sukses menggunakan SweetAlert
        echo "<script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Materi berhasil ditambahkan.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
              </script>";
    }
}
?>

<?php include '../../layout/footer.php'; ?>
