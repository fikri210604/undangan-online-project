# 💌 Aplikasi Undangan Online Berbasis Web

Sistem RSVP berbasis web yang dirancang untuk memudahkan proses konfirmasi kehadiran tamu pada acara formal seperti pernikahan. Aplikasi ini dibangun menggunakan PHP dan MySQL, serta mampu menghasilkan tiket undangan dalam format PDF yang dilengkapi dengan QR Code dan dikirim otomatis ke email tamu setelah melakukan konfirmasi.

---

## 🧭 Ringkasan Proyek

Sistem ini hadir sebagai solusi digital untuk menggantikan undangan fisik. Tamu cukup melakukan konfirmasi kehadiran melalui form yang tersedia tanpa perlu registrasi. Admin dapat mengelola data tamu, memantau status kehadiran, dan mengatur alokasi tempat duduk melalui dashboard.

> 🎓 *Mata Kuliah*: Pemrograman Web  
> 🧑‍💻 *Dikembangkan oleh*:  
> - Ahamad Fikri Hanif – 2317051061  
> - Intan Nur Laila – 2317051109  
> - Muhammad Alvin – 2317051040  
> - Rahayu Indah Lestari – 2317051073  
> 🏫 *Universitas*: Universitas Lampung, Prodi Ilmu Komputer – 2024/2025

## 🛠 Teknologi yang Digunakan

| Komponen         | Teknologi                         |
|------------------|------------------------------------|
| Backend          | PHP Native                         |
| Frontend         | HTML, CSS, Bootstrap, Tailwind CSS |
| Database         | MySQL                              |
| PDF Generator    | FPDF / DomPDF                      |
| QR Code          | PHP QR Code Library                |
| Email Sender     | PHPMailer                          |
| Local Server     | Laragon (Apache + MySQL)           |

## ⚙️ Cara Instalasi (Localhost)
1. Clone repository ini ke folder Laragon:
   ```bash
   git clone https://github.com/fikri210604/undangan-online-project.git

2. Pindahkan ke direktori:
   ```bash
C:\laragon\www\undangan-online

3. Import database proyek_akhir_web.sql ke phpMyAdmin

4. Konfigurasi file includes/db.php:
   ```bash
   $host = "localhost";
$user = "root";
$pass = "";
$db   = "proyek_akhir_web";

5.Jalankan di browser:
   ```bash
   http://localhost/undangan-online

6. Login Admin:
```bash
Email: admin@undangan.com
Password: admin123
---

## 📸 Tampilan Antarmuka

| Form Konfirmasi Kehadiran | QR Code Tiket Digital |
|---------------------------|------------------------|
| ![form](https://github.com/user-attachments/assets/ea7d4339-2dff-4670-9ce7-dffbc414372f) | ![qr-code](https://github.com/user-attachments/assets/497c2813-926c-48aa-9389-45f704f59dcd) |

| Dashboard Admin | Daftar Tamu |
|-----------------|-------------|
| ![dashboard](https://github.com/user-attachments/assets/acb42823-c96c-45ff-8c31-0789fab4066a) | ![tamu](https://github.com/user-attachments/assets/7dcd39f2-7621-4417-89fc-89286a4c8673) |

| Tambah Tamu | Filter Berdasarkan Kolom |
|-------------|--------------------------|
| ![tambah](https://github.com/user-attachments/assets/d97e8bda-39a1-4e43-9963-59fa20d71a84) | ![filter](https://github.com/user-attachments/assets/c99a604e-bba1-460c-b4c9-7fe7dd1e9a27) |

| Detail Tiket | Scan Kehadiran |
|--------------|----------------|
| ![ticket](https://github.com/user-attachments/assets/59aaa1d0-9ba5-48c6-8068-81619afa2e28) | ![scan](https://github.com/user-attachments/assets/af65e9d6-afca-46c0-9aa0-89dc211d3cd3) |

---
##📄 Lisensi
Proyek ini dikembangkan untuk keperluan akademik dan pembelajaran.






