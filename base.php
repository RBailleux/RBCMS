<?php
	include dirname(__FILE__).'/core/class/rbDatabase.class.php';
	include dirname(__FILE__).'/core/class/login.class.php';
	
	$install = new rbDatabase();
	if(!$install->isMainDatabaseInstalled()){
		$install->installMainDatabase();
	}
	session_start();
?>