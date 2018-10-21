<?php
	
	session_start();
	
	include "USERS/function_home.php";
	
	$contact_id = $_POST['id'];
	$names = $_POST['names'];
	$contact_number = $_POST['contact_number'];
	
	$execute_edit = new function_home();
	$execute_edit->edit_entry($names, $contact_number, $contact_id);
?>
