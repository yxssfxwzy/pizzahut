<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include "foodmanager.php";

$user = new User();
$user->set_uid($_POST['id']);

toggleAdmin($user);
Header("Location:userfunctionadministration.php");
?>
