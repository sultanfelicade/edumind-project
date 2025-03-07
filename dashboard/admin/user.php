<?php 
session_start();
include '../../config/koneksi.php';
$title = 'Edit User';
if (!isset($_SESSION['username'])) {  
    header("Location: ../../login.html");
    exit;
}
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../../login.html"); // Halaman untuk akses ditolak
  exit;
}
include '../../layout/header.php';
$query = "SELECT * FROM user";
$result = mysqli_query($conn, $query);
if (isset($_GET['status']) && $_GET['status'] == 'success') {
    echo "<script>
            Swal.fire({
                title: 'user berhasil ditambahkan!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'user.php'; // Redirect ke halaman user.php setelah ok
            });
          </script>";
}
?>

<main>
    <div class="card bg-light m-5 p-5">

        <h2 class="text-center">Daftar User</h2>
        <table class="table table-striped">
            <tbody>
              <?php $i = 1; while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td colspan="2"><?php echo $i; ?></td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td><?php echo $row['nama']; ?></td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td><?php echo $row['username']; ?></td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td><?php echo $row['role']; ?></td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center">
                        <a href="editUser.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                        <a href="deleteUser.php?id=<?php echo $row['id']; ?>" onclick="deleteData(event)"  class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
                <tr><td colspan="2" class="bg-dark"></td></tr>
                <?php $i++; } ?>
            </tbody> 
        </table>
    </div>
</main>

<?php include '../../layout/footer.php' ?>