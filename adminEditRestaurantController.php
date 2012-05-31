<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include "foodmanager.php";

$restaurant = new Branch();
$restaurant->set_bid($_POST['id']);
$restaurant->set_name($_POST['name']);
$restaurant->set_coordinate($_POST['coordinate']);
$restaurant->set_address($_POST['address']);
$restaurant->set_tel($_POST['telephone']);


editRestaurant($restaurant);
Header("Location:restaurantfunctionadministration.php");
?>
