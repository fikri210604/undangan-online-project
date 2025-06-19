<?php
$currentPage = basename($_SERVER['PHP_SELF'], '.php');
?>

<div class="d-flex">
  <!-- Sidebar -->
  <nav id="sidebarMenu" class="p-3 text-dark"
    style="width: 250px; min-height: 100vh; transition: width 0.3s; background-color: #CAF0F8;" data-state="open">
    
    <!-- Logo dan Judul -->
    <div class="d-flex align-items-center mb-3" style="gap: 10px;">
      <img src="../public/img/asset/logo.png" alt="Logo Admin Nikah" class="img-fluid"
        style="width: 50px; height: auto;">
      <h4 class="m-0" id="sidebarTitle" style="font-family: 'Montserrat', cursive; font-size: 20px;">Admin Nikah</h4>
    </div>

    <!-- Menu -->
    <ul class="nav flex-column mt-3">
      <li class="nav-item">
        <a class="nav-link mt-3 <?= ($currentPage == 'dashboard') ? 'active text-white bg-purple rounded px-2 py-1' : 'text-dark' ?>"
          href="dashboard.php">
          <i class="bi bi-house"></i> <span class="link-text"> Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link mt-3 <?= ($currentPage == 'tamu') ? 'active text-white bg-purple rounded px-2 py-1' : 'text-dark' ?>"
          href="tamu.php">
          <i class="bi bi-person-lines-fill"></i> <span class="link-text"> Data Tamu</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link mt-3 <?= ($currentPage == 'konfirmasi') ? 'active text-white bg-purple rounded px-2 py-1' : 'text-dark' ?>"
          href="konfirmasi.php">
          <i class="bi bi-check2-circle"></i> <span class="link-text"> Konfirmasi</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link mt-3 mb-3 <?= ($currentPage == 'galeri') ? 'active text-white bg-purple rounded px-2 py-1' : 'text-dark' ?>"
          href="galeri.php">
          <i class="bi bi-images"></i> <span class="link-text"> Galeri</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white bg-danger rounded" href="../logout.php">
          <i class="bi bi-box-arrow-right"></i> <span class="link-text">Logout</span>
        </a>
      </li>
    </ul>

    <!-- Toggle Sidebar -->
    <button id="toggleSidebar" class="btn btn-outline-dark d-flex align-items-center gap-2 mt-4" type="button">
      <span class="toggle-icon"><i class="bi bi-arrow-left-circle-fill"></i></span>
    </button>
  </nav>

  <!-- Script untuk toggle -->
  <script>
    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebarMenu');
    const texts = document.querySelectorAll('.link-text');
    const title = document.getElementById('sidebarTitle');
    const toggleIcon = document.querySelector('.toggle-icon i');

    toggleBtn.addEventListener('click', function () {
      const isOpen = sidebar.getAttribute('data-state') === 'open';

      if (isOpen) {
        sidebar.style.width = '80px';
        texts.forEach(t => t.style.display = 'none');
        title.style.display = 'none';
        toggleIcon.className = 'bi bi-arrow-right-circle-fill';
        sidebar.setAttribute('data-state', 'collapsed');
      } else {
        sidebar.style.width = '250px';
        texts.forEach(t => t.style.display = 'inline');
        title.style.display = 'block';
        toggleIcon.className = 'bi bi-arrow-left-circle-fill';
        sidebar.setAttribute('data-state', 'open');
      }
    });
  </script>

  <!-- CSS tambahan untuk bg-purple -->
  <style>
    .bg-purple {
      background-color: #9B5DE5 !important;
    }
  </style>
