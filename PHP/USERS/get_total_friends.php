<?php
	
	session_start();
	
	include "function_home.php";
	
	$current_user_id = $_POST['current_user_id'];
	
	$execute_get_total = new function_home();
	$execute_get_total->get_total_friends($current_user_id);
?>
