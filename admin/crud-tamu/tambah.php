<?php
include("../../includes/db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Tamu</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $kode_unik = 'TAMU-' . $nama . '-' . rand(1000, 9999);

    if (empty($email) || empty($nama)) {
        echo "
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Input Tidak Lengkap',
                text: 'Email dan Nama wajib diisi!',
                confirmButtonText: 'Kembali'
            }).then(() => {
                history.back();
            });
        </script>";
        exit;
    }

    // Cek apakah email sudah terdaftar
    $cek = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    if (mysqli_num_rows($cek) > 0) {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Email Duplikat',
                text: 'Email sudah digunakan. Silakan gunakan email lain.',
                confirmButtonText: 'Kembali'
            }).then(() => {
                history.back();
            });
        </script>";
        exit;
    }

    // Query Insert Untuk tambah tamu
    $query = "INSERT INTO users (email, nama, alamat, kode_unik, role) 
              VALUES ('$email', '$nama', '$alamat', '$kode_unik', 'tamu')";

    if (mysqli_query($conn, $query)) {
        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data tamu berhasil ditambahkan!',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = '../tamu.php';
            });
        </script>";
    } else {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal Menyimpan',
                text: 'Terjadi kesalahan: " . mysqli_error($conn) . "',
                confirmButtonText: 'Kembali'
            }).then(() => {
                history.back();
            });
        </script>";
    }
}
?>
</body>
</html>
