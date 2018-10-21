<?php
	
	session_start();
	
	include "function_home.php";
	
	$execute_retrieve = new function_home();
	$execute_retrieve->retrieve_all_users();
?>
