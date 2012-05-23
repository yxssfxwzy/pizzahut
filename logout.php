<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
unset($_SESSION['login']);
unset($_SESSION['uid']);
unset($_SESSION['userData']);
Header("Location:index.php");

?>
