<?php
/*
**  PHP Header Script Includes
**
**  These files and headers need to be the first sent out via HTTP
**  when the website is launched to avoid errors in terms of sending
**  out headers. Include as first line of PHP for every file.
**
**  17.05.2019 | Lucas Barbosa | williamferraz.com | All Rights Reserved (R)
*/

ob_start();
session_start();
// user_role !== admin
if (! isset($_SESSION["user_type"])) {
    header("Location: ../login.php");
}

///////////////////////////////////WARNING///////////////////////////////////

require_once('../conn/db.php');
require_once('../php/aux.php');

///////////////////////////////////WARNING///////////////////////////////////

require_once("../php/crud/image.class.php");
require_once("../php/crud/inquiry.class.php");
require_once("../php/crud/user.class.php");
require_once("../php/crud/category.class.php");

require_once("../user_service/automated_image_selection.php");

///////////////////////////////////WARNING///////////////////////////////////

?>
