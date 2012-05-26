<?php
include("domain/user.php");
include("domain/branch.php");
include("domain/product.php");
include("domain/order.php");
include("domain/mealorderitem.php");

	
$databaseURL;
$databaseUName;
$databasePWord;
$databaseName; 


function initDB() {
    if(! isset($_SESSION['databaseURL'])) {
        include("conf/conf.php");
        $dbConf = new FoodConf();
        $databaseURL = $dbConf->get_databaseURL();
        $databaseUName = $dbConf->get_databaseUName();
        $databasePWord = $dbConf->get_databasePWord();
        $databaseName = $dbConf->get_databaseName();

        $_SESSION['databaseURL']=$databaseURL;
        $_SESSION['databaseUName']=$databaseUName;
        $_SESSION['databasePWord']=$databasePWord;
        $_SESSION['databaseName']=$databaseName;



        $connection = mysql_connect($databaseURL,$databaseUName,$databasePWord) or die ("Error while connecting to localhost".mysql_error());
        $db = mysql_select_db($databaseName,$connection) or die ("Error while connecting to database".mysql_error());

        mysql_close($connection);
    }
    $databaseURL = $_SESSION['databaseURL'];
    $databaseUName = $_SESSION['databaseUName'];
    $databasePWord = $_SESSION['databasePWord'];
    $databaseName = $_SESSION['databaseName'];

    $connection = mysql_connect($databaseURL,$databaseUName,$databasePWord) or die ("Error while connecting to host".mysql_error());
    $db = mysql_select_db($databaseName,$connection) or die ("Error while connecting to database".mysql_error());
    return $connection;
}

function closeDB($connection) {
    mysql_close($connection);
}

function getUserInfo($uid) {
    $connection = initDB();
    $query;

    if($uid == 0) {
        $query = "SELECT * FROM user";
    }
    else {
        $query = "SELECT * FROM user WHERE UID='".$uid."'";
    }

    $result = mysql_query($query) or die ("Query Failed ".mysql_error());

    $userData;
    $lineId = 0;

    while($row = mysql_fetch_array($result)) {

        $uid = $row['uid'];
        $name = $row['name'];
        $tel = $row['tel'];
        $address = $row['address'];
        $coordinate = $row['coordinate'];
        $password = $row['password'];
        $isAdmin = $row['isadmin'];

        //Build the user object
        $user = new User();
        $user->set_uid($uid);
        $user->set_name($name);
        $user->set_tel($tel);
        $user->set_address($address);
        $user->set_coordinate($coordinate);
        $user->set_password($password);
        $user->set_isadmin($isAdmin);

        //Build the Flight object array
        $userData[$lineId] = $user;
        $lineId = $lineId + 1;
    }
    closeDB($connection);
    return $userData;
}

function editUser($user) {
    $connection = initDB();
    $query;

    if(isset($user)) {
        $query = "update user set name='".$user->get_name()."', address='".$user->get_address()."',tel='".$user->get_tel()."',coordinate='".$user->get_coordinate()."' where uid='".$user->get_uid()."';";
    //echo $query;
    }

    $result = mysql_query($query) or die ("Query Failed ".mysql_error());
    closeDB($connection);
}

function login($user) {
    $connection = initDB();
    $query;
    
    if(isset($user)) {
        $query = "SELECT password FROM user where uid='".$user->get_uid()."' ;";
    }
    else {
        echo 'user is empty';
    }

    $result = mysql_query($query);
    $Arr =  mysql_fetch_assoc($result);
    closeDB($connection);
	if ($Arr == null)
	{
		session_start();
		$_SESSION['errorMessage']="用户ID不存在";
		return false;
	}
    else if(sha1($user->get_password()) != $Arr['password']){
		session_start();
		$_SESSION['errorMessage']="密码错误";
		return false;
	}
	else{
	    session_start();
        $_SESSION['login']=true;
		$_SESSION['uid']=$user->get_uid();
        $_SESSION['userData']=json_encode($Arr);
        $_SESSION['isAdmin']=$Arr['isadmin']=='Y';
        return true;
    }
}

function changePassword($user,$newpassword,$confirmnewpassword) {
    if ($newpassword!=$confirmnewpassword) {
        session_start();
        $_SESSION['errorMessage']="New password not match.";
        return false;
    }
    $connection = initDB();
    $query;

    if(isset($user)) {
        $query = "SELECT password FROM user where uid='".$user->get_uid()."';";
    }

    $result = mysql_query($query);
    $Arr =  mysql_fetch_assoc($result);

    if ($Arr['password'] == sha1($user->get_password())) {
        $query2 = "update user set password='".sha1($newpassword)."' where uid=".$user->get_uid().";";
        $result2 = mysql_query($query2);
        if ($result2==true) {
			closeDB($connection);
			return true;
        }else {
            session_start();
            $_SESSION['errorMessage']="Update password error.";
            closeDB($connection);
			return false;
        }

    }else {
        session_start();
        $_SESSION['errorMessage']="Old password error.";
        closeDB($connection);
        return false;
    }
}

function adminChangeUserPassword($user,$confirmnewpassword) 
{
    if ($user->get_password()!=$confirmnewpassword) {
        session_start();
        $_SESSION['errorMessage']="New password not match.";
        return false;
    }
    $connection = initDB();
    $query;

    if(isset($user)) {
        $query = "SELECT count(*) as countNum FROM user where id=".$user->get_id().";";
    }

    $result = mysql_query($query);
    $countArr =  mysql_fetch_assoc($result);
    $count = $countArr['countNum'];

    if (isset($count)&&$count==1) {
        $query2 = "update user set password='".sha1($user->get_password())."' where id=".$user->get_id().";";
        $result2 = mysql_query($query2);
        if ($result2==true) {
            closeDB($connection);
            return true;
        }else {
            session_start();
            $_SESSION['errorMessage']="Update password error.";
            closeDB($connection);
        }

    }else {
        session_start();
        $_SESSION['errorMessage']="User did not exist.";
        closeDB($connection);
        return false;
    }
}

function toggleAdmin($user) 
{
    $connection = initDB();
    $query;

    if(isset($user)) {
        $query = "SELECT uid, isadmin from user where uid='".$user->get_uid()."';";
    }

    $result = mysql_query($query);
    $arr =  mysql_fetch_assoc($result);
    $isAdmin = $arr['isadmin'];
    $isNewAdmin;
    session_start();
    $userData = json_decode($_SESSION['userData'],true);

    if ($isAdmin=='N' || $userData['uid']==$user->get_uid()) {
        $isNewAdmin='Y';
    }else if($isAdmin=='Y') {
            $isNewAdmin= 'N';
        }else {
            $isNewAdmin= 'N';
        }

    if (isset($isNewAdmin)) {
        $query2 = "update user set isadmin='".$isNewAdmin."' where uid='".$user->get_uid()."';";
        $result2 = mysql_query($query2);
        if ($result2==true) {
            closeDB($connection);
            return true;
        }else {
            session_start();
            $_SESSION['errorMessage']="Update isAdmin error.";
            closeDB($connection);
            return false;
        }

    }else {
        session_start();
        $_SESSION['errorMessage']="User did not exist.";
        closeDB($connection);
        return false;
    }
}

function registerUser($user,$confirmpassword) {
    if ($user->get_password()!=$confirmpassword) {
        session_start();
        $_SESSION['errorMessage']="两次输入不一致";
        return false;
    }
    $connection = initDB();
    $query;

    if(isset($user)) {
        $query = "SELECT uid FROM user where uid='".$user->get_uid()."';";
    }

    $result = mysql_query($query);
    $Arr =  mysql_fetch_assoc($result);

    if ($Arr['uid']) {
        session_start();
        $_SESSION['errorMessage']="用户id已存在";
        closeDB($connection);
        return false;
    }else {
        $query2 = "insert into user (uid,name,tel,address,coordinate,password) values 
        ('".$user->get_uid()."','".$user->get_name()."','".$user->get_tel()."','".$user->get_address().
        "','".$user->get_coordinate()."','".sha1($user->get_password())."');";
        $result2 = mysql_query($query2);
        if ($result2== true) {
            closeDB($connection);
            return true;
        } else {
            session_start();
            $_SESSION['errorMessage']="注册失败";
            closeDB($connection);
            return false;
        }
    }
}

function getBranchInfo() {
    $connection = initDB();
    $query;

    $query = "SELECT * FROM branch";

    $result = mysql_query($query) or die ("Query Failed ".mysql_error());

    $branchData;
    $lineId = 0;

    while($row = mysql_fetch_array($result)) {

        $bid = $row['bid'];
        $name = $row['name'];
        $address = $row['address'];
        $tel = $row['tel'];
        $coordinate = $row['coordinate'];

        //Build the user object
        $branch = new Branch();
        $branch->set_uid($bid);
        $branch->set_name($name);
        $branch->set_address($address);
        $branch->set_telephone($tel);
        $branch->set_description($coordinate);

        //Build the Flight object array
        $branchData[$lineId] = $branch;
        $lineId = $lineId + 1;
    }
    closeDB($connection);
    return $branchData;
}

function addRestaurant($restaurant) {
    $connection = initDB();
    $query;

    if(isset($restaurant)) {
        $query = "insert into restaurants (name, telephone, address, description,isactive) values ('".$restaurant->get_name()."','".$restaurant->get_telephone()."','".$restaurant->get_address()."','".$restaurant->get_description()."','".$restaurant->get_isactive()."');";
    }
    else {
        echo "The user is empty!";
        return false;
    }

    //echo $query;
    $result = mysql_query($query);
    // or die ("Query Failed ".mysql_error());

    if ($result==false) {
        echo "insert wrong!";
        return false;
    }else {
        return true;
    }
}

function editRestaurant($restaurant) {
    $connection = initDB();
    $query;

    if(isset($restaurant)) {
        $query = "update restaurants set name='".$restaurant->get_name()."',  description='".$restaurant->get_description()."', address='".$restaurant->get_address()."',telephone='".$restaurant->get_telephone()."' where id=".$restaurant->get_id().";";
    //echo $query;
    }

    $result = mysql_query($query);
    // or die ("Query Failed ".mysql_error());
    closeDB($connection);
}

function deleteRestaurant($id) {
    $connection = initDB();
    $query;

    if(isset($id)) {
        $query = "delete from  restaurants where id=".$id.";";
    }
    else {
        echo "The id is empty!";
        return false;
    }

    //echo $query;
    $result = mysql_query($query);
    // or die ("Query Failed ".mysql_error());

    if ($result==false) {
        echo "delete wrong!";
        return false;
    }else {
        return true;
    }
}

function toggleRestaurant($restaurant) {
    $connection = initDB();
    $query;

    if(isset($restaurant)) {
        $query = "SELECT id, isActive from restaurants where id=".$restaurant->get_id().";";
    }

    $result = mysql_query($query);
    $arr =  mysql_fetch_assoc($result);
    $isActive = $arr['isActive'];
    $isNewActive;

    if ($isActive=='N' ) {
        $isNewActive='Y';
    }else if($isActive=='Y') {
            $isNewActive= 'N';
        }else {
            $isNewActive= 'N';
        }

    if (isset($isNewActive)) {
        $query2 = "update restaurants set isActive='".$isNewActive."' where id=".$restaurant->get_id().";";
        $result2 = mysql_query($query2);
        if ($result2==true) {
            closeDB($connection);
            return true;
        }else {
            session_start();
            $_SESSION['errorMessage']="Update isAdmin error.";
            closeDB($connection);
            return false;
        }

    }else {
        session_start();
        $_SESSION['errorMessage']="User did not exist.";
        closeDB($connection);
        return false;
    }
}

function getProducts($name) {
    $connection = initDB();
    $query;
	if (!$name)
    {$query = "SELECT * FROM product";}
	else
	{$query = "SELECT * FROM product WHERE name LIKE'%".$name."%';";}

    $result = mysql_query($query) or die ("Query Failed ".mysql_error());

    $productData;
    $lineId = 0;

    while($row = mysql_fetch_array($result)) {

        $pid = $row['pid'];
        $sort = $row['sort'];
        $name = $row['name'];
        $price = $row['price'];
        $description= $row['description'];

        //Build the user object
        $product = new Product();
        $product->set_pid($pid);
        $product->set_sort($sort);
        $product->set_name($name);
        $product->set_price($price);
        $product->set_description($description);

        //Build the Flight object array
        $productData[$lineId] = $product;
        $lineId = $lineId + 1;
    }
    closeDB($connection);
    return $productData;
}

function getProductInfo($pid) {
    $connection = initDB();
    $query;

    $query = "SELECT * FROM product WHERE pid=".$pid.";";
	
    $result = mysql_query($query) or die ("Query Failed ".mysql_error());

    $productData;
    $lineId = 0;

    while($row = mysql_fetch_array($result)) {
        $pid = $row['pid'];
        $sort = $row['sort'];
        $name = $row['name'];
        $price = $row['price'];
        $description= $row['description'];

        //Build the user object
        $product = new Product();
        $product->set_pid($pid);
        $product->set_sort($sort);
        $product->set_name($name);
        $product->set_price($price);
        $product->set_description($description);

        //Build the Flight object array
        $productData[$lineId] = $product;
        $lineId = $lineId + 1;
    }
    closeDB($connection);
    return $productData;
}

function addMenuItem($menuItem) {
    $connection = initDB();
    $query;

    if(isset($menuItem)) {
        $query = "insert into menuitems (restaurant_id, menu_name, menu_description, isActive,price,promotion) values (".$menuItem->get_restaurant_id().",'".$menuItem->get_menu_name()."','".$menuItem->get_menu_description()."','".$menuItem->get_isActive()."',".$menuItem->get_price().",'".$menuItem->get_promotion()."');";
    }
    else {
        echo "The user is empty!";
        return false;
    }

    // echo $query;
    $result = mysql_query($query);
    // or die ("Query Failed ".mysql_error());

    if ($result==false) {
        echo "insert wrong!";
        return false;
    }else {
        return true;
    }
}

function deleteMenuItem($id) {
    $connection = initDB();
    $query;

    if(isset($id)) {
        $query = "delete from  menuitems where id=".$id.";";
    }
    else {
        echo "The id is empty!";
        return false;
    }

    //echo $query;
    $result = mysql_query($query);
    // or die ("Query Failed ".mysql_error());

    if ($result==false) {
        echo "delete wrong!";
        return false;
    }else {
        return true;
    }
}

function toggleMenuItem($menuItem) {
    $connection = initDB();
    $query;

    if(isset($menuItem)) {
        $query = "SELECT id, isActive from menuitems where id=".$menuItem->get_id().";";
    }

    $result = mysql_query($query);
    $arr =  mysql_fetch_assoc($result);
    $isActive = $arr['isActive'];
    $isNewActive;

    if ($isActive=='N' ) {
        $isNewActive='Y';
    }else if($isActive=='Y') {
            $isNewActive= 'N';
        }else {
            $isNewActive= 'N';
        }

    if (isset($isNewActive)) {
        $query2 = "update menuitems set isActive='".$isNewActive."' where id=".$menuItem->get_id().";";
        $result2 = mysql_query($query2);
        if ($result2==true) {
            closeDB($connection);
            return true;
        }else {
            session_start();
            $_SESSION['errorMessage']="Update isActive error.";
            closeDB($connection);
            return false;
        }

    }else {
        session_start();
        $_SESSION['errorMessage']="Menu item did not exist.";
        closeDB($connection);
        return false;
    }
}

function editMenuItem($menuItem) {
    $connection = initDB();
    $query;

    if(isset($menuItem)) {
        $query = "update menuitems set restaurant_id=".$menuItem->get_restaurant_id().",  menu_name='".$menuItem->get_menu_name()."', menu_description='".$menuItem->get_menu_description()."',price=".$menuItem->get_price().",promotion='".$menuItem->get_promotion()."' where id=".$menuItem->get_id().";";
    //echo $query;
    }

    $result = mysql_query($query);
    // or die ("Query Failed ".mysql_error());
    closeDB($connection);
}

function addOrder($order){
 $connection = initDB();
    $query;

    if(isset($order)) {
        $query = "insert into `order` (uid, bid, pid, quantity, price, time,status) values ('".$order->get_uid()."',0,".$order->get_pid().",".$order->get_quantity().",".$order->get_price().",'".$order->get_time()."','".$order->get_status()."');";
    }
    else {
        echo "The order is empty!";
        return false;
    }

    $result = mysql_query($query) or die ("Query Failed ".mysql_error());;
	if (!$result){
    /*$mealorder_id = mysql_insert_id();

    if(isset($mealorder)) {
    $mealorderitem->set_mealorder_id($mealorder_id);

    $query1 = "insert into mealorderitems (mealorder_id, menuitem_id,price, amount) values (".$mealorderitem->get_mealorder_id().",".$mealorderitem->get_menuitem_id().",".$mealorderitem->get_price().",".$mealorderitem->get_amount().");";
    //echo $query1;
    $result1 = mysql_query($query1);
    }
    else {
        echo "The meal order item is empty!";
        return false;
    }
    if ($result==false) {
        echo "insert meal order wrong!";
        return false;
    }else if ($result1==false){
        echo "insert meal order item wrong!";*/
        return false;
    }else{
        return true;
    }
}

function getMealOrderInfo($user_id){
  $connection = initDB();
    $query;

    if(isset($user_id)) {
        date_default_timezone_set("PRC");
        $starttime=date("Y-m-d");
        $endtime=date("Y-m-d",(time()+3600*24));

        $query = "SELECT mealorders.id as mealorder_id, user_id, order_time,mealorders.description as mealorder_description,mealorders.promotion as mealorder_promotion,mealorders.isActive as mealorder_isActive,mealorderitems.id as mealorderitem_id,menuitem_id,mealorderitems.price as mealorderitem_price,amount,menu_name,name FROM mealorders, mealorderitems,menuitems, restaurants where mealorderitems.mealorder_id=mealorders.id and mealorderitems.menuitem_id=menuitems.id and menuitems.restaurant_id=restaurants.id and user_id=".$user_id." and order_time<'".$endtime."' and order_time>='".$starttime."' and mealorders.isActive='Y';";
        //echo $query;
        $result = mysql_query($query);
    // or die ("Query Failed ".mysql_error());
    $res_array;
    for ($count=0; $row = mysql_fetch_assoc($result); $count++) {
     $res_array[$count] = $row;
    }
    closeDB($connection);
    return $res_array;
    }
    else {
        closeDB($connection);
        echo "Get Meal Order Info fail, the user id is not set.";
        return null;
    }
}

function getMealOrderInfoAll(){
  $connection = initDB();
    $query;


        date_default_timezone_set("PRC");
        $starttime=date("Y-m-d");
        $endtime=date("Y-m-d",(time()+3600*24));

        $query = "SELECT mealorders.id as mealorder_id, user_id, order_time,mealorders.description as mealorder_description,mealorders.promotion as mealorder_promotion,mealorders.isActive as mealorder_isActive,mealorderitems.id as mealorderitem_id,menuitem_id,mealorderitems.price as mealorderitem_price,amount,menu_name,name,user.id,username,uid FROM mealorders, mealorderitems,menuitems, restaurants,user where mealorderitems.mealorder_id=mealorders.id and mealorderitems.menuitem_id=menuitems.id and menuitems.restaurant_id=restaurants.id and user_id=user.id and order_time<'".$endtime."' and order_time>='".$starttime."' and mealorders.isActive='Y';";
        //echo $query;
        $result = mysql_query($query);
    // or die ("Query Failed ".mysql_error());
    $res_array;
    for ($count=0; $row = mysql_fetch_assoc($result); $count++) {
     $res_array[$count] = $row;
    }
    closeDB($connection);
    return $res_array;
}

function getMealOrderInfoHistory(){
  $connection = initDB();
    $query;


        date_default_timezone_set("PRC");
        $starttime=date("Y-m-d");
        $endtime=date("Y-m-d",(time()+3600*24));

        $query = "SELECT mealorders.id as mealorder_id, user_id, order_time,mealorders.description as mealorder_description,mealorders.promotion as mealorder_promotion,mealorders.isActive as mealorder_isActive,mealorderitems.id as mealorderitem_id,menuitem_id,mealorderitems.price as mealorderitem_price,amount,menu_name,name,user.id,username,uid FROM mealorders, mealorderitems,menuitems, restaurants,user where mealorderitems.mealorder_id=mealorders.id and mealorderitems.menuitem_id=menuitems.id and menuitems.restaurant_id=restaurants.id and user_id=user.id order by order_time desc;";
        //echo $query;
        $result = mysql_query($query);
    // or die ("Query Failed ".mysql_error());
    $res_array;
    for ($count=0; $row = mysql_fetch_assoc($result); $count++) {
     $res_array[$count] = $row;
    }
    closeDB($connection);
    return $res_array;
}

function deleteMealOrder($id) {
    $connection = initDB();
    $query;

    if(isset($id)) {
        $query = "delete from  mealorders where id=".$id.";";
    }
    else {
        echo "The id is empty!";
        return false;
    }

    //echo $query;
    $result = mysql_query($query);
    // or die ("Query Failed ".mysql_error());
    $query2 = "delete from  mealorderitems where mealorder_id=".$id.";";

    $result2 = mysql_query($query2);

    if ($result==false) {
        echo "delete mealorder wrong!";
        return false;
    }else if ($result2==false){
        echo "delete mealorderitem wrong!";
        return false;
    }else {
        return true;
    }
}

function toggleMealOrder($id) {
    $connection = initDB();
    $query;

    if(isset($id)) {
        $query = "SELECT id, isActive from mealorders where id=".$id.";";
    }

    $result = mysql_query($query);
    $arr =  mysql_fetch_assoc($result);
    $isActive = $arr['isActive'];
    $isNewActive;

    if ($isActive=='N' ) {
        $isNewActive='Y';
    }else if($isActive=='Y') {
            $isNewActive= 'N';
        }else {
            $isNewActive= 'N';
        }

    if (isset($isNewActive)) {
        $query2 = "update mealorders set isActive='".$isNewActive."' where id=".$id.";";
        $result2 = mysql_query($query2);
        if ($result2==true) {
            closeDB($connection);
            return true;
        }else {
            session_start();
            $_SESSION['errorMessage']="Update isActive error.";
            closeDB($connection);
            return false;
        }

    }else {
        session_start();
        $_SESSION['errorMessage']="Meal order did not exist.";
        closeDB($connection);
        return false;
    }
}
?>
