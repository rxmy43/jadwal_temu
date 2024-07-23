<?php 

    session_start();
    include_once "./php/config.php";
    include_once "./funcs/guardFuncs.php";

    checkAuth();

    $pageTitle = "Dashboard";
    $cssFiles = ["css/dashboard.css", "css/jadwal_janji.css", "/css/modal.css"];
    $additionalLinks = ['<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />'];

    include "./layouts/header.php";
    include "./funcs/dateFuncs.php";
?>
    <!-- Navbar -->
     <?php include "./partials/_navbar.php" ?>
     <!-- Navbar -->
    <div class="container">
        <!-- Sidebar -->
         <?php include "./partials/_sidebar.php" ?>
         <!-- Sidebar -->
        <div class="content">
            <h1>Dashboard Admin</h1>
            <p><?= get_current_date(); ?></p>
            <div style="display: flex; border-bottom: 1px solid #ccc; margin-top: 35px;">
                <div class="container-cards">
                    <div class="card card-total-tamu">
                        <div style="display: flex; align-items: center; justify-content: space-between;">
                            <div class="card-value" id="total-tamu">0</div>
                            <i style="font-size: 20px;" class="fa-solid fa-users"></i>
                        </div>
                        <div class="card-title">Total Tamu</div>
                    </div>
                    <div class="card card-tamu-hari-ini">
                        <div style="display: flex; align-items: center; justify-content: space-between;">
                            <div class="card-value" id="tamu-hari-ini">0</div>
                            <i style="font-size: 20px;" class="fa-solid fa-user"></i>
                        </div>
                        <div class="card-title">Tamu Hari Ini</div>
                    </div>
                    <div class="card card-jadwal-temu">
                        <div style="display: flex; align-items: center; justify-content: space-between;">
                            <div class="card-value" id="jadwal-temu">0</div>
                            <i style="font-size: 20px;" class="fa-solid fa-clock"></i>
                        </div>
                        <div class="card-title">Jadwal janji temu</div>
                    </div>
                    <div style="margin-top: 2rem;">
                        <i id="refreshButton" class="fa-solid fa-arrows-rotate refresh-button"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="./js/dashboard_fetch_data.js"></script>
</body>

</html>