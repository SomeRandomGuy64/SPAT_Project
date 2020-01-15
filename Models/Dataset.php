<?php
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
//models (classes) required in this page
require_once ('Database.php');
//DatSet class created, to get data from the database
class DataSet {

    //global variables
    protected $_dbHandle, $_dbInstance;

    //class constructor, establishing database connection
    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function signUp($username, $email, $password) {
        $sqlQuery = "INSERT INTO `users` VALUES (NULL, '" . $username . "', '" . $email . "', '" . $password . "')";
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
    }

    public function checkUserCredentials($email, $password) {
        $sqlQuery = "SELECT COUNT(userId) FROM users WHERE email = '" . $email . "' AND password = '" . $password . "'";
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        $checkCount = 0;
        while ($row = $statement->fetch()) {
            $checkCount = $row[0];
        }
        return $checkCount;
    }

    public function getAllBuildings() {
        $url = "http://18.130.150.122/api/v1/buildings";
        $json = file_get_contents($url);
        $json_data = json_decode($json, true);

        $data = [];
        $data = $json_data['buildings'];
        return $data;
    }

    public function getAllInfrastructure() {
        $url = "http://18.130.150.122/api/v1/infrastructure";
        $json = file_get_contents($url);
        $json_data = json_decode($json, true);

        $data = [];
        $data = $json_data['infrastructure'];
        return $data;
    }

    public function getAllDemographics() {
        $url = "http://18.130.150.122/api/v1/demographics";
        $json = file_get_contents($url);
        $json_data = json_decode($json, true);

        $data = [];
        $data = $json_data['demographics'];
        return $data;
    }

    public function getAllUtilities() {
        $url = "http://18.130.150.122/api/v1/utilities";
        $json = file_get_contents($url);
        $json_data = json_decode($json, true);

        $data = [];
        $data = $json_data['utilities'];
        return $data;
    }

    public function addNewBuilding($name, $city, $type, $postcode, $value, $maxOccupants, $area) {
        $url = "http://18.130.150.122/api/v1/buildings";
//The data you want to send via POST
        $fields = [
            'name'      => $name,
            'city'      => $city,
            'type'      => $type,
            'postcode'      => $postcode,
            'value'      => $value,
            'maxOccupants'      => $maxOccupants,
            'size_m2'      => $area
        ];

//url-ify the data for the POST
        $fields_string = http_build_query($fields);

//open connection
        $ch = curl_init();

//set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

//So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

//execute post
        $result = curl_exec($ch);
        header('location: buildings.php');
    }

    public function addNewDemographics($postcode, $totalPopulation, $totalElderly, $totalMobilityNeeds, $totalHealthNeeds) {
        $url = "http://18.130.150.122/api/v1/demographics";
//The data you want to send via POST
        $fields = [
            'postcode'      => $postcode,
            'totalPopulation'      => $totalPopulation,
            'totalElderly'      => $totalElderly,
            'totalMobilityNeeds'      => $totalMobilityNeeds,
            'totalHealthNeeds'      => $totalHealthNeeds
        ];

//url-ify the data for the POST
        $fields_string = http_build_query($fields);

//open connection
        $ch = curl_init();

//set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

//So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

//execute post
        $result = curl_exec($ch);
        header('location: demographics.php');
    }

    public function addNewInfrastructure($name, $postCodeArray, $type, $classification) {
        $url = "http://18.130.150.122/api/v1/infrastructure";
//The data you want to send via POST
        $fields = [
            'name'      => $name,
            'postcodes'      => $postCodeArray,
            'type'      => $type,
            'classification'      => $classification
        ];

//url-ify the data for the POST
        $fields_string = http_build_query($fields);

//open connection
        $ch = curl_init();

//set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

//So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

//execute post
        $result = curl_exec($ch);
        header('location: infrastructure.php');
    }

    public function addNewUtilities($name, $postcode, $type, $classification) {
        $url = "http://18.130.150.122/api/v1/utilities";
//The data you want to send via POST
        $fields = [
            'name'      => $name,
            'type'      => $type,
            'postcode'      => $postcode,
            'classification'      => $classification
        ];

//url-ify the data for the POST
        $fields_string = http_build_query($fields);

//open connection
        $ch = curl_init();

//set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

//So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

//execute post
        $result = curl_exec($ch);
        header('location: utilities.php');
    }

    public function deleteItem($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    }
}
