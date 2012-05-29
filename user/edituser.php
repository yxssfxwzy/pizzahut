<?php
include "../include/islogin.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Edit User Info</title>
        <link href="../css/default.css" rel="stylesheet" type="text/css" />
    </head>
    <?php
            include("../foodmanager.php");
            $uid = $_SESSION['uid'];
    ?>
    
    <body>
        <div id="wrapper">
        <?php include '../include/header.php'; ?>
            <!-- end div#header -->
            <div id="page">
                <div id="content">
                    <div id="welcome">
                        <form action="editUserController.php" method="post">
                        <!-- Fetch Rows -->
                        <table class="aatable">
                            <?php
                            $userData = getUserInfo($uid);
                            for($index=0;$index < count($userData);$index++){
                                $user = $userData[$index];
                                echo "<tr><td colspan='2'> Edit User<input type='hidden' name='uid' value='".$user->get_uid()."'></td></tr>";
                                echo "<tr><td>Name:</td><td><input type='text' name='name' value='".$user->get_name()."'/></td></tr>";
                                echo "<tr><td>Tel:</td><td><input type='text' name='tel' value='".$user->get_tel()."'/></td></tr>";
                                echo "<tr><td>Address:</td><td><input type='text' name='address' value='".$user->get_address()."'/></td></tr>";
                                echo "<tr><td>Coordinate:</td><td><input type='text' name='coordinate' value='".$user->get_coordinate()."'/></td></tr>";
								echo "<tr><td colspan='2'><input type='submit' value='Edit'/>&nbsp;<input type='button' value='Cancel' onclick='javaScript:window.location.href=\"userinfo.php\";' /></td></tr>";
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
                        <?php include '../include/usernav.php'; ?>
                        <!-- end navigation -->
                            <?php include '../include/updates.php'; ?>
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
