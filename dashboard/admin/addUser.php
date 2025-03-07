<?php
session_start();
include '../../config/koneksi.php';
$title = 'Add User';

if (!isset($_SESSION['username'])) {
    header("Location: ../../login.html");
    exit;
}

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../login.html"); // Halaman untuk akses ditolak
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $role = $_POST['role'];
    $password = $_POST['password'];

    // Cek apakah username sudah ada di database
    $checkQuery = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        // Jika username sudah ada, arahkan kembali ke addUser.php dengan status failed
        header("Location: addUser.php?status=failed&message=" . urlencode('Username sudah terdaftar!'));
        exit;
    } else {
        // Jika username belum ada, lanjutkan melakukan insert
        $updateQuery = "INSERT INTO user(nama, username, `password`, `role`) VALUES ('$nama', '$username', '$password', '$role')";
        if (mysqli_query($conn, $updateQuery)) {
            // Jika berhasil, arahkan ke halaman user.php dengan status success
            header("Location: user.php?status=success");
            exit;
        } else {
            // Jika gagal menambahkan data
            header("Location: addUser.php?status=failed&message=" . urlencode('Data gagal ditambahkan.'));
            exit;
        }
    }
}

include '../../layout/header.php';
?>

<main>
    <h2>Add User</h2>
    <div class="card bg-light m-5 p-5" style="width: 19 rem;">
        <form method="POST">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <button type="submit" class="btn btn-lg btn-primary mt-5 ">Add</button>
            </div>
        </form>
    </div>
</main>

<?php
// Menampilkan pesan berdasarkan status di URL
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    $message = isset($_GET['message']) ? urldecode($_GET['message']) : '';

    if ($status == 'failed') {
        // Jika status failed, tampilkan pesan error menggunakan SweetAlert
        echo "<script>
                Swal.fire({
                    title: 'Gagal!',
                    text: '$message',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'addUser.php'; // Redirect ke halaman addUser.php setelah ok
                });
              </script>";
    }
}
?>

<?php include '../../layout/footer.php'; ?>
