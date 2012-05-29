<?php
include "../foodmanager.php";

$oid = $_POST['oid'];

if (deleteOrder($oid)) {
    Header("Location:confirm.php");
} else {
    header("Cache-control: private, must-revalidate");
}
?>