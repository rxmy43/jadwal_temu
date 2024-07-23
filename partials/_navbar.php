<nav class="navbar">
    <div class="logo">
        <img src="images/logo.png" alt="">
        <h1>PT.PLN(Persero) UP2B Kaltimra</h1>
    </div>
    <a class="logout-button" href="#" onclick="document.getElementById('logout_modal').style.display='block'">Logout
        <i class="fa-solid fa-right-from-bracket"></i>
    </a>
</nav>

<div id="logout_modal" class="modal" style="display: none;">
        <div class="modal-content">
        <span class="close" onclick="this.parentElement.parentElement.style.display='none';">&times;</span>
        <div>
            <h3>Apakah Anda yakin ingin keluar?</h3>
            <button class="decline" onclick="window.location.href='logout.php'">Logout</button>
            <button class="cancel" onclick="this.parentElement.parentElement.parentElement.style.display='none';">Batal</button>
        </div>
        </div>
    </div>