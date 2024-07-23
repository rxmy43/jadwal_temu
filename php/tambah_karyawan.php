<?php 

session_start();
include_once "./config.php";
include_once "../funcs/guardFuncs.php";
include_once "../funcs/validateFuncs.php";

checkAuth();
checkRole($conn, "admin", getUniqueId());

$namaKaryawan = mysqli_real_escape_string($conn, $_POST['nama']);
$username = mysqli_real_escape_string($conn, $_POST['username']);
$nip = mysqli_real_escape_string($conn, $_POST['nip']);
$phone = mysqli_real_escape_string($conn, $_POST['telpon']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$jabatan = mysqli_real_escape_string($conn, $_POST['departemen']);
$alamat = mysqli_real_escape_string($conn, $_POST['alamat']);

notBlank($namaKaryawan, "Nama Karyawan");
notBlank($username, "Username");
notBlank($email, "Email");
notBlank($nip, "NIP");
notBlank($phone, "Nomor Telepon");
notBlank($jabatan, "Departemen");

$password = "password";

$checkEmail = $conn->prepare("SELECT email FROM karyawan WHERE email = ?");
$checkEmail->bind_param("s", $email);
$checkEmail->execute();
$result = $checkEmail->get_result();

if ($result->num_rows > 0) {
    echo "Email $email sudah terdaftar";
    exit;
}

$checkNip = $conn->prepare("SELECT nip FROM karyawan WHERE nip = ?");
$checkNip->bind_param("s", $nip);
$checkNip->execute();
$result = $checkNip->get_result();

if ($result->num_rows > 0) {
    echo "NIP $nip sudah ada";
    exit;
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$unique_id = uniqid().microtime();

$insertSql = "INSERT INTO karyawan (username, password, email, nama_karyawan, nip, jabatan, alamat, unique_id, nomor_telepon) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$insertStmt = $conn->prepare($insertSql);
$insertStmt->bind_param("sssssssss", $username, $hashedPassword, $email, $namaKaryawan, $nip, $jabatan, $alamat, $unique_id, $phone);

if (!$insertStmt->execute()) {
    echo "Gagal membuat data";
    exit;
}

$conn->close();

echo "Berhasil membuat data karyawan";
exit;