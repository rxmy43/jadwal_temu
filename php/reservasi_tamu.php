<?php

include_once "./config.php";
include_once "../funcs/mailFuncs.php";

$nama = mysqli_escape_string($conn, $_POST['nama']);
$alamat = mysqli_escape_string($conn, $_POST['alamat']);
$jenis_kelamin = mysqli_escape_string($conn, $_POST['jenis_kelamin']);
$karyawan = mysqli_escape_string($conn, $_POST['karyawan']);
$keperluan = mysqli_escape_string($conn, $_POST['keperluan']);
$phone = mysqli_escape_string($conn, $_POST['nomor_telepon']);
$jam_janji = isset($_POST['jam_janji'])  ? mysqli_escape_string($conn, $_POST['jam_janji']) : null;;
$jam_masuk = isset($_POST['jam_masuk'])  ? mysqli_escape_string($conn, $_POST['jam_masuk']) : null;
$tanggal = mysqli_escape_string($conn, $_POST['tanggal']);
$jumlah_orang = mysqli_escape_string($conn, $_POST['jumlah_orang']);
$email = mysqli_escape_string($conn, $_POST['email']);
$instansi = mysqli_escape_string($conn, $_POST['instansi']);
$jenis_reservasi = mysqli_escape_string($conn, $_POST['jenis_reservasi']);

if (!isset($_FILES['photo'])) {
    echo "Gambar tidak boleh kosong";
    exit;
}

if ($_FILES['photo']['error'] != UPLOAD_ERR_OK) {
    echo "Terjadi kesalahan dalam upload gambar";
    exit;
}

$photo = $_FILES['photo'];

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

$fields = "";
$values = "";

if ($jenis_reservasi === 'buku_tamu') {
    $fields = "(nama_tamu, alamat, jenis_kelamin, karyawan_id, keperluan, nomor_telepon, tanggal, jam_masuk, jumlah_orang, instansi, email_pemohon, foto, jenis_reservasi)";
    $values = "('$nama', '$alamat', '$jenis_kelamin', $karyawan, '$keperluan', '$phone', '$tanggal', '$jam_masuk', $jumlah_orang, '$instansi', '$email', '$uploadPath', 'buku_tamu');";
} else if ($jenis_reservasi === 'janji_temu') {
    $fields = "(nama_tamu, alamat, jenis_kelamin, karyawan_id, keperluan, nomor_telepon, tanggal, jam_janji, jumlah_orang, instansi, email_pemohon, foto, jenis_reservasi)";
    $values = "('$nama', '$alamat', '$jenis_kelamin', $karyawan, '$keperluan', '$phone','$tanggal', '$jam_janji', $jumlah_orang, '$instansi', '$email', '$uploadPath', 'janji_temu');";
} else {
    echo "Invalid jeni reservasi";
    exit;
}

$sql = "INSERT INTO reservasi_tamu 
        $fields
        VALUES 
        $values
";

$query = mysqli_query($conn, $sql);

if ($query) {
    try {
        $rev_type = $jenis_reservasi === 'buku_tamu' ? 'Pengisian Buku Tamu' : 'Jadwal Janji Temu';
        sendEmail(SUCCESS_EMAIL, $email, $nama, [], $rev_type);
    } catch (Exception $e) {
        throw $e;
    }
    echo "Berhasil menyimpan data";
    exit;
} else {
    unlink($uploadPath);
    echo "Gagal menyimpan data";
    exit;
}