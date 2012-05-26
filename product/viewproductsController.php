<?php
include "../foodmanager.php";

$name = $_POST['name'];
$productData = getProducts($name);

if (count($productData) == 0)
{
	Header("Location:noResult.php");
}
else {
	session_start();
	$_SESSION['productName'] = $name;
	Header("Location:viewproducts.php");
}
?>
