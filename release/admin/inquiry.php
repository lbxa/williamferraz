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
    $page_location = "Inquiries";
    $page_description = "";
    $page_keywords = '';
    $page_display_title = $page_title . " | " . $page_location;
    require_once("inc/head.php");
?>
<body class="fix-header fix-sidebar card-no-border">
    <style media="screen">
        button:focus, button:active {
            outline: none !important;
        }
    </style>
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
                            $inquiry_handler = new Inquiry();
                            $inquiry_count = $inquiry_handler->get_inquiry_count();

                            if (isset($_GET['del'])) {
                                $deleted_inquiry_id = trim(filter_input(INPUT_GET, 'del', FILTER_SANITIZE_NUMBER_INT));
                                $inquiry_handler->delete($deleted_inquiry_id);
                                include_once('elements/alerts/inquiry_delete_success.php');
                                header("refresh:2;url=" . $_SERVER['PHP_SELF']);
                            }
                        ?>
                        </div>
                    </div>

                    <div class="accordion" id="inquiries-accordion">
                    <?php
                        $inquiry_list = $inquiry_handler->get_all();
                        foreach ($inquiry_list as $curr_inquiry) {
                            $acc_id = 'collapse' . $curr_inquiry['inquiry_id'];
                            $acc_heading = 'heading' . $curr_inquiry['inquiry_id'];
                            $formatted_inquiry_date = date("D d M Y", strtotime($curr_inquiry['inquiry_date']));
                            // end PHP code block
                    ?>
                    <div class="card acc-card">
                        <div class="card-header acc-header" id="<?php echo $acc_heading; ?>">
                            <h2 class="mb-0">
                                <button class="btn btn-dark acc-btn" type="button" data-toggle="collapse" data-target="#<?php echo $acc_id; ?>" aria-expanded="true" aria-controls="<?php echo $acc_id; ?>">
                                    <i class="fal fa-user-circle"></i>&nbsp;&nbsp;<?php echo $curr_inquiry['inquiry_name']; ?>
                                </button>
                                <a href="inquiry.php?del=<?php echo $curr_inquiry['inquiry_id']; ?>" class="btn btn-danger"><i class="fal fa-trash-alt"></i></a>
                            </h2>
                            <span class="acc-sub acc-contact"><i class="fal fa-paper-plane"></i>&nbsp;&nbsp;<?php echo $curr_inquiry['inquiry_contact']; ?></span>
                            <span class="acc-sub acc-date"><i class="fal fa-calendar-alt"></i>&nbsp;&nbsp;<?php echo $formatted_inquiry_date; ?></span>
                        </div>

                        <div id="<?php echo $acc_id; ?>" class="collapse acc-body" aria-labelledby="<?php echo $acc_heading; ?>" data-parent="#inquiries-accordion">
                            <div class="card-body">
                                <?php echo htmlspecialchars($curr_inquiry['inquiry_details']); ?>
                            </div>
                        </div>
                    </div>

                    <?php // continue PHP code block
                        }
                    ?>

                    </div>

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
