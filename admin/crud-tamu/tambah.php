<?php
include("../../includes/db.php");
include("../../includes/email-config.php");
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
    $email = trim($_POST["email"]);
    $nama = trim($_POST["nama"]);
    $alamat = trim($_POST["alamat"]);
    $password_plain = trim($_POST["password"]);
    $password_hash = password_hash($password_plain, PASSWORD_DEFAULT);

    if (empty($email) || empty($nama) || empty($password_plain)) {
        echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Input Tidak Lengkap',
                text: 'Email, Nama, dan Password wajib diisi!',
                confirmButtonText: 'Kembali'
            }).then(() => { history.back(); });
        </script>";
        exit;
    }

    // Cek duplikasi email atau nama
    $cek = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' OR nama = '$nama'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Email atau Nama Duplikat',
                text: 'Gunakan data lain yang belum terdaftar.',
                confirmButtonText: 'Kembali'
            }).then(() => { history.back(); });
        </script>";
        exit;
    }

    // Generate kode unik yang belum ada
    do {
        $kode_unik = 'TAMU-' . strtoupper(substr(md5($nama . rand()), 0, 6));
        $cekKode = mysqli_query($conn, "SELECT * FROM users WHERE kode_unik = '$kode_unik'");
    } while (mysqli_num_rows($cekKode) > 0);

    // Simpan ke database
    $query = "INSERT INTO users (email, nama, alamat, kode_unik, password, role)
              VALUES ('$email', '$nama', '$alamat', '$kode_unik', '$password_hash', 'tamu')";

    if (mysqli_query($conn, $query)) {
        // Kirim email
        $result = sendEmail($email, $nama, $password_plain, $kode_unik);
        $redirect = base_url("admin/tamu.php");

        if ($result === true) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Tamu berhasil ditambahkan dan email telah dikirim.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = '$redirect';
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Data Tersimpan, Tapi Email Gagal',
                    text: 'Error: " . addslashes($result) . "',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = '$redirect';
                });
            </script>";
        }
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal Menyimpan',
                text: 'Terjadi kesalahan: " . addslashes(mysqli_error($conn)) . "',
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
