<?php
	
	session_start();
	
	include "function_home.php";
	
	$username_entered = $_SESSION['username_entered'];
	
	$execute = new function_home();
	$execute->determine_current_user($username_entered);
?>
