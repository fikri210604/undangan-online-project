<?php
include("../includes/db.php");
session_start();
if ($_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

// Pagination Data Setup
$limit = 10;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Query total data untuk pagination
$total_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users WHERE role = 'tamu'");
$total_result = mysqli_fetch_assoc($total_query);
$total_data = $total_result['total'];
$total_pages = ceil($total_data / $limit);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Konfirmasi Kehadiran Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body style="background-color: #E1E1E1;">
    <?php include("../asset/sidebar.php"); ?>

    <div class="container mt-4 p-4">
        <h2>Konfirmasi Kehadiran Tamu</h2>

        <div class="bg-light p-4 rounded shadow-lg mt-3">
            <div class="table-responsive">
                <table class="table table-bordered table-hover bg-dark">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>No</th>
                            <th>Email</th>
                            <th>Nama Lengkap</th>
                            <th>Alamat</th>
                            <th>Kode Unik</th>
                            <th>Status Konfirmasi</th>
                            <th>Undangan PDF</th>
                            <th>Ucapan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        ?>
                    </tbody>
                    <?php
                    $query = mysqli_query($conn, "
                        SELECT 
                            users.id, users.email, users.nama, users.alamat, users.kode_unik,
                            konfirmasi.status AS status_konfirmasi,
                            konfirmasi.pdf_path AS undangan_pdf,
                            konfirmasi.whishes AS ucapan
                        FROM users
                        LEFT JOIN konfirmasi ON users.id = konfirmasi.user_id
                        WHERE users.role = 'tamu'
                        LIMIT $limit OFFSET $offset
                    ");

                    $no = $offset + 1;
                    while ($row = mysqli_fetch_assoc($query)) {
                        $status = $row['status_konfirmasi'] ?? 'Belum Konfirmasi';
                        $pdf = $row['undangan_pdf'] ?? '-';
                        $ucapan = $row['ucapan'] ?? '-';
                        $pdf_link = ($pdf !== '-') ? "<a href='../public/uploads/{$pdf}' target='_blank'>Lihat</a>" : '-';

                        echo "
                            <tr>
                                <td>{$no}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['nama']}</td>
                                <td>{$row['alamat']}</td>
                                <td>{$row['kode_unik']}</td>
                                <td>{$status}</td>
                                <td>{$pdf_link}</td>
                                <td>{$ucapan}</td>
                                <td>
                                    <a href='crud-tamu/hapus.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Hapus data ini?\")'>Hapus</a>
                                </td>
                            </tr>
                        ";
                        $no++;
                    }
                    ?>
                </table>
                <!-- Pagination -->
                <nav aria-label="Page navigation" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=1">&laquo;</a>
                        </li>
                        <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page - 1 ?>">&lsaquo;</a>
                        </li>
                        <li class="page-item active">
                            <span class="page-link"><?= $page ?></span>
                        </li>
                        <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page + 1 ?>">&rsaquo;</a>
                        </li>
                        <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $total_pages ?>">&raquo;</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

    </div>
</body>

</html>