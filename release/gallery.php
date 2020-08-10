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


<!-- begin container-fluid -->
<div class="container-fluid">
    <div class="sub_30px"></div>

    <!-- begin row -->
    <div class="row">
    <?php
        if ((is_GET()) && (isset($_GET["cat"]))) {
            $user_selected_category = trim(filter_input(INPUT_GET, "cat", FILTER_SANITIZE_STRING));
        }

        if (isset($user_selected_category)) {
            $img_handler = new Image_Controller("img_repo/" . $user_selected_category . "/");
            $img_gallery= $img_handler->list_col_3x();
            for ($i = 0; $i < count($img_gallery); $i++) {
                if ($i == 0) {
                    echo '<!-- start column -->';
                    echo '<div class="col-md-4">';
                }

                if ($img_gallery[$i] != "#") {
                    echo $img_gallery[$i];  // avoid displaying partitions on website
                }

                if ($img_gallery[$i] == "#") {
                    echo '</div>';
                    echo '<!-- end column -->';
                }

                /*
                ** Execute this block sequentially. Must be after above block.
                ** prints beginning of column for every interation that ins't first
                ** or last
                */
                if (($img_gallery[$i] == "#") && ($i != 0) && ($i != count($img_gallery) - 1)) {
                    echo '<!-- start column -->';
                    echo '<div class="col-md-4">';
                }
            }
        } else {
            // create default page if user alters URL
        }
    ?>
    </div>
    <!-- end row -->

</div>
<!-- end container-fluid -->

</div>
<!-- end master-wrapper -->

<div class="sub_20px"></div>
<?php require_once("inc/footer.php"); ?>
</body>
<?php require_once("inc/scripts.php"); ?>
</html>
