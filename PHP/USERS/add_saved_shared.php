<?php
	include "function_home.php";
	
	$current_user_id = $_POST["current_user_id"];
	$saved_contact_id = $_POST['id'];
	$saved_time = $_POST['saved_time'];
	
	$execute_add = new function_home();
	$execute_add->add_save_shared($current_user_id, $saved_contact_id, $saved_time);
?>
