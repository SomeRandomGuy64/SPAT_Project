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

    $url = "http://18.130.150.122/api/v1/utilities";
//The data you want to send via POST
    $fields = [
        'name'      => $name,
        'type'      => $type,
        'postcode'      => $postcode,
        'classification'      => $classification
    ];

    $dataSet->addNewItem($url, $fields);
    header('location: utilities.php');
}

require_once ('../Views/header.phtml');
require_once ('../Views/addNewUtilities.phtml');
