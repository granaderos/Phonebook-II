<?php
	
	session_start();
	
	include "USERS/function_home.php";
	
	$contact_id = $_POST['id'];
	
	$execute_retrieve = new function_home();
	$execute_retrieve->retrieve_entry($contact_id);
?>
