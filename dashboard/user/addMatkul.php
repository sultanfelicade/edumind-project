<?php
session_start();
include '../../config/koneksi.php';
$title = 'Add Matkul';

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
    $nama_matkul = $_POST['nama_matkul'];
    $kategori = $_POST['kategori'];
    $dosen = $_POST['dosen'];

    // Langsung melakukan insert tanpa validasi duplikat
    $updateQuery = "INSERT INTO matkul(nama_matkul, `status`, `id_user`, `dosen`) VALUES ('$nama_matkul', '$kategori', '$id_user', '$dosen')";
    if (mysqli_query($conn, $updateQuery)) {
        // Jika berhasil, arahkan ke halaman user.php dengan status success
        header("Location: matkul.php?status=success");
        exit;
    } else {
        // Jika gagal menambahkan data
        header("Location: addMatkul.php?status=failed&message=" . urlencode('Matkul gagal ditambahkan.'));
        exit;
    }
}

include '../../layout/header.php';
?>

<main class="bg-primary  bg-opacity-10">
    <h2 class="text-center">Tambah Mata Kuliah</h2>
    <!-- <a href="matkul.php" class="btn btn-warning btn-lg m-3"><i class="fa-solid fa-chevron-left"></i> Kembali</a> -->
    <div style="background-color:rgba(137, 207, 242, 0.66);" class="card mb-3 shadow-sm bg-opacity-50 align-items-center justify-content-center">     
        <a href="matkul.php" class="btn btn-warning btn-lg m-5 w-50 rounded-pill">
            <i class="fa-solid fa-chevron-left"></i> Kembali
        </a>
    </div>
    <div class="card bg-light m-5 p-5" style="width: 19 rem;">
        <form method="POST">
            <div class="form-group">
                <label for="nama_matkul">Nama Mata Kuliah</label>
                <input type="text" class="form-control" id="nama_matkul" name="nama_matkul" required>
            </div>
            <div class="form-group">
                <label for="dosen">Nama Dosen Pengajar</label>
                <input type="text" class="form-control" id="dosen" name="dosen">
            </div>
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select class="form-control" id="kategori" name="kategori" required>
                    <option value="wajib">Wajib</option>
                    <option value="pilihan">Pilihan</option>
                </select>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <button type="submit" class="btn btn-lg btn-primary m-5 "><i class="fa-solid fa-plus"></i>Tambah</button>
            </div>
        </form>
    </div>
</main>

<?php include '../../layout/footer.php'; ?>
