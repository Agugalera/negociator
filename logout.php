<?php 
	$root = "";
	require_once($root."includes/session.php");
	require_once($root."includes/connect.php");
	require_once($root."includes/functions.php"); ?>
<?php

		// Four steps to closing a session
		// (i.e. logging out)

		// 1. Find the session
		session_start();
		
		// 2. Unset all the session variables
		$_SESSION = array();
		
		// 3. Destroy the session cookie
		if(isset($_COOKIE[session_name()])) {
			setcookie(session_name(), '', time()-42000, '/');
		}
		
		// 4. Destroy the session
		session_destroy();
		
		redirect_to("index.php?logout=1");
?>