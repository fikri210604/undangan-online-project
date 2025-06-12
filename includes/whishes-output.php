<?php
include("db.php");

// Ambil data nama dan ucapan
$query = "SELECT users.nama, konfirmasi.whishes AS ucapan 
          FROM konfirmasi 
          JOIN users ON konfirmasi.user_id = users.id 
          WHERE konfirmasi.whishes IS NOT NULL 
          AND konfirmasi.whishes != '' 
          ORDER BY konfirmasi.id DESC";


$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    foreach ($result as $row) {
        if (trim($row['ucapan']) === '') continue; // skip ucapan kosong
    
        echo '<div class="bg-white p-4 rounded-lg shadow-md">';
        echo '<h2 class="text-lg font-semibold text-[#74583E]">' . htmlspecialchars($row['nama']) . '</h2>';
        echo '<p class="text-gray-600 italic">"' . htmlspecialchars($row['ucapan']) . '"</p>';
        echo '</div>';
    }
    
} else {
    echo '<p class="text-gray-500 text-center">Belum ada ucapan yang ditampilkan.</p>';
}
?>