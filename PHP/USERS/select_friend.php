<?php
	
	session_start();
	
	include "function_home.php";
	
	$current_user_id = $_POST["current_user_id"];
	
	$execute_select = new function_home();
	$execute_select->select_friend($current_user_id);
?>
