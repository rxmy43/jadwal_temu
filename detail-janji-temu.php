<?php 
    $pageTitle = "Data Buku Tamu - PT PLN";
    $cssFiles = ["css/badge.css", "css/alert.css", "css/modal.css", "css/form_buku_tamu.css", "css/jadwal_janji.css"];
    $additionalLinks = ['<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />'];

    session_start();

    include "./php/config.php";
    include "./layouts/header.php";
    include "./funcs/guardFuncs.php";

    checkAuth();

    $id = $_GET['id'];

    $sql = "SELECT * FROM reservasi_tamu WHERE jenis_reservasi = 'janji_temu' AND id = $id";

    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);
?>

<div class="overlay"></div>
    <div class="container">
        <div class="alert" style="display: none">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
            <strong id="message"></strong>
        </div>
        <h2>Detail Temu</h2>
        <form action="" method="POST" id="form_jadwal_janji_temu" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group-left">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" value="<?= $row['nama_tamu']; ?>">
                </div>

                <div class="form-group-right">
                    <label for="alamat">Alamat</label>
                    <input type="text" id="alamat" name="alamat" value="<?= $row['alamat']; ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group-left">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <input type="text" value="<?= $row['jenis_kelamin'] === "l" ? "Laki-laki" : "Perempuan"; ?>">
                </div>
                <div class="form-group-right">
                    <label for="keperluan">Keperluan</label>
                    <input type="text" id="keperluan" name="keperluan" value="<?= $row['keperluan']; ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group-left">
                    <label for="jam">Jam Janji</label>
                    <input type="time" id="jam" name="jam" value="<?= $row['jam']; ?>">
                </div>

                <div class="form-group-right">
                    <label for="tanggal">Tanggal Janji</label>
                    <input type="date" id="tanggal" name="tanggal" value="<?= $row['tanggal']; ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group-left">
                    <label for="jumlah_orang">Jumlah Orang </label>
                    <input type="number" step="1" min="1" id="jumlah_orang" name="jumlah_orang" value="<?= $row['jumlah_orang']; ?>">
                </div>

                <div class="form-group-right">
                    <label for="email">Email Tamu</label>
                    <input type="email" id="email" name="email" value="<?= $row['email_pemohon']; ?>">
                </div>

            </div>
            <div class="form-row">
                <div class="form-group-left">
                    <img src="<?= $row['foto']; ?>" alt="" width="150" height="150">
                </div>
                <div class="form-group-right">
                    <label for="photo">Instansi</label>
                    <input type="text" id="instansi" name="instansi" value="<?= $row['instansi']; ?>">
                </div>
            </div>
            <div style="margin-top: 10px; display: flex; justify-content: center; gap: 20px">
                <button class="approve" type="button" data-id="<?= $_GET['id']; ?>" onclick="confirmationModal(this, true)">setujui</button>
                <button class="reject" type="button" data-id="<?= $_GET['id']; ?>" onclick="confirmationModal(this, false)">tolak</button>
            </div>
        </form>
    </div>

    <div id="confirm_modal" class="modal" style="z-index: 999 !important">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h4 id="confirm_text" style="color:#222"></h4>
            <form style="margin-bottom: 15px;padding: 10px" id="form_alasan_penolakan">
                <label for="alasan_penolakan"style="color:#222">Alasan Penolakan</label>
                <textarea name="alasan_penolakan" id="alasan_penolakan" rows="3" cols="68" style="font-family: arial;color:#222"></textarea>
                <label for="suggested_date"style="color:#222">Rekomendasi Pengajuan Kembali</label><br>
                <input type="date" name="suggested_date" id="suggested_date" style="width: 97.5%; font-family: arial;color:#222">
            </form>
            <button type="button" id="confirm_button"></button>
            <button type="button" id="cancel_button">Batal</button>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./js/modal.js" defer></script>
    <script src="./js/detail_tamu.js"></script>