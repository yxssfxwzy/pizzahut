<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include "foodmanager.php";

$user = new User();
$user->set_empid($_POST['empid']);
$user->set_password($_POST['password']);

if (login($user)) {
    session_start();
    if ($_SESSION['isAdmin']==true){
        Header("Location:adminhomepage.php");
    }else {
        Header("Location:userhomepage.php");
    }
}else {
   Header("Location:index.php");
}
?>
