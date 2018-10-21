<?php
	
	session_start();
	
	include "USERS/function_home.php";
	
	$contact_id = $_POST['id'];
	
	$execute_delete = new function_home();
	$execute_delete->delete_entry($contact_id);
?>
