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
    $page_location = "Categories";
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

                    <!-- begin row -->
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                        <?php
                            require_once("elements/forms/add_cat.form.php");

                            if (isset($_GET['edit'])) {
                                $cat_id = trim(filter_input(INPUT_GET, 'edit', FILTER_SANITIZE_NUMBER_INT));
                                include_once("elements/forms/edit_cat.form.php");
                            }
                        ?>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="card">
                                <div class="card-block">
                                    <h4 class="card-title">All Categories</h4>
                                    <?php
                                        $cat_table = new Category();
                                        echo $cat_table->display_table();

                                        // CATEGORY DELETION QUERY
                                        if (isset($_GET['del'])) {
                                            $cat_id = trim(filter_input(INPUT_GET, 'del', FILTER_SANITIZE_NUMBER_INT));
                                            $deleted_cat_handler = new Category();
                                            $deleted_cat_handler->delete($cat_id);
                                            header('Location:' . $_SERVER['PHP_SELF']);
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- end row -->

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
