<?php
session_start();
include '../../config/koneksi.php';
$title = 'Daftar Mata Kuliah';

if (!isset($_SESSION['username'])) {
    header("Location: ../../login.php");
    exit;
}

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: ../../login.php");
    exit;
}

$id_user = $_SESSION['id'];

// Query untuk mengambil data matkul berdasarkan id_user
$query = "
    SELECT * 
    FROM matkul 
    WHERE id_user = $id_user
";
$result = mysqli_query($conn, $query);

include '../../layout/header.php';
?>

<main class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center mb-4">Daftar Mata Kuliah</h1>
            <a href="addMatkul.php" class="btn btn-warning mb-3"><i class="fa-solid fa-plus"></i> Tambah Mata Kuliah</a>
            <div class="card bg-light">
                <h2 class="text-center">Daftar Mata Kuliah</h2>
                <table class="table table-bordered text-center">
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <th class="text-center"><?= ucwords($row['nama_matkul'])?></th>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">
                                <!-- Tombol Aksi -->
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalAksi<?php echo $row['id']; ?>">
                                    <i class="fa-solid fa-bars-progress"></i> Aksi
                                </button>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="modalAksi<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="modalAksiLabel<?php echo $row['id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalAksiLabel<?php echo $row['id']; ?>"><?php echo strtoupper($row['nama_matkul']); ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Status:</strong> <br> <?php echo $row['status']; ?></p>
                                                <p><strong>Dosen:</strong> <br> <?php echo $row['dosen']; ?></p>
                                            </div>
                                            
                                            <div class="modal-footer">
                                                <a href="editMatkul.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen"></i> Edit</a>
                                                <a href="delete.php?id=<?php echo $row['id']; ?>&table=matkul" onclick="deleteData(event)" class="btn btn-danger btn-sm"><i class="fa-regular fa-trash-can"></i> Hapus</a>
                                                <a href="materi.php?id_matkul=<?php echo $row['id']; ?>" class="btn btn-info btn-sm"><i class="fa-solid fa-book"></i> Materi</a>
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
    </div>
</main>

<?php include '../../layout/footer.php'; ?>