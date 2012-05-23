<?php
include "../include/islogin.php";
include("../foodmanager.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Menu Item Info.</title>
        <link href="../css/default.css" rel="stylesheet" type="text/css" />
    </head>
        <?php
            $restaurant_id=0;
            session_start();
            // echo $_SESSION['userData'];
            if(isset($_POST['restaurant_id'])){
                $restaurant_id = $_POST['restaurant_id'];
            }
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
                            <tr>
                                <th>ID</th>
                                <th>Restaurant</th>
                                <th>menu_name</th>
                                <th>menu_description</th>
                                <th>isActive</th>
                                <th>price</th>
                                <th>promotion</th>
                            </tr>
                            <?php
                            $menuitemData = getMenuItemInfoByRestaurantId($restaurant_id);
                            
                            for($index=0;$index < count($menuitemData);$index++){
                                $menuitem = $menuitemData[$index];
                                echo "<tr>";
                                echo "<td>".$menuitem->get_id()."</td>";
                                echo "<td>".$menuitem->get_restaurant()->get_name()."</td>";
                                echo "<td>".$menuitem->get_menu_name()."</td>";
                                echo "<td>".$menuitem->get_menu_description()."</td>";
                                echo "<td>".$menuitem->get_isActive()."</td>";
                                echo "<td>".$menuitem->get_price()."</td>";
                                echo "<td>".$menuitem->get_promotion()."</td>";
                                echo "<td><form  action='orderMenuItemController.php' method='post'><input type='hidden' name='menuitem_id' value='".$menuitem->get_id()."'/><input type='submit' value='Order'/></form>";
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
                        <?php if ($_SESSION['isAdmin'] ){
                                include '../include/adminnav.php';
                                }else{
                                  include '../include/usernav.php';
                                } ?>
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
