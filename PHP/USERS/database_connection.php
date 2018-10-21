<?php

	class database_connection {
		
		protected $dbh;
		
		function open_connection() { 
		
			$this->dbh = new PDO("mysql:host=localhost;dbname=mjPhonebook", "root", "");
		}
		
		function close_connection() {
			
			$this->dbh = null;	
			
		}
		
	}
?>
