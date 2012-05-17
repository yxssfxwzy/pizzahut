<?php
/*
DB Configuration information is stored here.
Ideally you should read these vaules from an 
external properties file.
*/

class FoodConf{
    private $databaseURL = "localhost";
    private $databaseUName = "root";
    private $databasePWord = "520";
    private $databaseName = "pizza";

    function get_databaseURL(){
            return $this->databaseURL;
        }
    function get_databaseUName(){
            return $this->databaseUName;
        }
    function get_databasePWord(){
            return $this->databasePWord;
        } 
    function get_databaseName(){
            return $this->databaseName;
        } 
}
?>