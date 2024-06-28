<?php
require '../../assets/libs/fpdf/fpdf.php';
require '../../koneksi/koneksi.php';

error_reporting(E_ALL);
ini_set('display_errors', 1); 

// Instansiasi kelas FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(0, 10, 'Laporan Pendaftar', 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 10, 'No', 1);
$pdf->Cell(30, 10, 'Nama', 1);
$pdf->Cell(10, 10, 'JK', 1);
$pdf->Cell(25, 10, 'Telepon', 1);
$pdf->Cell(25, 10, 'Tanggal Daftar', 1);
$pdf->Cell(40, 10, 'Asal Akademik', 1);
$pdf->Cell(40, 10, 'Jurusan', 1);
$pdf->Ln();

$pdf->SetFont('Arial', '', 10);

$query = "SELECT * FROM pendaftaran a
          JOIN detail_pendaftaran c ON a.Id = c.id_user
          JOIN akun b ON b.id_user = a.Id";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error: " . mysqli_error($conn));
}

$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(10, 10, $no++, 1);
    $pdf->Cell(30, 10, $row['nama'], 1);
    $pdf->Cell(10, 10, $row['jenis_kelamin'], 1);
    $pdf->Cell(25, 10, $row['telepon'], 1);
    $pdf->Cell(25, 10, $row['tanggal_daftar'], 1);
    $pdf->Cell(40, 10, $row['nama_akademik'], 1);
    $pdf->Cell(40, 10, $row['jurusan_akademik'], 1);
    $pdf->Ln();
}

$pdf->Output('D', 'laporan_pendaftar.pdf');
?>
