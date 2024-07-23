<?php

session_start();
include_once "./config.php";
include_once "../funcs/guardFuncs.php";

checkAuth();

$id = $conn->real_escape_string($_POST['id']);

$query = $conn->query("DELETE FROM karyawan WHERE id = $id");

if ($conn->affected_rows === 0) {
    echo "Gagal hapus data";
    exit;
}

echo "Berhasil hapus data karyawan";
exit;