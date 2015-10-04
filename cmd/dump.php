<?
	/**
	 * Дамп базы данных
	 *
	 **/
	
	set_time_limit(0);

	customization('default');
	return dump($argv, $argc);
	customization('user');		# это необходимо, потому что если подряд выполняется несколько команд, необходимо вернуться к текущему состоянию
	
	function dump($argv, $argc) {
		global $fold, $database, $site;

		$fix = $argv[1];
		
		$datestamp = date("Y-m-d_H-i-s");

		$dumpFileName = /* $page['base']['href'] . */ $fold['sql'] . $database['name'] . "_$datestamp.sql";
		$connection = mysql_connect($database['host'], $database['user'], $database['pass']);
		if (!$connection) {
			return "Святые одуванчики! У нас проблемы!";
		}

		include_once $fold['classes'] . 'MySQLDump' . $site['extensions'];
		$dumper = new MySQLDump($database['name'], $dumpFileName, false, false);
		mysql_query("set names utf8");
		$dumper->doDump();

		if ($fix) {
			# фикс заменяющий неработающую CURRENT_TIMESTAMP на некоторых серверах (в частности на сервере ФС)
			$fileContents = file_get_contents($dumpFileName);
			$fileContents = str_ireplace('CURRENT_TIMESTAMP', date("Y-m-d H:i:s"), $fileContents);
			file_put_contents($dumpFileName, $fileContents);
		}

		return "Дамп ${mysql['db']}_$datestamp.sql успешно создан в папку дампов и бекапов \"".$fold['sql']."\". Просмотр содержимого: `get last dump`. Создание дампа с просмотром осуществляется командой get mysql dump.\n";
	}