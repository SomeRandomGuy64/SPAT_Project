<?php
session_start();

if(!empty($_SESSION)) {
    header('location: ../index.php');
}

require_once ('../Models/Dataset.php');
$Dataset = new DataSet();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $baseEncodedPassword = base64_encode($password);
    $Dataset->signUp($username, $email, $baseEncodedPassword);
    $_SESSION["userId"] = $email;
    header('location: ../index.php');
}

require_once ('../Views/signup.phtml');