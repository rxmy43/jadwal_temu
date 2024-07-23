<?php

session_start();

include_once "./config.php";
include_once "../funcs/guardFuncs.php";

checkAuth();

$id = $conn->escape_string($_POST['id']);
$nama_tamu = $conn->escape_string($_POST['nama_tamu']);
$alamat = $conn->escape_string($_POST['alamat']);
$jenis_kelamin = $conn->escape_string($_POST['jenis_kelamin']);
$karyawan_id = $conn->escape_string($_POST['karyawan_id']);
$keperluan = $conn->escape_string($_POST['keperluan']);
$jam_masuk = $conn->escape_string($_POST['jam_masuk']);
$tanggal = $conn->escape_string($_POST['tanggal']);
$jumlah_orang = $conn->escape_string($_POST['jumlah_orang']);
$instansi = $conn->escape_string($_POST['instansi']);
$old_photo_path = $conn->escape_string($_POST['old_photo_path']);
$email_pemohon = $conn->escape_string($_POST['email_pemohon']);

if (isset($_FILES['foto'])) {
    if ($_FILES['foto']['error'] != UPLOAD_ERR_OK) {
        $uploadPath = $old_photo_path;
    } else {

        $photo = $_FILES['foto'];
        
        $uploadDir = "uploads/";
        
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        $fileExt = pathinfo($photo['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . microtime(true) . '.' . $fileExt;
        $uploadPath = $uploadDir.$filename;
        
        if (!move_uploaded_file($photo['tmp_name'], $uploadPath)) {
            echo "Gagal upload gambar";
            exit;
        }
        
        $uploadPath = "php/".$uploadPath;
    }
} else {
    echo "Gambar harus ada";
    exit;
}


$stmt = $conn->prepare("UPDATE reservasi_tamu
                        SET
                            nama_tamu = ?,
                            alamat = ?,
                            jenis_kelamin = ?,
                            karyawan_id = ?,
                            keperluan = ?,
                            jam_masuk = ?,
                            tanggal = ?,
                            jumlah_orang = ?,
                            instansi = ?,
                            foto = ?,
                            email_pemohon = ?
                        WHERE
                            id = ?
                        ");
$stmt->bind_param("sssssssisssi", $nama_tamu, $alamat, $jenis_kelamin, $karyawan_id, 
$keperluan, $jam_masuk, $tanggal, $jumlah_orang, $instansi, $uploadPath, $email_pemohon, $id);

$stmt->execute();

echo "Berhasil update buku tamu";

$conn->close();

exit;