<?php
include dirname(__FILE__).'/base.php';
require_once 'core/class/addon.class.php';
$test = new addon('test.zip');
var_dump($test->checkIntegrity());
?>