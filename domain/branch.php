<?php
/*
This is a Flight helper class. Instance of
this class can store flight information.
*/

class Branch{
    private $bid;
    private $name;
    private $address;
    private $tel;
    private $coordinate;
    public function get_bid() {
        return $this->bid;
    }

    public function set_bid($bid) {
        $this->bid = $bid;
    }

    public function get_name() {
        return $this->name;
    }

    public function set_name($name) {
        $this->name = $name;
    }

    public function get_address() {
        return $this->address;
    }

    public function set_address($address) {
        $this->address = $address;
    }

    public function get_tel() {
        return $this->tel;
    }

    public function set_tel($tel) {
        $this->tel = $tel;
    }

    public function get_coordinate() {
        return $this->coordinate;
    }

    public function set_coordinate($coordinate) {
        $this->coordinate = $coordinate;
    }


    // The constructor, duh!
//    function __construct(){
//    }


}
?>