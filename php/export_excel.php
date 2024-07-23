<?php

session_start();
include_once "./config.php";
include_once "../funcs/guardFuncs.php";

require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

checkAuth();

$json = file_get_contents('php://input');

// Decode the JSON data
$data = json_decode($json, true);

$interval = $data['interval'];

$objPHPExcel = new Spreadsheet();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Your Name")
                               ->setLastModifiedBy("Your Name")
                               ->setTitle("Office 2007 XLSX Test Document")
                               ->setSubject("Office 2007 XLSX Test Document")
                               ->setDescription("Test document for Office 2007 XLSX, generated using PHPExcel.")
                               ->setKeywords("office 2007 openxml php")
                               ->setCategory("Test result file");

// Add some data
$objPHPExcel->setActiveSheetIndex(0);

// Set column headers
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'No'); 
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Nama Tamu');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Alamat');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Jenis Kelamin');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Nomor Telepon Karyawan');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Nama Karyawan');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Keperluan');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Jam Janji');
$objPHPExcel->getActiveSheet()->setCellValue('I1', 'Jam Masuk');
$objPHPExcel->getActiveSheet()->setCellValue('J1', 'Tanggal');
$objPHPExcel->getActiveSheet()->setCellValue('K1', 'Jumlah Orang');
$objPHPExcel->getActiveSheet()->setCellValue('L1', 'Instansi');
$objPHPExcel->getActiveSheet()->setCellValue('M1', 'Email Pemohon');

// Set data from MySQL query
$query = "SELECT 
            rt.id, 
            rt.nama_tamu, 
            rt.alamat, 
            rt.jenis_kelamin, 
            rt.nomor_telepon, 
            rt.keperluan, 
            rt.jam_masuk, 
            rt.jam_janji, 
            rt.tanggal, 
            rt.jumlah_orang, 
            rt.instansi, 
            rt.foto, 
            rt.jenis_reservasi, 
            rt.email_pemohon, 
            k.nama_karyawan
        FROM 
            reservasi_tamu rt
        INNER JOIN 
            karyawan k ON rt.karyawan_id = k.id
        WHERE 
            rt.tanggal >= DATE_SUB(CURDATE(), INTERVAL $interval MONTH)
            AND rt.jenis_reservasi = 'buku_tamu'";
$result = mysqli_query($conn, $query);

if ($result) {
    $i = 2; // Start from row 2
    $rowNumber = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $rowNumber);
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $row['nama_tamu']);
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $row['alamat']);
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $row['jenis_kelamin'] === "l" ? "Laki-laki" : "Perempuan");
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $row['nomor_telepon']);
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $row['nama_karyawan']);
        $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $row['keperluan']);
        $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $row['jam_janji']);
        $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, $row['jam_masuk']);
        $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $row['tanggal']);
        $objPHPExcel->getActiveSheet()->setCellValue('K' . $i, $row['jumlah_orang']);
        $objPHPExcel->getActiveSheet()->setCellValue('L' . $i, $row['instansi']);
        $objPHPExcel->getActiveSheet()->setCellValue('M' . $i, $row['email_pemohon']);
        $rowNumber++;
        $i++;
    }
}

// Save the file
$writer = new Xlsx($objPHPExcel);
$filename = 'buku_tamu.xlsx'; // Choose a filename for the Excel file
$writer->save($filename);

// Download the file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer->save('php://output');

// Close the database connection
mysqli_close($conn);