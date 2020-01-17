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
    $postcode = $_POST['postcode'];
    $totalPopulation = $_POST['totalPopulation'];
    $totalElderly = $_POST['totalElderly'];
    $totalMobilityNeeds = $_POST['totalMobilityNeeds'];
    $totalHealthNeeds = $_POST['totalHealthNeeds'];

    $url = "http://18.130.150.122/api/v1/demographics";
//The data you want to send via POST
    $fields = [
        'postcode'      => $postcode,
        'totalPopulation'      => $totalPopulation,
        'totalElderly'      => $totalElderly,
        'totalMobilityNeeds'      => $totalMobilityNeeds,
        'totalHealthNeeds'      => $totalHealthNeeds
    ];
    $dataSet->addNewItem($url, $fields);
    header('location: demographics.php');
}

require_once ('../Views/header.phtml');
require_once ('../Views/addNewDemographics.phtml');
