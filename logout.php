<?php

		require_once('config.khan');
		require_once(COMPONENTS.SESSION);
		$_SESSION['Loggedin_User']="no";
		unset($_SESSION['Loggedin_User_password']);
		unset($_SESSION['current_loggedin_user']);
		unset($_SESSION['current_loggedin_user_email']);
		session_destroy();
		header('location:login');
	
?>