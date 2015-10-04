<?php

error_reporting(0); // Set E_ALL for debuging

include_once __DIR__.DIRECTORY_SEPARATOR.'elFinderConnector.class.php';
include_once __DIR__.DIRECTORY_SEPARATOR.'elFinder.class.php';
include_once __DIR__.DIRECTORY_SEPARATOR.'elFinderVolumeDriver.class.php';
include_once __DIR__.DIRECTORY_SEPARATOR.'elFinderVolumeLocalFileSystem.class.php';
// Required for MySQL storage connector
include_once __DIR__.DIRECTORY_SEPARATOR.'elFinderVolumeMySQL.class.php';
// Required for FTP connector support
include_once __DIR__.DIRECTORY_SEPARATOR.'elFinderVolumeFTP.class.php';


/**
 * Simple function to demonstrate how to control file access using "accessControl" callback.
 * This method will disable accessing files/folders starting from  '.' (dot)
 *
 * @param  string  $attr  attribute name (read|write|locked|hidden)
 * @param  string  $path  file path relative to volume root directory started with directory separator
 * @return bool|null
 **/
function access($attr, $path, $data, $volume) {
	return preg_match('!^[_\.]!', basename($path))       // if file/folder begins with '.' (dot)
		? !($attr == 'read' || $attr == 'write')    // set read+write to false, other (locked+hidden) set to true
		:  null;                                    // else elFinder decide it itself
}

$opts = array(
	// 'debug' => true,
	'roots' => array(
		array(
			'driver'        => 'LocalFileSystem',
			'path'          => 'ajax/',
			'URL'           => dirname($_SERVER['PHP_SELF']) . '/ajax/',
			'accessControl' => 'access'
		),
		array(
			'driver'        => 'LocalFileSystem',
			'path'          => 'class/',
			'URL'           => dirname($_SERVER['PHP_SELF']) . '/class/',
			'accessControl' => 'access'
		),
		array(
			'driver'        => 'LocalFileSystem',
			'path'          => 'conf/',
			'URL'           => dirname($_SERVER['PHP_SELF']) . '/conf/',
			'accessControl' => 'access'
		),
		array(
			'driver'        => 'LocalFileSystem',
			'path'          => 'css/',
			'URL'           => dirname($_SERVER['PHP_SELF']) . '/css/',
			'accessControl' => 'access'
		),
		array(
			'driver'        => 'LocalFileSystem',
			'path'          => 'font/',
			'URL'           => dirname($_SERVER['PHP_SELF']) . '/font/',
			'accessControl' => 'access'
		),
		array(
			'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
			'path'          => 'html/',         // path to files (REQUIRED)
			'URL'           => dirname($_SERVER['PHP_SELF']) . '/html/', // URL to files (REQUIRED)
			'accessControl' => 'access'             // disable and hide dot starting files (OPTIONAL)
		),
		array(
			'driver'        => 'LocalFileSystem',
			'path'          => 'img/',
			'URL'           => dirname($_SERVER['PHP_SELF']) . '/img/',
			'accessControl' => 'access'
		),
		array(
			'driver'        => 'LocalFileSystem',
			'path'          => 'js/',
			'URL'           => dirname($_SERVER['PHP_SELF']) . '/js/',
			'accessControl' => 'access'
		),
		array(
			'driver'        => 'LocalFileSystem',
			'path'          => 'lang/',
			'URL'           => dirname($_SERVER['PHP_SELF']) . '/lang/',
			'accessControl' => 'access'
		),
		array(
			'driver'        => 'LocalFileSystem',
			'path'          => 'rout/',
			'URL'           => dirname($_SERVER['PHP_SELF']) . '/rout/',
			'accessControl' => 'access'
		),
		array(
			'driver'        => 'LocalFileSystem',
			'path'          => 'setup/',
			'URL'           => dirname($_SERVER['PHP_SELF']) . '/setup/',
			'accessControl' => 'access'
		)
	)
);

// run elFinder
$connector = new elFinderConnector(new elFinder($opts));
$connector->run();

