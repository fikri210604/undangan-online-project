<?php
include("../../includes/db.php");
include("../../includes/email-config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kirim Ulang Email</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<?php
if (!isset($_GET['id'])) {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'ID Tidak Ditemukan',
            text: 'ID user tidak tersedia.',
        }).then(() => {
            window.close();
        });
    </script>";
    exit;
}

$id = intval($_GET['id']);

$query = mysqli_query($conn, "SELECT * FROM users WHERE id = $id AND role = 'tamu'");
if (mysqli_num_rows($query) === 0) {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'User Tidak Ditemukan',
            text: 'Data user tidak valid atau bukan tamu.',
        }).then(() => {
            window.close();
        });
    </script>";
    exit;
}

$user = mysqli_fetch_assoc($query);

$email = $user['email'];
$nama = $user['nama'];
$password_plain = "****";
$kode_unik = $user['kode_unik'];

$result = sendEmail($email, $nama,  $password_plain, $kode_unik);

if ($result === true) {
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Email Terkirim',
            text: 'Email berhasil dikirim ke $email',
        }).then(() => {
            window.close();
        });
    </script>";
} else {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal Mengirim Email',
            text: 'Terjadi kesalahan: $result',
        }).then(() => {
            window.close();
        });
    </script>";
}
?>

</body>
</html>
