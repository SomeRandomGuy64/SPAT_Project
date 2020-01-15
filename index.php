
<?php

session_start();
$loggedIn = false;
if (!empty($_SESSION)) {
    $loggedIn = true;
}

if (isset($_GET['logout'])) {
    session_unset();
    header("location: index.php");
}




require_once ('Views/header.phtml');
require_once ('Views/index.phtml');