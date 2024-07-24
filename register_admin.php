<?php 
    $pageTitle = "Register Admin";
    $cssFiles = ["css/login.css", "css/alert.css"];
    $additionalLinks = ['<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />'];

    include "./layouts/header.php";
?>
    <div class="main-register">
        <div class="alert failure" style="display: none">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
            <strong id="alert-message"></strong>
        </div>
        <!-- <input type="checkbox" id="chk" aria-hidden="true"> -->
        <div class="login">
            <form action="" method="POST" class="form" id="admin_register_form">
                <div class="img">
                    <img src="images/book.jpg" alt="">
                </div>
                <label for="chk" aria-hidden="true">Register Admin</label>
                <div class="input-container">
                    <input class="input" type="text" name="register_full_name" placeholder="Nama Admin" required="">
                </div>
                <div class="input-container">
                    <input class="input" type="text" name="register_username" placeholder="Username" required="">
                </div>
                <div class="input-container">
                    <input class="input" type="email" name="register_email" placeholder="Email" required="">
                </div>
                <div class="input-container">
                    <input class="input" type="password" name="register_password" id="password" placeholder="Password" required="">
                    <button type="button" class="show-password" onclick="togglePassword(this, 'password')">Show</button>
                </div>
                <div class="input-container">
                    <input class="input" type="text" name="register_nip" placeholder="NIP" required="">
                </div>
                <div class="input-container">
                    <input class="input" type="text" name="register_phone" placeholder="Nomor Telepon" required="">
                </div>
                <button type="submit">Register</button>
            </form>
        </div>
    </div>

    <script src="./js/register.js"></script>
    <script src="./js/form_util.js"></script>
</body>

</html>