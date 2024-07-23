<?php

session_start();
include_once "./config.php";
include_once "../funcs/guardFuncs.php";

checkAuth();

$id = $conn->escape_string($_POST['id']);
$jenis = $conn->escape_string($_POST['jenis']);

$query = $conn->query("SELECT 
                            rt.*,,
                            k.id AS karyawan_id,
                            k.nama_karyawan,
                            k.nomor_telepon AS karyawan_no
                        FROM 
                            reservasi_tamu rt
                        LEFT JOIN 
                            karyawan k ON rt.karyawan_id = k.id
                        WHERE
                            rt.id = $id
                        AND rt.jenis_reservasi = $jenis");

$row = $query->fetch_assoc();

$response = [
    'nama_tamu' => $row['nama_tamu'],
    'alamat' => $row['alamat'],
    'jenis_kelamin' => $row['jenis_kelamin'],
    'karyawan_id' => $row['karyawan_id'],
    'nomor_telepon' => $row['nomor_telepon'],
    'tanggal' => $row['tanggal'],
    'jumlah_orang' => $row['jumlah_orang'],
    'instansi' => $row['instansi'],
    'foto'=> $row['foto'],
    'email_pemohon' => $row['email_pemohon'],
    'keperluan' => $row['keperluan'],
    'id' => $row['id'],
    'jam_janji' => $row['jam_janji'],
    'nama_karyawan' => $row['nama_karyawan'],
    'nomor_telepon_karyawan' => $row['karyawan_no']
];

echo json_encode($response);

$conn->close();