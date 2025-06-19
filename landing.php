<?php
session_start();
var_dump($_SESSION); // DEBUG
include 'asset/navbar.php';
include_once 'includes/db.php';

$nama = '';
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = $conn->query("SELECT nama FROM users WHERE id = $user_id");
    if ($query && $row = $query->fetch_assoc()) {
        $nama = $row['nama'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alvin & Rahayu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Clicker+Script&family=Great+Vibes&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

</head>

<body class="bg-[#FFF7EE]">

    <!-- Hero Section -->
    <section class="relative w-full h-screen font-[Poppins]">
        <img src="public/img/asset/background.jpeg" alt="Gambar Lapangan"
            class="absolute inset-0 w-full h-full object-cover" />
        <div class="absolute inset-0 bg-[#E5BDA7]/30 z-10"></div>
        <div class="relative z-20 flex flex-col items-center justify-center h-full px-6 text-white text-center gap-4">
            <h1 class="text-3xl md:text-4xl font-semibold drop-shadow-md mb-6">Save The Date</h1>

            <h2 class="text-5xl md:text-7xl drop-shadow-md mb-4 text-[#74583E]"
                style="font-family: 'Great Vibes', cursive;">
                Alvin & Rahayu
            </h2>

            <h2 class="text-lg md:text-md max-w-3xl leading-snug drop-shadow-md font-bold">
                21 Juni 2025, Gedung Bagas Raya, Bandar Lampung
            </h2>

            <h3 class="text-sm md:text-md max-w-3xl leading-snug drop-shadow-md">
                "Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu istri-istri dari jenismu sendiri,
                supaya kamu cenderung dan merasa tenteram kepadanya, dan dijadikan-Nya di antaramu rasa kasih dan
                sayang. Sesungguhnya pada yang demikian itu benar-benar terdapat tanda-tanda bagi kaum yang berfikir."
                (Ar-Rum : 21)
            </h3>
            <h2 class="text-lg md:text-md max-w-3xl leading-snug drop-shadow-md font-bold">
                <?= htmlspecialchars($nama) ?> kamu diundang
            </h2>

            <a href="#konfirmasi"
                class="mt-4 bg-[#ffe4d5] text-[#74583E] w-[250px] px-6 py-3 rounded-full font-bold hover:bg-gray-200 hover:text-black transition outline outline-1 outline-[#74583E]"
                id="rsvp">
                RSVP
            </a>
        </div>
    </section>

    <!-- Surat Undangan -->
    <section id="undangan" class="py-16 px-8 mx-auto scroll-mt-20">
        <div class="justify-center items-center flex flex-col">
            <h1 class="text-4xl font-bold text-[#74583E] mb-2 text-center" style="font-family: 'Great Vibes', cursive;">
                Assalamu'alaikum</h1>
            <h2 class="text-lg text-black mb-8 text-center font-light">Bismillahirrahmanirrahim</h2>
            <h3 class="text-sm max-w-3xl text-center drop-shadow-md text-[#74583E] mb-4">
                "Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu istri-istri dari jenismu sendiri,
                supaya kamu cenderung dan merasa tenteram kepadanya, dan dijadikan-Nya di antaramu rasa kasih dan
                sayang. Sesungguhnya pada yang demikian itu benar-benar terdapat tanda-tanda bagi kaum yang berfikir."
                (Ar-Rum : 21)
            </h3>

            <!-- Pengantin -->
            <div class="flex flex-col md:flex-row items-stretch justify-center gap-16 mt-10">
                <!-- Pengantin Pria -->
                <div class="flex-1 flex flex-col items-center gap-4">
                    <div class="relative w-60 h-60 p-8">
                        <img src="public/img/asset/alvin.jpeg" alt="Pengantin Pria"
                            class="w-full h-full object-cover rounded-full z-10 relative" />
                        <img src="public/img/asset/frame-pengantin.png" alt="Frame Pengantin"
                            class="absolute inset-0 w-full h-full object-contain z-40 pointer-events-none scale-110" />
                    </div>
                    <h2 class="text-xl font-bold text-center" style="font-family: 'Great Vibes', cursive;">Muhammad
                        Alvin</h2>
                    <p class="text-center text-gray-600">Putra dari Bapak Ahmad & Ibu Fatimah</p>
                </div>

                <!-- Pengantin Wanita -->
                <div class="flex-1 flex flex-col items-center gap-4">
                    <div class="relative w-60 h-60 p-8">
                        <img src="public/img/asset/rahayu.jpeg" alt="Pengantin Wanita"
                            class="w-full h-full object-cover rounded-full z-10 relative" />
                        <img src="public/img/asset/frame-pengantin.png" alt="Frame Pengantin"
                            class="absolute inset-0 w-full h-full object-contain z-40 pointer-events-none scale-110" />
                    </div>
                    <h2 class="text-xl font-bold text-center" style="font-family: 'Great Vibes', cursive;">Rahayu Indah
                        Lestari</h2>
                    <p class="text-center text-gray-600">Putri dari Bapak Joko & Ibu Megawati</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Jadwal Acara -->
    <section id="acara" class="py-20 px-8 scroll-mt-10 bg-[#EDEDED]">
        <h1 class="text-4xl font-bold text-[#74583E] mb-6 text-center" style="font-family: 'monserrat', light;">
            <i class="fas fa-clock mr-2"></i>
            Acara Pernikahan
            <i class="fas fa-clock ml-2"></i>
        </h1>
        <p class="text-sm text-black mb-12 text-center font-medium">
            Dengan memohon rahmat dan ridho Allah SWT, kami mengundang Bapak/Ibu/Saudara/i untuk hadir pada acara
            pernikahan kami.
        </p>
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-center gap-8 mb-12">
            <!-- Akad Nikah -->
            <div class="w-[300px] bg-white p-6 rounded-xl outline outline-1 outline-[#74583E] flex flex-col gap-4">
                <h2 class="text-2xl font-bold text-[#74583E] text-center" style="font-family: 'great vibes', cursive;">
                    Akad Nikah
                </h2>
                <div class="flex items-center gap-3">
                    <i class="fas fa-calendar-days text-[#74583E] w-6 text-lg"></i>
                    <p class="text-base text-gray-800">Sabtu, 21 Juni 2025</p>
                </div>
                <div class="flex items-center gap-3">
                    <i class="fas fa-clock text-[#74583E] w-6 text-lg"></i>
                    <p class="text-base text-gray-800">Pukul: 09.00 WIB - Selesai</p>
                </div>
                <div class="flex items-center gap-3">
                    <i class="fas fa-map-marker-alt text-[#74583E] w-6 text-lg"></i>
                    <p class="text-base text-gray-800">Gedung Bagas Raya</p>
                </div>
            </div>

            <!-- Resepsi Nikah -->
            <div class="w-[300px] bg-white p-6 rounded-xl outline outline-1 outline-[#74583E] flex flex-col gap-4">
                <h2 class="text-2xl font-bold text-[#74583E] text-center" style="font-family: 'Great Vibes', cursive;">
                    Resepsi Nikah
                </h2>
                <div class="flex items-center gap-3">
                    <i class="fas fa-calendar-days text-[#74583E] w-6 text-lg"></i>
                    <p class="text-base text-gray-800">Sabtu, 21 Juni 2025</p>
                </div>
                <div class="flex items-center gap-3">
                    <i class="fas fa-clock text-[#74583E] w-6 text-lg"></i>
                    <p class="text-base text-gray-800">Pukul: 11.00 WIB - Selesai</p>
                </div>
                <div class="flex items-center gap-3">
                    <i class="fas fa-map-marker-alt text-[#74583E] w-6 text-lg"></i>
                    <p class="text-base text-gray-800">Gedung Bagas Raya</p>
                </div>
            </div>
        </div>

        <!-- Lokasi Google Maps -->
        <h1 class="text-4xl font-bold text-[#74583E] mb-6 text-center mt-10" style="font-family: 'monserrat', light;">
            <i class="fas fa-map-marker-alt mr-2"></i>
            Lokasi Acara
            <i class="fas fa-map-marker-alt ml-2"></i>
        </h1>
        <div class="container mx-auto flex justify-center">
            <div class="w-full max-w-3xl px-4">
                <iframe class="w-full h-96 rounded-lg border border-gray-300 drop-shadow-lg"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.262040523779!2d105.27836497452033!3d-5.3769586537787815!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40db3082221e8f%3A0x3703f97c93d48f7!2sGedung%20Bagas%20Raya!5e0!3m2!1sid!2sid!4v1748916252996!5m2!1sid!2sid"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <!-- Konfirmasi Kehadiran Tamu -->
    <section id="konfirmasi" class="py-16 px-4 md:px-32 scroll-mt-20">
        <div class="flex flex-col md:flex-row gap-12 justify-center items-center">
            <!-- Teks RSVP -->
            <div class="flex-1">
                <h2 class="text-3xl md:text-4xl font-bold font-poppins mb-4 text-black">
                    Konfirmasi Kehadiran
                </h2>
                <p class="text-base text-gray-700 font-poppins mb-6">
                    Silahkan berikan konfirmasi kehadiran, apakah akan hadir atau tidak.
                </p>

                <!-- Slideshow Foto -->
                <?php
                $folder = 'public/img/galeri';
                $files = glob($folder . '/*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE);
                ?>
                <div
                    class="relative w-72 h-72 rounded-xl overflow-hidden shadow-lg border-2 border-[#74583F] transform -translate-x-3">
                    <img id="slideshow" src="<?= !empty($files) ? $files[0] : 'public/img/default.jpg' ?>"
                        alt="Foto Galeri" class="w-full h-full object-cover transition duration-500 ease-in-out">
                </div>
            </div>
            <div class="flex-1 w-full max-w-xl">
                <form action="includes/konfirmasi-user.php" method="POST" class="flex flex-col gap-6">
                    <div>
                        <label for="whishes"
                            class="block text-sm font-medium text-gray-800 mb-1 font-poppins">Wishes</label>
                        <input type="text" id="whishes" name="whishes" placeholder="Berikan Ucapan Untuk Mempelai"
                            class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-black/30 font-poppins"
                            required />
                    </div>
                    <!-- Jumlah Tamu -->
                    <div>
                        <label for="jumlahUndangan" class="block text-sm font-medium text-gray-800 mb-1 font-poppins">
                            Berapa orang yang akan hadir?
                        </label>
                        <select id="jumlahUndangan" name="jumlahUndangan"
                            class="w-full px-4 py-2 rounded-md border border-gray-300 bg-white text-black focus:outline-none focus:ring-2 focus:ring-black/30 font-poppins"
                            required>
                            <option value="" disabled selected>Pilih Jumlah Kehadiran (Maksimal 5)</option>
                            <option value="1">1 orang</option>
                            <option value="2">2 orang</option>
                            <option value="3">3 orang</option>
                            <option value="4">4 orang</option>
                            <option value="5">5 orang</option>
                        </select>

                    </div>
                    <!-- Kehadiran -->
                    <div>
                        <label class="block text-sm font-medium text-gray-800 mb-1 font-poppins">
                            Apakah kamu akan hadir?
                        </label>
                        <div class="flex flex-col sm:flex-row gap-4 mt-1">
                            <label for="hadir" class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="kehadiran" id="hadir" value="hadir" required
                                    class="accent-[#74583F] w-5 h-5">
                                <span class="text-sm font-medium text-gray-700">Hadir</span>
                            </label>
                            <label for="tidak_hadir" class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="kehadiran" id="tidak_hadir" value="tidak" required
                                    class="accent-[#74583F] w-5 h-5">
                                <span class="text-sm font-medium text-gray-700">Tidak Hadir</span>
                            </label>
                        </div>
                    </div>

                    <!-- Tombol Submit -->
                    <div>
                        <button type="submit"
                            class="mt-6 w-full bg-[#74583E] text-white px-6 py-3 rounded-md font-bold hover:bg-[#5f4830] transition">
                            Kirim Konfirmasi
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </section>

    <!-- Cerita Kami -->
    <section id="cerita" class="py-16 px-8 mx-auto scroll-mt-20 bg-[#EDEDED]">
        <h1 class="text-4xl font-bold text-[#74583E] mb-6 text-center" style="font-family: 'Great Vibes', cursive;">
            Cerita Kami
        </h1>
        <p class="text-sm text-black text-center font-medium mb-10">
            Kami ingin berbagi sedikit cerita tentang perjalanan cinta kami.
        </p>

        <div class="container mx-auto px-6 max-w-5xl">
            <div class="relative">
                <!-- Garis Tengah -->
                <div class="absolute left-1/2 transform -translate-x-1/2 w-1 h-full bg-gray-300"></div>

                <!-- Cerita 1 - SD -->
                <div class="flex justify-between items-center mb-12">
                    <div class="w-5/12">
                        <div class="bg-white rounded-lg p-6 outline outline-1 outline-[#74583E] ">
                            <h3 class="text-sm font-bold text-gray-800" style="font-family: 'monserrat', light;">SDN
                                Harapan Jaya</h3>
                            <p class="mt-2 text-gray-500 text-sm">Segalanya bermula di bangku SD. Saat itu, aku masih
                                belum mengenal arti cinta. Tapi, ada satu teman bernama Naya yang selalu duduk di bangku
                                depan. Tawanya, entah kenapa, selalu membuat hari-hariku cerah.</p>
                        </div>
                    </div>
                    <div class="z-10">
                        <img src="public/img/asset/foto3.jpg" alt="Foto SD"
                            class="w-32 h-32 rounded-full border-4 border-white object-cover shadow-md">
                    </div>
                    <div class="w-5/12"></div>
                </div>

                <!-- Cerita 2 - SMP -->
                <div class="flex justify-between items-center mb-12">
                    <div class="w-5/12"></div>
                    <div class="z-10">
                        <img src="public/img/asset/foto2.jpg" alt="Foto SMP"
                            class="w-32 h-32 rounded-full border-4 border-white object-cover shadow-md">
                    </div>
                    <div class="w-5/12">
                        <div class="bg-white rounded-lg outline outline-1 outline-[#74583E] p-6">
                            <h3 class="text-sm font-bold text-gray-800" style="font-family: 'monserrat', light;">SMP
                                Cendekia Bangsa</h3>
                            <p class="mt-2 text-gray-500">Kami bertemu lagi di SMP, tanpa sengaja duduk sebangku di
                                kelas 7. Dari situ kami mulai sering belajar bersama. Aku mulai sadar, ada perasaan
                                berbeda saat melihat dia tertawa karena lelucon recehku.</p>
                        </div>
                    </div>
                </div>

                <!-- Cerita 3 - SMA -->
                <div class="flex justify-between items-center mb-12">
                    <div class="w-5/12">
                        <div class="bg-white rounded-lg outline outline-1 outline-[#74583E] p-6">
                            <h3 class="text-sm font-bold text-gray-800" style="font-family: 'monserrat', light;">SMA
                                Negeri 5 Harmoni</h3>
                            <p class="mt-2 text-gray-500">SMA jadi masa yang paling berkesan. Kami aktif di organisasi
                                yang sama dan mulai sering pulang bareng. Aku memberanikan diri menyatakan perasaan saat
                                acara perpisahan kelas 12... dan dia tersenyum sambil mengangguk.</p>
                        </div>
                    </div>
                    <div class="z-10">
                        <img src="public/img/asset/foto2.jpg" alt="Foto SMA"
                            class="w-32 h-32 rounded-full border-4 border-white object-cover shadow-md">
                    </div>
                    <div class="w-5/12"></div>
                </div>

                <!-- Cerita 4 - Kuliah -->
                <div class="flex justify-between items-center mb-12">
                    <div class="w-5/12"></div>
                    <div class="z-10">
                        <img src="public/img/asset/background1.jpeg" alt="Foto Kuliah"
                            class="w-32 h-32 rounded-full border-4 border-white object-cover shadow-md">
                    </div>
                    <div class="w-5/12">
                        <div class="bg-white rounded-lg outline outline-1 outline-[#74583E] p-6">
                            <h3 class="text-sm font-bold text-gray-800" style="font-family: 'monserrat', light;">
                                Universitas Cinta Sejati</h3>
                            <p class="mt-2 text-gray-500">Walau kami kuliah di kota berbeda, kami tetap menjaga
                                komunikasi. Liburan semester jadi momen paling ditunggu. Setelah lulus, kami memutuskan
                                untuk melangkah ke jenjang yang lebih serius — bersama.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Galeri Foto -->
    <section id="galeri" class="py-16 bg-[#EDEDED]">
        <h1 class="text-4xl font-bold text-[#74583E] mb-6 text-center" style="font-family: 'Great Vibes', cursive;">
            Galeri Foto
        </h1>
        <p class="text-sm text-black text-center font-medium mb-10">
            Berikut adalah beberapa momen indah yang telah kami abadikan.
        </p>

        <!-- Wrapper dengan padding & lebar maksimal -->
        <div class="px-4 md:px-10 max-w-screen-xl mx-auto overflow-hidden w-full">
            <div class="galeri-track flex gap-3 animate-scroll-loop">
                <?php
                $folder = 'public/img/galeri';
                $files = glob($folder . '/*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE);
                for ($i = 0; $i < 3; $i++) {
                    foreach ($files as $file) {
                        $basename = basename($file);
                        echo '<div class="w-1/4 flex-shrink-0">';
                        echo '<img src="' . $folder . '/' . $basename . '" class="w-full h-48 object-cover rounded-md shadow-md" alt="Galeri">';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
        <!-- CSS untuk animasi scroll -->
        <style>
            .animate-scroll-loop {
                animation: scroll-left 60s linear infinite;
                width: max-content;
                display: flex;
            }

            @keyframes scroll-left {
                0% {
                    transform: translateX(0%);
                }

                100% {
                    transform: translateX(-33.333%);
                }
            }
        </style>
    </section>


    <!-- Tampilan Whishes -->
    <section id="whishes" class="py-16 px-8 mx-auto scroll-mt-20">
        <h1 class="text-4xl font-bold text-[#74583E] mb-6 text-center" style="font-family: 'Great Vibes', cursive;">
            Ucapan & Doa Dari Sahabat
        </h1>

        <div class="w-full py-4 px-4 m-6 outline outline-1 outline-[#74583E]">
            <h2 class="text-sm text-gray-700 text-center font-medium mb-4">
                Kami sangat menghargai setiap ucapan dan doa dari sahabat-sahabat kami.
                Berikut adalah beberapa ucapan yang telah kami terima:
            </h2>
            <div class="space-y-4">
                <?php include('includes/whishes-output.php'); ?>
            </div>
        </div>
    </section>


    <script>
        // Fungsi untuk memencet radio button
        document.addEventListener('DOMContentLoaded', function () {
            const yesRadio = document.getElementById('yes');
            const noRadio = document.getElementById('no');
            const labelYes = document.getElementById('label-yes');
            const labelNo = document.getElementById('label-no');

            function updateSelection() {
                if (yesRadio.checked) {
                    labelYes.classList.add('bg-black', 'text-white');
                    labelYes.classList.remove('bg-gray-100', 'text-black');

                    labelNo.classList.remove('bg-black', 'text-white');
                    labelNo.classList.add('bg-gray-100', 'text-black');
                } else if (noRadio.checked) {
                    labelNo.classList.add('bg-black', 'text-white');
                    labelNo.classList.remove('bg-gray-100', 'text-black');

                    labelYes.classList.remove('bg-black', 'text-white');
                    labelYes.classList.add('bg-gray-100', 'text-black');
                }
            }

            yesRadio.addEventListener('change', updateSelection);
            noRadio.addEventListener('change', updateSelection);
        });
        // Slideshow untuk gambar-gambar
        document.addEventListener("DOMContentLoaded", function () {
            const images = <?php echo json_encode($files); ?>;
            let currentIndex = 0;
            const slideshow = document.getElementById('slideshow');

            if (slideshow && images.length > 0) {
                setInterval(() => {
                    slideshow.classList.remove('opacity-100');
                    slideshow.classList.add('opacity-0');

                    setTimeout(() => {
                        currentIndex = (currentIndex + 1) % images.length;
                        slideshow.src = images[currentIndex];

                        slideshow.classList.remove('opacity-0');
                        slideshow.classList.add('opacity-100');
                    }, 300);
                }, 3000);
            }
        });
    </script>

    <!-- Alert Ketika sudah submit-->
    <?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: '<?= $_GET['message'] ?>',
                showCancelButton: <?= isset($_GET['pdf_file']) ? 'true' : 'false' ?>,
                confirmButtonText: 'Download PDF',
                cancelButtonText: 'Tutup'
            }).then((result) => {
                if (result.isConfirmed && <?= isset($_GET['pdf_file']) ? 'true' : 'false' ?>) {
                    window.open('<?= $_GET['pdf_file'] ?>', '_blank');
                }
            });
        </script>
    <?php elseif (isset($_GET['status']) && $_GET['status'] === 'error'): ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '<?= $_GET['message'] ?>'
            });
        </script>
    <?php endif; ?>

</body>

</html>