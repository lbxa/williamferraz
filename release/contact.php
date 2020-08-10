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
    include_once("inc/header_includes.php");
    $page_title = "William Ferraz";
    $page_location = "Contact";
    $page_description = "";
    $page_keywords = '';
    $page_display_title = $page_title . " | " . $page_location;
    require_once('inc/head.php');
?>
<body>
<!-- begin master-wrapper -->
<div class="master-wrapper">
<?php require_once("inc/header.php"); ?>

<!-- begin content-wrapper -->
<div class="content-wrapper">
<!-- begin container-fluid -->
<div class="container-fluid">
    <div class="sub_30px"></div>
    <!-- begin row -->
    <div class="row">
        <div class="sub_30px"></div>

        <div class="col-md-6">
            <div class="contact-info">
                <h1 class="pg-title">Contact Info</h1>
                <p>William Ferraz</p>
                <p>Sydney, Australia</p>
                <p><a href="mailto:contact@williamferraz.com"><i class="fal fa-paper-plane"></i>&nbsp;&nbsp;contact@williamferraz.com</a></p>
            </div>
        </div>

        <?php
            if ((is_POST()) && (isset($_POST['inquriy_submit']))) {
                $inquiry_name = trim(filter_input(INPUT_POST, 'inquriy_name', FILTER_SANITIZE_STRING));
                $inquiry_contact = trim(filter_input(INPUT_POST, 'inquriy_contact', FILTER_SANITIZE_STRING));
                $inquiry_details = trim(filter_input(INPUT_POST, 'inquriy_details', FILTER_SANITIZE_STRING));
                $inquiry_date = date("Y-m-d");

                $inquiry_handler = new Inquiry();
                $inquiry_handler->create($inquiry_name, $inquiry_contact, $inquiry_details, $inquiry_date);
                $inquiry_handler->upload();
            }
        ?>

        <div class="col-md-6">
        <form class="exp-form" action="" method="POST">
            <div class="form-group">
                <input type="text" class="contact-form-input" name="inquriy_name" required>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label class="contact-form-label">Name</label>
            </div>

            <div class="form-group">
                <input type="text" class="contact-form-input" name="inquriy_contact" required>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label class="contact-form-label">Contact</label>
            </div>

            <div class="form-group">
                <textarea class="contact-form-input" name="inquriy_details" required></textarea>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label class="contact-form-label">Inquiry</label>
            </div>

            <div class="ripple-box">
                <button type="submit" name="inquriy_submit" class="btn btn-dark btn-ripple">Send</button>
            </div>
        </form>

        </div>

    </div>
    <!-- end row -->


</div>
<!-- end container-fluid -->
</div>
<!-- end content-wrapper -->
</div>
<!-- end master-wrapper -->
<div class="sub_20px"></div>
<?php require_once("inc/footer.php"); ?>
</body>
<?php require_once("inc/scripts.php"); ?>
</html>
