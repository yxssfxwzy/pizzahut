<?php
include "include/islogin.php";
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
            session_start();
            // echo $_SESSION['userData'];
            if(isset($_POST['id'])){
                    $id = $_POST['id'];
        }
    ?>
    
    <body>
        <div id="wrapper">
        <?php# include 'include/header.php'; ?>
            <!-- end div#header -->
            <div id="page">
                <div id="content">
                    <div id="welcome">
                        <form action="adminChangeUserPasswordController.php" method="post">
                        <!-- Fetch Rows -->
                        <table class="aatable">
                            <?php
                            $userData = getUserInfo($id);
                            
                            for($index=0;$index < count($userData);$index++){
                                $user = $userData[$index];
                                echo "<tr><td colspan='2'> User Info<input type='hidden' name='id' value='".$user->get_uid()."'></td></tr>";
                                //echo "<tr><td>EmpID:</td><td>".$user->get_empid()."</td></tr>";
                                echo "<tr><td>User Name:</td><td>".$user->get_name()."</td></tr>";
                                echo "<tr><td>Address:</td><td>".$user->get_address()."</td></tr>";
                                echo "<tr><td>coordinate:</td><td>".$user->get_coordinate()."</td></tr>";
                                echo "<tr><td>Tel:</td><td>".$user->get_tel()."</td></tr>";
                                echo "<tr><td>IsAdmin:</td><td>".$user->get_isadmin()."</td></tr>";
                                 echo "<tr><td>New Password:</td><td><input type='password' name='newpassword' value=''/></td></tr>";
                                echo "<tr><td>Confirm New Password:</td><td><input type='password' name='confirmnewpassword' value=''/></td></tr>";
                                echo "<tr><td colspan='2'><input type='submit' value='Change Password'/>&nbsp;<input type='button' value='Cancel' /></td></tr>";
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
                <?php# include 'include/footer.php'; ?>
        </div>
        <!-- end div#wrapper -->
    </body>
</html>
