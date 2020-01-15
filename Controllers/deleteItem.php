<?php
require_once ('../Models/Dataset.php');
$dataSet = new DataSet();
if (isset($_GET['buildingId'])) {
    $link = "http://18.130.150.122/api/v1/buildings/";
    $buildingId = $_GET['buildingId'];
    $url = $link.$buildingId;
    $dataSet->deleteItem($url);
    header('location: buildings.php');
} else if (isset($_GET['demographicId'])) {
    $link = "http://18.130.150.122/api/v1/demographics/";
    $demographicId = $_GET['demographicId'];
    $url = $link.$demographicId;
    $dataSet->deleteItem($url);
    header('location: demographics.php');
} else if (isset($_GET['infrastructureId'])) {
    $link = "http://18.130.150.122/api/v1/infrastructure/";
    $infrastructureId = $_GET['infrastructureId'];
    $url = $link.$infrastructureId;
    $dataSet->deleteItem($url);
    header('location: infrastructure.php');
} else if (isset($_GET['utilitiesId'])) {
    $link = "http://18.130.150.122/api/v1/utilities/";
    $utilitiesId = $_GET['utilitiesId'];
    $url = $link.$utilitiesId;
    $dataSet->deleteItem($url);
    header('location: utilities.php');
}