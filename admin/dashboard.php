<?php
include("../includes/db.php");

session_start();
// Validasi admin
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

$query = "SELECT COUNT(*) as total FROM users WHERE role = 'tamu'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);
$jumlahTamu = $data['total'];

// Tamu yang hadir
$hadir = mysqli_query($conn, "
    SELECT COUNT(*) as total FROM konfirmasi 
    INNER JOIN users ON konfirmasi.user_id = users.id 
    WHERE users.role = 'tamu' AND konfirmasi.status = 'Hadir'
");
$dataHadir = mysqli_fetch_assoc($hadir);
$jumlahHadir = $dataHadir['total'];

// Tamu yang tidak hadir
$tidakHadir = mysqli_query($conn, "
    SELECT COUNT(*) as total FROM konfirmasi 
    INNER JOIN users ON konfirmasi.user_id = users.id 
    WHERE users.role = 'tamu' AND konfirmasi.status = 'Tidak Hadir'
");
$dataTidakHadir = mysqli_fetch_assoc($tidakHadir);
$jumlahTidakHadir = $dataTidakHadir['total'];

// Tamu Belum Konfirmasi
$jumlahBelumKonfirmasi = $jumlahTamu - ($jumlahHadir + $jumlahTidakHadir);
if ($jumlahBelumKonfirmasi < 0) {
    $jumlahBelumKonfirmasi = 0;
}

// Sisa Kursi
$sisaKursi = 500 - $jumlahHadir;

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body style="background-color: #E1E1E1;">
    <?php include("../asset/sidebar.php"); ?>

    <div class="container mt-4">
        <h2 class="mb-4">Dashboard Admin</h2>
        <div class="alert alert-info" role="alert">
            Selamat datang di dashboard admin! Di sini Anda dapat melihat statistik kehadiran tamu.
        </div>
        <div class="bg-light p-4 rounded shadow-md mt-3">
            <div class="row g-4">
                <!-- Total Tamu -->
                <div class="col-md-3">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="bi bi-people-fill text-primary" style="font-size: 2.5rem;"></i>
                            </div>
                            <h6 class="card-title text-muted">Total Tamu</h6>
                            <p class="display-6 fw-bold text-primary"><?php echo $jumlahTamu; ?></p>
                        </div>
                    </div>
                </div>

                <!-- Tamu Hadir -->
                <div class="col-md-3">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="bi bi-check2-circle text-success" style="font-size: 2.5rem;"></i>
                            </div>
                            <h6 class="card-title text-muted">Hadir</h6>
                            <p class="display-6 fw-bold text-success"><?php echo $jumlahHadir; ?></p>
                        </div>
                    </div>
                </div>

                <!-- Tamu Tidak Hadir -->
                <div class="col-md-3">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="bi bi-x-circle-fill text-danger" style="font-size: 2.5rem;"></i>
                            </div>
                            <h6 class="card-title text-muted">Tidak Hadir</h6>
                            <p class="display-6 fw-bold text-danger"><?php echo $jumlahTidakHadir; ?></p>
                        </div>
                    </div>
                </div>

                <!-- Tamu Belum Konfirmasi -->
                <div class="col-md-3">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="bi bi-question-circle-fill text-warning" style="font-size: 2.5rem;"></i>
                            </div>
                            <h6 class="card-title text-muted">Belum Konfirmasi</h6>
                            <p class="display-6 fw-bold text-warning"><?php echo $jumlahBelumKonfirmasi; ?></p>
                        </div>
                    </div>
                </div>

                <!-- Sisa Kursi-->
                <div class="col-md-3">
                    <div class="card shadow-sm border-0">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="bi bi-question-circle-fill text-warning" style="font-size: 2.5rem;"></i>
                            </div>
                            <h6 class="card-title text-muted">Sisa Kursi</h6>
                            <p class="display-6 fw-bold text-warning"><?php echo $sisaKursi; ?></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>