<?php
    $host = "localhost";
    $user = "Admin";
    $pass = "";
    $db = "proyek_akhir_web";
    $conn = mysqli_connect($host, $user, $pass, $db);
    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }
?>