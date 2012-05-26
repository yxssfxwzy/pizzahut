<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Order{
private $oid;
private $uid;
private $bid;
private $pid;
private $quantity;
private $price;
private $time;
private $state;

public function get_oid() {
    return $this->oid;
}

public function set_oid($oid) {
    $this->oid = $oid;
}

public function get_uid() {
    return $this->uid;
}

public function set_uid($uid) {
    $this->uid = $uid;
}

public function get_bid() {
    return $this->bid;
}

public function set_bid($bid) {
    $this->bid = $bid;
}

public function get_pid() {
    return $this->pid;
}

public function set_pid($pid) {
    $this->pid = $pid;
}
public function get_quantity() {
    return $this->quantity;
}

public function set_quantity($quantity) {
    $this->quantity = $quantity;
}

public function get_price() {
    return $this->price;
}

public function set_price($price) {
    $this->price = $price;
}

public function get_time() {
    return $this->time;
}

public function set_time($time) {
    $this->time = $time;
}

public function get_status() {
    return $this->status;
}

public function set_status($status) {
    $this->status = $status;
}
}
?>
