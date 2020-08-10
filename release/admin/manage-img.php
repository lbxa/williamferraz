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
    $page_location = "Image Management";
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

                    <!-- Start Page Content -->

                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                        <?php
                            $img_cat_handler = new Category();
                            $img_row_handler = new Image();

                            if (isset($_GET['del'])) {
                                $deleted_img_id = trim(filter_input(INPUT_GET, 'del', FILTER_SANITIZE_NUMBER_INT));
                                $img_row_handler->delete($deleted_img_id);
                                include_once('elements/alerts/img-delete-success.php');
                                header("refresh:2;url=" . $_SERVER['PHP_SELF']);
                            }

                            if (isset($_GET['flag'])) {
                                $flagged_img_id = trim(filter_input(INPUT_GET, 'flag', FILTER_SANITIZE_NUMBER_INT));
                                $img_row_handler->toggle_img_status($flagged_img_id);
                                //include_once('elements/alerts/img-toggle-success.php');
                                header("Location:" . $_SERVER['PHP_SELF']);
                            }
                        ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="flix-slider">
                            <h2 class="flix-slider-title"><i class="fal fa-pennant"></i>&nbsp;&nbsp;Carousel</h2>
                            <div class="flix-slider-row">
                            <?php
                            $img_list = $img_row_handler->get_active_imgs(1000);
                            $counter = 0;
                            foreach ($img_list as $img_data) {
                                $img_file_path = '../img_repo/' . $img_data['img_category'] . '/' . $img_data['img_file_name'];
                                $img_state = $img_row_handler->check_if_img_active($img_data['img_id']);
                                $counter++;
                                // end PHP code block
                            ?>
                            <div class="flix-slider-tile" style="background-image: url('<?php echo $img_file_path; ?>');">
                                <div class="flix-slider-tile-menu">
                                    <ul class="flix-slider-tile-menu-ul">
                                        <li class="flix-slider-tile-menu-li">
                                            <a href="manage-img.php?del=<?php echo $img_data['img_id']; ?>" class="img-del"><i class="fal fa-trash-alt"></i></a>
                                        </li>
                                        <li class="flix-slider-tile-menu-li">
                                            <a href="upload-img.php?edit=<?php echo$img_data['img_id']; ?>"><i class="fal fa-edit"></i></a>
                                        </li>
                                        <li class="flix-slider-tile-menu-li">
                                            <a href="manage-img.php?flag=<?php echo$img_data['img_id']; ?>" class="img-toggle <?php if ($img_state) echo 'active-img'; ?>"><i class="fal fa-pennant"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <?php
                                // continue PHP code block
                            }
                            ?>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                        <?php
                        if ($counter < 4) {
                            include_once("elements/alerts/img-toggle-warning.php");
                        }
                        ?>
                        </div>
                    </div>

                    <hr><br>

                    <?php
                        $cat_list = $img_cat_handler->get_all_assoc();
                        foreach ($cat_list as $curr_cat) {
                        // end PHP code block
                    ?>
                    <div class="row">
                        <div class="flix-slider">
                            <h2 class="flix-slider-title"><?php echo ucfirst($curr_cat); ?></h2>
                            <div class="flix-slider-row">
                            <?php
                            $img_list = $img_row_handler->get_entire_cat_imgs($curr_cat);
                            foreach ($img_list as $img_data) {
                                $img_file_path = '../img_repo/' . $curr_cat . '/' . $img_data['img_file_name'];
                                $img_state = $img_row_handler->check_if_img_active($img_data['img_id']);
                                // end PHP code block
                            ?>
                            <div class="flix-slider-tile" style="background-image: url('<?php echo $img_file_path; ?>');">
                                <div class="flix-slider-tile-menu">
                                    <ul class="flix-slider-tile-menu-ul">
                                        <li class="flix-slider-tile-menu-li">
                                            <a href="manage-img.php?del=<?php echo $img_data['img_id']; ?>" class="img-del"><i class="fal fa-trash-alt"></i></a>
                                        </li>
                                        <li class="flix-slider-tile-menu-li">
                                            <a href="upload-img.php?edit=<?php echo$img_data['img_id']; ?>"><i class="fal fa-edit"></i></a>
                                        </li>
                                        <li class="flix-slider-tile-menu-li">
                                            <a href="manage-img.php?flag=<?php echo$img_data['img_id']; ?>" class="img-toggle <?php if ($img_state) echo 'active-img'; ?>"><i class="fal fa-pennant"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <?php
                                // continue PHP code block
                            }
                            ?>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                    <?php
                        // continue PHP code block
                    } // end foreach loop
                    ?>

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
