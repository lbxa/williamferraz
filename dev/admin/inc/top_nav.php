<nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
    <!-- ============================================================== -->
    <!-- Logo -->
    <!-- ============================================================== -->
    <div class="navbar-header">
        <a class="navbar-brand" href="index.php">
            <img src="../logo/WFerraz_logo_Tranparency.png" alt="homepage" class="light-logo" height="60"/>
        </a>
    </div>
    <!-- ============================================================== -->
    <!-- End Logo -->
    <!-- ============================================================== -->
    <div class="navbar-collapse">
        <!-- ============================================================== -->
        <!-- toggle and nav items -->
        <!-- ============================================================== -->
        <ul class="navbar-nav mr-auto mt-md-0">
            <!-- This is  -->
            <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
            <!-- ============================================================== -->
            <!-- Search -->
            <!-- ============================================================== -->
            <li class="nav-item hidden-sm-down search-box"> <a class="nav-link hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="fal fa-search"></i></a>
                <form class="app-search">
                    <input type="text" class="form-control" placeholder="Search & enter"> <a class="srh-btn"><span style="font-size: 1rem;"><i class="fal fa-times"></i></span></a> </form>
            </li>
        </ul>
        <!-- ============================================================== -->
        <!-- User profile and search -->
        <!-- ============================================================== -->
        <ul class="navbar-nav my-lg-0">
            <!-- ============================================================== -->
            <!-- Profile -->
            <!-- ============================================================== -->
            <?php
                $user_profile = new User();
                $user_profile_data = $user_profile->search($_SESSION['user_name'], $_SESSION['user_pwd']);
            ?>
            <li class="nav-item dropdown">
                <a class="nav-link text-muted waves-effect waves-dark" href="profile.php" aria-haspopup="true" aria-expanded="false" style="display: flex;">
                    <div class="profile-circle profile-circle-sm m-r-10" style="background-image: url(<?php echo $user_profile_data['user_profile_img']; ?>);"></div>
                    <?php echo $user_profile_data['user_first_name'] . ' ' .  $user_profile_data['user_last_name']; ?>
                </a>
            </li>
        </ul>
    </div>
</nav>
