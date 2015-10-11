<?
	return open($argv, $argc);

	function open($argv, $argc) {
		global $module;

		if ($argv[1] == 'fm') {
			$argv[1] = 'file-manager';
		}
		if ($argv[1] == 'dm') {
			$argv[1] = 'database-manager';
		}
		if ($argv[1] == 'pma') {
			$argv[1] = 'phpmyadmin';
		}
		if ($argv[1] == 'te') {
			$argv[1] = 'text-editor';
		}
		if ($argv[1] == 'ce') {
			$argv[1] = 'code-editor';
		}
		// header('Location: ' . $module[ $module['prefer']['file-manager'] ]['url']);
		# такая запись не оставляет записи в истории браузера:
		// exit('<meta http-equiv="refresh" content="0;URL=' . $module[ $module['prefer']['file-manager'] ]['url'] . '">');
		if (!empty($module[ $module['prefer'][ $argv[1] ] ]['url'])) {
			// run('cloud ' . $module[ $module['prefer'][ $argv[1] ] ]['url']);
			exit('<script>document.location.href = "http://' . $_SERVER['HTTP_HOST'] . $module[ $module['prefer'][ $argv[1] ] ]['url'] . '";</script>');
		} else {
			if (!empty($module[ $argv[1] ]['url'])) {
				# try to open user choose...
				// header('Location: '.$module[ $argv[1] ]['url']);
				exit('<script>document.location.href = "http://' . $_SERVER['HTTP_HOST'] . $module[ $argv[1] ]['url'] . '";</script>');
			}
			else {
				throw new Exception("Указанный пакет не обнаружен в репозитории", 4986);
			}
		}
	}