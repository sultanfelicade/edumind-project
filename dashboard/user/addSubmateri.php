<?php
session_start();
include '../../config/koneksi.php';
$title = 'Add Sub Materi';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: ../../login.html");
    exit;
}

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: ../../login.html"); // Halaman untuk akses ditolak
    exit;
}

// Pastikan `id_materi` tersedia di URL
if (!isset($_GET['id_materi'])) {
    echo "ID Materi tidak ditemukan.";
    exit;
}

$id_materi = $_GET['id_materi'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $catatan = $_POST['catatan'];
    $progres = $_POST['progres'];
    $referensi = $_POST['referensi'];
    $praktek = $_POST['praktek'];
    $target = $_POST['target'];

    // Validasi panjang judul dan catatan
    if (strlen($judul) > 400 || strlen($catatan) > 2000) {
        header("Location: addSubmateri.php?id_materi=$id_materi&status=failed&message=" . urlencode('Judul maksimal 400 karakter dan catatan maksimal 2000 karakter!'));
        exit;
    }

    // Menambahkan data ke database
    $insertQuery = "INSERT INTO submateri (judul, catatan, progres, referensi, praktek, target, id_materi) 
                    VALUES ('$judul', '$catatan', '$progres', '$referensi', '$praktek', '$target', '$id_materi')";

    if (mysqli_query($conn, $insertQuery)) {
        header("Location: submateri.php?id_materi=$id_materi&status=success");
        exit;
    } else {
        header("Location: addSubmateri.php?id_materi=$id_materi&status=failed&message=" . urlencode('Sub Materi gagal ditambahkan.'));
        exit;
    }
}

include '../../layout/header.php';
?>

<main class="container mt-5">
    <a href="submateri.php?id_materi=<?= $id_materi ?>" class="btn btn-warning mb-3"><i class="fa-solid fa-chevron-left"></i> Batal</a>
    <h1 class="text-center mb-4">Tambah Sub Materi</h1>
    <form method="POST">
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" maxlength="400" required>
        </div>
        <div class="mb-3">
            <label for="catatan" class="form-label">Catatan</label>
            <textarea class="form-control" id="catatan" name="catatan" rows="4" maxlength="2000" required></textarea>
        </div>
        <div class="mb-3">
            <label for="progres" class="form-label">Progres</label>
            <select class="form-control" id="progres" name="progres" required>
                <option value="bisa">Bisa</option>
                <option value="hampir">Hampir</option>
                <option value="belum bisa" selected>Belum Bisa</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="referensi" class="form-label">Referensi</label>
            <input type="text" class="form-control" placeholder="buku / url" id="referensi" name="referensi" maxlength="500">
        </div>
        <div class="mb-3">
            <label for="praktek" class="form-label">Praktek</label>
            <input type="text" class="form-control" id="praktek" name="praktek" maxlength="300" placeholder="langkah yang ingin anda lakukan">
        </div>
        <div class="mb-3">
            <label for="target" class="form-label">Target Harian</label>
            <input type="number" class="form-control" id="target" name="target" placeholder="Target Harian" required>
        </div>
        <input type="hidden" name="status" value="success">
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
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
                    text: 'Sub Materi berhasil ditambahkan.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
              </script>";
    }
}
?>

<?php include '../../layout/footer.php'; ?>
