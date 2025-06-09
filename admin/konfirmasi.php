<?php
include("../includes/db.php");

$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

$cari = isset($_GET['cari']) ? $_GET['cari'] : '';

// Query data untuk menampilkan dalam tabel
$sql = "SELECT 
            users.id, users.email, users.nama, users.alamat, users.kode_unik,
            konfirmasi.status AS status_konfirmasi,
            konfirmasi.pdf_path AS undangan_pdf,
            konfirmasi.whishes AS ucapan
        FROM users
        LEFT JOIN konfirmasi ON users.id = konfirmasi.user_id
        WHERE users.role = 'tamu'";

if ($cari != '') {
    $sql .= " AND users.nama LIKE '%$cari%'";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>

<body style="background-color: #E1E1E1;">
    <?php include("../asset/sidebar.php"); ?>

    <div class="container mt-4 p-4">
        <h2>Konfirmasi Kehadiran Tamu</h2>
        <div class="bg-light p-4 rounded shadow-lg mt-3">
            <div class="row mb-3">
                <div class="col-md-6">
                    <form method="GET" class="d-flex">
                        <input type="text" name="cari" placeholder="Cari Nama Tamu..." class="form-control-sm  me-2"
                            value="<?= htmlspecialchars($cari) ?>" />
                        <button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-search"></i> Cari</button>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover  table-striped">
                    <thead>
                        <tr>
                            <th class="bg-primary">No</th>
                            <th class="bg-primary">Email</th>
                            <th class="bg-primary">Nama Lengkap</th>
                            <th class="bg-primary">Alamat</th>
                            <th class="bg-primary">Kode Unik</th>
                            <th class="bg-primary">Status Konfirmasi</th>
                            <th class="bg-primary">Undangan PDF</th>
                            <th class="bg-primary">Ucapan</th>
                            <th class="bg-primary">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($query) > 0) : ?>
                            <?php while ($row = mysqli_fetch_assoc($query)) :
                                $status = $row['status_konfirmasi'] ?: 'Belum Konfirmasi';
                                $pdf = $row['undangan_pdf'] ?: '-';
                                $ucapan = $row['ucapan'] ?: '-';
                                $pdf_link = ($pdf !== '-') ? "<a href='../public/uploads/$pdf' target='_blank'>Lihat</a>" : '-';
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $row['email'] ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['alamat'] ?></td>
                                    <td><?= $row['kode_unik'] ?></td>
                                    <td><?= $status ?></td>
                                    <td><?= $pdf_link ?></td>
                                    <td><?= $ucapan ?></td>
                                    <td>
                                        <a href="crud-tamu/hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm fas fa-trash"
                                            onclick="return confirm('Hapus data ini?')"></a>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            endwhile; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="9" class="text-center">Data tidak ditemukan</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <!-- Pagination sederhana -->
                <nav aria-label="Page navigation" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page - 1 ?>&cari=<?= urlencode($cari) ?>">Prev</a>
                        </li>
                        <li class="page-item">
                            <span class="page-link"><?= $page ?></span>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $page + 1 ?>&cari=<?= urlencode($cari) ?>">Next</a>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>
</body>

</html>
