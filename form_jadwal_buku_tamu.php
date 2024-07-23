<?php 
    $pageTitle = "Data Buku Tamu - PT PLN";
    $cssFiles = ["css/form_buku_tamu.css", "css/alert.css"];
    $additionalLinks = ['<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />'];

    include "./php/config.php";
    include "./layouts/header.php";
?>
    <div class="overlay"></div>
    <div class="container">
        <div class="alert" style="display: none">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
            <strong id="message"></strong>
        </div>
        <h2>Data Buku Tamu</h2>
        <form action="" method="POST" id="form_jadwal_buku_tamu" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group-left">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" required>
                </div>

                <div class="form-group-right">
                    <label for="alamat">Alamat</label>
                    <input type="text" id="alamat" name="alamat" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group-left">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                        <option value="l">Laki-laki</option>
                        <option value="p">Perempuan</option>
                    </select>
                </div>
                
                <div class="form-group-right">
                    <label for="karyawan">Karyawan yang Dituju</label>
                    <?php 
                        $karyawan_query = mysqli_query($conn, "SELECT id, nama_karyawan, nomor_telepon  FROM karyawan")
                    ?>
                    <select id="karyawan" name="karyawan" required>
                        <option value="" disabled selected>Pilih Karyawan</option>
                        <?php if (mysqli_num_rows($karyawan_query) > 0) : ?>
                            <?php while($row = mysqli_fetch_assoc($karyawan_query)) : ?>
                                <option value="<?= $row['id']; ?>"><?= $row['nama_karyawan']; ?></option>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group-left">
                    <label for="keperluan">Keperluan</label>
                    <input type="text" id="keperluan" name="keperluan" required>
                </div>
                <div class="form-group-right">
                    <label for="nomor_telepon">Nomor Telp Tamu</label>
                    <input type="text" id="nomor_telepon" name="nomor_telepon" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group-left">
                    <label for="jam_masuk">Jam Masuk</label>
                    <input type="time" id="jam_masuk" name="jam_masuk" required>
                </div>
                <div class="form-group-right">
                    <label for="tanggal">Tanggal Masuk</label>
                    <input type="date" id="tanggal" name="tanggal" required>
                </div>
            </div>

            <div class="form-row">
             <div class="form-group-left">
                    <label for="photo">Photo</label>
                    <input type="file" id="photo" name="photo" required class="file">
                </div>
                <div class="form-group-right">
                    <label for="jumlah_orang">Jumlah Orang </label>
                    <input type="number" step="1" min="1" id="jumlah_orang" name="jumlah_orang" required>
                </div>
                
            </div>
            <div class="form-row">
                <div class="form-group-left">
                    <label for="email">Email Anda</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group-right">
                    <label for="photo">Instansi</label>
                    <input type="text" id="instansi" name="instansi" required>
                </div>
            </div>
            <div style="margin-top: 10px; display: flex; justify-content: center; gap: 20px">
                <button class="send" type="submit">send</button>
                <button class="cancel" type="reset">cancel</button>
            </div>
        </form>
    </div>

    <script src="./js/tambah_reservasi_tamu.js"></script>
</body>

</html>