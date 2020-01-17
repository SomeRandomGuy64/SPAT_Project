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
require_once ('../Models/pagination.php');
$pagination = new pagination();

$view = new stdClass();
//post data passed to the view class
$POIDataSet = new DataSet();
$view->POIDataSet = $POIDataSet->getAllPOI();

if (isset($_POST['searchButton'])) {
    $searchValue = $_POST['searchBar'];
    $view->POIDataSet = $POIDataSet->getPOIBySearch($searchValue);
}





require_once ('../Views/header.phtml');
require_once ('../Views/pointOfInterest.phtml');
