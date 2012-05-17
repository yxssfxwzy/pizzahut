<?php
class User {
  private $uid;

  private $name;
  private $tel;
  private $address;
  private $password;
  private $coordinate;
  private $isadmin;

  public function get_uid() {
    return $this->uid;
  }

  public function set_uid($uid) {
    $this->uid = $uid;
  }

  public function get_name() {
    return $this->name;
  }

  public function set_name($name) {
    $this->name = $name;
  }

  public function get_password() {
    return $this->password;
  }

  public function set_password($password) {
    $this->password = $password;
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

  public function get_isadmin() {
    return $this->isadmin;
  }

  public function set_isadmin($isadmin) {
    $this->isadmin = $isadmin;
  }

  function __construct() {
  }
}
?>