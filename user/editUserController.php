<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include "../foodmanager.php";

$user = new User();
$user->set_uid($_POST['uid']);
$user->set_name($_POST['name']);
$user->set_tel($_POST['tel']);
$user->set_address($_POST['address']);
$user->set_coordinate($_POST['coordinate']);

editUser($user);

Header("Location:userinfo.php");
?>
