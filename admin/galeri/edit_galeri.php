<?php
ob_start();
session_start();
include '../../includes/db.php'; // base_url sudah dideklarasikan di sini

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST['id'])) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'error',
                title: 'ID tidak ditemukan!',
                text: 'Permintaan tidak valid.'
            }).then(() => window.history.back());
        });
        </script>";
        exit;
    }

    $id = intval($_POST['id']);
    $query = mysqli_query($conn, "SELECT * FROM galeri WHERE id = $id");

    if (mysqli_num_rows($query) === 0) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'error',
                title: 'Data tidak ditemukan!',
                text: 'Galeri dengan ID tersebut tidak ada.'
            }).then(() => window.history.back());
        });
        </script>";
        exit;
    }

    $data = mysqli_fetch_assoc($query);

    $judul = mysqli_real_escape_string($conn, trim($_POST['judul']));
    $deskripsi = mysqli_real_escape_string($conn, trim($_POST['deskripsi']));
    $gambarBaru = $data['gambar'];
    $uploadDir = '../../public/img/galeri/';

    // Jika ada gambar baru
    if (isset($_FILES['gambar']) && $_FILES['gambar']['name'] != '') {
        $gambar = $_FILES['gambar'];
        $ext = strtolower(pathinfo($gambar['name'], PATHINFO_EXTENSION));
        $allowed_ext = ['jpg', 'jpeg', 'png', 'webp'];

        if (!in_array($ext, $allowed_ext)) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Format gambar tidak valid!',
                    text: 'Hanya jpg, jpeg, png, atau webp yang diizinkan.'
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
                    text: 'Maksimal ukuran gambar adalah 2MB.'
                }).then(() => window.history.back());
            });
            </script>";
            exit;
        }

        $namaBaru = 'galeri_' . time() . '.' . $ext;
        $targetPath = $uploadDir . $namaBaru;

        if (move_uploaded_file($gambar['tmp_name'], $targetPath)) {
            $gambarLama = $uploadDir . $data['gambar'];
            if (file_exists($gambarLama)) {
                unlink($gambarLama);
            }
            $gambarBaru = $namaBaru;
        } else {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal upload!',
                    text: 'Gambar tidak berhasil disimpan.'
                }).then(() => window.history.back());
            });
            </script>";
            exit;
        }
    }

    $stmt = $conn->prepare("UPDATE galeri SET judul = ?, deskripsi = ?, gambar = ? WHERE id = ?");
    $stmt->bind_param("sssi", $judul, $deskripsi, $gambarBaru, $id);

    if ($stmt->execute()) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data galeri berhasil diperbarui.',
                timer: 2000,
                showConfirmButton: false
            });

            setTimeout(() => {
                window.location.href = '" . base_url('admin/galeri.php') . "';
            }, 2100);
        });
        </script>";
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Terjadi kesalahan saat menyimpan perubahan.'
            }).then(() => window.history.back());
        });
        </script>";
    }
}
?>
