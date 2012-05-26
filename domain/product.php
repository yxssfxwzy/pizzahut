<?php

class Product {
    private $pid;
    private $sort;
    private $name;
    private $price;
    private $description;

    public function get_pid() {
        return $this->pid;
    }

    public function set_pid($pid) {
        $this->pid = $pid;
    }

    public function get_sort() {
        return $this->sort;
    }

    public function set_sort($sort) {
        $this->sort = $sort;
    }

    public function get_name() {
        return $this->name;
    }

    public function set_name($name) {
        $this->name = $name;
    }

    public function get_price() {
        return $this->price;
    }

    public function set_price($price) {
        $this->price = $price;
    }

    public function get_description() {
        return $this->description;
    }

    public function set_description($description) {
        $this->description = $description;
    }

}
?>
