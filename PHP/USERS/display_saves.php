<?php
	include "function_home.php";
	
	$current_user_id = $_POST['current_user_id'];
	
	$execute_display = new function_home();
	$execute_display->display_saves_notifications($current_user_id);
	
?>