<?php
include_once "./config.php";

$search = isset($_POST['search']) ? $conn->real_escape_string($_POST['search']) : '';
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$records_per_page = isset($_POST['records_per_page']) ? (int)$_POST['records_per_page'] : 10;
$offset = ($page - 1) * $records_per_page;

$allowed_jenis_reservasi = ['buku_tamu', 'janji_temu'];
$jenis_reservasi = isset($_POST['jenis_reservasi']) ? $conn->real_escape_string($_POST['jenis_reservasi']) : '';

if (empty($jenis_reservasi) || !in_array($jenis_reservasi, $allowed_jenis_reservasi)) {
    echo json_encode(['message' => 'invalid jenis reservasi']);
    http_response_code(400);
    exit;
}

$search_query = "";
if (!empty($search)) {
    $search_query = "AND (reservasi_tamu.nama_tamu LIKE '%$search%' OR reservasi_tamu.alamat LIKE '%$search%')";
}

// Main query to fetch data
$sql = "SELECT reservasi_tamu.*, karyawan.nama_karyawan 
        FROM reservasi_tamu 
        LEFT JOIN karyawan ON reservasi_tamu.karyawan_id = karyawan.id 
        WHERE reservasi_tamu.jenis_reservasi = '$jenis_reservasi' $search_query 
        LIMIT $offset, $records_per_page";
$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Count query to determine total records
$count_sql = "SELECT COUNT(*) AS total 
              FROM reservasi_tamu 
              LEFT JOIN karyawan ON reservasi_tamu.karyawan_id = karyawan.id 
              WHERE reservasi_tamu.jenis_reservasi = '$jenis_reservasi' $search_query";
$count_result = $conn->query($count_sql);
$total_records = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_records / $records_per_page);

// Prepare response including records_per_page
$response = [
    'data' => $data,
    'total_pages' => $total_pages,
    'records_per_page' => $records_per_page // Include records_per_page in the response
];

echo json_encode($response);

$conn->close();