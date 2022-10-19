<?php
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

spl_autoload_register(function($class) {
	
	$prefix = 'VXN\Express\Core\\';

	if ( substr($class,0,strlen($prefix))  !== $prefix  ) {
		return;
	}

	$class = str_replace($prefix, 'class' . DIRECTORY_SEPARATOR, $class);
	$class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
	$class = str_replace("_", '-', $class);
	$class = strtolower($class);


	// $class  = str_replace($prefix, DIRECTORY_SEPARATOR . 'class'. DIRECTORY_SEPARATOR, $class);    
	// $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
	// $class = str_replace("_", '-', $class);
	// $class = strtolower($class);

	// $class = str_replace("VXN\Express\Core", 'class', $class);
	// $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
	// $class = str_replace("_", '-', $class);
	// $class = strtolower($class);
	
	require_once VXN_EXPRESS_CORE_PATH . $class . '.php';

});
