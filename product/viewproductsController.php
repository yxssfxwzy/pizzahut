<?php
include "../foodmanager.php";

$name = $_POST['name'];
$sort = $_POST['sort'];
if ($sort == 'all')
{
	$sort = '';
}

$productData = getProducts($name,$sort);

if (count($productData) == 0)
{
	$name = 'null';
}

	session_start();
	$_SESSION['productName'] = $name;
	$_SESSION['sort'] = $sort;
	Header("Location:viewproducts.php");

?>
