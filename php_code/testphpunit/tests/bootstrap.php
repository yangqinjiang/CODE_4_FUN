<?php 
require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/lib.php';
//Register non-Slim autoloader
function customAutoLoader($class)
{
	$file = dirname(__FILE__) . '/' . $class . '.php';
	if (file_exists($file)) {
		require $file;
	} else {
		return;
	}
}
spl_autoload_register('customAutoLoader');

 ?>
