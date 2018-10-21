<?php
	include "function_home.php";
	
	$current_user_id = $_POST["current_user_id"];
	
	$execute_get = new function_home();
	$execute_get->get_total_notifications($current_user_id);
?>
