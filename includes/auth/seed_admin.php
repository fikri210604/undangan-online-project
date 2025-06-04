<?php
include("../db.php");

$nama = "admin";
$email = "admin@example.com";
$password_plain = "admin123";
$role = "admin";

$password_hashed = password_hash($password_plain, PASSWORD_DEFAULT);
if (!$conn) {
    die("Koneksi ke database gagal.");
}
$cek = mysqli_query($conn, "SELECT * FROM users WHERE nama = '$nama'");

if (!$cek) {
    die("Query cek gagal: " . mysqli_error($conn));
}

if (mysqli_num_rows($cek) == 0) {
    $stmt = mysqli_prepare($conn, "INSERT INTO users (nama, email, password, role) VALUES (?, ?, ?, ?)");
    
    if (!$stmt) {
        die("Prepare gagal: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "ssss", $nama, $email, $password_hashed, $role);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "Admin default berhasil dibuat.";
    } else {
        echo "Gagal membuat admin: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Admin sudah ada.";
}

mysqli_close($conn);
?>
