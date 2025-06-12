<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah Tamu</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<?php
include("../../includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];

    if (!empty($_POST["password"])) {
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET email = '$email', nama = '$nama', alamat='$alamat', password = '$password' WHERE id = '$id'";
    } else {
        $sql = "UPDATE users SET email = '$email', nama = '$nama', alamat='$alamat' WHERE id = '$id'";
    }

    if (mysqli_query($conn, $sql)) {
        echo '
                    <script>
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil!",
                            text: "User berhasil diupdate.",
                            confirmButtonText: "OK"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "../tamu.php";
                            }
                        });
                    </script>';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>