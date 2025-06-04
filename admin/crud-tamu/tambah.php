<?php
include("../../includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $role = 'tamu';

    $kode_unik = 'TAMU-' . strtoupper(substr($nama, 0, 3)) . '-' . rand(1000, 9999); 
    $sql = "INSERT INTO users (email, nama, alamat, password,  role, kode_unik) 
            VALUES ('$email', '$nama', '$alamat', '$password', '$role', '$kode_unik')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('User berhasil ditambahkan.'); window.location.href = '../tamu.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
