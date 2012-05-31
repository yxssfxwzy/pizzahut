<?php
include "foodmanager.php";

$oid = $_POST['oid'];

deliverOrder($oid);
  Header("Location:viewMealOrder.php");

?>