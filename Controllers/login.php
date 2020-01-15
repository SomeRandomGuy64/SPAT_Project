<?php
session_start();
require_once ('../Models/Dataset.php');
$Dataset = new DataSet();

if(!empty($_SESSION)) {
    header('location: ../index.php');
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $baseEncodedPassword = base64_encode($password);

    if ($Dataset->checkUserCredentials($email, $baseEncodedPassword) > 0) {
        echo "connected";
        $_SESSION["userId"] = $email;
        header('location: ../index.php');
    }


}


require_once ('../Views/login.phtml');