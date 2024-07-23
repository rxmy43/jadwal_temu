<?php

session_start();
include_once "./config.php";

if (isset($_SESSION['unique_id'])) {
    header("location: /dashboard");
}

$full_name = mysqli_real_escape_string($conn, $_POST['register_full_name']);
$email = mysqli_real_escape_string($conn, $_POST['register_email']);
$password = mysqli_real_escape_string($conn, $_POST['register_password']);
$username = mysqli_real_escape_string($conn, $_POST['register_username']);
$register_type = mysqli_real_escape_string($conn, $_POST['register_type']);
$nip = mysqli_real_escape_string($conn, $_POST['register_nip']);
$phone = mysqli_real_escape_string($conn, $_POST['register_phone']);

if (empty($full_name)) {
    echo "Nama Lengkap harus diisi";
    return;
}
if (empty($email)) {
    echo "Email harus diisi";
    return;
}
if (empty($password)) {
    echo "Password harus diisi";
    return;
}

if (empty($nip)) {
    echo "Nip harus diisi";
    return;
}

if (empty($phone)) {
    echo "Nomor telepon harus diisi";
    return;
}

if ($register_type != "admin" && $register_type != "karyawan" && $register_type != "petugas") {
    echo "invalid register type";
    return;
}

$email = filter_var($email, FILTER_SANITIZE_EMAIL);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Email tidak valid";
    return;
}

$checkEmail = mysqli_query($conn, "SELECT 'Admin' AS user_type, email
                                    FROM `admin`
                                    WHERE email = '$email'
                                    UNION
                                    SELECT 'Staff' AS user_type, email
                                    FROM `petugas`
                                    WHERE email = '$email'
                                    UNION
                                    SELECT 'Employee' AS user_type, email
                                    FROM `karyawan`
                                    WHERE email = '$email'");
if (mysqli_num_rows($checkEmail) > 0) {
    echo "Email sudah ada";
    return;
}

$checkUsername = mysqli_query($conn, "SELECT 'Admin' AS user_type
                            FROM `admin`
                                WHERE username = '$username'
                            UNION
                            SELECT 'Staff' AS user_type
                            FROM `petugas`
                                WHERE username = '$username'
                            UNION
                            SELECT 'Employee' AS user_type
                            FROM `karyawan`
                                WHERE username = '$username'");

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$unique_id = uniqid().microtime();

$fullNameColumn = "";
if ($register_type === 'admin') $fullNameColumn = "nama_admin";
elseif ($register_type === 'karyawan') $fullNameColumn = "nama_karyawan";
elseif ($register_type === "petugas") $fullNameColumn = "nama_petugas";

$insertSql = "INSERT INTO $register_type ($fullNameColumn, email, username, password, unique_id, nip, nomor_telepon) VALUES (?, ?, ?, ?, ?, ?, ?)";
$insertStmt = $conn->prepare($insertSql);
$insertStmt->bind_param("sssssss", $full_name, $email, $username, $hashedPassword, $unique_id, $nip, $phone);
$insertStmt->execute();

$_SESSION['unique_id'] = $unique_id;

echo "Register berhasil.";
return;