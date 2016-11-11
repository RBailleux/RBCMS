<?php
	include dirname(__FILE__).'/core/class/utilit.class.php';

	$install = new rbDatabase();
	$install->installMainDatabase();
?>