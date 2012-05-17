<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class MealOder{
private $id;
private $user_id;
private $user;
private $order_time;
private $description;
private $promotion;

public function get_id() {
    return $this->id;
}

public function set_id($id) {
    $this->id = $id;
}

public function get_user_id() {
    return $this->user_id;
}

public function set_user_id($user_id) {
    $this->user_id = $user_id;
}

public function get_user() {
    return $this->user;
}

public function set_user($user) {
    $this->user = $user;
}

public function get_order_time() {
    return $this->order_time;
}

public function set_order_time($order_time) {
    $this->order_time = $order_time;
}

public function get_description() {
    return $this->description;
}

public function set_description($description) {
    $this->description = $description;
}

public function get_promotion() {
    return $this->promotion;
}

public function set_promotion($promotion) {
    $this->promotion = $promotion;
}
}
?>
