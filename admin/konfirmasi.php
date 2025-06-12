<?php
include("../includes/db.php");

$limit = 10;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

$cari = isset($_GET['cari']) ? $_GET['cari'] : '';
$filter_status = isset($_GET['filter_status']) ? $_GET['filter_status'] : '';

// Query data untuk menampilkan dalam tabel
$sql = "SELECT 
            users.id, users.email, users.nama, users.alamat, users.kode_unik,
            konfirmasi.status AS status_konfirmasi,
            konfirmasi.nomor_kursi AS nomor_kursi,
            konfirmasi.pdf_path AS undangan_pdf,
            konfirmasi.whishes AS ucapan
        FROM users
        LEFT JOIN konfirmasi ON users.id = konfirmasi.user_id
        WHERE users.role = 'tamu'";

if ($cari != '') {
    $sql .= " AND users.nama LIKE '%$cari%'";
}

if ($filter_status != '') {
    if ($filter_status == 'belum') {
        $sql .= " AND konfirmasi.status IS NULL";
    } else {
        $sql .= " AND konfirmasi.status = '$filter_status'";
    }
}

$sql .= " ORDER BY users.id DESC LIMIT $limit OFFSET $offset";
$query = mysqli_query($conn, $sql);
$no = $offset + 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Konfirmasi Kehadiran Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
</head>
<body style="background-color: #f4f4f4;">
<?php include("../asset/sidebar.php"); ?>

<div class="container mt-4 p-3">
    <h2 class="mb-3">Konfirmasi Kehadiran Tamu</h2>
    <div class="card shadow-sm p-4 bg-white">
        <div class="row mb-3">
            <div class="col-md-12">
                <form method="GET" class="d-flex flex-wrap gap-2">
                    <input type="text" name="cari" placeholder="Cari Nama Tamu..." class="form-control-sm me-2"
                           value="<?= htmlspecialchars($cari) ?>" />
                    <select name="filter_status" class="form-select form-select-sm me-2" style="width: auto;">
                        <option value="">Semua Status</option>
                        <option value="hadir" <?= $filter_status == 'hadir' ? 'selected' : '' ?>>Hadir</option>
                        <option value="tidak hadir" <?= $filter_status == 'tidak hadir' ? 'selected' : '' ?>>Tidak Hadir</option>
                        <option value="belum" <?= $filter_status == 'belum' ? 'selected' : '' ?>>Belum Konfirmasi</option>
                    </select>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-primary text-center">
                    <tr>
                        <th>No</th>
                        <th>Email</th>
                        <th>Nama Lengkap</th>
                        <th>Alamat</th>
                        <th>Kode Unik</th>
                        <th>Status Konfirmasi</th>
                        <th>Jumlah Hadir</th>
                        <th>Nomor Kursi</th>
                        <th>Undangan PDF</th>
                        <th>Ucapan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($query) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($query)):
                            $status = $row['status_konfirmasi'] ?? 'Belum Konfirmasi';
                            $status_lower = strtolower($status);
                            $badge_class = ($status_lower === 'hadir') ? 'success' :
                                           (($status_lower === 'tidak hadir') ? 'danger' : 'warning');
                            $pdf = $row['undangan_pdf'] ?: '-';
                            $ucapan = $row['ucapan'] ?: '-';
                            $pdf_link = ($pdf !== '-') ? "<a href='../public/undangan_pdf/$pdf' target='_blank'>Lihat</a>" : '-';
                            $nomor_kursi = $row['nomor_kursi'] ?: '';
                            $jumlah_kursi = ($nomor_kursi !== '') ? count(explode(',', $nomor_kursi)) : '-';
                            ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['alamat'] ?></td>
                                <td class="text-center"><?= $row['kode_unik'] ?></td>
                                <td class="text-center">
                                    <span class="badge bg-<?= $badge_class ?>">
                                        <?= ucfirst($status) ?>
                                    </span>
                                </td>
                                <td class="text-center"><?= $jumlah_kursi ?></td>
                                <td class="text-center"><?= $nomor_kursi ?></td>
                                <td class="text-center"><?= $pdf_link ?></td>
                                <td><?= $ucapan ?></td>
                                <td class="text-center">
                                    <a href="crud-tamu/hapus_konfirmasi.php?id=<?= $row['id'] ?>"
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Hapus data ini?')">
                                       <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="11" class="text-center">Data tidak ditemukan</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation" class="mt-4">
            <ul class="pagination justify-content-center">
                <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                    <a class="page-link"
                       href="?page=<?= $page - 1 ?>&cari=<?= urlencode($cari) ?>&filter_status=<?= urlencode($filter_status) ?>">Prev</a>
                </li>
                <li class="page-item active">
                    <span class="page-link"><?= $page ?></span>
                </li>
                <li class="page-item">
                    <a class="page-link"
                       href="?page=<?= $page + 1 ?>&cari=<?= urlencode($cari) ?>&filter_status=<?= urlencode($filter_status) ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</div>
</body>
</html>
