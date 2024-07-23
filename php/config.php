<?php 

$conn = mysqli_connect("localhost", "root", "mysql1412", "jadwal_temu_pln");

if (!$conn) {
    echo "Database error : " . mysqli_connect_error();
}