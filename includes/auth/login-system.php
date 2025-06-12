<?php
include("../db.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["nama"]) && !empty($_POST["password"])) {
        $username = $_POST["nama"];
        $password = $_POST["password"];

        $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE nama = ?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($user = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $user["password"])) {
                $_SESSION['login'] = true;
                $_SESSION['user_id'] = $user['id']; 
                $_SESSION['role'] = strtolower($user['role']);

                // Redirect berdasarkan role
                if ($_SESSION['role'] === 'admin') {
                    header("Location: ../../admin/dashboard.php");
                } elseif ($_SESSION['role'] === 'tamu') {
                    header("Location: ../../landing.php");
                } else {
                    header("Location: ../index.php");
                }
                exit;
            } else {
                $_SESSION["error"] = 'Password salah!';
                header("Location: ../../login.php");
            }
        } else {
            $_SESSION["error"] = "Username tidak ditemukan.";
            header("Location: ../../login.php");
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    } else {
        $_SESSION["error"] = "Username dan password harus diisi.";
        header("Location: ../../login.php");
    }
}
?>
