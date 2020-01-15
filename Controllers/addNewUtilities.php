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
    $postcode = $_POST['postcode'];
    $type = $_POST['type'];
    $classification = $_POST['classification'];
    $dataSet->addNewUtilities($name, $postcode, $type, $classification);
}

require_once ('../Views/header.phtml');
require_once ('../Views/addNewUtilities.phtml');
