<?php
    include("../../includes/db.php");
    $id = $_GET['id'];
    $sql = "DELETE FROM galeri WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Foto berhasil dihapus.'); window.location.href = '../galeri.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
?>