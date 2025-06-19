<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Tamu</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php
include("../../includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id     = $_POST['id'];
    $email  = $_POST['email'];
    $nama   = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $redirect = base_url("admin/tamu.php");

    if (!empty($_POST["password"])) {
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET email = ?, nama = ?, alamat = ?, password = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $email, $nama, $alamat, $password, $id);
    } else {
        $stmt = $conn->prepare("UPDATE users SET email = ?, nama = ?, alamat = ? WHERE id = ?");
        $stmt->bind_param("sssi", $email, $nama, $alamat, $id);
    }

    if ($stmt->execute()) {
        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data tamu berhasil diperbarui.',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = '$redirect';
            });
        </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
</body>
</html>
