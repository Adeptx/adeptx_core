<?
	return del($argv, $argc);

	# слова new, for, command - синтаксический сахар (опциональны), созданы только для удобства пользвоателя
	function del($argv, $argc) {
		$arg1 = $argv[1];
		$arg2 = $argv[2];
		$arg3 = $argv[3];
		$arg4 = $argv[4];
		$arg5 = $argv[5];
		$arg6 = $argv[6];

		# запретить удаление не своих файлов и баз, для удаления своих запрпашивать пароль
		if ($_SESSION['status'] == 'ghost') {
			throw new Exception('Эта операция доступна только авторизованным пользователям', 403);
		}
		if ($argc < 2) {
			throw new Exception('Количество переданных аргументов меньше количества обязательных', 1007);
		}

		// # add new alias $alias_name for command $command_name
		// # add new alias $alias_name for $command_name
		// # add new alias $command_name $alias_name
		// # add alias $command_name $alias_name
		// if ($arg1 == 'new') {
		// 	$arg1 = $arg2;
		// 	$arg2 = $arg3;
		// 	$arg3 = $arg4;
		// 	$arg4 = $arg5;
		// 	$arg5 = $arg6;
		// }
		// # add hotkey $hotkey $command
		// # add alias $alias_name for command $command_name
		// # add alias $alias_name for $command_name
		// if ($arg3 == 'for' || $arg3 == 'with' || $arg3 == 'vs') {
		// 	$arg3 = $arg4;
		// 	$arg4 = $arg5;
		// }
		// # add hotkey $hotkey $command
		// # add alias $alias_name command $command_name
		// # add alias $alias_name $command_name
		// if ($arg3 == 'command' || $arg3 == 'pass' || $arg3 == 'password') {
		// 	$arg3 = $arg4;
		// }
		// # add hotkey $hotkey $command
		// # add alias $alias_name $command_name
		switch ($arg1) {
			// case 'hotkey':
			// 	# вешаем на сочетание клавиш $property действие $value
			// 	return "Мы \"типо\" повесили выполнение команды `$arg3` на сочетание клавиш \"$arg2\" (на самом деле это всего лишь заглушка)";
			// case 'alias':
			// 	if (isset($aliases[$arg3])) {
			// 		$aliases[$arg3]	.= '|' . $arg2;
			// 	}
			// 	else {
			// 		$aliases[$arg3]	= $arg2;
			// 	}
			// 	return "Мы \"типо\" создали новый псевдоним `$arg2` для команды `$arg3` (на самом деле это всего лишь заглушка пока что). На самом деле, псевдоним добавляется в массив псевдонимов, но этот массив не сохраняется в файл, а следовательно результат можно заметить только вызывая эту функцию другим исполняемым файлом и только пока не завершиться выполнение скрипта.";
			// case 'user':
			// 	return run("reg $arg2 $arg3");
			// case 'epigraph':
			// 	return "Мы \"типо\" создали новый эпиграф `$arg2`";
			case 'file':
				if (!is_file($arg2)) {
					throw new Exception("Указан некорректный файл", 6553);
				}
				if (!unlink($arg2)) {
					throw new Exception("Не удаётся удалить файл (возможно такого файла нет или не хватает прав?)", 6554);
				}
				return "Файл успешно удалён";
			case 'dir':
				if (!is_dir($arg2)) {
					throw new Exception("Указан некорректный каталог", 4785);
				}
				if (!rmdir($arg2)) {
					throw new Exception("Не удаётся удалить директорию (директория не пуста?)", 4786);
				}
				return "Директория успешно удалена";
			case 'inode':
			case 'file_or_dir':
				if (is_dir($arg2)) {
					if (!rmdir($arg2)) {
						throw new Exception("Не удаётся удалить директорию (директория не пуста?)", 9576);
					}
					return "Директория успешно удалена\n";
				}
				if (is_file($arg2)) {
					if (!unlink($arg2)) {
						throw new Exception("Не удаётся удалить файл (возможно такого файла нет или не хватает прав?)", 9577);
					}
					return "Файл успешно удалён\n";
				}
				throw new Exception("Указан некорректный путь, не существует инода с таким именем", 9575);
			case 'db':
			case 'bd':
			case 'бд':
			case 'sql':
			case 'mysql':
			case 'database':
			# можно добавить case-синтаксический сахар - if exists
				global $db;

				$prefix = "user_{$_SESSION['id']}_";
				if ($_SESSION['status'] == 'admin' && preg_match('!^\\\\!', $arg2)) {
					$prefix = '';
					$arg2 = substr($arg2, 1);
				}
				$dbname = $prefix . $arg2;
				
				$query = sprintf("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '%s'", $dbname);
				$res = $db->call($query);
				if (!$res->num_rows) {
					throw new Exception("Базы данных `$arg2` <strong style=\"color:red\">не существует</strong>", 3654);
				}
				$query = sprintf("DROP DATABASE IF EXISTS `%s`", $dbname);
				$db->call($query);

				return "База данных `$arg2` успешно <strong style=\"color:orange\">удалена</strong>";
		}
		return $return;
	}

