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

    <div class="flex flex-col md:flex-row items-center justify-center gap-10 min-h-screen px-4 py-10">
        <!-- Gambar Sebelah Kiri-->
        <div class="w-full md:w-1/2 flex justify-center">
            <img src="public/img/asset/background-nikah.svg" alt="Ilustrasi"
                class="w-80 md:w-full max-w-md object-contain">
        </div>
        <!-- Form Login -->
        <div class="w-full md:w-1/2 max-w-md">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Masuk</h1>
            <p class="text-gray-600 mb-6 text-sm">Silahkan masukkan nama lengkap dan password sesuai email yang telah dikirimkan</p>
            <form action="includes\auth\login-system.php" method="POST" class="flex flex-col gap-4">
                <input type="text" name="nama" placeholder="Masukkan Nama Lengkap"
                    class="px-4 py-3 border border-rose-200 rounded-lg focus:outline-2 focus:ring-rose-300">
                <input type="password" name="password" placeholder="Password"
                    class="px-4 py-3 border border-rose-200 rounded-lg focus:outline-2 focus:ring-rose-300">
                <button type="submit"
                    class="bg-rose-400 text-white rounded-full py-3 font-semibold hover:bg-rose-500 transition duration-300">Masuk</button>

            </form>
        </div>

    </div>

</body>

</html>