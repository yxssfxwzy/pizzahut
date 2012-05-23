<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


include "../foodmanager.php";
 
$user = new User();
$user->set_uid($_POST['uid']);
$user->set_password($_POST['password']);
$newpassword = $_POST['newpassword'];
$confirmnewpassword = $_POST['confirmnewpassword'];
if (changePassword($user,$newpassword,$confirmnewpassword)){
/*	echo <<<script
	<script>
		alert('修改成功');
		window.location.href="userhomepage.php";
		</script>
script;
exit;   
*/
    Header("Location:userhomepage.php");
}else {
    Header("Location:changepassword.php");
}
?>
