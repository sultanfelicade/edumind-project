<?php
session_start();
include '../../config/koneksi.php';
$title = 'Edit Matkul';
if (!isset($_SESSION['username'])) {
    header("Location: ../../login.html");
    exit;
}
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: ../../login.html"); // Halaman untuk akses ditolak
    exit;
}
$id = $_GET['id'];
$query = "SELECT * FROM matkul WHERE id = $id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_matkul = $_POST['nama_matkul'];
    $status = $_POST['status'];
    $dosen = $_POST['dosen'];

    $updateQuery = "UPDATE matkul SET nama_matkul = '$nama_matkul', `status` = '$status' , `dosen`= '$dosen' WHERE id = $id";
    if (mysqli_query($conn, $updateQuery)) {
        header("Location: matkul.php");
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

include '../../layout/header.php';
?>

<main>
    <h2 class="text-center">Edit Matkul</h2>
    <a href="matkul.php" class="btn btn-warning"><i class="bi bi-arrow-left fa fa-arrow-left"> Kembali</i></a>
    <form method="POST">
        <div class="form-group">
            <label for="nama_matkul">Nama Matkul</label>
            <input type="text" class="form-control" id="nama_matkul" name="nama_matkul" value="<?php echo $user['nama_matkul']; ?>" required>
        </div>
        <div class="form-group">
            <label for="dosen">Nama Dosen</label>
            <input type="text" class="form-control" id="dosen" name="dosen" value="<?php echo $user['dosen']; ?>" required>
        </div>
        <div class="form-group">
            <label for="username">Status</label>
            <select name="status" id="status" class="form-control">
              <option value="wajib" <?php if ($user['status'] === 'wajib') echo 'selected'; ?>>Wajib</option>
              <option value="pilihan" <?php if ($user['status'] === 'pilihan') echo 'selected'; ?>>Pilihan</option>
            </select>
        </div>
        <button type="submit" onclick="save(event)" class="btn btn-primary"><i class="fa-solid fa-pen"></i> Perbarui</button>
    </form>
</main>

<?php include '../../layout/footer.php'; ?>