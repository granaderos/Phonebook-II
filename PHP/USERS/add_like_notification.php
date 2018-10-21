<?php
	include "function_home.php";
	
	$current_user_id = $_POST["current_user_id"];
	$liked_contact_id = $_POST['id'];
	$liked_time = $_POST['liked_time'];
	
	$execute_add = new function_home();
	$execute_add->add_like_notification($current_user_id, $liked_contact_id, $liked_time);
?>
