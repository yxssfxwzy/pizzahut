<?php
include "include/isadmin.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>User Info.</title>
        <link href="css/default.css" rel="stylesheet" type="text/css" />
    </head>
    <?php
            include("foodmanager.php");
            $id=0;
            if(isset($_REQUEST["id"])){
            $id = $_REQUEST["id"];
        }
    ?>
    
    <body>
        <div id="wrapper">
        <?php# include 'include/header.php'; ?>
            <!-- end div#header -->
            <div id="page">
                <div id="content">
                    <div id="welcome">
                        <!-- Fetch Rows -->
                        <table class="aatable">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Telephone</th>
                                <th>Address</th>
                                <th>Description</th>
                                <th>Is Active</th>
                                <th>Operation</th>
                            </tr>
                            <?php
                            $restaurantData = getRestaurantInfo($id);
                            
                            for($index=0;$index < count($restaurantData);$index++){
                                $restaurant = $restaurantData[$index];
                                echo "<tr>";
                                echo "<td>".$restaurant->get_id()."</td>";
                                echo "<td>".$restaurant->get_name()."</td>";
                                echo "<td>".$restaurant->get_telephone()."</td>";
                                echo "<td>".$restaurant->get_address()."</td>";
                                echo "<td>".$restaurant->get_description()."</td>";
                                echo "<td>".$restaurant->get_isactive()."</td>";
                                echo "<td><form  action='deleteRestaurant.php' method='post'><input type='hidden' name='id' value='".$restaurant->get_id()."'/><input type='submit' value='delete'/></form>
                                            <form action='admineditrestaurant.php' method='post'><input type='hidden' name='id' value='".$restaurant->get_id()."'/><input type='submit' value='Edit' /></form>
                                            <form action='toggleRestaurantController.php' method='post'><input type='hidden' name='id' value='".$restaurant->get_id()."'/><input type='submit' value='Toggle Restaurant' /></form></td>";
                                echo "</tr>";
                            }
                            ?>
                            <form action="adminAddRestaurantController.php" method="post">
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><input type="text" name="name" value="" /></td>
                                    <td><textarea name="telephone"></textarea></td>
                                    <td><textarea name="address"></textarea></td>
                                    <td><textarea name="description"></textarea></td>
                                    <td><input type="radio" name="isActive" value="Y" checked="true"/>Y<input type="radio" name="isActive" value="N"/>N</td>
                                    <td><input type="submit" value="add" /></td>
                                </tr>
                            </form>
                        </table>
                    </div>
                    <!-- end div#welcome -->			
                    
                </div>
                <!-- end div#content -->
                <div id="sidebar">
                    <!--ul-->
                        <?php if ($_SESSION['isAdmin'] ){
                                include 'include/adminnav.php';
                                }else{
                                  include 'include/usernav.php';
                                } ?>
                        <!-- end navigation -->
                            <?php include 'include/updates.php'; ?>
                        <!-- end updates -->
                    <!--/ul-->
                </div>
                <!-- end div#sidebar -->
                <div style="clear: both; height: 1px"></div>
            </div>
                <?php# include 'include/footer.php'; ?>
        </div>
        <!-- end div#wrapper -->
    </body>
</html>
