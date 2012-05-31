<?php
/*
This is a Flight helper class. Instance of
this class can store flight information.
*/

class Restaurant{
    private $id;
    private $name;
    private $description;
    private $address;
    private $telephone;
   private $coordinate;
    private $isactive;
    public function get_id() {
        return $this->id;
    }

    public function set_id($id) {
        $this->id = $id;
    }

    public function get_name() {
        return $this->name;
    }

    public function set_name($name) {
        $this->name = $name;
    }

    public function get_description() {
        return $this->description;
    }

    public function set_description($description) {
        $this->description = $description;
    }

    public function get_address() {
        return $this->address;
    }

    public function set_address($address) {
        $this->address = $address;
    }

    public function get_telephone() {
        return $this->telephone;
    }

    public function set_telephone($telephone) {
        $this->telephone = $telephone;
    }
    
   public function get_coordinate() {
        return $this->coordinate;
    }

    public function set_coordinate($coordinate) {
        $this->coordinate = $coordinate;
    }
    

    public function get_isactive() {
        return $this->isactive;
    }

    public function set_isactive($isactive) {
        $this->isactive = $isactive;
    }


    // The constructor, duh!
    function __construct(){
    }


}
?>