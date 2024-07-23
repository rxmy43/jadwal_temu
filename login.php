<?php 
    $pageTitle = "Login";
    $cssFiles = ["css/login.css", "css/alert.css"];
    $additionalLinks = ['<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />'];

    include "./layouts/header.php";
?>
    <div class="main">
        <div class="alert failure" style="display: none">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
            <strong id="alert-message"></strong>
        </div>
        <input type="checkbox" id="chk" aria-hidden="true">
        <div class="login">
            <form action="" method="POST" class="form" id="admin_login_form">
                <div class="img">
                    <img src="images/book.jpg" alt="">
                </div>
                <label for="chk" aria-hidden="true">Log in</label>
                <div class="input-container">
                    <input class="input" type="text" name="login_email" placeholder="Email / Username" required="">
                </div>
                <div class="input-container">
                    <input class="input" type="password" name="login_password" id="login_password" placeholder="Password" required="">
                    <button type="button" class="show-password" onclick="togglePassword(this, 'login_password')">Show</button>
                </div>
                <button type="submit">Log in</button>
            </form>
        </div>

        <div class="register">
            <form action="" method="POST" class="form" id="admin_register_form">
                <label for="chk" aria-hidden="true">Register</label>
                <input type="hidden" name="register_type" value="admin">
                <div class="input-container">
                    <input class="input" type="text" name="register_full_name" placeholder="Full Name" required="">
                </div>
                <div class="input-container">
                    <input class="input" type="text" name="register_username" placeholder="Username" required="">
                </div>
                <div class="input-container">
                    <input class="input" type="email" name="register_email" placeholder="Email" required="">
                </div>
                <div class="input-container">
                    <input class="input" type="password" name="register_password" placeholder="Password" id="register_password" required="">
                    <button type="button" class="show-password" onclick="togglePassword(this, 'register_password')">Show</button>
                </div>
                <div class="input-container">
                    <input class="input numeric-only" type="text" name="register_nip" placeholder="nip" required="" maxlength="20">
                </div>
                <div class="input-container">
                    <input class="input" type="text" name="register_phone" placeholder="Nomor Telepon" required="">
                </div>
                <button type="submit">Register</button>
            </form>
        </div>
    </div>

    <script src="./js/auth.js"></script>
    <script src="./js/form_util.js"></script>
</body>

</html>