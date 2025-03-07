<?php 
session_start();
include '../../config/koneksi.php';
$title = 'Materi';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {  
    header("Location: ../../login.html");
    exit;
}

// Cek apakah pengguna memiliki role 'user'
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: ../../login.html"); // Akses ditolak jika role tidak sesuai
    exit;
}

include '../../layout/header.php';

// Pastikan id_matkul ada di URL
if (isset($_GET['id_matkul'])) {
    // Ambil nilai id_matkul dari URL
    $id_matkul = intval($_GET['id_matkul']); // Mengonversi ke integer untuk keamanan

    // Query untuk mengambil data materi berdasarkan id_matkul
    $query = "SELECT * FROM materi WHERE id_matkul = $id_matkul";
    // Eksekusi query
    $result = mysqli_query($conn, $query);
    $kueri = "SELECT matkul.nama_matkul 
          FROM matkul 
          INNER JOIN materi ON materi.id_matkul = matkul.id 
          WHERE matkul.id = $id_matkul";
    $res = mysqli_query($conn, $kueri);
    $row = mysqli_fetch_assoc($res);
} else {
    // Handle jika id_matkul tidak ditemukan
    echo "ID Mata Kuliah tidak ditemukan.";
    exit;
}

// Jika ada status success, tampilkan notifikasi dengan SweetAlert
if (isset($_GET['status']) && $_GET['status'] == 'success') {
    echo "<script>
            Swal.fire({
                title: 'Materi berhasil ditambahkan!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'materi.php?id_matkul=$id_matkul'; // Redirect kembali ke halaman materi
            });
          </script>";
}
?>

<main class="bg-warning  bg-opacity-10">
    <div class="container-fluid p-5">
        <h1 class="text-center ">Materi <b> <?= strtoupper($row['nama_matkul']); ?> </b></h1>
        <!-- Tombol untuk menambahkan materi dan kembali ke mata kuliah -->
        <a href="addMateri.php?id_matkul=<?= $id_matkul ?>" class="btn btn-warning opacity-75 mb-3"><i class="fa-solid fa-plus"></i> Tambah Materi</a>
        <a href="materiAll.php" class="btn btn-info mb-3"><i class="fa-solid fa-circle-info"></i> Semua Materi</a>
        <a href="matkul.php" class="btn btn-secondary mb-3 rounded-pill"><i class="fa-solid fa-book-open"></i> Mata Kuliah</a>

        <!-- Daftar Materi -->
        <div class="card bg-light">
            <h2 class="text-center">Daftar Materi</h2>
            <table class="table table-bordered text-center">
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <th>Target: </th>
                        <td><?= $row['minggu']?> Minggu</td>
                    </tr>
                    <tr>
                        <th>Judul: </th>
                        <td><?= $row['judul']?></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <!-- Tombol Aksi -->
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalAksi<?php echo $row['id']; ?>">
                            <i class="fa-solid fa-grip"></i> Detail
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="modalAksi<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="modalAksiLabel<?php echo $row['id']; ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalAksiLabel<?php echo $row['id']; ?>"><?= strtoupper($row['judul'])?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Tujuan Mempelajari:</strong> <br> <?php echo $row['tujuan']; ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="editMateri.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
                                            <a href="delete.php?id=<?php echo $row['id']; ?>&table=materi" onclick="deleteData(event)" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Hapus</a>
                                            <a href="submateri.php?id_materi=<?php echo $row['id']; ?>" class="btn btn-info btn-sm"><i class="fa-solid fa-book-open-reader"></i> SubMateri</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="bg-secondary"></td> <!-- Garis pembatas antar data -->
                    </tr>
                <?php } ?>

            </table>
        </div>
    </div>
</main>

<?php include '../../layout/footer.php' ?>
