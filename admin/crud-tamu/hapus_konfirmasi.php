<?php
    include("../../includes/db.php");

    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM konfirmasi WHERE user_id = ?");
    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        header("Location: ../konfirmasi.php?delete=success");
        exit();
    } else {
        header("Location: ../konfirmasi.php?delete=failed");
        exit();
    }
?>
