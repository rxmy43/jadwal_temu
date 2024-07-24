<?php 

    session_start();
    include_once "./php/config.php";
    include_once "./funcs/guardFuncs.php";

    checkAuth();
    checkRole($conn, ["Admin", "Petugas"], getUniqueId());

    $pageTitle = "Buku Tamu";
    $cssFiles = ["css/jadwal_janji.css", "css/dashboard.css", "css/badge.css", "css/alert.css", "css/modal.css", "css/buku_tamu.css", "css/sidebar.css", "css/navbar.css"];
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
        <h1 class="b">Buku Tamu</h1>
        <div class="dropdown">
            <div class="dropbtn">
                <button style=" width: 200px; height: 30px; border-radius: 5px;cursor:pointer;" class="export" onclick="document.getElementById('export_modal').style.display='block'"><i class="fa-solid fa-book"></i>&nbsp;Rekapan Data</button>
            </div>
        </div>
        <div class="con" style="">
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
                <input type="text" id="search" name="search" placeholder="Cari..." style="" class="sea">
            </div>
       </div>
    </div>
    <div class="table-container">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Tamu</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>No Telp Tamu</th>
                    <th>Nama Karyawan</th>
                    <th>Keperluan</th>
                    <th>Jam Janji</th>
                    <th>Jam Masuk</th>
                    <th colspan="2" align="center">Aksi</th>
                </tr>
            </thead>
            <tbody id="data-container">
                <!-- <tr>
                    <td data-label="No">1</td>
                    <td data-label="Nama">John Doe</td>
                    <td data-label="Alamat">Jl. Kebon Jeruk No. 5</td>
                    <td data-label="Jenis Kelamin">Laki-laki</td>
                    <td data-label="Telepon">081234567890</td>
                    <td data-label="Bertemu Dengan">Mr. Smith</td>
                    <td data-label="Keperluan">Meeting</td>
                    <td data-label="Jam Masuk">09:00</td>
                    <td data-label="Tanggal">2023-06-08</td>
                    <td data-label="Jumlah Orang">1</td>
                    <td data-label="Foto Tamu"><img src="https://via.placeholder.com/50" alt="Foto John"></td>
                    <td data-label="Edit"><button>PDF</button></td>
                    <td data-label="Hapus"><button>Excel</button></td>
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

    <!-- Export Excel Modal -->
    <div id="export_modal" class="modal">
        <div class="modal-content">
        <span class="close" onclick="this.parentElement.parentElement.style.display='none';">&times;</span>
        <div>
            <h3>Pilih Jangka Waktu Rekapan</h3>
            <select name="interval" id="interval">
                <option value="1">1 Bulan</option>
                <option value="3">3 Bulan</option>
            </select>
            <button id="exportExcel">Export</button>
            <button class="cancel" onclick="this.parentElement.parentElement.parentElement.style.display='none';">Batal</button>
        </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
        <span class="close" onclick="this.parentElement.parentElement.style.display='none';">&times;</span>
            <h2>Edit Buku Tamu</h2>
            <div class="alert" style="display: none;">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                <strong id="message"></strong>
            </div>
            <form method="POST" id="form_edit_buku_tamu">
                <label for="nama_tamu">Nama Tamu:</label>
                <input type="text" id="nama_tamu" name="nama_tamu">
                <label for="alamat">Alamat:</label>
                <textarea type="text" id="alamat" name="alamat"></textarea>
                <label for="jenis_kelamin">Jenis kelamin:</label>
                <select name="jenis_kelamin" id="jenis_kelamin">
                    <option value="l">Laki-laki</option>
                    <option value="p">Perempuan</option>
                </select>
                <?php 
                    $karyawanQuery = mysqli_query($conn, "SELECT id, nama_karyawan FROM karyawan ORDER BY id DESC");
                ?>
                <label for="karyawan_id">Nama Karyawan:</label>
                <select name="karyawan_id" id="karyawan_id">
                    <?php while($karyawanRow = mysqli_fetch_assoc($karyawanQuery)) : ?>
                        <option value="<?= $karyawanRow['id']; ?>"><?= $karyawanRow['nama_karyawan']; ?></option>
                    <?php endwhile; ?>
                </select>
                <label for="keperluan">Keperluan:</label>
                <input type="text" id="keperluan" name="keperluan">
                <label for="jam_janji">Jam Janji:</label>
                <input type="time" id="jam_janji" name="jam_janji">
                <label for="jam_masuk">Jam Masuk:</label>
                <input type="time" id="jam_masuk" name="jam_masuk">
                <label for="tanggal">Tanggal:</label>
                <input type="date" id="tanggal" name="tanggal">
                <label for="jumlah_orang">Jumlah Orang:</label>
                <input type="text" id="jumlah_orang" name="jumlah_orang">
                <label for="instansi">Instansi:</label>
                <input type="text" id="instansi" name="instansi">
                <img src="" alt="" id="img_foto" width="250" height="250">
                <label for="foto">Foto:</label>
                <input type="file" id="foto" name="foto">
                <label for="email_pemohon">Email Pemohon:</label>
                <input type="text" id="email_pemohon" name="email_pemohon">
                <button type="submit">Ubah</button>
            </form>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="this.parentElement.parentElement.style.display='none';">&times;</span>
            <h2>Hapus Data Buku Tamu</h2>
            <div class="alert alert-dashboard" style="display: none;">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                <strong id="message"></strong>
            </div>
            <h4>Apakah anda yakin ingin menghapus buku tamu <span id="deletion_name"></span>?</h4>
            <form method="POST" id="form_delete_buku_tamu" style="display:flex;flex-direction:row !important;justify-content:end !important;gap:8px !important">
                <button type="button" class="cancel" onclick="this.parentElement.parentElement.parentElement.style.display='none';">Batal</button>
                <button type="submit" class="decline">Hapus</button>
            </form>
        </div>
    </div>

</body>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./js/modal.js" defer></script>
    <script src="./js/edit_delete_buku_tamu.js" defer></script>
    <script src="./js/table_reservasi_tamu.js" defer></script>
    <script>
        document.getElementById('exportExcel').addEventListener('click', function() {
            var button = this;
            var originalText = button.innerHTML;

            button.innerHTML = "Loading...";

            fetch('php/export_excel.php', {
                headers: {
                    'Content-Type': 'application/json' // Use application/json for JSON data
                },
                method: 'POST',
                body: JSON.stringify({ interval: document.querySelector("#export_modal #interval").value })
            })
            .then(response => response.blob())
            .then(blob => {
                var link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.download = 'buku_tamu.xlsx'; // Set the desired file name
                link.click();

                // Reset button text to the original
                button.innerHTML = originalText;
            })
            .catch(error => {
                console.error('Error:', error);
                button.innerHTML = originalText; // Reset button text in case of error
            });
        });

        // script.js
        // document.addEventListener('DOMContentLoaded', function() {
        //     const dropbtn = document.querySelector('.dropbtn');
        //     const dropdown = document.querySelector('.dropdown');
            
        //     dropbtn.addEventListener('click', function() {
        //         dropdown.classList.toggle('show');
        //     });

            

        //     document.getElementById('exportPdf').addEventListener('click', function() {
        //         window.location.href = 'php/export_pdf.php';
        //     });
            
        //     // Close the dropdown if the user clicks outside of it
        //     window.onclick = function(event) {
        //         if (!event.target.matches('.dropbtn')) {
        //             if (dropdown.classList.contains('show')) {
        //                 dropdown.classList.remove('show');
        //             }
        //         }
        //     }
        // });

    </script>
</html>