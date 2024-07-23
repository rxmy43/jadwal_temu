<?php

session_start();
include_once "./config.php";
include_once "../funcs/guardFuncs.php";

checkAuth();
checkRole($conn, "admin", getUniqueId());

$id = $conn->escape_string($_POST['id']);
$username = $conn->escape_string($_POST['username']);
$email = $conn->escape_string($_POST['email']);
$namaKaryawan = $conn->escape_string($_POST['nama']);
$nip = $conn->escape_string($_POST['nip']);
$jabatan = $conn->escape_string($_POST['departemen']);
$alamat = $conn->escape_string($_POST['alamat']);
$phone = $conn->escape_string($_POST['telpon']);

$stmt = $conn->prepare("UPDATE karyawan
                            SET
                                username = ?,
                                email = ?,
                                nama_karyawan = ?,
                                nip = ?,
                                nomor_telepon = ?,
                                jabatan = ?,
                                alamat = ?
                            WHERE
                                id = ?");

$stmt->bind_param("sssssssi", $username, $email, $namaKaryawan, $nip, $phone, $jabatan, $alamat, $id);

if (!$stmt->execute()) {
    echo "Gagal update data";
    exit;
}

echo "Berhasil update data karyawan";
$conn->close();
exit;