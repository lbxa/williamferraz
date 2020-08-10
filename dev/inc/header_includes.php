<?php
/*
**  PHP Header Script Includes
**
**  These files and headers need to be the first sent out via HTTP
**  when the website is launched to avoid errors in terms of sending
**  out headers.
**
**  17.05.2019 | Lucas Barbosa | williamferraz.com | All Rights Reserved (R)
*/
///////////////////////////////////WARNING///////////////////////////////////

ob_start();
require_once('conn/db.php');
require_once('php/aux.php');

///////////////////////////////////WARNING///////////////////////////////////

require_once("php/crud/image.class.php");
require_once("php/crud/inquiry.class.php");
require_once("php/crud/user.class.php");
require_once("php/crud/category.class.php");

require_once("user_service/automated_image_selection.php");

///////////////////////////////////WARNING///////////////////////////////////

?>
