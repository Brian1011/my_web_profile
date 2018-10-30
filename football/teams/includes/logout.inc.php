<?php
	session_start();
	//destroy the session ref only
	
	if(isset($_SESSION['coach'])){
	//session_destroy();

	//unset the session 
	//unset destroys a specific function
	unset($_SESSION['coach']);

	header("location: ../../login/index.php?message=logout");
	}
?>