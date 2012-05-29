<?php
include "../foodmanager.php";

$productData = getproductInfo($_POST['pid']);
$quantity = $_POST['quantity'];
$product = $productData[0];
$uid = $_SESSION['uid'];
$userArr = getUserInfo($uid);
$user = $userArr[0];

$order = new Order();
$order->set_uid($uid);
date_default_timezone_set("PRC");
$order->set_time(date("Y-m-d H:i:s"));
$order->set_pid($product->get_pid());
$order->set_quantity($quantity);
$order->set_price($quantity * $product->get_price());
$order->set_status("ordering");


if (addOrder($order)) {
    Header("Location:order.php");
} else {
    header("Cache-control: private, must-revalidate");
}
?>
