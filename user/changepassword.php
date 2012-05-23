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
            $uid = $_SESSION['uid'];
    ?>
    
    <body>
        <div id="wrapper">
        <?php include '../include/header.php'; ?>
            <!-- end div#header -->
            <div id="page">
                <div id="content">
                    <div id="welcome">
                        <form action="changePasswordController.php" method="post">
                            <h2><?php
                                session_start();
                                echo $_SESSION['errorMessage'];
                                unset($_SESSION['errorMessage']);
                                ?></h2>
                        <!-- Fetch Rows -->
                        <table class="aatable">
                            <?php
                            $userData = getUserInfo($uid);
                            
                            for($index=0;$index < count($userData);$index++){
                                $user = $userData[$index];
                                echo "<tr><td colspan='2'> Change Password<input type='hidden' name='uid' value='".$user->get_uid()."'></td><td>";
                                echo "<tr><td>Old Password:</td><td><input type='password' name='password' value=''/></td></tr>";
                                echo "<tr><td>New Password:</td><td><input type='password' name='newpassword' value=''/></td></tr>";
                                echo "<tr><td>Confirm New Password:</td><td><input type='password' name='confirmnewpassword' value=''/></td></tr>";
                                echo "<tr><td colspan='2'><input type='submit' value='Change'/>&nbsp;<input type='button' value='Cancel' /></td></tr>";
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
                <?php include '../include/footer.php'; ?>
        </div>
        <!-- end div#wrapper -->
    </body>
</html>
