<?php
	include "USERS/function_home.php";
	
	$current_user_id = $_POST["current_user_id"];
	
	$execute_select = new function_home();
	$execute_select->get_total_phonebook_entries($current_user_id);
?>
