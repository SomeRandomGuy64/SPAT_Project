<?php
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

session_start();

$loggedIn = false;
if (!empty($_SESSION)) {
    $loggedIn = true;
} else {
    header('location: login.php');
}

require_once ('../Models/Dataset.php');
$Dataset = new DataSet();

if (isset($_POST['submit'])) {

    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    $fileDestination = '';

    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg','jpeg','png');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 20000000) {
                $fileNameNew = uniqid('',true).".".$fileActualExt;
                $fileDestination = '../uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                header('location: pointOfInterest.php');
            } else {
                echo "The file is too big!";
            }
        } else {
            echo "There was an error uploading your file!";
            echo $fileError;
        }
    } else {
        echo "You cannot upload file of this type!";
    }

    $title = $_POST['title'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $timeStamp = $Dataset->getCurrentTime();
    $Dataset->addNewPOI($title, $location, $description, $fileDestination, $timeStamp);
    //header('location: pointOfInterest.php');
}

require_once ('../Views/header.phtml');
require_once ('../Views/addNewPOI.phtml');