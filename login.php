<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body>
    <?php include 'asset/navbar.php'; ?>

    <div class="flex flex-col md:flex-row items-center justify-center gap-6 min-h-screen px-4">
        <!-- Gambar Sebelah Kiri -->
        <div class="w-full md:w-1/2 flex justify-center">
            <img src="public/img/asset/background-nikah.svg" alt="Ilustrasi"
                class="w-80 md:w-full max-w-md object-contain">
        </div>

        <!-- Form Login -->
        <div class="w-full md:w-1/2 max-w-md">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Masuk</h1>
            <p class="text-gray-600 mb-4 text-sm">Silahkan masukkan nama lengkap dan password sesuai email yang telah
                dikirimkan</p>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <h1 class="font-bold">Error: <?= htmlspecialchars($_SESSION['error']) ?></h1>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <form action="includes/auth/login-system.php" method="POST" class="flex flex-col gap-4">
                <input type="text" name="nama" placeholder="Masukkan Nama Lengkap"
                    class="px-4 py-3 border border-rose-200 rounded-lg focus:outline-2 focus:ring-rose-300" required>
                <div class="relative">
                    <input type="password" id="password" name="password" placeholder="Masukkan Password"
                        class="w-full px-4 py-3 border border-rose-200 rounded-lg focus:outline-2 focus:ring-rose-300 pr-10"
                        required>
                    <span onclick="togglePassword('password', this)"
                        class="absolute right-3 top-3 cursor-pointer text-gray-500">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
                <button type="submit"
                    class="bg-rose-400 text-white rounded-full py-3 font-semibold hover:bg-rose-500 transition duration-300">
                    Masuk
                </button>
            </form>
        </div>
    </div>
    <script>
        function togglePassword(id, el) {
            const input = document.getElementById(id);
            const icon = el.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>