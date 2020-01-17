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

    $url = "http://18.130.150.122/api/v1/infrastructure";
//The data you want to send via POST
    $fields = [
        'name'      => $name,
        'postcodes'      => $postCodeArray,
        'type'      => $type,
        'classification'      => $classification
    ];
    $dataSet->addNewItem($url, $fields);
    header('location: infrastructure.php');
}

require_once ('../Views/header.phtml');
require_once ('../Views/addNewInfrastructure.phtml');
