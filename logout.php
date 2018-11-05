<?php
	session_start();
	if(session_destroy()){//clear session variables and redirect to login page
		header("location: index.php");
	}
?>
