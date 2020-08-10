<!--
 ___       __   ___  ___       ___       ___  ________  _____ ______           ________ _______   ________  ________  ________  ________
|\  \     |\  \|\  \|\  \     |\  \     |\  \|\   __  \|\   _ \  _   \        |\  _____\\  ___ \ |\   __  \|\   __  \|\   __  \|\_____  \
\ \  \    \ \  \ \  \ \  \    \ \  \    \ \  \ \  \|\  \ \  \\\__\ \  \       \ \  \__/\ \   __/|\ \  \|\  \ \  \|\  \ \  \|\  \\|___/  /|
 \ \  \  __\ \  \ \  \ \  \    \ \  \    \ \  \ \   __  \ \  \\|__| \  \       \ \   __\\ \  \_|/_\ \   _  _\ \   _  _\ \   __  \   /  / /
  \ \  \|\__\_\  \ \  \ \  \____\ \  \____\ \  \ \  \ \  \ \  \    \ \  \       \ \  \_| \ \  \_|\ \ \  \\  \\ \  \\  \\ \  \ \  \ /  /_/__
   \ \____________\ \__\ \_______\ \_______\ \__\ \__\ \__\ \__\    \ \__\       \ \__\   \ \_______\ \__\\ _\\ \__\\ _\\ \__\ \__\\________\
    \|____________|\|__|\|_______|\|_______|\|__|\|__|\|__|\|__|     \|__|        \|__|    \|_______|\|__|\|__|\|__|\|__|\|__|\|__|\|_______|
 -->
<!DOCTYPE html>                  <!-- williamferraz.com Mark 1 -->
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en">
<?php
    require_once("inc/header_includes.php");
    $page_title = "William Ferraz | Admin";
    $page_location = "Login";
    $page_description = "";
    $page_keywords = '';
    $page_display_title = $page_title . " | " . $page_location;
    require_once("inc/head.php");
?>
<body class="login">
<div class="login-background-col"></div>
<div class="login-body">
    <div class="login-card">
        <img src="logo/WFerraz_logo_Tranparent_small.png" alt="Logo" class="img-responsive login-img">
        <h4 style="font-weight: 200; margin-bottom: 50px;">Sign In</h4>

        <form class="exp-form" action="admin/php/login_service.php" method="POST">
            <div class="form-group">
                <input type="text" name="user_name" class="contact-form-input login-form-input" required>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label class="contact-form-label login-form-label">User Name</label>
            </div>

            <div class="form-group">
                <input type="password" name="user_pwd" class="contact-form-input login-form-input" required>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label class="contact-form-label login-form-label">Password</label>
            </div>

            <div class="ripple-box">
                <button type="submit" name="login_submit" class="btn btn-dark btn-ripple">Sign In</button>
            </div>
        </form>
    </div>
</div>




</body>
<?php require_once("inc/scripts.php"); ?>
</html>
