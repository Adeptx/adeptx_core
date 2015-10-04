<?
	// $handler['output'] = array(
	// 	 'name'			=> 'output'
	// 	,'version'		=> '0.2.2'
	// 	,'summary'		=> 'output any arguments'
	// 	,'syntax'		=> 'output [ARGUMENTS]'
	// 	,'description'	=> 'there no manual for this script yet...'
	// 	,'author'		=> 'Written by Evgeny Grinec aka x-positive @ Adeptx, Inc.'
	// 	,'callback'		=> 'E-mail: e.grinec@gmail.com'
	// 	,'copyright'	=> 'Copyright © 2015 Adeptx, Inc. License GPLv3+: GNU GPL version 3 or later <http://gnu.org/licenses/gpl.html>. This is free software: you are free to change and redistribute it. There is NO WARRANTY, to the extent permitted by law.'
	// 	,'run'			=> function($arguments) use ($handler) {
		for ($i = 1; $i < count($arg); $i++) {
			$return .= $arg[$i];
		}
	// });

	return $return;