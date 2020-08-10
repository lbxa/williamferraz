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
    $page_location = "Gallery";
    $page_description = "";
    $page_keywords = '';
    $page_display_title = $page_title . " | " . $page_location;
    require_once('inc/head.php');
?>
<body>
<!-- begin master-wrapper -->
<div class="master-wrapper">
<?php require_once("inc/header.php"); ?>

    <!-- <header>
        <ul class="header-ul">
            <li class="header-li"><a href="index.html"><img src="logos/WFerraz_logo_cropped.png" alt="William Ferraz Logo" class="header-logo-img img-responsive"/></a></li>
        </ul>
    </header>
    <nav>
        <ul class="nav-ul">
            <li class="nav-li"><a href="index.html">Home</a></li>
            <li class="nav-li"><a href="gallery.html">Gallery</a></li>
            <li class="nav-li"><a href="about.html">About</a></li>
            <li class="nav-li"><a href="contact.html">Contact</a></li>
        </ul>
    </nav> -->

<!-- begin content-wrapper -->
<div class="content-wrapper">
<!-- begin container-fluid -->
<div class="container-fluid">
    <div class="sub_30px"></div>

    <!-- begin row -->
    <div class="row">
        <div class="col-md-4">
            <div class="about-profile-img">
                <?php
                    $admin__profile_img_handler = new User();
                    $admin_data = $admin__profile_img_handler->get_admin_data();
                    $admin_img = "";
                    foreach ($admin_data as $curr_data_row) {
                        $admin_img = $curr_data_row['user_profile_img'];
                    }
                ?>
                <img class="about-img" src="<?php echo $admin_img = "admin/" . $admin_img; ?>" alt="Card image cap">
            </div>
        </div>
        <div class="col-md-8">
            <div class="about-profile-title">
                <h1 class="pg-title">About Me</h1>
            </div>
            <hr>
            <div class="about-pg-content">
            <?php
                $about_content = file_get_contents('admin/elements/about-page-content.html');
                echo htmlspecialchars_decode($about_content, ENT_QUOTES);
            ?>
            </div>
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
