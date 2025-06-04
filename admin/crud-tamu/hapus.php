<?php
    include("../../includes/db.php");
    $id = $_GET['id'];
    $sql = "DELETE FROM users WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('User berhasil dihapus.'); window.location.href = '../tamu.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
?>