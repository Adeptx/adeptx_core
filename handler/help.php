<?
	$handler['help'] = array(
		 'name' => 'help'
		,'version' => '0.5'
		,'summary' => 'script for look descriptions of other programs'
		,'syntax' => 'help [SCRIPTS]'
		,'description' => 'there no manual for this script yet...'
		,'author' => 'Written by Evgeny Grinec aka x-positive @ Adeptx, Inc.'
		,'callback' => 'E-mail: e.grinec@gmail.com'
		,'copyright' => 'Copyright © 2015 Adeptx, Inc. License GPLv3+: GNU GPL version 3 or later <http://gnu.org/licenses/gpl.html>. This is free software: you are free to change and redistribute it. There is NO WARRANTY, to the extent permitted by law.'
	);

	$handler['help']['resulting'] = function($handler, $script) use ($handler) {
		$handler_file = 'handler/' . $script . '.php';
		include_once $handler_file;

		$result .= 'SUMMARY' . EOL . EOL;
		$result .= htmlspecialchars($handler[$script]['name']) . ' ver.' . $handler[$script]['version'] . ' - ' . $handler[$script]['summary'] . EOL . EOL;
		$result .= 'SYNTAX' . EOL . EOL;
		$result .= htmlspecialchars($handler[$script]['syntax']) . EOL . EOL;
		$result .= 'DESCRIPTION' . EOL . EOL;
		$result .= htmlspecialchars($handler[$script]['description']) . EOL . EOL;
		$result .= 'AUTHOR' . EOL . EOL;
		$result .= htmlspecialchars($handler[$script]['author']) . EOL . EOL;
		$result .= 'CALLBACK' . EOL . EOL;
		$result .= htmlspecialchars($handler[$script]['callback']) . EOL . EOL;
		$result .= 'COPYRIGHT' . EOL . EOL;
		$result .= htmlspecialchars($handler[$script]['copyright']) . EOL . EOL;

		return $result;
	};

	$handler['help']['run'] = function($arguments) use ($handler) {
		if (is_array($arguments)) {
			foreach ($arguments as $arg) {
				$result .= $handler['help']['resulting']($handler, $arg);
			}
		} else {
			$result .= $handler['help']['resulting']($handler, $arguments);
		}
		include_once 'handler/output.php';
		$handler['output']['run']($result);
	};