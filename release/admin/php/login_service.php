<?php
    ob_start();
    session_start();
    require_once("../../conn/db.php");
    require_once('../../php/aux.php');
    require_once("../../php/crud/user.class.php");

    // 1) process information from login form
    // 2) check if admin user exists
    // 3) create session with code below

    if ((is_POST()) && (isset($_POST['login_submit']))) {
        $user_name = trim(filter_input(INPUT_POST, 'user_name', FILTER_SANITIZE_STRING));
        $user_pwd = trim(filter_input(INPUT_POST, 'user_pwd', FILTER_SANITIZE_STRING));

        $admin_user_login = new User();
        $user_login_auth = $admin_user_login->search($user_name, $user_pwd);

        if (($user_login_auth['user_name'] === $user_name) && ($user_login_auth['user_pwd'] === $user_pwd)) {
            $_SESSION['user_id']          = $user_login_auth['user_id'];
            $_SESSION['user_name']        = $user_login_auth['user_name'];
            $_SESSION['user_pwd']         = $user_login_auth['user_pwd'];
            $_SESSION['user_first_name']  = $user_login_auth['user_first_name'];
            $_SESSION['user_last_name']   = $user_login_auth['user_last_name'];
            $_SESSION['user_email']       = $user_login_auth['user_email'];
            $_SESSION['user_profile_img'] = $user_login_auth['user_profile_img'];
            $_SESSION['user_type']        = $user_login_auth['user_type'];
            $_SESSION['user_date_joined'] = $user_login_auth['user_date_joined'];

            header('Location: ../index.php');
        } else {
            // add fallback options for user errors here
            header('Location: ../../index.php');
        }
    }

?>
