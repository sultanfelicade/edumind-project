<?php 
session_start();
include '../../config/koneksi.php';
$title = 'SubMateri';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {  
    header("Location: ../../login.html");
    exit;
}

// Cek apakah pengguna memiliki role 'user'
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: ../../login.html"); // Halaman untuk akses ditolak
    exit;
}

include '../../layout/header.php';

// Query untuk mengambil semua data submateri beserta informasi materi dan mata kuliah
$id_user = $_SESSION['id']; // Ambil id_user dari session

$query = "
    SELECT 
        submateri.id,
        submateri.judul,
        submateri.catatan,
        submateri.progres,
        submateri.referensi,
        submateri.praktek,
        submateri.target,
        materi.judul AS judul_materi,
        matkul.nama_matkul
    FROM submateri
    INNER JOIN materi ON submateri.id_materi = materi.id
    INNER JOIN matkul ON materi.id_matkul = matkul.id
    WHERE matkul.id_user = $id_user;
";
$result = mysqli_query($conn, $query);


// Validasi hasil query
if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}
?>

<main class="bg-info bg-opacity-10">
    <div class="container-fluid p-5">
        <h1 class="text-center">Sub Materi <b> ALL </b></h1>

        <!-- Tombol untuk menambahkan sub materi dan kembali ke mata kuliah -->
        <a href="materiAll.php" class="btn btn-warning mb-3 rounded-pill"><i class="fa-solid fa-book-open"></i> Materi All</a>

        <!-- Daftar Sub Materi -->
        <div class="card bg-light">
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
                            <th>Progres</th>
                            <td 
                                class="<?= 
                                    ($row['progres'] === 'belum bisa') ? 'text-danger' : 
                                    (($row['progres'] === 'hampir') ? 'text-warning' : 
                                    (($row['progres'] === 'bisa') ? 'text-success' : ''));
                                ?>"
                            >
                                <b><?= htmlspecialchars($row['progres']); ?> </b>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <!-- Tombol Selengkapnya -->
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalDetail<?php echo $row['id']; ?>">
                                <i class="fa-regular fa-circle-up"></i> Selengkapnya
                                </button>
                                
                                <!-- Modal Detail (Tanpa Aksi) -->
                                <div class="modal fade" id="modalDetail<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="modalDetailLabel<?php echo $row['id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalDetailLabel<?php echo $row['id']; ?>">Detail Sub Materi</h5>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Judul:</strong> <?= htmlspecialchars($row['judul']); ?></p>
                                                <p><strong>Catatan:</strong> <?= htmlspecialchars($row['catatan']); ?></p>
                                                <p><strong>Praktek:</strong> <?= htmlspecialchars($row['praktek']); ?></p>
                                                <p><strong>Target:</strong> <?= htmlspecialchars($row['target']); ?> Hari</p>
                                                <p><strong>Referensi:</strong> <?= htmlspecialchars($row['referensi']); ?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning opacity-75" data-bs-dismiss="modal"> <i class="fa-regular fa-circle-down"></i> Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr><td colspan="2" class="bg-light"></td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include '../../layout/footer.php'; ?>
