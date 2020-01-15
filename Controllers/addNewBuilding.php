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
    $dataSet->addNewBuilding($name, $city, $type, $postcode, $value, $maxOccupants, $area);
}

require_once ('../Views/header.phtml');
require_once ('../Views/addNewBuilding.phtml');
