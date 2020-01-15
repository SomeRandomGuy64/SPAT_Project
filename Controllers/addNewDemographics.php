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
    $dataSet->addNewDemographics($postcode, $totalPopulation, $totalElderly, $totalMobilityNeeds, $totalHealthNeeds);
}

require_once ('../Views/header.phtml');
require_once ('../Views/addNewDemographics.phtml');
