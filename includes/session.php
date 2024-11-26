<?php
	session_start();
	
	function logged_in() {
		$time = time()-($_SESSION['login_time']); //LOG: <5 UNLOG: >5
		$session = isset($_SESSION['usuario']); //LOG: TRUE / UNLOG: FALSE
		if (!session || $time >28800) {return FALSE;} 
		else {return TRUE;}
}
	
	function confirm_logged_in() {
		if (!logged_in()) {
			redirect_to("index.php");
		}
	}

	function logged_in_admin() {
		$time = time()-($_SESSION['admin_time']); //LOG: <5 UNLOG: >5
		$session = isset($_SESSION['admin']); //LOG: TRUE / UNLOG: FALSE
		if (!session || $time >3600) {return FALSE;} 
		else {return TRUE;}
}

	function confirm_logged_in_admin() {
		if (logged_in_admin()) {
			redirect_to("index.php");
		}
	}
?>