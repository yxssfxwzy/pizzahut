<?php
include "../include/islogin.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>User Info.</title>
        <link href="../css/default.css" rel="stylesheet" type="text/css" />
    </head>
    <?php
            include("../foodmanager.php");
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
                                <th>Name</th>
                                <th>Telephone</th>
                                <th>Address</th>
                                <th>Coordinate</th>
                            </tr>
                            <?php
                            $branchData = getBranchInfo();
                            
                            for($index=0;$index < count($branchData);$index++){
                                $branch = $branchData[$index];
                                echo "<tr>";
                                echo "<td>".$branch->get_name()."</td>";
                                echo "<td>".$branch->get_tel()."</td>";
                                       echo "<td>".$branch->get_address()."</td>";
                                echo "<td>".$branch->get_coordinate()."</td>";
                                echo "<td><form  action='orderMenuItem.php' method='post'><input type='hidden' name='branch_bid' value='".$branch->get_bid()."'/><input type='submit' value='Order'/></form></td>";
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
                        <?php
                            if ($_SESSION['isAdmin']==true) {
                               include '../include/adminnav.php';
                            } else {
                                include '../include/usernav.php';
                            }?>
                        <!-- end navigation -->
                            <?php include '../include/updates.php'; ?>
                        <!-- end updates -->
                    <!--/ul-->
                </div>
                <!-- end div#sidebar -->
                <div style="clear: both; height: 1px"></div>
            </div>
                <?php# include '../include/footer.php'; ?>
        </div>
        <!-- end div#wrapper -->
    </body>
</html>
