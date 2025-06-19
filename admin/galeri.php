<?php
include '../includes/db.php';
$galeri = mysqli_query($conn, "SELECT * FROM galeri ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Galeri Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .galeri-card {
            position: relative;
            overflow: hidden;
        }

        .hover-actions {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: 0.3s ease;
        }

        .galeri-card:hover .hover-actions {
            opacity: 1;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>

<body class="bg-light">
    <?php include '../asset/sidebar.php'; ?>

    <div class="container py-4">
        <div class="card shadow-sm mb-4 py-3 px-4 bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="fw-bold"><i class="bi bi-images me-2"></i>Galeri</h3>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Foto
                </button>
            </div>
        </div>

        <div class="card shadow-sm mb-4 p-3 bg-white">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                <?php while ($row = mysqli_fetch_assoc($galeri)): ?>
                    <div class="col">
                        <div class="card shadow-sm h-100 galeri-card">
                            <img src="../public/img/galeri/<?= $row['gambar'] ?>" class="card-img-top"
                                alt="<?= htmlspecialchars($row['judul']) ?>">

                            <div class="hover-actions">
                                <a href="#" class="btn btn-sm btn-warning me-2" data-bs-toggle="modal"
                                    data-bs-target="#modalEdit<?= $row['id'] ?>">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <a href="hapus_galeri.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus foto ini?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </a>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">
                                    <i class="bi bi-camera me-1"></i><?= htmlspecialchars($row['judul']) ?>
                                </h5>
                                <p class="card-text small text-muted"><?= htmlspecialchars($row['deskripsi']) ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="modalEdit<?= $row['id'] ?>" tabindex="-1">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <form action="galeri/edit_galeri.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            <i class="bi bi-pencil-square me-2"></i>Edit Foto
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Judul Foto</label>
                                            <input type="text" name="judul" class="form-control"
                                                value="<?= htmlspecialchars($row['judul']) ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Deskripsi</label>
                                            <textarea name="deskripsi" class="form-control"
                                                rows="2"><?= htmlspecialchars($row['deskripsi']) ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Ganti Gambar</label>
                                            <input type="file" name="gambar" class="form-control" accept="image/*">
                                            <input type="hidden" name="gambar_lama" value="<?= $row['gambar'] ?>">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">
                                            <i class="bi bi-x-circle"></i> Batal
                                        </button>
                                        <button type="submit" class="btn btn-success">
                                            <i class="bi bi-save"></i> Simpan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <!-- Modal Tambah -->
        <div class="modal fade" id="modalTambah" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <form action="galeri/tambah_galeri.php" method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="bi bi-image-fill me-2"></i>Tambah Foto Galeri</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Judul Foto</label>
                                <input type="text" name="judul" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="2"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Upload Gambar</label>
                                <input type="file" name="gambar" class="form-control" accept="image/*" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i>
                                Batal</button>
                            <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</body>

</html>