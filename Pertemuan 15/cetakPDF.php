<?php
require('fpdf.php');
include 'db.php'; // Pastikan koneksi database disertakan di awal atau sebelum query

// PERBAIKAN 1: Gunakan 'L' untuk Landscape karena tabelmu lebar (157mm)
// A5 Landscape lebarnya 210mm, cukup untuk tabelmu.
$pdf = new FPDF('L','mm','A5');

$pdf->AddPage();

$pdf->SetFont('Arial','B',16);
// Sesuaikan lebar Cell header agar simetris (misal 190mm agar pas margin)
$pdf->Cell(190,7,'SEKOLAH MENENGAH KEJURUSAN NEGERI 2 LANGSA',0,1,'C');

$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,7,'DAFTAR SISWA KELAS IX JURUSAN REKAYASA PERANGKAT LUNAK',0,1,'C');

$pdf->Cell(10,7,'',0,1); // Spasi kosong (enter)

// Header Tabel
$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,6,'NIM',1,0,'C'); // Tambah 'C' agar teks di tengah
$pdf->Cell(85,6,'NAMA MAHASISWA',1,0,'C');
$pdf->Cell(35,6,'NO HP',1,0,'C'); // Sedikit diperlebar biar rapi
$pdf->Cell(30,6,'TANGGAL LAHIR',1,1,'C');

// Isi Tabel
$pdf->SetFont('Arial','',10);

$query = mysqli_query($conn, "SELECT * FROM mahasiswa ORDER BY nim ASC");

// Cek apakah query berhasil sebelum looping
if (!$query) {
    die("Query Error: " . mysqli_error($conn));
}

while($data = mysqli_fetch_array($query)){
    $pdf->Cell(20,6,$data['nim'],1,0,'C'); // NIM di tengah
    $pdf->Cell(85,6,$data['nama_lengkap'],1,0); // Nama rata kiri (default)
    $pdf->Cell(35,6,$data['no_hp'],1,0,'C');
    $pdf->Cell(30,6,$data['tanggal_lahir'],1,1,'C');
}

$pdf->Output();
?>