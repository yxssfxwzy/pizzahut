<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>用户注册</title>
        <link href="css/default.css" rel="stylesheet" type="text/css" />
    </head>
   
    <body>
        <div id="wrapper">
        <?php include 'include/header.php'; ?>
            <!-- end div#header -->
            <div id="page">
                <div id="content">
                    <div id="welcome">
                        <form action="registerController.php" method="post">
                        <h2><?php
                                echo $_SESSION['errorMessage'];
                                unset($_SESSION['errorMessage']);
                                ?></h2>
                        <table class="aatable">
                                <tr><td colspan='2'> 用户注册 </td></tr>
                                <tr><td>用户id:</td><td><input type='text' name='uid' value=''/></td></tr>
                                <tr><td>用户名:</td><td><input type='text' name='name' value=''/></td></tr>
                                <tr><td>电话:</td><td><input type='text' name='tel' value=''/></td></tr>
                                <tr><td>地址:</td><td><input type='text' name='address' value=''/></td></tr>
                                <tr><td>经纬度:</td><td><input type='text' name='coordinate' value=''/></td></tr>
                                <tr><td>输入密码</td><td><input type='password' name='password' value=''/></td></tr>
                                <tr><td>确认密码</td><td><input type='password' name='confirmpassword' value=''/></td></tr>
                                <tr><td colspan='2'><input type='submit' value='注册'/>&nbsp;<input type='button' value='放弃'  onclick='javaScript:window.location.href="index.php";'/></td></tr>
                        </table>
                        </form>
                    </div>
                    <!-- end div#welcome -->			
                    
                </div>
                <!-- end div#content -->
                <div id="sidebar">
                </div>
                <!-- end div#sidebar -->
                <div style="clear: both; height: 1px"></div>
            </div>
                <?php include 'include/footer.php'; ?>
        </div>
        <!-- end div#wrapper -->
    </body>
</html>
