<?php
session_start();
include '../../config/koneksi.php';
$title = 'Edit Sub Materi';
if (!isset($_SESSION['username'])) {
  header("Location: ../../login.html");
  exit;
}
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
  header("Location: ../../login.html"); // Halaman untuk akses ditolak
  exit;
}
$id = $_GET['id'];
$query = "SELECT * FROM submateri WHERE id = $id";
$result = mysqli_query($conn, $query);
$submateri = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $judul = $_POST['judul'];
  $catatan = $_POST['catatan'];
  $referensi = $_POST['referensi'];
  $praktek = $_POST['praktek'];
  $target = $_POST['target'];

  $updateQuery = "UPDATE submateri SET judul = '$judul', `catatan` = '$catatan', referensi = '$referensi', praktek = '$praktek', target = '$target' WHERE id = $id";
  if (mysqli_query($conn, $updateQuery)) {
    header("Location: submateri.php?id_materi=" . $submateri['id_materi']);
    exit;
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }
}

include '../../layout/header.php';
?>

<main>
  <h2 class="text-center">Edit Submateri</h2>
  <a href="submateri.php?id_materi=<?= $submateri['id_materi'] ?>" class="btn btn-warning"><i class="bi bi-arrow-left fa fa-arrow-left"></i>Kembali</a>
  <form method="POST">
    <div class="form-group">
      <label for="judul">Judul</label>
      <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $submateri['judul']; ?>" required>
    </div>
    <div class="form-group">
      <label for="catatan">Catatan</label>
      <textarea class="form-control" name="catatan" id="catatan"><?= $submateri['catatan'] ?></textarea>
    </div>
    <div class="form-group">
      <label for="referensi" class="form-label">Referensi</label>
      <input type="text" class="form-control" id="referensi" name="referensi" value="<?= $submateri['referensi'] ?>">
    </div>
    <div class="form-group">
      <label for="praktek" class="form-label">Praktek [aksi]</label>
      <input type="text" class="form-control" id="praktek" name="praktek" value="<?= $submateri['praktek'] ?>">
    </div>
    <div class="form-group">
      <label for="target" class="form-label">Target {harian}</label>
      <input type="number" class="form-control" id="target" name="target" value="<?= $submateri['target'] ?>">
    </div>
    <button type="submit" onclick="save(event)" class="btn btn-info"><i class="fa-solid fa-pen"></i> Perbarui</button>
  </form>
</main>

<?php include '../../layout/footer.php'; ?>