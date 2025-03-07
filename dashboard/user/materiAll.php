<?php 
session_start();
include '../../config/koneksi.php';
$title = 'Materi';

if (!isset($_SESSION['username'])) {  
    header("Location: ../../login.html");
    exit;
}
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: ../../login.html");
    exit;
}

$id_user = $_SESSION['id'];

include '../../layout/header.php';

// Query untuk mengambil data materi berdasarkan id_user
$query = "
    SELECT materi.*, matkul.nama_matkul
    FROM materi
    INNER JOIN matkul ON materi.id_matkul = matkul.id
    WHERE matkul.id_user = $id_user
    ORDER BY matkul.nama_matkul, materi.id
";
$result = mysqli_query($conn, $query);

// Inisialisasi array untuk mengelompokkan data
$groupedMateri = [];

while ($row = mysqli_fetch_assoc($result)) {
    $groupedMateri[$row['nama_matkul']][] = $row;
}

// Periksa status sukses
if (isset($_GET['status']) && $_GET['status'] == 'success') {
    echo "<script>
            Swal.fire({
                title: 'Materi berhasil ditambahkan!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'materiAll.php';
            });
          </script>";
}
?>

<main>
    <div class="container-fluid p-5">
        <a href="matkul.php" class="btn btn-warning m-2"> <i class="fa-solid fa-book-open"></i> Mata Kuliah</a>
        <div class="card bg-light m-3 p-2">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th colspan="2" class="text-center"><h1><b>Semua Materi</b></h1></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($groupedMateri)): ?>
                        <?php $i = 1; foreach ($groupedMateri as $nama_matkul => $materis): ?>
                            <tr class="table-warning">
                                <th colspan="2" class="text-center"> <i><?= $i ?>. <?= htmlspecialchars($nama_matkul); ?> </i> </th>
                            </tr>
                            <?php foreach ($materis as $materi): ?>
                                <tr>
                                    <th>Target :</th>
                                    <td><?= htmlspecialchars($materi['minggu']); ?> Minggu</td>
                                </tr>
                                <tr>
                                    <th>Judul Materi:</th>
                                    <td><?= htmlspecialchars($materi['judul']); ?></td>
                                </tr>
                                <tr>
                                    <th>Tujuan:</th>
                                    <td><?= htmlspecialchars($materi['tujuan']); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="bg-light"></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php $i++; endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2" class="text-center">Tidak ada materi yang tersedia.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include '../../layout/footer.php'; ?>
