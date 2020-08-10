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
    $page_location = "Profile";
    $page_description = "";
    $page_keywords = '';
    $page_display_title = $page_title . " | " . $page_location;
    require_once("inc/head.php");
?>
<body class="fix-header fix-sidebar card-no-border">

    <?php require_once("elements/preloader.php"); ?>

    <!-- Main wrapper - style you can find in pages.scss -->
    <div id="main-wrapper">

    <!-- Topbar header - style you can find in pages.scss -->
    <?php require_once("inc/header.php"); ?>
    <!-- End Topbar header -->

            <!-- Left Sidebar - style you can find in sidebar.scss  -->
            <?php require_once("inc/sidebar_nav.php"); ?>
            <!-- End Left Sidebar - style you can find in sidebar.scss  -->

            <!-- Page wrapper  -->
            <div class="page-wrapper">
                <!-- Container fluid  -->
                <div class="container-fluid">
                    <!-- Bread crumb and right sidebar toggle -->
                    <?php require_once("elements/breadcrumbs.php"); ?>
                    <!-- End Bread crumb and right sidebar toggle -->

                    <?php
                        $user_profile = new User();
                        $img_handler = new Image();
                        $inquiry_handler = new Inquiry();

                        $user_profile_data = $user_profile->search($_SESSION['user_name'], $_SESSION['user_pwd']);
                        $img_count = $img_handler->get_img_count();
                        $user_count = $user_profile->get_user_count();
                        $inquiry_count = $inquiry_handler->get_inquiry_count();

                    ?>

                    <!-- Start Page Content -->
                    <!-- Row -->
                    <div class="row">
                        <!-- Column -->
                        <div class="col-lg-4 col-xlg-3 col-md-5">
                            <div class="card">
                                <div class="card-block">
                                    <center class="m-t-30">
                                        <div class="profile-circle" style="background-image: url(<?php echo  $user_profile_data['user_profile_img']; ?>)">
                                            <div class="profile-caption-body"><span class="profile-caption"><a href="profile.php?editp=true"><i class="fal fa-fw fa-edit"></i>&nbsp;&nbsp;Edit</a></span></div>
                                        </div>
                                        <h4 class="card-title m-t-10"><?php echo $user_profile_data['user_first_name'] . ' ' . $user_profile_data['user_last_name'] ?></h4>
                                        <h6 class="card-subtitle"><?php echo $user_profile_data['user_type']; ?></h6>
                                        <div class="row text-center justify-content-md-center">
                                            <div class="col-4"><a href="javascript:void(0)" class="link"><i class="fal fa-users-crown"></i>&nbsp;&nbsp;<font class="font-medium"><?php echo $user_count; ?></font></a></div>
                                            <div class="col-4"><a href="manage-img.php" class="link"><i class="fal fa-images"></i>&nbsp;&nbsp;<font class="font-medium"><?php echo $img_count; ?></font></a></div>
                                            <div class="col-4"><a href="inquiry.php" class="link"><i class="fal fa-envelope-open-text"></i>&nbsp;&nbsp;<font class="font-medium"><?php echo $inquiry_count; ?></font></a></div>
                                        </div>
                                    </center>
                                </div>
                            </div>

                            <?php
                                if (isset($_GET['editp'])) {
                                    require_once("elements/forms/user_edit_profile_img.form.php");
                                }
                            ?>
                        </div>
                        <!-- Column -->
                        <?php require_once("elements/forms/user_update.form.php"); ?>
                    </div>
                    <!-- Row -->

                    <!-- End page Content -->

                </div>
                <!-- End Container fluid  -->

            <!-- begin footer -->
            <?php require_once("inc/footer.php"); ?>
            <!-- End footer -->
            </div>
            <!-- End Page wrapper  -->
    </div>
    <!-- End Wrapper -->
</body>
<?php require_once("inc/scripts.php"); ?>
</html>
