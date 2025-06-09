<?php
include("db.php");
require("public/fpdf186/fpdf.php");
require("public/phpqrcode/phpqrcode.php");

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $whises = $_POST['whises'];
    $status_konfirmasi = $_POST['status']; // contoh: "Hadir"
    $waktu_konfirmasi = date("Y-m-d H:i:s");
    $kode_unik = $_POST['kode_unik']; // misalnya dikirimkan dari hidden input
    $user_id = $_POST['user_id'];     // ID user login atau hidden input

    // =============== FUNCTION ================
    function generate_nomor_kursi($conn) {
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

    function generate_qr_code($nomor_kursi) {
        $qr_dir = "public/qr-code/";
        if (!file_exists($qr_dir)) mkdir($qr_dir, 0777, true);
        $qr_path = $qr_dir . $nomor_kursi . ".png";
        QRcode::png("Nomor Kursi: $nomor_kursi", $qr_path, "L", 5);
        return $qr_path;
    }

    function generate_undangan_pdf($nomor_kursi, $qr_path) {
        $pdf_dir = "public/pdf/";
        if (!file_exists($pdf_dir)) mkdir($pdf_dir, 0777, true);
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
        if (file_exists($qr_path)) $pdf->Image($qr_path, 10, 70, 50, 50);
        $pdf->Output('F', $pdf_path);
        return $pdf_path;
    }

    // =============== PROSES ================
    $nomor_kursi = generate_nomor_kursi($conn);
    $qr_code_path = generate_qr_code($nomor_kursi);
    $pdf_path = generate_undangan_pdf($nomor_kursi, $qr_code_path);

    // Simpan ke database
    $stmt = $conn->prepare("INSERT INTO konfirmasi (user_id, status, waktu_konfirmasi, nomor_kursi, qr_code_path, pdf_path, kode_unik, whishes)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssssss", $user_id, $status_konfirmasi, $waktu_konfirmasi, $nomor_kursi, $qr_code_path, $pdf_path, $kode_unik, $whises);
    $stmt->execute();

    // Redirect ke halaman sukses
    header("Location: sukses_konfirmasi.php?pdf=" . urlencode($pdf_path));
    exit;
}
?>
