<?
	/**
	 *  Данная команда оснащена мощным синтаксическим сахаром.
	 *
	 *	Примеры:
	 *
	 *	add hotkey Ctrl+C auth
	 *	add new hotkey Ctrl+V paste
	 *	add new hotkey Ctrl+V for paste
	 *	add new hotkey Ctrl+V for command paste
	 *
	 *	add alias just_alis_name help
	 *	add new alias just_alis_name help
	 *	add new alias just_alis_name for help
	 *	add new alias just_alis_name for command help
	 *
	 *	add user $nickname/$email $pass
	 *	add new user $nickname/$email $pass
	 *	add new user $nickname/$email with $pass
	 *	add new user $nickname/$email with pass $pass
	 *	add new user $nickname/$email with password $pass
	 */
	return add($argv, $argc);

	# слова new, for, command - синтаксический сахар (опциональны), созданы только для удобства пользвоателя
	function add($argv, $argc) {
		global $db, $database;

		if ($_SESSION['status'] == 'ghost') {
			throw new Exception('Эта операция доступна только авторизованным пользователям', 403);
		}
		if ($argc < 2) {
			throw new Exception('Указано слишком мало аргументов', 1007);
		}

		$arg1 = $argv[1];
		$arg2 = $argv[2];
		$arg3 = $argv[3];
		$arg4 = $argv[4];
		$arg5 = $argv[5];
		$arg6 = $argv[6];

		# add new alias $alias_name for command $command_name
		# add new alias $alias_name for $command_name
		# add new alias $command_name $alias_name
		# add alias $command_name $alias_name
		if ($arg1 == 'new') {
			$arg1 = $arg2;
			$arg2 = $arg3;
			$arg3 = $arg4;
			$arg4 = $arg5;
			$arg5 = $arg6;
		}
		# add hotkey $hotkey $command
		# add alias $alias_name for command $command_name
		# add alias $alias_name for $command_name
		if ($arg3 == 'for' || $arg3 == 'with' || $arg3 == 'vs') {
			$arg3 = $arg4;
			$arg4 = $arg5;
		}
		# add hotkey $hotkey $command
		# add alias $alias_name command $command_name
		# add alias $alias_name $command_name
		if ($arg3 == 'command' || $arg3 == 'pass' || $arg3 == 'password') {
			$arg3 = $arg4;
		}
		# add hotkey $hotkey $command
		# add alias $alias_name $command_name
		switch ($arg1) {
			case 'hotkey':
				# вешаем на сочетание клавиш $property действие $value
				return "Мы \"типо\" повесили выполнение команды `$arg3` на сочетание клавиш \"$arg2\" (на самом деле это всего лишь заглушка)";
			case 'alias':
				if (isset($aliases[$arg3])) {
					$aliases[$arg3]	.= '|' . $arg2;
				}
				else {
					$aliases[$arg3]	= $arg2;
				}
				return "Мы \"типо\" создали новый псевдоним `$arg2` для команды `$arg3` (на самом деле это всего лишь заглушка пока что). На самом деле, псевдоним добавляется в массив псевдонимов, но этот массив не сохраняется в файл, а следовательно результат можно заметить только вызывая эту функцию другим исполняемым файлом и только пока не завершиться выполнение скрипта.";
			case 'user':
				return run("reg $arg2 $arg3");
			case 'epigraph':
				return "Мы \"типо\" создали новый эпиграф `$arg2`";
			case 'db':
			case 'bd':
			case 'бд':
			case 'sql':
			case 'mysql':
			case 'database':
				$prefix = "user_{$_SESSION['id']}_";
				if (run("is exists db $arg2")) {
					throw new Exception("Databade \"$arg2\" <strong style=\"color:red\">already exists</strong>", 6894);
				}
				if ($_SESSION['status'] == 'admin' && preg_match('!^\\\\!', $arg2)) {
					$prefix = '';
					$arg2 = substr($arg2, 1);
				}
				$query = sprintf("CREATE DATABASE IF NOT EXISTS `%s%s` CHARACTER SET utf8 COLLATE utf8_general_ci", $prefix, $arg2);
				$db->call($query);
				return "База данных `$arg2` успешно <strong style=\"color:green\">создана</strong>";
		}
		return $return;
	}

