<?
	$page['title'] = 'File Manager';
	unset($page['header'], $page['footer']);
	$page['css'][] = array(
		'jQuery and jQuery UI (REQUIRED)' => 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css'
		,'elFinder CSS (REQUIRED)' => array('elfinder/elfinder.min.css', 'elfinder/theme.css')
	);
	$page['js']['async'] = array(
		'jQuery and jQuery UI (REQUIRED)' => array( 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js')
		,'elFinder JS (REQUIRED)' => 'elfinder/elfinder.min.js'
		,'elFinder translation (OPTIONAL)' => 'elfinder/i18n/elfinder.ru.js'
	);