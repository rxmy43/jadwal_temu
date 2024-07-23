<?php

session_start();
include_once "./config.php";
include_once "../funcs/guardFuncs.php";

checkAuth();

$id = $conn->real_escape_string($_POST['id']);

$query = $conn->query("DELETE FROM reservasi_tamu WHERE jenis_reservasi = 'buku_tamu' AND id = $id");

if ($conn->affected_rows === 0) {
    echo "Gagal menghapus buku tamu";
    exit;
}

echo "Berhasil hapus buku tamu";
exit;