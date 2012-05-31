<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include "foodmanager.php";

$restaurant = new Branch();
$restaurant->set_name($_POST['name']);
$restaurant->set_tel($_POST['telephone']);
$restaurant->set_address($_POST['address']);
$restaurant->set_coordinate($_POST['coordinate']);
//$restaurant->set_isactive($_POST['isActive']);

if (addRestaurant($restaurant)) {
    Header("Location:restaurantfunctionadministration.php");
}
?>
