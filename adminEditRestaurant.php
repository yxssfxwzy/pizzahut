<?php
error_reporting(0); 
include "include/isadmin.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Restaurant Info.</title>
        <link href="css/default.css" rel="stylesheet" type="text/css" />
    </head>
    <?php
            include("foodmanager.php");
            $id=0;
            session_start();
            if(isset($_POST['id'])){
                $id = $_POST['id'];
            }
    ?>
    
    <body>
        <div id="wrapper">
        <?php include 'include/header.php'; ?>
            <!-- end div#header -->
            <div id="page">
                <div id="content">
                    <div id="welcome">
                        <form action="adminEditRestaurantController.php" method="post">
                        <!-- Fetch Rows -->
                        <table class="aatable">
                            <?php
                            $restaurantData = getBranchInfo($id);
                            
                            for($index=0;$index < count($restaurantData);$index++){
                                $restaurant = $restaurantData[$index];
                                echo "<tr><td colspan='2'> Edit Restaurant<input type='hidden' name='id' value='".$restaurant->get_bid()."'></td></tr>";
                                echo "<tr><td>name:</td><td><input type='text' name='name' value='".$restaurant->get_name()."'/></td></tr>";
                                echo "<tr><td>description:</td><td><textarea name='coordinate'>".$restaurant->get_coordinate()."</textarea></td></tr>";
                                echo "<tr><td>address:</td><td><textarea name='address' >".$restaurant->get_address()."</textarea></td></tr>";
                                echo "<tr><td>telephone:</td><td><textarea name='telephone' >".$restaurant->get_tel()."</textarea></td></tr>";
                               // echo "<tr><td>IsActive:</td><td>".$restaurant->get_isActive()."</td></tr>";
                                echo "<tr><td colspan='2'><input type='submit' value='Edit'/>&nbsp;<input type='button' value='Cancel' /></td></tr>";
                            }
                            ?>
                        </table>
                        </form>
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
                <?php include 'include/footer.php'; ?>
        </div>
        <!-- end div#wrapper -->
    </body>
</html>
