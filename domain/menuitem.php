<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class MenuItem {
    private $id;
    private $restaurant_id;
    private $restaurant;
    private $restaurantArr;
    private $menu_name;
    private $menu_description;
    private $isActive;
    private $price;
    private $promotion;

    public function get_id() {
        return $this->id;
    }

    public function set_id($id) {
        $this->id = $id;
    }

    public function get_restaurant_id() {
        return $this->restaurant_id;
    }

    public function set_restaurant_id($restaurant_id) {
        $this->restaurant_id = $restaurant_id;
    }

    public function get_restaurant() {
        return $this->restaurant;
    }

    public function set_restaurant($restaurant) {
        $this->restaurant = $restaurant;
    }

    public function get_restaurantArr() {
        return $this->restaurantArr;
    }

    public function set_restaurantArr($restaurantArr) {
        $this->restaurantArr = $restaurantArr;
    }

    public function get_menu_name() {
        return $this->menu_name;
    }

    public function set_menu_name($menu_name) {
        $this->menu_name = $menu_name;
    }

    public function get_menu_description() {
        return $this->menu_description;
    }

    public function set_menu_description($menu_description) {
        $this->menu_description = $menu_description;
    }

    public function get_isActive() {
        return $this->isActive;
    }

    public function set_isActive($isActive) {
        $this->isActive = $isActive;
    }

    public function get_price() {
        return $this->price;
    }

    public function set_price($price) {
        $this->price = $price;
    }

    public function get_promotion() {
        return $this->promotion;
    }

    public function set_promotion($promotion) {
        $this->promotion = $promotion;
    }


}
?>
