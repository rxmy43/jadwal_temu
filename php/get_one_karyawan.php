<?php

include_once "./config.php";

$id = $conn->real_escape_string($_POST['id']);

$query = $conn->query("SELECT * FROM karyawan WHERE id = $id");
$row = $query->fetch_assoc();

$response = [
    "nama_karyawan" => $row['nama_karyawan'],
    "username" => $row['username'],
    "nip" => $row['nip'],
    "nomor_telepon" => $row['nomor_telepon'],
    "email" => $row['email'],
    "jabatan" => $row['jabatan'],
    "alamat" => $row['alamat'],
    "id" => $row['id']
];

echo json_encode($response);

$conn->close();