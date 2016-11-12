<?php
	include dirname(__FILE__).'/core/class/rbDatabase.class.php';
	include dirname(__FILE__).'/core/class/login.class.php';
	
	$install = new rbDatabase();
	$install->installMainDatabase();
	
	session_start();
?>