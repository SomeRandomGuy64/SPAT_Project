<?php
session_start();
$loggedIn = false;
if (!empty($_SESSION)) {
    $loggedIn = true;
} else {
    header('location: login.php');
}

require_once ('../Models/Dataset.php');
$dataSet = new DataSet();

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $postcodeString = $_POST['postcode'];
    $postCodeArray = preg_split("/[\s,]+/", $postcodeString);
    $type = $_POST['type'];
    $classification = $_POST['classification'];
    $dataSet->addNewInfrastructure($name, $postCodeArray, $type, $classification);
}

require_once ('../Views/header.phtml');
require_once ('../Views/addNewInfrastructure.phtml');
