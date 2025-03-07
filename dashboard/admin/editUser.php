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
$id = $_GET['id'];
$query = "SELECT * FROM user WHERE id = $id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $updateQuery = "UPDATE user SET nama = '$nama', username = '$username', `password` = '$password' WHERE id = $id";
    if (mysqli_query($conn, $updateQuery)) {
        header("Location: user.php");
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

include '../../layout/header.php';
?>

<main>
    <h2 class="text-center">Edit User</h2>
    <a href="user.php" class="btn btn-secondary"><i class="bi bi-arrow-left fa fa-arrow-left"> Kembali</i></a>
    <form method="POST">
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $user['nama']; ?>" required>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="text" class="form-control" id="password" name="password" value="<?php echo $user['password']; ?>">
        </div>
        <button type="submit" onclick="save(event)" class="btn btn-primary">Update</button>
    </form>
</main>

<?php include '../../layout/footer.php'; ?>