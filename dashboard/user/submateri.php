<?php 
session_start();
include '../../config/koneksi.php';
$title = 'Sub Materi';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {  
    header("Location: ../../login.php");
    exit;
}

// Cek apakah pengguna memiliki role 'user'
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: ../../login.php"); // Akses ditolak jika role tidak sesuai
    exit;
}

// Pastikan id_materi ada di URL
if (isset($_GET['id_materi'])) {
    // Ambil nilai id_materi dari URL
    $id_materi = intval($_GET['id_materi']); // Mengonversi ke integer untuk keamanan
    // Query untuk mengambil data submateri berdasarkan id_materi
    $query = "SELECT * FROM submateri WHERE id_materi = $id_materi";
    $result = mysqli_query($conn, $query);
    
    // Query untuk mendapatkan judul materi dan nama mata kuliah
    $campur = "SELECT matkul.nama_matkul, materi.judul, materi.id_matkul 
               FROM materi 
               INNER JOIN matkul ON materi.id_matkul = matkul.id 
               WHERE materi.id = $id_materi";
    $camp = mysqli_query($conn, $campur);
    $c = mysqli_fetch_assoc($camp);
    $id_matkul = $c['id_matkul'];
} else {
    echo "ID Materi tidak ditemukan.";
    exit;
}

// Jika ada status success, tampilkan notifikasi dengan SweetAlert
if (isset($_GET['status']) && $_GET['status'] == 'success') {
    echo "<script>
            Swal.fire({
                title: 'Sub Materi berhasil ditambahkan!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'submateri.php?id_materi=$id_materi';
            });
          </script>";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_progres'])) {
    $id = intval($_POST['id']);
    $progres = mysqli_real_escape_string($conn, $_POST['progres']);

    $updateQuery = "UPDATE submateri SET progres = '$progres' WHERE id = $id";
    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Progres berhasil diperbarui.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'submateri.php?id_materi=$id_materi';
                });
              </script>";
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Gagal memperbarui progres.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
              </script>";
    }
}

include '../../layout/header.php';
?>

<main class="bg-info bg-opacity-10">
    <div class="container-fluid p-5">
        <h1 class="text-center">Sub Materi <b> <?= strtoupper($c['judul']); ?> </b></h1>
        <!-- Tombol untuk menambahkan sub materi dan kembali ke mata kuliah -->
        <a href="addSubmateri.php?id_materi=<?php echo $id_materi; ?>" class="btn btn-secondary mb-3"><i class="fa-solid fa-plus"></i> Tambah Sub Materi</a>
        <a href="submateriAll.php" class="btn btn-info mb-3"><i class="fa-solid fa-circle-info"></i> Semua Sub Materi</a>
        <a href="materi.php?id_matkul=<?php echo $id_matkul; ?>" class="btn btn-warning mb-3 rounded-pill"><i class="fa-solid fa-book-open"></i> Materi</a>

        <!-- Daftar Sub Materi -->
        <div class="card bg-light table-responsive p-2">
            <h2 class="text-center bg-info">Daftar Sub Materi</h2>
            <table class="table table-bordered text-center">
                <thead>
                    <tr class="table-warning">
                        <th colspan="2">Sub Materi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <th>Judul</th>
                        <td><?= htmlspecialchars($row['judul']); ?></td>
                    </tr>
                    <tr>
                        <th>Referensi</th>
                        <td><?= htmlspecialchars($row['referensi']); ?></td>
                    </tr>
                    <tr>
                        <th>Progres</th>
                        <td 
                         class="
                             <?= 
                                ($row['progres'] === 'belum bisa') ? 'text-danger' : 
                                (($row['progres'] === 'hampir') ? 'text-warning' : 
                                (($row['progres'] === 'bisa') ? 'text-success' : ''));
                            ?>
                         "
                        > <b><?= htmlspecialchars($row['progres']); ?> </b></td>
                        <tr>
                            <td colspan="2">
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalAksi<?php echo $row['id']; ?>">
                                <i class="fa-brands fa-jedi-order"></i>
                                Selengkapnya
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="modalAksi<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="modalAksiLabel<?php echo $row['id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalAksiLabel<?php echo $row['id']; ?>"><strong><?php echo strtoupper($row['judul']); ?></strong></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Praktek:</strong> <?php echo htmlspecialchars($row['praktek']); ?></p>
                                                <p><strong>Target:</strong> <?php echo htmlspecialchars($row['target']); ?> Hari</p> <hr>
                                                <p><strong>Catatan:</strong> <br> <?php echo htmlspecialchars($row['catatan']); ?></p>
                                                <hr class="my-3 border border-secondary border-2 opacity-50">
                                                <form method="POST">
                                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                    <div class="mb-3">
                                                        <label for="progres" class="form-label">Ubah Progres</label>
                                                        <select class="form-control" id="progres" name="progres" required>
                                                            <option value="bisa" <?= $row['progres'] == 'bisa' ? 'selected' : ''; ?>>Bisa</option>
                                                            <option value="hampir" <?= $row['progres'] == 'hampir' ? 'selected' : ''; ?>>Hampir</option>
                                                            <option value="belum bisa" <?= $row['progres'] == 'belum bisa' ? 'selected' : ''; ?>>Belum Bisa</option>
                                                        </select>
                                                    </div>
                                                    <button type="submit" name="update_progres" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Simpan</button>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="editSubmateri.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
                                                <a href="delete.php?id=<?php echo $row['id']; ?>&table=submateri" onclick="deleteData(event)" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    </tr>
                    <tr><td colspan="2" class="bg-light"></td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include '../../layout/footer.php'; ?>
