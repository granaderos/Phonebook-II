<?php
	
	session_start();
	
	include "USERS/function_home.php";
	
	$current_user_id = $_POST['current_user_id'];
	$friend_id = $_POST['friend_id'];
	$shared_contact_id = $_POST['shared_contact_id'];
	$shared_time = $_POST['shared_time'];
	
	$execute_add = new function_home();
	$execute_add->add_shared_phonebook_entries($current_user_id, $friend_id, $shared_contact_id, $shared_time);
	
?>
