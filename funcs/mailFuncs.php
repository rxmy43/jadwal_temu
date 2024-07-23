<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

const SUCCESS_EMAIL = "success_email";
const APPROVED_EMAIL = "approved_email";
const DECLINED_EMAIL = "declined_email";

function sendEmail($type, $to, $name, $additionalData = [], $rev_type = '') {
    $mail = new PHPMailer(true);

    $from = "ramyabyyu907@gmail.com";

    try {
        // Server settings
        $mail->SMTPDebug = 0; // Enable verbose debug output
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'ramyabyyu907@gmail.com'; // SMTP username
        $mail->Password = 'vquxgwcywxwncyjo'; // SMTP password (use app-specific password)
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587; // TCP port to connect to

        $message = getMessage($type, $to, $name, $additionalData, $rev_type);

        // Sender
        $mail->setFrom($from, 'Ramy Abyyu');

        // Recipient
        $mail->addAddress($to, $name); // Add a recipient

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $message['subject'];
        $mail->Body    = $message['body'];
        // $mail->addEmbeddedImage('../images/logo.png', 'pln_logo');

        $mail->send();
    } catch (Exception $e) {
        echo "<script>
            alert('Sending email failed. Mailer Error: {$mail->ErrorInfo}');
        </script>";
        exit;
    }
}

function getMessage($type, $to, $name, $additionalData = [], $rev_type = '') {
    switch ($type) {
        case SUCCESS_EMAIL:
            $subject = "Terima Kasih Telah Melakukan $rev_type";
            $rev_type = strtolower($rev_type);
            $body = "
            <html>
            <body>
            <p>Balikpapan, " . date('d m Y') . "</p>
            <p>Kepada YTH: $name</p>
            <p>Dengan hormat,</p>
            <p>Terima kasih telah melakukan jadwal janji temu. Harap tunggu informasi selanjutnya.</p>
            <p>Terima kasih.</p>
            </body>
            </html>
            ";
            break;

        case APPROVED_EMAIL:
            $subject = "Konfirmasi Persetujuan Jadwal Janji Temu";
            $karyawan = $additionalData['karyawan'];
            $nama = $additionalData['nama_tamu'];
            $alamat = $additionalData['alamat'];
            $jenisKelamin = $additionalData['jenisKelamin'] === "l" ? "Laki-laki" : "Perempuan";
            $phone = $additionalData['phone'];
            $keperluan = $additionalData['keperluan'];
            $jam = $additionalData['jam'];
            $jumlahOrang = $additionalData['jumlahOrang'];
            $contactNumber = "0812343445;"; // Ganti dengan nomor kontak PLN
            $body = "
            <html>
            <body>
            <p>Yth. $name,</p>
            <p>Dengan hormat,</p>
            <p>Kami mengucapkan terima kasih telah melakukan jadwal janji temu dengan PLN. Kami dengan senang hati menginformasikan bahwa permohonan janji temu Anda telah disetujui.</p>
            <p>Berikut adalah rincian janji temu Anda:</p> <br>
            <p style='margin: 0;padding: 0'>Nama : $nama</p> <br>
            <p style='margin: 0;padding: 0'>Alamat : $alamat</p> <br>
            <p style='margin: 0;padding: 0'>Jenis Kelamin : $jenisKelamin</p> <br>
            <p style='margin: 0;padding: 0'>Karyawan yang Dituju : $karyawan</p> <br>
            <p style='margin: 0;padding: 0'>Nomor Telp Karyawan : $phone</p> <br>
            <p style='margin: 0;padding: 0'>Keperluan : $keperluan</p> <br>
            <p style='margin: 0;padding: 0'>jam : $jam</p> <br>
            <p style='margin: 0;padding: 0'>jumlahOrang : $jumlahOrang</p> <br>
            <p style='margin: 0;padding: 0'>Harap hadir tepat waktu dan membawa dokumen yang diperlukan. Jika ada pertanyaan lebih lanjut, jangan ragu untuk menghubungi kami melalui email ini atau telepon $contactNumber.</p>
            <p style='margin: 0;padding: 0'>Terima kasih atas perhatian dan kerjasamanya.</p> <br>
            <p>Hormat kami,</p>
            </body>
            </html>
            ";
            break;

        case DECLINED_EMAIL:
            $subject = "Pemberitahuan Penolakan Jadwal Janji Temu";
            $declineReason = $additionalData['declineReason'];
            $suggestedDate = date('d m Y', strtotime($additionalData['suggestedDate']));
            $body = "
            <html>
            <body>
            <p>Yth. $name,</p>
            <p>Dengan hormat,</p>
            <p>Kami mengucapkan terima kasih telah melakukan jadwal janji temu dengan PLN. Kami mohon maaf untuk menginformasikan bahwa permohonan janji temu Anda tidak dapat kami setujui pada saat ini.</p>
            <p>Alasan penolakan: $declineReason</p>
            <p>Kami sangat menghargai pengertian Anda dan kami menyarankan anda untuk menjadwalkan ulang janji temu di lain tanggal $suggestedDate.</p>
            <p>Terima kasih atas perhatian dan kerjasamanya.</p>
            </body>
            </html>
            ";
            break;

        default:
            throw new Exception("Invalid email type provided.");
    }

    return [
        'subject' => $subject,
        'body' => $body
    ];
}