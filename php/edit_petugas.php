<?php

session_start();
include_once "./config.php";
include_once "../funcs/guardFuncs.php";

checkAuth();
checkRole($conn, "admin", getUniqueId());

$id = $conn->escape_string($_POST['id']);
$username = $conn->escape_string($_POST['username']);
$email = $conn->escape_string($_POST['email']);
$namaPetugas = $conn->escape_string($_POST['nama']);
$nip = $conn->escape_string($_POST['nip']);
$shift = $conn->escape_string($_POST['shift']);
$alamat = $conn->escape_string($_POST['alamat']);
$phone = $conn->escape_string($_POST['telpon']);

$stmt = $conn->prepare("UPDATE petugas
                            SET
                                username = ?,
                                email = ?,
                                nama_petugas = ?,
                                nip = ?,
                                nomor_telepon = ?,
                                shift = ?,
                                alamat = ?
                            WHERE
                                id = ?");

$stmt->bind_param("sssssssi", $username, $email, $namaPetugas, $nip, $phone, $shift, $alamat, $id);

if (!$stmt->execute()) {
    echo "Gagal update data";
    exit;
}

echo "Berhasil update data petugas";
$conn->close();
exit;