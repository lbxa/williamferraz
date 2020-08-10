<?php
    session_start();

    // remove session variables to remmove user from admin
    $_SESSION['user_name'] = NULL;
    $_SESSION['user_pwd'] = NULL;
    $_SESSION['user_first_name'] = NULL;
    $_SESSION['user_last_name'] = NULL;
    $_SESSION['user_type'] = NULL;

    header('Location: ../../index.php');
?>
