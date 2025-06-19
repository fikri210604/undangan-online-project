<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("db.php");
require(__DIR__ . '/../public/fpdf186/fpdf.php');
require(__DIR__ . '/../public/phpqrcode/phpqrcode.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$whishes = $_POST['whishes'] ?? '';
$status_konfirmasi = strtolower($_POST['kehadiran'] ?? '');
$user_id = $_SESSION['user_id'];
$waktu_konfirmasi = date("Y-m-d H:i:s");

$user = $conn->query("SELECT * FROM users WHERE id = $user_id")->fetch_assoc();
$user_email = $user['email'] ?? '';

// Mengambil Kode unik dari user
$stmtKodeUnik = $conn->prepare("SELECT kode_unik FROM users WHERE email = ?");
$stmtKodeUnik->bind_param("s", $user_email);
$stmtKodeUnik->execute();
$result = $stmtKodeUnik->get_result();
$tamu = $result->fetch_assoc();
$kode_unik = $tamu['kode_unik'] ?? '';

// Memastikan konfirmasi kehadiran sudah ada
$cek = $conn->query("SELECT * FROM konfirmasi WHERE user_id = $user_id")->num_rows;
if ($cek == 0) {
    $stmtInsert = $conn->prepare("INSERT INTO konfirmasi (user_id, kode_unik) VALUES (?, ?)");
    $stmtInsert->bind_param("is", $user_id, $kode_unik);
    $stmtInsert->execute();
}

// ================= FUNCTION Generate Nomor Kursi, Kode QR, dan Undangan PDF =================
function generate_nomor_kursi($conn)
{
    $max_kursi = 500;
    do {
        $nomor_kursi = rand(1, $max_kursi);
        $stmt = $conn->prepare("SELECT COUNT(*) as jumlah FROM konfirmasi WHERE nomor_kursi = ?");
        $stmt->bind_param("i", $nomor_kursi);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
    } while ($result['jumlah'] > 0);
    return $nomor_kursi;
}

function generate_qr_code($nomor_kursi)
{
    $qr_dir = "../public/qr-code/";
    if (!file_exists($qr_dir))
        mkdir($qr_dir, 0777, true);
    $qr_path = $qr_dir . $nomor_kursi . ".png";
    QRcode::png("Nomor Kursi: $nomor_kursi", $qr_path, "L", 5);
    return $qr_path;
}

function generate_undangan_pdf($nomor_kursi, $qr_path)
{
    $pdf_dir = "../public/undangan_pdf/";
    if (!file_exists($pdf_dir))
        mkdir($pdf_dir, 0777, true);
    $pdf_path = $pdf_dir . "undangan_kursi_$nomor_kursi.pdf";

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, "Undangan Pernikahan", 0, 1, 'C');
    $pdf->Ln(10);
    $pdf->SetFont('Arial', '', 14);
    $pdf->Cell(0, 10, "Nomor Kursi: $nomor_kursi", 0, 1, 'L');
    $pdf->Ln(10);
    $pdf->Cell(0, 10, "Tunjukkan QR ini saat hadir:", 0, 1, 'L');
    if (file_exists($qr_path))
        $pdf->Image($qr_path, 10, 70, 50, 50);
    $pdf->Output('F', $pdf_path);
    return $pdf_path;
}

// ================= Konfirmasi Kehadiran =================
if ($status_konfirmasi === 'hadir') {
    $countHadir = $conn->query("SELECT COUNT(*) as total FROM konfirmasi WHERE status = 'Hadir'")->fetch_assoc()['total'];
    if ($countHadir >= 500) {
        header("Location: ../landing.php?status=error&message=Kursi penuh. Tidak bisa menerima konfirmasi hadir lagi.");
        exit;
    }

    // Memanggil Fungsi
    $nomor_kursi = generate_nomor_kursi($conn);
    $qr_code_path = generate_qr_code($nomor_kursi);
    $pdf_path = generate_undangan_pdf($nomor_kursi, $qr_code_path);

    $_SESSION['pdf_path'] = str_replace('../public/', '', $pdf_path);
    $_SESSION['qr_code_path'] = str_replace('../public/', '', $qr_code_path);
    $_SESSION['success'] = true;
    
    // Update kehadiran
    $stmt = $conn->prepare("UPDATE konfirmasi SET status = ?, waktu_konfirmasi = ?, nomor_kursi = ?, qr_code_path = ?, pdf_path = ?, whishes = ? WHERE user_id = ?");
    $status_konfirmasi = 'Hadir';
    $stmt->bind_param("ssisssi", $status_konfirmasi, $waktu_konfirmasi, $nomor_kursi, $qr_code_path, $pdf_path, $whishes, $user_id);
    $stmt->execute();

    header("Location: ../landing.php?status=success&message=Konfirmasi berhasil!&pdf_file=" . urlencode($pdf_path));
    exit;

} elseif ($status_konfirmasi === 'tidak') {
    $status_konfirmasi = 'Tidak Hadir';

    // Update status jadi Tidak Hadir
    $stmt = $conn->prepare("UPDATE konfirmasi SET status = ?, waktu_konfirmasi = ?, nomor_kursi = NULL, qr_code_path = NULL, pdf_path = NULL, whishes = ? WHERE user_id = ?");
    $stmt->bind_param("sssi", $status_konfirmasi, $waktu_konfirmasi, $whishes, $user_id);
    $stmt->execute();

    header("Location: ../landing.php?status=success&message=Konfirmasi berhasil!");
    exit;
}
?>