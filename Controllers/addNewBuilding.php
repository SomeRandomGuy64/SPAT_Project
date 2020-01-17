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
    $city = $_POST['city'];
    $type = $_POST['type'];
    $postcode = $_POST['postcode'];
    $value = $_POST['value'];
    $maxOccupants = $_POST['maxOccupants'];
    $area = $_POST['area'];

    $url = "http://18.130.150.122/api/v1/buildings";
    $fields = [
        'name'      => $name,
        'city'      => $city,
        'type'      => $type,
        'postcode'      => $postcode,
        'value'      => $value,
        'maxOccupants'      => $maxOccupants,
        'size_m2'      => $area
    ];
    $dataSet->addNewBuilding($url, $fields);
    header('location: buildings.php');
}

require_once ('../Views/header.phtml');
require_once ('../Views/addNewBuilding.phtml');
