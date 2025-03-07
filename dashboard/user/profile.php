<?php
session_start();
include '../../config/koneksi.php';
$title = 'Edit Profile';
if (!isset($_SESSION['username'])) {
    header("Location: ../../login.html");
    exit;
}
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: ../../login.html"); // Halaman untuk akses ditolak
    exit;
}
include '../../layout/header.php';

$username = $_SESSION['username'];
$nama = $_SESSION['nama'];


if (isset($_POST['username']) || isset($_POST['password']) || isset($_POST['nama'])) {
    $newUsername = $_POST['username'];
    $newNama = $_POST['nama'];
    $password = $_POST['password'];

    if (!empty($password)) {
        $stmt = $conn->prepare("UPDATE user SET `password` = ? WHERE username = ?");
        $stmt->bind_param("ss", $password, $username);
        $stmt->execute();
        $stmt->close();
        $_SESSION['password'] = $password;
    }

    if (!empty($newUsername) && $newUsername !== $username) {
        $stmt = $conn->prepare("UPDATE user SET `username` = ? WHERE username = ?");
        $stmt->bind_param("ss", $newUsername, $username);
        $stmt->execute();
        $stmt->close();
        $_SESSION['username'] = $newUsername;
        $username = $newUsername;
    }

    if (!empty($newNama) && $newNama !== $nama) {
        $stmt = $conn->prepare("UPDATE user SET `nama` = ? WHERE username = ?");
        $stmt->bind_param("ss", $newNama, $username);
        $stmt->execute();
        $stmt->close();
        $_SESSION['nama'] = $newNama;
    }

    header("Location: profile.php");
    exit;
}
?>

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center bg-info text-white p-3 mb-5 rounded">Your Profile</h1>
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="text-center">Edit Profile</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input
                                type="text"
                                name="nama"
                                id="nama"
                                class="form-control"
                                value="<?php echo htmlspecialchars($_SESSION['nama']); ?>"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input
                                type="text"
                                name="username"
                                id="username"
                                class="form-control"
                                value="<?php echo htmlspecialchars($_SESSION['username']); ?>"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input
                                type="text"
                                name="password"
                                id="password"
                                class="form-control">
                        </div>
                        <div class="d-grid">
                            <button 
                            type="submit" 
                            class="btn btn-primary"
                            onclick="save(event)"
                            >Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include '../../layout/footer.php' ?>