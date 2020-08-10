<?php
function is_POST() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        return true;
    } else {
        return false;
    }
}

function is_GET() {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        return true;
    } else {
        return false;
    }
}
?>
