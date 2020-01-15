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

$buildingsData = $dataSet->getAllBuildings();
$infrastructureData = $dataSet->getAllInfrastructure();
$demographicsData = $dataSet->getAllDemographics();
$utilitiesData = $dataSet->getAllUtilities();

require_once ('../Views/header.phtml');
require_once ('../Views/allData.phtml');
