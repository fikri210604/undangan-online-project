<?php
    session_start();
    $_SESSION['pdf_path'] = $pdf_path;
    $_SESSION['qr_code_path'] = $qr_code_path;
    $_SESSION['success'] = true;
    header('Location: ../landing.php');
?>