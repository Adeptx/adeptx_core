<?
	return sql($argv, $argc);

	function sql($argv, $argc) {
		global $db;

		$flags['var_dump'] = false;
		$flags['custom_db'] = false;
		$flags['fetch'] = false;
		$flags['assoc'] = false;

		foreach ($argv as $num => $param) {
			switch ($param) {
				case '-d':
				case '--var_dump':
					$flags['var_dump'] = true;
					break;
				case '-i':
				case '--index':
					$index = $argv[$num + 1];
					break;
				case '-q':
				case '--query':
					$query = $argv[$num + 1];
					break;
				case '-b':
				case '--base':
				case '--database':
					$flags['custom_db'] = true;
					$current_db = run('pwdb');
					run('db '. $argv[$num + 1]);
					break;
				case '-f':
				case '--fetch':
					$flags['fetch'] = true;
					break;
				case '-a':
				case '--assoc':
					$flags['assoc'] = true;
					break;
				case '-fa':
				case '-af':
				case '--fetch-assoc':
					$flags['fetch'] = true;
					$flags['assoc'] = true;
					break;
			}
		}
		# если аргументов всего два или же просто первый аргумент не начинается с дефиса, считаем первый аргумент SQL запросом, в противном случае выдадим ошибку некорректного синтаксиса
		if ($argc == 2 || !preg_match('!^-!', $argv[1])) {
			$query = $argv[1];
		}
		
		if (!$query && $index) {
			$query = $argv[$index];
		}
		elseif (!$query && !$index) {
			throw new Exception('Не указан SQL запрос, указывайте SQL запрос первым параметрои или используйте `sql -q "QUERY"` (или `sql "QUERY" -i 1`, где -i 1 - индекс параметра, в котором указан SQL запрос), когда выполняете SQL запрос со специальными параметрами');
		}

		$result = $db->call($query);
		if ($flags['fetch']) {
			if ($flags['assoc']) {
				$result = $db->fetch_assoc($result);
			}
			else {
				$result = $db->fetch($result);
			}
		}

		echo "=== НАЧАЛО РЕЗУЛЬТАТОВ SQL ЗАПРОСА ===\n";
		if ($flags['var_dump']) {
			var_dump($result);
		}
		else {
			print_r($result);
		}

		if ($flags['custom_db']) {
			run('db '.$current_db);
		}
		return "\n=== КОНЕЦ РЕЗУЛЬТАТОВ SQL ЗАПРОСА ===";
	}