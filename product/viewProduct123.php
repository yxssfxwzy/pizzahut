<?php
include ("../include/isadmin.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>商品信息</title>
        <link href="../css/default.css" rel="stylesheet" type="text/css" />
    </head>
    <?php
            include("../foodmanager.php");
			$pid = 123;
    ?>
    
    <body>
        <div id="wrapper">
        <?php include '../include/header.php'; ?>
            <!-- end div#header -->
            <div id="page">
                <div id="content">
                    <div id="welcome">
                        <!-- Fetch Rows -->
                        <table class="aatable">
                        	<tr><h1>商品信息</h1></tr>
                            <tr>
                                <th>图片</th>
                                <th>商品名字</th>
                                <th>类别</th>
                                <th>价格</th>
                                <th>描述</th>
                            </tr>
                            <?php
                            $productData = getProductInfo($pid);
                            
                            for($index=0;$index < count($productData);$index++){
                                $product = $productData[$index];
                                echo "<tr>";
                                echo "<td><input type='image' src='image/".$product->get_pid().".jpg'></td>";
                                echo "<td>".$product->get_name()."</td>";
                                echo "<td>".$product->get_sort()."</td>";                            	echo "<td>".$product->get_price()."</td>";
                                echo "<td>".$product->get_description()."</td>";
                                echo "</tr>";
                            }
                            ?>
                        </table>
                    </div>
                    <!-- end div#welcome -->			
                    
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
