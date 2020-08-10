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
    $page_location = "About Page";
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
                        <div class="col-sm-12 col-md-12 col-lg-12">
                        <?php
                            $about_pg_file = "elements/about-page-content.html";
                            if ((is_POST()) && (isset($_POST['about_pg_publish']))) {
                                //FILTER_SANITIZE_FULL_SPECIAL_CHARS is equivalent of calling htmlspecialchars($about_content);
                                $about_content = trim(filter_input(INPUT_POST, 'about_pg_content', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

                                // LOCK_EX flag preventS anyone else writing to the file at the same time
                                $file_updated = file_put_contents($about_pg_file, $about_content, LOCK_EX);
                                if ($file_updated != false) {
                                    include_once('elements/alerts/about-pg-file-update-success.php');
                                } else {
                                    include_once('elements/alerts/about-pg-file-update-failure.php');
                                }
                            }
                        ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <form class="form" action="" method="POST">
                                <div class="form-group">
                                    <label for="editor">About Content</label>
                                    <textarea name="about_pg_content" id="editor"><?php if (strlen(file_get_contents($about_pg_file)) > 0) echo file_get_contents($about_pg_file); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="about_pg_publish" class="btn btn-primary">Publish</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- end row -->

                    <script type="text/javascript">
                    // CKEditor script link
                    window.onload = function() {
                        ClassicEditor
                            .create( document.querySelector( '#editor' ) )
                            .catch(error => {
                                console.error( error );
                            });
                    };

                    </script>
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
