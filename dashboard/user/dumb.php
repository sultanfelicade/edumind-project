<?php 
session_start();
include '../../config/koneksi.php';
$title = 'Dump';
if (!isset($_SESSION['username'])) {  
    header("Location: ../../login.html");
    exit;
}
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: ../../login.html"); // Halaman untuk akses ditolak
    exit;
}
include '../../layout/header.php';
$query = "SELECT * FROM dumb WHERE id_user = ".$_SESSION['id'];
$result = mysqli_query($conn, $query);
if (isset($_GET['status']) && $_GET['status'] == 'success') {
    echo "<script>
            Swal.fire({
                title: 'Dump berhasil ditambahkan!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'dumb.php'; // Redirect ke halaman user.php setelah ok
            });
          </script>";
}
?>

<main>
    <div class="container-fluid p-5">
        <a href="addDumb.php" class="btn btn-secondary mb-3"><i class="fa-solid fa-plus"></i>Tambah Dump</a>
        <div class="card bg-light p-3">
            <table class="table table-success table-striped-columns table-borderless">
                <thead>
                    <tr>
                        <td colspan="2"><h2 class="text-center"><i class="fa-brands fa-think-peaks"></i>Your Dump <i class="fa-brands fa-think-peaks"></h2></td>
                    </tr>
                    <tr><td colspan="2" class="bg-light"></td></tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                        <td colspan="2" class="text-center text-secondary">
                            <i>
                                <?= date('l, d-m-Y', strtotime($row['tanggal_buat'])); ?>
                            </i>
                        </td>

                        </tr>
                    <tr>
                        <th>Judul</th>
                        <td><b><?= $row['judul']; ?></b></td>
                    </tr>
                    <tr>
                    	<th>Deskripsi</th>
                    	<td>
                    		<?= isset($row['deskripsi']) ? nl2br(htmlspecialchars($row['deskripsi'])) : 'Tidak ada deskripsi'; ?>
                    	</td>
                    </tr>

                    <tr>
                        <td colspan="2" class="text-center">
                            <a href="delete.php?id=<?php echo $row['id']; ?>&table=dumb" onclick="doneData(event)" class="btn btn-success"><i class="fa-solid fa-check-double"></i> Done</a>
                        </td>
                    </tr>
                    <tr><td colspan="2" class="bg-light"></td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include '../../layout/footer.php' ?>