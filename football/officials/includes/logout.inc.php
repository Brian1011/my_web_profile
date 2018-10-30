<?php
	session_start();
	//destroy the session uname only

	if(isset($_SESSION['uname'])){
	//session_destroy();
	//session destriy eliminates all sessions

	//unset the session
	unset($_SESSION['uname']);

	header("location: ../../login/index.php?message=logout");
	}
	
?>