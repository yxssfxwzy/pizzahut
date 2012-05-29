<?php
include "../include/islogin.php";
include("../foodmanager.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Confirm</title>
        <link href="../css/default.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="wrapper">
        <?php include '../include/header.php'; ?>
            <!-- end div#header -->
            <div id="page">
                <div id="content">
                    <div id="welcome">
                        <!-- Fetch Rows -->
                        <table class="aatable">
                        	<tr><h1>订单内容</h1></tr>
                            <tr>
                                <th>商品名字</th>
                                <th>数量</th>
                                <th>价格</th>
                                <th>订单状态</th>
                                <th>删除</th>
                            </tr>
                            
                            <?php
							$uid = $_SESSION['uid'];
							$status = 'ordering';
							$orderData = getOrderInfo($uid,$status);
                            
                            for($index=0;$index < count($orderData);$index++){
                                $order = $orderData[$index];
                                echo "<tr>";
                                echo "<td>".$order->get_pid()."</td>";
                                echo "<td>".$order->get_quantity()."</td>";                            	echo "<td>".$order->get_price()."</td>";
                                echo "<td>".$order->get_status()."</td>";
                                echo "<td><form  action='deleteOrderController.php' method='post'><input type='hidden' name='oid' value='".$order->get_oid()."'/><input type='submit' value='Delete'/></form>";
								echo "</tr>";
                            }
                            ?>                            
                        </table>
                        
                        <br />
                        <table class="aatable">
                            <tr><h1>用户信息</h1></tr>
                            <tr>
                                <th>用户ID</th>
                                <th>用户名</th>
                                <th>电话</th>
                                <th>地址</th>
                                <th>经纬度</th>
                            </tr>
                            <?php
                            $userData = getUserInfo($uid);
                            
                            for($index=0;$index < count($userData);$index++){
                                $user = $userData[$index];
                                echo "<tr>";
                                echo "<td>".$user->get_uid()."</td>";
                                echo "<td>".$user->get_name()."</td>";                            	echo "<td>".$user->get_tel()."</td>";
                                echo "<td>".$user->get_address()."</td>";
                                echo "<td>".$user->get_coordinate()."</td>";
                                echo "</tr>";
                            }
                            ?>
                        </table>
                        
                        <br />
                        <div align='right'><form action='confirmController.php' method='post'><input type='submit' value='corfirm' /></form></div>
                    <!-- end div#welcome -->			
                    </div>
                </div>
                <!-- end div#content -->
                <div id="sidebar">
                    <!--ul-->
                        <?php include '../include/usernav.php'; ?>
                        <!-- end navigation -->
                            <?php include '../include/updates.php'; ?>
                        <!-- end updates -->
                    <!--/ul-->
                </div>
                <!-- end div#sidebar -->
                <div style="clear: both; height: 1px"></div>
            </div>
                <?php include '../include/footer.php'; ?>
        </div>
        <!-- end div#wrapper -->
    </body>
</html>
