<?
	$handler['ls'] = array(
		 'name'			=> 'ls'
		,'version'		=> '0.2'
		,'summary'		=> 'list directory contents'
		,'syntax'		=> 'ls [OPTIONS] [FILES]'
		,'description'	=> 'there no manual for this script yet...'
		,'author'		=> 'Written by Evgeny Grinec aka x-positive @ Adeptx, Inc.'
		,'callback'		=> 'E-mail: e.grinec@gmail.com'
		,'copyright'	=> 'Copyright © 2015 Adeptx, Inc. License GPLv3+: GNU GPL version 3 or later <http://gnu.org/licenses/gpl.html>. This is free software: you are free to change and redistribute it. There is NO WARRANTY, to the extent permitted by law.'
		,'run'			=> function($arguments) use ($handler) {
		include_once 'handler/output.php';

		foreach (glob('*') as $file_name) {
			if (is_dir($file_name)) $file_name.='/';
			$handler['output']['run']($file_name);
		}
	});