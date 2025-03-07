<?php 
session_start();
include '../../config/koneksi.php';
$title = 'Dashboard User';

// Pastikan pengguna sudah login
if (!isset($_SESSION['username'])) {  
    header("Location: ../../login.php");
    exit;
}
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: ../../login.php"); // Halaman untuk akses ditolak
    exit;
}

$user = $_SESSION['nama'];
$id_user = $_SESSION['id'];

// Query untuk menghitung jumlah setiap progres berdasarkan id_user
$queryProgres = "
    SELECT submateri.progres, COUNT(*) as count 
    FROM submateri 
    INNER JOIN materi ON submateri.id_materi = materi.id 
    INNER JOIN matkul ON materi.id_matkul = matkul.id 
    WHERE matkul.id_user = $id_user 
    GROUP BY submateri.progres
";
$resultProgres = mysqli_query($conn, $queryProgres);

$progresData = [
    'bisa' => 0,
    'hampir' => 0,
    'belum bisa' => 0
];

while ($row = mysqli_fetch_assoc($resultProgres)) {
    $progresData[$row['progres']] = $row['count'];
}

// Query untuk menghitung jumlah matkul, materi, submateri, dan dumb
$queryCounts = "
    SELECT 
        (SELECT COUNT(*) FROM matkul WHERE id_user = $id_user) AS jumlah_matkul,
        (SELECT COUNT(*) FROM materi INNER JOIN matkul ON materi.id_matkul = matkul.id WHERE matkul.id_user = $id_user) AS jumlah_materi,
        (SELECT COUNT(*) FROM submateri INNER JOIN materi ON submateri.id_materi = materi.id INNER JOIN matkul ON materi.id_matkul = matkul.id WHERE matkul.id_user = $id_user) AS jumlah_submateri,
        (SELECT COUNT(*) FROM dumb WHERE id_user = $id_user) AS jumlah_dumb
";
$resultCounts = mysqli_query($conn, $queryCounts);
$dataCounts = mysqli_fetch_assoc($resultCounts);

include '../../layout/header.php';
?>

<main class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h1 class="text-center mb-4">Hallo, <?php echo $_SESSION['nama']; ?></h1>
            <p class="text-center">Anda login sebagai <strong>Manusia Biasa</strong></p>
            
            <div class="row g-4">
                <!-- Statistik -->
                <div class="col-md-6">
                    <div class="card shadow-sm border-1 bg-light shadow">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Rekap Progres</h5>
                            <p>Jumlah Mata Kuliah: <strong><?php echo $dataCounts['jumlah_matkul']; ?></strong></p>
                            <p>Jumlah Materi: <strong><?php echo $dataCounts['jumlah_materi']; ?></strong></p>
                            <p>Jumlah Submateri: <strong><?php echo $dataCounts['jumlah_submateri']; ?></strong></p>
                            <p>Jumlah Dump Yang Belum Terselesaikan: <strong><?php echo $dataCounts['jumlah_dumb']; ?></strong></p>
                        </div>
                    </div>
                </div>

                <!-- Progress Chart -->
                <div class="col-md-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title text-success">Progress Anda</h5>
                            <canvas id="progressChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    var ctx = document.getElementById('progressChart').getContext('2d');
    var progressChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Bisa', 'Hampir', 'belum Bisa'],
            datasets: [{
                label: 'Progres',
                data: [
                    <?php echo $progresData['bisa']; ?>,
                    <?php echo $progresData['hampir']; ?>,
                    <?php echo $progresData['belum bisa']; ?>
                ],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(255, 99, 132, 0.7)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Progres Sub Materi'
                }
            }
        }
    });
</script>

<?php include '../../layout/footer.php'; ?>
