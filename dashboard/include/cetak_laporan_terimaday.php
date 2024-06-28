<?php

ob_start();
include '../../assets/libs/fpdf/fpdf.php';
include '../../koneksi/koneksi.php';
include '../../assets/libs/fpdf/mc_table/mc_table.php';

$id_maintenance = $_GET['id_mnt'];


// Instanciation of inherited class
$pdf = new PDF_MC_Table();
$pdf->AliasNbPages();
$pdf->AddPage();

if (isset($_POST['tampil'])) {
    $daritgl = $_POST['dari_tanggal'];
    $ketgl = $_POST['ke_tanggal'];
    $pdf->Ln(15);
    $pdf->Cell(40, 10, '', 0, 0, 'L');
    $pdf->SetFont('TIMES', 'B', 12);
    $pdf->Cell(100, 10, 'List Pendaftaran Diterima dari Tanggal ' . $daritgl . ' sampai Tanggal ' . $ketgl . '', 0, 1, 'C');
    $pdf->Ln();
    $pdf->SetFont('TIMES', '', 10);
    $pdf->Cell(6, 10, 'No.', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Nama', 1, 0, 'C');
    $pdf->Cell(5, 10, 'JK', 1, 0, 'C');
    $pdf->Cell(25, 10, 'No.Telepon', 1, 0, 'C');
    $pdf->Cell(23, 10, 'Tanggal Daftar', 1, 0, 'C');
    $pdf->Cell(45, 10, 'Asal Akademik', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Jurusan', 1, 0, 'C');
    $pdf->Cell(26, 10, 'Status Verifikasi', 1, 1, 'C');



    // $ambil = "SELECT * FROM tanggapan INNER JOIN pelanggan ON tanggapan.id_pelanggan = pelanggan.id_pelanggan 
    //  WHERE tanggal BETWEEN '$daritgl' AND '$ketgl' ORDER BY tanggal DESC";


    $query  =  "SELECT * FROM pendaftaran a, akun b, detail_pendaftaran c WHERE a.Id = c.id_user 
            AND b.id_user = a.Id AND c.status_pendaftaran = 1 AND c.tanggal_daftar BETWEEN '$daritgl' AND '$ketgl' ";
    $exec   =  mysqli_query($conn, $query);
}

$no = 0;

$pdf->SetWidths(array(6, 30, 5, 25, 23, 45, 30, 26));

while ($rows = mysqli_fetch_array($exec)) {
    $pdf->Row(array(++$no, $rows['nama'], $rows['jenis_kelamin'], $rows['telepon'], $rows['tanggal_daftar'], $rows['nama_akademik'], $rows['jurusan_akademik'], "Diterima"));
}


$pdf->Output();
