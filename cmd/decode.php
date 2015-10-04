<?
	return decode($arg);

	function decode($arg) {
		foreach ($arg as $num => $param) {
			switch ($param) {
				case '-t':
				case '--type':
					$type = strtolower($arg[$num + 1]);
					break;
				case '-s':
				case '--source-file':
					$source = $arg[$num + 1];
					break;
			}
		}

		if (isset($source)) {
			$src = file_get_contents($source);
		}
		if ($type == 'json') {
			$res = json_decode($src);
		}
		if ($type == 'url') {
			$res = urldecode($src);
		}
		if ($type == 'base64') {
			$res = base64_decode($src);
		}
		if ($type == 'html') {
			$res = htmlspecialchars_decode($src);
		}
		if ($type == 'bson') {
			$res = bson_decode($src);
		}
		if ($type == 'session') {
			$res = session_decode($src);
		}
		if ($type == 'utf8') {
			$res = utf8_decode($src);
		}
		if ($type == 'xmlrpc') {
			$res = xmlrpc_decode($src);
		}
		return $res;
	}