<?php 

    session_start();
    include_once "./php/config.php";
    include_once "./funcs/guardFuncs.php";

    checkAuth();
    checkRole($conn, ["Admin", "Karyawan"], getUniqueId());

    $pageTitle = "Jadwal Janji";
    $cssFiles = ["css/jadwal_janji.css", "css/dashboard.css", "css/badge.css", "css/alert.css", "css/modal.css", "css/sidebar.css", "css/navbar.css"];
    $additionalLinks = ['<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />'];

    include "./layouts/header.php";
    include "./funcs/dateFuncs.php";
?>

    <!-- Navbar -->
    <?php include "./partials/_navbar.php" ?>
     <!-- Navbar -->
    <!-- Sidebar -->
    <?php include "./partials/_sidebar.php" ?>
    <!-- Sidebar -->
        <div>
            <h1 class="j">Jadwal Janji</h1>
            <!-- <div class="alert success" style="margin-left: 260px; margin-top: 40px; width: 1024px;">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                <strong id="message">Berhasil menyetujui data</strong>
            </div> -->
            <div class="alert alert-dashboard" style="display:none">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                <strong id="message">Berhasil menyetujui data</strong>
            </div>
            <div class="s" style=" ">
                <div style=" display: flex; gap: 10px; align-items: center; margin-top: 10px">
                    <p style="font-weight: bold; font-size: 20px; ">show</p>
                    <select name="show" id="show" style="width: 60px; height: 30px; border-radius: 5px">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <p style="font-weight: bold; font-size: 20px; ">entries</p>
                </div>
                <div>
                    <input type="text" id="search" name="search" placeholder="Cari..." class="se" style="">
                </div>
            </div>
        </div>
        <div class="table-container">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>Telepon</th>
                        <th>Bertemu Dengan</th>
                        <th>Keperluan</th>
                        <th>Tanggal</th>
                        <th>Jumlah Orang</th>
                        <th>Foto Tamu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="data-container">
                    <!-- <tr>
                        <td data-label="No">1</td>
                        <td data-label="Nama">John Doe</td>
                        <td data-label="Nama">Email/td>
                        <td data-label="Alamat">Jl. Kebon Jeruk No. 5</td>
                        <td data-label="Jenis Kelamin">Laki-laki</td>
                        <td data-label="Telepon">081234567890</td>
                        <td data-label="Bertemu Dengan">Mr. Smith</td>
                        <td data-label="Keperluan">Meeting</td>
                        <td data-label="Jam Masuk">09:00</td>
                        <td data-label="Tanggal">2023-06-08</td>
                        <td data-label="Jumlah Orang">1</td>
                        <td data-label="Foto Tamu"><img src="https://via.placeholder.com/50" alt="Foto John"></td>
                        <td data-label="Edit"><button>Setujui</button></td>
                        <td data-label="Hapus"><button class="decline">Tolak</button></td>
                    </tr> -->
                    <!-- Tambahkan baris lainnya sesuai kebutuhan -->
                </tbody>
            </table>
        </div>
        <div id="pagination" style="" class="pagination">
            <!-- <a href="#">&laquo;</a>
            <a href="#">1</a>
            <a href="#" class="active">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#">6</a>
            <a href="#">&raquo;</a> -->
        </div>

    <div id="confirm_modal" class="modal">
        <div class="modal-content">
        <span class="close" onclick="this.parentElement.parentElement.style.display='none';">&times;</span>
            <h4 id="confirm_text" style="color:#222"></h4>
            <form style="margin-bottom: 15px;padding: 10px" id="form_alasan_penolakan">
                <label for="alasan_penolakan"style="color:#222">Alasan Penolakan</label>
                <textarea name="alasan_penolakan" id="alasan_penolakan" rows="3" cols="68" style="font-family: arial;color:#222"></textarea>
                <label for="suggested_date"style="color:#222">Rekomendasi Pengajuan Kembali</label><br>
                <input type="date" name="suggested_date" id="suggested_date" style="width: 97.5%; font-family: arial;color:#222">
            </form>
            <form style="margin-bottom: 15px;padding: 10px" id="form_edit_jadwal_janji__"></form>
            <button type="button" id="confirm_button"></button>
            <button type="button" id="cancel_button">Batal</button>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./js/modal.js" defer></script>
    <script src="./js/table_reservasi_tamu.js" defer></script>
</body>

</html>