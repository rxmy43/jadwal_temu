<?php
include_once "./config.php";
include_once "../funcs/mailFuncs.php";

$id = $conn->escape_string($_POST['id']);
$approval_status = $conn->escape_string($_POST['approval_status']);
$reject_reason = $conn->escape_string($_POST['reject_reason']);
$suggested_date = $conn->escape_string($_POST['suggested_date']);

if ($approval_status == 'true') {
    $update = $conn->prepare("UPDATE reservasi_tamu SET jenis_reservasi = 'buku_tamu' WHERE id = ?");
    $update->bind_param("i", $id);
    
    if (!$update->execute()) {
        echo json_encode(['message' => 'Gagal update query']);
        http_response_code(400);
        exit;
    } else {
        $getOneQuery = mysqli_query($conn, "SELECT 
                                            rt.id, 
                                            rt.nama_tamu, 
                                            rt.alamat, 
                                            rt.jenis_kelamin, 
                                            rt.nomor_telepon, 
                                            rt.keperluan, 
                                            rt.jam_janji, 
                                            rt.tanggal, 
                                            rt.jumlah_orang, 
                                            rt.instansi, 
                                            rt.foto, 
                                            rt.jenis_reservasi,
                                            rt.email_pemohon, 
                                            rt.created_at, 
                                            rt.updated_at, 
                                            k.nama_karyawan,
                                            k.nomor_telepon AS kary_nomor_telepon
                                        FROM 
                                            reservasi_tamu rt
                                        LEFT JOIN 
                                            karyawan k ON rt.karyawan_id = k.id
                                        WHERE rt.id = $id");
        $getOneRes = mysqli_fetch_assoc($getOneQuery);
        $additionalData = [
            'karyawan' => $getOneRes['nama_karyawan'],
            'nama_tamu' => $getOneRes['nama_tamu'],
            'alamat' => $getOneRes['alamat'],
            'jenisKelamin' => $getOneRes['jenis_kelamin'],
            'phone' => $getOneRes['nomor_telepon'],
            'keperluan' => $getOneRes['keperluan'],
            'jam' => $getOneRes['jam_janji'],
            'jumlahOrang' => $getOneRes['jumlah_orang'],
        ];
        sendEmail(APPROVED_EMAIL, $getOneRes['email_pemohon'], $getOneRes['nama_tamu'], $additionalData);
        echo json_encode(['message'=> 'Berhasil menyetujui data', 
                            'nama_karyawan' => $getOneRes['nama_karyawan'], 
                            'phone' => $getOneRes['kary_nomor_telepon'],
                            'nama_tamu' => $getOneRes['nama_tamu'],
                            'tanggal' => $getOneRes['tanggal'],
                            'jam' => $getOneRes['jam_janji'],
                            'keperluan' => $getOneRes['keperluan']
                        ]);
        exit;
    }
} else {
    $getOneQuery = mysqli_query($conn, "SELECT nama_tamu, email_pemohon FROM reservasi_tamu WHERE id = $id");
    $getOneRes =mysqli_fetch_assoc($getOneQuery);

    $name = $getOneRes['nama_tamu'];
    $email = $getOneRes['email_pemohon'];

    $remove = $conn->prepare("DELETE FROM reservasi_tamu WHERE id = ?");
    $remove->bind_param("i", $id);
    
    if (!$remove->execute()) {
        echo json_encode(['message' => 'Gagal menghapus data dari jadwal janji temu']);
        http_response_code(400);
        exit;
    } else {
        $additionalData = [
            'declineReason' => $reject_reason,
            'suggestedDate' => $suggested_date
        ];
        sendEmail(DECLINED_EMAIL, $email, $name, $additionalData);
        echo json_encode(['message' => 'Berhasil menolak data']);
        exit;
    }
}