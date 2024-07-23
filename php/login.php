<?php

session_start();
include_once "./config.php";

$email = mysqli_real_escape_string($conn, $_POST["login_email"]);
$password = mysqli_real_escape_string($conn, $_POST["login_password"]);

if (empty($email)) {
    echo "Email tidak boleh kosong";
    return;
}

if (empty($password)) {
    echo "Password tidak boleh kosong";
    return;
} 

$query = mysqli_query($conn, "SELECT 'Admin' AS user_type, email, password, unique_id, username
                                FROM `admin`
                                WHERE email = '$email' OR username = '$email'
                                UNION
                                SELECT 'Staff' AS user_type, email, password, unique_id, username
                                FROM `petugas`
                                WHERE email = '$email' OR username = '$email'
                                UNION
                                SELECT 'Employee' AS user_type, email, password, unique_id, username
                                FROM `karyawan`
                                WHERE email = '$email' OR username = '$email'");
if (mysqli_num_rows($query) === 0) {
    echo "Email / Username salah";
    return;
}

$row = mysqli_fetch_assoc($query);
$hashedPassword = $row['password'];

if (!password_verify($password, $hashedPassword)) {
    echo "Password salah";
    return;
}

$_SESSION['unique_id'] = $row['unique_id'];
echo "Berhasil Login";
return;