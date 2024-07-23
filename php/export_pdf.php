<?php

session_start();
include_once "./config.php";
include_once "../funcs/guardFuncs.php";

require '../vendor/autoload.php';

use TCPDF as TCPDF;

checkAuth();

// Fetch data from MySQL
$query = "SELECT 
            rt.nama_tamu, 
            rt.jenis_kelamin, 
            k.nama_karyawan, 
            rt.jam, 
            rt.tanggal
          FROM 
            reservasi_tamu rt
          INNER JOIN 
            karyawan k ON rt.karyawan_id = k.id
          WHERE 
            rt.tanggal >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)
            AND rt.jenis_reservasi = 'buku_tamu'";
$result = mysqli_query($conn, $query);

// Initialize PDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator('Your Name');
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Reservation Data');
$pdf->SetSubject('Reservation Data');
$pdf->SetKeywords('PDF, Reservation, Data');

// Set default header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Set margins
$pdf->SetMargins(5, 5, 5); // Set minimal margins
$pdf->SetHeaderMargin(5);
$pdf->SetFooterMargin(5);

// Add a page
$pdf->AddPage();

// Set content font
$pdf->SetFont('helvetica', '', 10);

// Column headers
$pdf->Cell(15, 10, 'No', 1, 0, 'C');
$pdf->Cell(50, 10, 'Nama Tamu', 1, 0, 'C');
$pdf->Cell(20, 10, 'Gender', 1, 0, 'C');
$pdf->Cell(50, 10, 'Nama Karyawan', 1, 0, 'C');
$pdf->Cell(20, 10, 'Jam Masuk', 1, 0, 'C');
$pdf->Cell(20, 10, 'Tanggal', 1, 1, 'C');

// Data rows
$rowNumber = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(15, 10, $rowNumber, 1, 0, 'C');
    $pdf->Cell(50, 10, $row['nama_tamu'], 1, 0, 'L');
    $pdf->Cell(20, 10, ($row['jenis_kelamin'] === 'l' ? 'L' : 'P'), 1, 0, 'C');
    $pdf->Cell(50, 10, $row['nama_karyawan'], 1, 0, 'L');
    $pdf->Cell(20, 10, $row['jam'], 1, 0, 'C');
    $pdf->Cell(20, 10, $row['tanggal'], 1, 1, 'C');

    $rowNumber++;
}

// Close and output PDF
$pdf->Output('buku_tamu.pdf', 'D');

// Close the database connection
mysqli_close($conn);
