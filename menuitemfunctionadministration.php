<?php
include "include/isadmin.php";
include("foodmanager.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Menu Item Info.</title>
        <link href="css/default.css" rel="stylesheet" type="text/css" />
    </head>
    
    <body>
        <div id="wrapper">
        <?php include '../include/header.php'; ?>
            <!-- end div#header -->
            <div id="page">
                <div id="content">
                    <div id="welcome">
                        <!-- Fetch Rows -->
                        <h1>商品信息</h1>
       					<?php
							$name = $_SESSION['productName'];
							unset($_SESSION['productName']);
							$sort = $_SESSION['sort'];
							unset($_SESSION['sort']);
							
							echo "<h2>".$sort."</h2>";
							
							if ($name == 'null'){
								echo "<h2>No results!</h2>";
							}
							else{
                        		echo "
									<table class='aatable'>
                        				<tr>
                                			<th>商品名字</th>
                                			<th>类别</th>
                                			<th>价格</th>
                                			<th>描述</th>
                            			</tr>";
                            	
                            	$productData = getProducts($name,$sort);
                            
                            	for($index=0;$index < count($productData);$index++){
                                	$product = $productData[$index];
                                	echo "<tr>";
                                	echo "<td><a href = 'viewProduct". $product->get_pid().".php'>".$product->get_name()."</a></td>";
                                	echo "<td>".$product->get_sort()."</td>";                            	
									echo "<td>".$product->get_price()."</td>";
                                	echo "<td>".$product->get_description()."</td>";
									echo "<td><form  action='editProduct.php' method='post'><input type='hidden' name='pid' value='".$product->get_pid()."'/><input type='submit' value='Edit'/></form></td>";
                                	echo "</tr>";
                            	}
                        	echo "</table>";
                        	}
						?>
                      	<form action="searchProduct.php" method="post">
                        	<select name="sort">
                            	<option>all</option>
                                <option>pizza</option>
                                <option>drink</option>
                                <option>3</option>
                            </select>
                            <input type='text' name='name'>&nbsp <input type='submit' value='search'>&nbsp <input type="button" value="  Add   " onclick="javaScript:window.location.href='addProduct.php'">
                        </form>
                    
                    </div>
                    <!-- end div#welcome -->		
                    
                </div>
                <!-- end div#content -->
                <div id="sidebar">
                    <!--ul-->
                        <?php  include 'include/adminnav.php'; ?>
                        <!-- end navigation -->
                            <?php include 'include/updates.php'; ?>
                        <!-- end updates -->
                    <!--/ul-->
                </div>
                <!-- end div#sidebar -->
                <div style="clear: both; height: 1px"></div>
            </div>
                <?php include 'include/footer.php'; ?>
        </div>
        <!-- end div#wrapper -->
    </body>
</html>
