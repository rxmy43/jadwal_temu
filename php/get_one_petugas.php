<?php

include_once "./config.php";

$id = $conn->real_escape_string($_POST['id']);

$query = $conn->query("SELECT * FROM petugas WHERE id = $id");
$row = $query->fetch_assoc();

$response = [
    "nama_petugas" => $row['nama_petugas'],
    "username" => $row['username'],
    "nip" => $row['nip'],
    "nomor_telepon" => $row['nomor_telepon'],
    "email" => $row['email'],
    "shift" => $row['shift'],
    "alamat" => $row['alamat'],
    "id" => $row['id']
];

echo json_encode($response);

$conn->close();