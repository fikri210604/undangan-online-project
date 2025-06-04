<?php
include("db.php");

// Kalau ada inputan dari form pencarian
if (isset($_GET["cari"]) && trim($_GET["cari"]) !== '') {
    $kata_kunci = $_GET["cari"];

    // Query untuk mencari nama tamu berdasarkan nama panjang tamu
    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE nama = ?");
    mysqli_stmt_bind_param($stmt, "s", $kata_kunci);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    echo '<p id="pesan-kosong" class="text-center text-gray-700 mt-6 font-semibold" style="display:none;">Masukkan Nama Anda.</p>';

    // Mengecek apakah ada hasil dari query
    if (mysqli_num_rows($result) > 0) {
        echo '<div class="space-y-6 mt-6" id="container-notifikasi">';
        while ($row = mysqli_fetch_assoc($result)) {
            $id = htmlspecialchars($row["id"]);
            $nama = htmlspecialchars($row["nama"]);
            echo '<div id="notifikasi-' . $id . '" class="p-4 bg-white rounded shadow-md max-w-md mx-auto cursor-pointer" onclick="hapusNotifikasi(\'notifikasi-' . $id . '\')">';
            echo '<h2 class="text-center font-semibold mb-6">' . $nama . ' - Anda Diundang Untuk Hadir</h2>';
            echo '<div class="text-center">';
            echo '<a href="login.php" class="bg-rose-600 text-[#ffcc00] w-[250px] py-2 px-4 rounded-full font-bold hover:bg-gray-200">RSVP</a>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        // Jika tidak ditemukan nama, langsung tampilkan pesan
        echo '<p class="text-center text-gray-700 mt-6">Nama Tidak Ditemukan</p>';
    }

    mysqli_stmt_close($stmt);
} else {
    // Jika nama belum diinputkan, menampilkan pesan untuk mengisi nama
    echo '<p id="pesan-kosong" class="text-center text-gray-700 mt-6 font-semibold">Masukkan Nama Anda.</p>';
}
?>

<!-- Menghapus notifikasi -->
<script>
    function hapusNotifikasi(id) {
        const notifikasi = document.getElementById(id);
        if (notifikasi) {
            notifikasi.remove();
        }

        const container = document.getElementById('container-notifikasi');
        const pesan = document.getElementById('pesan-kosong');
        if (!container || container.children.length === 0) {
            if (pesan) {
                pesan.style.display = 'block';
            }
        }
    }
</script>
