<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class MealOrderItem{
private $id;
private $mealorder_id;
private $mealorder;
private $price;
private $amount;
private $menuitem_id;
private $menuitem;

public function get_id() {
    return $this->id;
}

public function set_id($id) {
    $this->id = $id;
}

public function get_mealorder_id() {
    return $this->mealorder_id;
}

public function set_mealorder_id($mealorder_id) {
    $this->mealorder_id = $mealorder_id;
}

public function get_mealorder() {
    return $this->mealorder;
}

public function set_mealorder($mealorder) {
    $this->mealorder = $mealorder;
}

public function get_price() {
    return $this->price;
}

public function set_price($price) {
    $this->price = $price;
}

public function get_amount() {
    return $this->amount;
}

public function set_amount($amount) {
    $this->amount = $amount;
}
public function get_menuitem_id() {
    return $this->menuitem_id;
}

public function set_menuitem_id($menuitem_id) {
    $this->menuitem_id = $menuitem_id;
}

public function get_menuitem() {
    return $this->menuitem;
}

public function set_menuitem($menuitem) {
    $this->menuitem = $menuitem;
}


}
?>
