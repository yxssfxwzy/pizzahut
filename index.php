<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>订购你的比萨！</title>
        <link href="css/default.css" rel="stylesheet" type="text/css" />
    </head>
   
    <body>
        <div id="wrapper">
        <?php include 'include/header.php'; ?>
            <!-- end div#header -->
            <div id="page">
                <div id="content">
                    <h1>登陆</h1>
                <form action="login.php" method="post">
                <table>
                <h2><?php
                    	echo $_SESSION['errorMessage'];
                        unset($_SESSION['errorMessage']);
                    ?></h2>
                <tr><td  class="login">用户ID:</td><td><input type="text" name="uid" value="" /></td></tr>
                <tr><td  class="login">密码:</td><td><input type="password" name="password" value="" /></td></tr>
                <tr><td colspan="2"><input type="submit" value="登陆"/>&nbsp;<input type='button' value='注册'  onclick='javaScript:window.location.href="register.php";'/></td></tr>
                </table>
            </form>
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
