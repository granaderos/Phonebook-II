<?php
	
	session_start();
	
	include "function_home.php";
	
	$search_people_field = $_POST['search_people_field'];
	$current_user_id = $_POST['current_user_id'];
	
	$execute_search = new function_home();
	$execute_search->search_people($search_people_field, $current_user_id);

?>
