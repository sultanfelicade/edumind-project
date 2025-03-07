<?php
session_start();
include '../../config/koneksi.php';
$title = 'Add Dump';

// Pastikan pengguna login
if (!isset($_SESSION['username'])) {
    header("Location: ../../login.html");
    exit;
}

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: ../../login.html"); // Halaman untuk akses ditolak
    exit;
}

$id_user = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal_dibuat = $_POST['tanggal_dibuat'];

    // Validasi panjang judul dan deskripsi
    if (strlen($judul) > 225 || strlen($deskripsi) > 4000) {
        echo "<script>
                alert('Judul maksimal 225 karakter dan deskripsi maksimal 4000 karakter!');
                window.location.href = 'addDumb.php';
              </script>";
        exit;
    }

    // Menambahkan data ke database
    $insertQuery = "INSERT INTO dumb (judul, deskripsi, tanggal_buat, `id_user`) 
                    VALUES ('$judul', '$deskripsi', '$tanggal_dibuat', '$id_user')";

    if (mysqli_query($conn, $insertQuery)) {
        // Jika berhasil, arahkan ke halaman dumb.php dengan status sukses
        header("Location: dumb.php?status=success");
        exit;
    } else {
        // Jika gagal, tampilkan pesan error
        header("Location: addDumb.php?status=failed&message=" . urlencode('Dumb gagal ditambahkan.'));
        exit;
    }
}

include '../../layout/header.php';
?>

<main>
  <div class="card bg-light m-5 p-5" style="width: 19 rem;">
      <h3>Dump Dump!</h3>
        <form method="POST">
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" required>
            </div>
            <div class="form-group">
              <label for="deskripsi" class="form-label">Deskripsi</label>
              <textarea name="deskripsi" class="form-control" id="deskripsi" rows="3" placeholder="Apa yang kamu pikirkan?"></textarea>
              <input type="hidden" id="tanggal_dibuat" name="tanggal_dibuat" value="<?= date('Y-m-d') ?>">
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
        // Jika status gagal, tampilkan pesan error menggunakan SweetAlert
        echo "<script>
                Swal.fire({
                    title: 'Gagal!',
                    text: '$message',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'addDumb.php'; // Redirect ke halaman addDumb.php setelah OK
                });
              </script>";
    }
}
?>

<?php include '../../layout/footer.php'; ?>
