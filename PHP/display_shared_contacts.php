<?php
	
	session_start();
	
	include 'USERS/function_home.php';
	
	$current_user_id = $_POST['current_user_id'];
	
	$execute_display = new function_home();
	$execute_display->display_shared_contacts($current_user_id);
?>
