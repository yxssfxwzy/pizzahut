<?php
include "foodmanager.php";


$user = new User();
$user->set_uid($_POST['uid']);
$user->set_name($_POST['name']);
$user->set_tel($_POST['tel']);
$user->set_coordinate($_POST['coordinate']);
$user->set_address($_POST['address']);
$user->set_password($_POST['password']);
$confirmpassword=$_POST['confirmpassword'];

if(registerUser($user,$confirmpassword)){
    if (login($user)) {
        Header("Location:userhomepage.php");
    }else {
       Header("Location:index.php");
    }
}else {
     Header("Location:register.php");
}

?>
