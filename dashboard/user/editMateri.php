<?php
session_start();
include '../../config/koneksi.php';
$title = 'Edit Materi';
if (!isset($_SESSION['username'])) {
  header("Location: ../../login.html");
  exit;
}
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
  header("Location: ../../login.html"); // Halaman untuk akses ditolak
  exit;
}
$id = $_GET['id'];
$query = "SELECT * FROM materi WHERE id = $id";
$result = mysqli_query($conn, $query);
$materi = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $judul = $_POST['judul'];
  $tujuan = $_POST['tujuan'];
  $minggu = $_POST['minggu'];

  $updateQuery = "UPDATE materi SET judul = '$judul', `tujuan`= '$tujuan', minggu = '$minggu' WHERE id = $id";
  if (mysqli_query($conn, $updateQuery)) {
    header("Location: materi.php?id_matkul=" . $materi['id_matkul']);
    exit;
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }
}

include '../../layout/header.php';
?>

<main>
  <h2 class="text-center">Edit Materi</h2>
  <a href="materi.php?id_matkul=<?= $materi['id_matkul'] ?>" class="btn btn-warning"><i class="bi bi-arrow-left fa fa-arrow-left"></i>Kembali</a>
  <form method="POST">
    <div class="form-group">
      <label for="judul">Judul</label>
      <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $materi['judul']; ?>" required>
    </div>
    <div class="form-group">
      <label for="tujuan">Tujuan</label>
      <textarea class="form-control" name="tujuan" id="tujuan"><?= $materi['tujuan'] ?></textarea>
    </div>
    <div class="form-group">
      <label for="target" class="form-label">Target {mingguan}</label>
      <input type="number" class="form-control" id="minggu" name="minggu" value="<?= $materi['minggu'] ?>">
    </div>
    <button type="submit" onclick="save(event)" class="btn btn-info"><i class="fa-solid fa-pen"></i> Perbarui</button>
  </form>
</main>

<?php include '../../layout/footer.php'; ?>