<?php 

session_start();
include_once "config.php";

$totalTamu = mysqli_query($conn, "SELECT COUNT(*) AS counts FROM reservasi_tamu");
$totalTamuRow = mysqli_fetch_assoc($totalTamu);

$tamuHariIniQuery = mysqli_query($conn, "SELECT COUNT(*) AS counts FROM reservasi_tamu WHERE jenis_reservasi = 'buku_tamu' AND DATE(created_at) = CURDATE()");
$tamuHariIniRow = mysqli_fetch_assoc($tamuHariIniQuery);

$jadwalTemuQuery = mysqli_query($conn, "SELECT COUNT(*) AS counts FROM reservasi_tamu WHERE jenis_reservasi = 'janji_temu' AND DATE(created_at) = CURDATE()");
$jadwalTemuRow = mysqli_fetch_assoc($jadwalTemuQuery);

$response = [
    'total_tamu' => $totalTamuRow['counts'],
    'tamu_hari_ini' => $tamuHariIniRow['counts'],
    'jadwal_temu' => $jadwalTemuRow['counts']
];

echo json_encode($response);