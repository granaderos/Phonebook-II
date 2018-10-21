<?php
	
	session_start();
	
	include "function_home.php";
	
	$current_user_id = $_POST['current_user_id'];
	$friend_id = $_POST['friend_id'];
	
	$execute_add = new function_home();
	$execute_add->add_friends($current_user_id, $friend_id);
?>
