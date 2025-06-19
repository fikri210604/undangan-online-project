<?php
include '../../includes/db.php'; // base_url() sudah dari sini

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = trim($_POST['judul']);
    $deskripsi = trim($_POST['deskripsi']);
    $gambar = $_FILES['gambar'];

    if (empty($judul) || empty($gambar['name'])) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Judul dan gambar wajib diisi!',
            }).then(() => window.history.back());
        });
        </script>";
        exit;
    }

    $allowed_ext = ['jpg', 'jpeg', 'png', 'webp'];
    $ext = strtolower(pathinfo($gambar['name'], PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed_ext)) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'error',
                title: 'Format tidak didukung!',
                text: 'Gunakan file jpg, jpeg, png, atau webp.',
            }).then(() => window.history.back());
        });
        </script>";
        exit;
    }

    if ($gambar['size'] > 2 * 1024 * 1024) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'warning',
                title: 'Ukuran terlalu besar!',
                text: 'Maksimal ukuran gambar 2MB.',
            }).then(() => window.history.back());
        });
        </script>";
        exit;
    }

    $namaFileBaru = 'galeri_' . time() . '.' . $ext;
    $uploadDir = '../../public/img/galeri/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (move_uploaded_file($gambar['tmp_name'], $uploadDir . $namaFileBaru)) {
        $stmt = $conn->prepare("INSERT INTO galeri (judul, deskripsi, gambar) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $judul, $deskripsi, $namaFileBaru);

        if ($stmt->execute()) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data galeri berhasil ditambahkan.',
                    timer: 2000,
                    showConfirmButton: false
                });

                setTimeout(() => {
                    window.location.href = '" . base_url('admin/galeri.php') . "?success=1';
                }, 2100);
            });
            </script>";
        } else {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal menyimpan!',
                    text: 'Coba lagi beberapa saat.',
                }).then(() => window.history.back());
            });
            </script>";
        }
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'error',
                title: 'Upload gagal!',
                text: 'Gagal menyimpan gambar ke server.',
            }).then(() => window.history.back());
        });
        </script>";
    }
}
?>
