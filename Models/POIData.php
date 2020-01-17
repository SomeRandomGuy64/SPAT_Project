<?php

//postData class created
class POIData {

    //global variables
    protected $_POI_id, $_title, $_location, $_description, $_image, $_timeStamp;

    //class constructor passed database retrieved data as a parameter, initialises global varibales
    public function __construct($dbRow) {
        $this->_POI_id = $dbRow['poi_id'];
        $this->_title = $dbRow['title'];
        $this->_location = $dbRow['location'];
        $this->_description = $dbRow['description'];
        $this->_image = $dbRow['image_path'];
        $this->_timeStamp = $dbRow['timeStamp'];
    }

    //an accessor method used to get the postId
    public function getPOIId() {
        return $this->_POI_id;
    }

    //an accessor method used to get the user id
    public function getTitle() {
        return $this->_title;
    }

    //an accessor method used to get the post subject
    public function getLocation() {
        return $this->_location;
    }

    //an accessor method used to get the post text
    public function getDescription() {
        return $this->_description;
    }

    //an accessor method used to get the post image
    public function getImage() {
        return $this->_image;
    }

    //a method used to check if the session is on and image exists, then display it
    public function checkPhoto() {
        if (!empty($this->getImage())) {
            return '<img height="400px" width="100%" src="'.$this->getImage().'"><br><br>';
        }
    }

    //a method used to check if session is on, then, let use the more options button
    public function getTimeStamp() {
        $timestamp = strtotime($this->_timeStamp); //convert to Unix timestamp
        $timestamp = $timestamp-3600; //subtract 1 hour (3600 this is 1 hour in seconds)
        return date("H:i:s d-m-Y",$timestamp);
    }


}
