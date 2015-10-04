<?php

error_reporting(E_ALL); # E_ALL for debuging

include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinderConnector.class.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinder.class.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinderVolumeDriver.class.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinderVolumeLocalFileSystem.class.php';
// Required for MySQL storage connector
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinderVolumeMySQL.class.php';
// Required for FTP connector support
// include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elFinderVolumeFTP.class.php';


/**
 * Simple function to demonstrate how to control file access using "accessControl" callback.
 * This method will disable accessing files/folders starting from  '.' (dot)
 *
 * @param  string  $attr  attribute name (read|write|locked|hidden)
 * @param  string  $path  file path relative to volume root directory started with directory separator
 * @return bool|null
 **/
function access($attr, $path, $data, $volume) {
	return preg_match('!^[_\.]!', basename($path))
		? !($attr == 'read' || $attr == 'write')    // set read+write to false, other (locked+hidden) set to true
		:  null;                                    // else elFinder decide it itself
}

$opts = array(
	// 'debug' => true,
	'roots' => array(
		array(
			'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
			# область видимости пользователя ограничена этим адресом
			# когда создавал для adeptx тут было '.'
			# для админки меняю на '/'
			'path'          => 'html/',         // path to files (REQUIRED)
			'URL'           => dirname($_SERVER['PHP_SELF']) . '/html/', // URL to files (REQUIRED)
			'accessControl' => 'access'     // disable and hide dot starting files (OPTIONAL)
	)	
)
);

// run elFinder
$connector = new elFinderConnector(new elFinder($opts));
$connector->run();

/*
	// Function: Hash checker
function checkHash($path, $fileName) {
	if(file_exists($path.$fileName)) {
		return true;
	}
	return false;
}
$getHash = stripslashes($_GET['access']);
// IF checkHash returns true then show elfinder
if(checkHash('html/elfinder/sessions/', $getHash)) {
	// run elFinder
	$connector = new elFinderConnector(new elFinder($opts)); //DO NOT EDIT
	$connector->run(); //DO NOT EDIT
}
*/