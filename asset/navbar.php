<nav id="navbar" class="fixed w-full z-50 bg-[#FFF7EE] shadow-md">
    <div class="max-w-screen-xl mx-auto flex flex-wrap items-center justify-between p-6">
        <!-- Logo & Link -->
        <?php if (isset($_SESSION['login']) && $_SESSION['login'] === true): ?>
            <a href="landing.php" class="flex items-center">
        <?php else: ?>
            <a href="index.php" class="flex items-center">
        <?php endif; ?>
                <img src="public/img/asset/logo.png" class="h-10 mr-3" alt="Logo" />
                <span class="text-xl font-semibold text-[#74583A]">Alvin & Rahayu</span>
            </a>

        <!-- Hamburger Toggle Mobile -->
        <button data-collapse-toggle="mobile-menu" type="button"
            class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-[#74583E] focus:outline-none focus:ring-2 focus:ring-gray-200"
            aria-controls="mobile-menu" aria-expanded="false">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Menu Links -->
        <ul id="mobile-menu"
            class="hidden w-full md:flex md:w-auto flex-col md:flex-row items-center gap-4 mt-4 md:mt-0 font-medium">
            <?php if (isset($_SESSION['login']) && $_SESSION['login']): ?>
                <li><a href="#undangan" class="nav-link block py-2 px-4 text-gray-700 hover:text-[#74583E] md:p-0">Undangan</a></li>
                <li><a href="#acara" class="nav-link block py-2 px-4 text-gray-700 hover:text-[#74583E] md:p-0">Jadwal & Lokasi</a></li>
                <li><a href="#konfirmasi" class="nav-link block py-2 px-4 text-gray-700 hover:text-[#74583E] md:p-0">Konfirmasi Kehadiran</a></li>

                 <?php if (!empty($pdf_path)): ?>
                    <li>
                        <a href="public/<?= htmlspecialchars($pdf_path) ?>"
                            class="py-2 px-4 bg-rose-500 text-white rounded-lg hover:bg-rose-600 transition duration-200 shadow-md hover:shadow-lg flex items-center gap-2"
                            download>
                            <i class="fas fa-file-pdf text-white"></i>
                            <span>Download PDF</span>
                        </a>
                    </li>
                <?php endif; ?>

                <li>
                    <a href="logout.php"
                        class="py-2 px-4 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition duration-200 shadow-md hover:shadow-lg">
                        Logout
                    </a>
                </li>
            <?php else: ?>
                <li><a href="#undangan" class="nav-link block py-2 px-4 text-gray-700 hover:text-[#74583E] md:p-0">Undangan</a></li>
                <li><a href="#acara" class="nav-link block py-2 px-4 text-gray-700 hover:text-[#74583E] md:p-0">Jadwal & Lokasi</a></li>
                <li><a href="#cari" class="nav-link block py-2 px-4 text-gray-700 hover:text-[#74583E] md:p-0">Cari Nama</a></li>
                <li><a href="#cerita" class="nav-link block py-2 px-4 text-gray-700 hover:text-[#74583E] md:p-0">Cerita Perjalanan</a></li>
                <li>
                    <a href="login.php"
                        class="py-2 px-4 mt-6 bg-[#74583E] text-white rounded-lg hover:bg-gray-700 transition duration-200">
                        Login
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<!-- Spacer agar konten tidak tertutup navbar -->
<div class="pt-20"></div>

<script>
    const toggle = document.querySelector('[data-collapse-toggle]');
    const menu = document.getElementById('mobile-menu');

    toggle?.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });

    window.addEventListener('scroll', () => {
        const scrollY = window.scrollY;

        // Highlight active menu link
        const sections = document.querySelectorAll("section[id]");
        const navLinks = document.querySelectorAll("nav .nav-link");
        let current = "";

        sections.forEach((section) => {
            const sectionTop = section.offsetTop;
            if (scrollY >= sectionTop - 200) {
                current = section.getAttribute("id");
            }
        });

        navLinks.forEach((link) => {
            const href = link.getAttribute("href");
            if (href?.startsWith("#")) {
                link.classList.remove("text-[#74583E]", "font-semibold");
                if (href === `#${current}`) {
                    link.classList.add("text-[#74583E]", "font-semibold");
                }
            }
        });
    });
</script>
