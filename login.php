<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include "foodmanager.php";

$user = new User();
$user->set_uid($_POST['uid']);
$user->set_password($_POST['password']);

if (login($user)) {
    session_start();
    if ($_SESSION['isAdmin']==true){
        Header("Location:adminhomepage.php");
    }else {
        Header("Location:user/userhomepage.php");
    }
}else {
	session_start();    
    Header("Location:index.php");
}
?>
