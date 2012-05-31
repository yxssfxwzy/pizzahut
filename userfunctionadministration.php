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
    ?>
    
    <body>
        <div id="wrapper">
        <?php include 'include/header.php'; ?>
            <!-- end div#header -->
            <div id="page">
                <div id="content">
                    <div id="welcome">
                        <h2><?php
                                session_start();
                                echo $_SESSION['errorMessage'];
                                unset($_SESSION['errorMessage']);
                                ?></h2>
                        <!-- Fetch Rows -->
                        <table class="aatable">
                            <tr>
                                <th>UID</th>
                                <th>name</th>
                                <th>address</th>
                                <th>coordinate</th>
                                <th>tel</th>
                                <th>IsAdmin</th>
                                <th>Operation</th>
                            </tr>
                            <?php
                            $userData = getUserInfo($id);
                            
                            for($index=0;$index < count($userData);$index++){
                                $user = $userData[$index];
                                echo "<tr>";
                                echo "<td>".$user->get_uid()."</td>";
                                echo "<td>".$user->get_name()."</td>";                            
                                echo "<td>".$user->get_address()."</td>";
                                echo "<td>".$user->get_coordinate()."</td>";
                                echo "<td>".$user->get_tel()."</td>";
                                echo "<td>".$user->get_isadmin()."</td>";
                                echo "<td><form action='changepassworduserform.php' method='post'><input type='hidden' name='id' value='".$user->get_uid()."'/><input type='submit' value='Change Password' /></form>
                                          <form action='toggleAdminController.php' method='post'><input type='hidden' name='id' value='".$user->get_uid()."'/><input type='submit' value='Toggle Admin' /></form>
                                          <form action='adminedituser.php' method='post'><input type='hidden' name='id' value='".$user->get_uid()."'/><input type='submit' value='Edit' /></form>  </td>";
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
