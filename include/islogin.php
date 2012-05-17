<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
if (!isset($_SESSION['login'])){
   session_destroy();
   Header("Location:index.php");
}else if($_SESSION['login']!=true) {
   session_destroy();
   Header("Location:index.php");
}
?>
