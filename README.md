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

---

## 📸 Tampilan Antarmuka
![image](https://github.com/user-attachments/assets/5df71e5c-37c9-4688-9d2f-032b7132e30b)

![image](https://github.com/user-attachments/assets/b2a41d4d-fc73-4adb-b7a0-b006f487f95c)

![image](https://github.com/user-attachments/assets/f3697e6a-fac3-43a3-8c6f-354d61f42fcc)

![image](https://github.com/user-attachments/assets/6f628130-5cd7-46e0-a22c-f27511349b0d)

![image](https://github.com/user-attachments/assets/d81fa527-bc6a-49fb-a65b-e39a16c4c323)

![image](https://github.com/user-attachments/assets/e9fc4e28-8890-44a5-9257-1b3685ef4286)

![image](https://github.com/user-attachments/assets/197d5818-ea30-4939-b388-e48f7405b978)

![image](https://github.com/user-attachments/assets/66e23f05-5172-4a1b-988d-041f4cc91721)


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
##📄 Lisensi
Proyek ini dikembangkan untuk keperluan akademik dan pembelajaran.






