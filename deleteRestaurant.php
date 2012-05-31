<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include "foodmanager.php";

$id = $_POST['id'];

if (deleteRestaurant($id)) {
    Header("Location:restaurantfunctionadministration.php");
}
?>
