<?php
include "../foodmanager.php";

$uid = $_SESSION['uid'];
$status = 'ordering';
$orderData = getOrderInfo($uid,$status);
if (count($orderData) == 0){
	header("Location:warning.php");	
}

for($index=0;$index < count($orderData);$index++){
	$order = $orderData[$index];
    $oid = $order->get_oid();                        
	if (!confirmOrder($oid,$uid)) {
		header("Location:order.php");	
}     
Header("Location:viewOrder.php");
}
?>