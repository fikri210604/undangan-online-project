<?php
$env = parse_ini_file(__DIR__ . '/../.env');
$host = $env['DB_HOST'];
$user = $env['DB_USER'];
$pass = $env['DB_PASS'];
$db = $env['DB_NAME'];
$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Function Base URL
if (!function_exists('base_url')) {
    function base_url($path = '') {
        return 'http://localhost/proyek-akhir-web/' . $path;
    }
}

?>