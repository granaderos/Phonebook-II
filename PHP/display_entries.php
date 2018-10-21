<?php
	
	session_start();
	
	include "USERS/function_home.php";
	
	$current_user = $_POST['current_user'];
	
	$execute_display = new function_home();
	$execute_display->display_entries($current_user);
?>
