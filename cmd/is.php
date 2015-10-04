<?
	$inverse_flag = 0;

	# два способа вызвать отрицание + эффект двойного отрицания, минус на минус даёт плюс
	if ($argv[0] == 'isnt') {
		$inverse_flag = 1;
	}
	if ($argv[1] == 'not' || isset($rgrgv['i']) || isset($argv['inversion']) || isset($argv['not'])) {
		$inverse_flag = 1 ^ $inverse_flag;
		array_splice($argv, 1, 1);	# "not" сделал своё дело, удаляем его из массива
	}

	return $inverse_flag ^ is($argv, $argc);

	function is($argv, $argc) {
		global $db, $database;

		if ($_SESSION['status'] == 'ghost') {
			throw new Exception('Эта операция доступна только авторизованным пользователям', 403);
		}
		if ($argc < 2) {
			throw new Exception('Количество переданных аргументов меньше количества обязательных', 1007);
		}

		$arg1 = $argv[1];
		$arg2 = $argv[2];
		$arg3 = $argv[3];
		$arg4 = $argv[4];
		$arg5 = $argv[5];
		$arg6 = $argv[6];

		if (isset($argv['e'])) {
			$object = $argv['e'];
		}
		if (isset($argv['exist'])) {
			$object = $argv['exist'];
		}

		switch ($arg1) {
			case 'exists':
				switch ($arg2) {
					case 'dir':
						if (is_dir($arg3)) {
							return 1;
						}
						return 0;
					case 'file':
						if (is_file($arg3)) {
							return 1;
						}
						return 0;
					case 'user':
						$where = "$arg3=\"$arg4\"";
						#	"email=\"$email\"" . (($nickname)?' OR nickname="' . $nickname . '"':'')

						$query = sprintf('SELECT \'hash\' FROM `%suser` WHERE %s LIMIT 1', $database['prefix'], $where
							);
						$res = $db->call($query);
						if (!$res) {
							throw new Exception('<strong style="color:red">Ошибка обращения к базе данных</strong>', 3654);	# sprintf('$err_auth_mysql4', $email);	// $err_auth_mysql4 = $msg['cmd']['auth']['mysql_error_4']
						}
						$res = $db->fetch_assoc($res);
						if ($res[0]['hash']) {
							return 1;
						}
						return 0;
					case 'db':
					case 'bd':
					case 'бд':
					case 'sql':
					case 'mysql':
					case 'database':
					# bd name $dbname, db with name $dbname, db vs name $dbname, etc
						$prefix = "user_{$_SESSION['id']}_";
						if ($_SESSION['status'] == 'admin' && preg_match('!^\\\\!', $arg3)) {
							$prefix = '';
							$arg3 = substr($arg3, 1);
						}
						$dbname = $prefix . $arg3;

						$query = sprintf("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '%s'", $dbname);
						$res = $db->call($query);
						if (!$res) {
							throw new Exception('<strong style="color:red">Ошибка обращения к базе данных</strong>', 3655);
						}
						if (!$res->num_rows) {
							return 0;
						}
						return 1;
					case 'table':
					case 'dbtable':
					case 'bdtable':
					case 'bdtable':
						$table_list = $this->call( "SHOW TABLES FROM `" . $database['name'] . "`" );
						while( $arr = $db->fetch_array($table_list)){
							if ($table == $arr[0]) {
								return 1;
							}
						}
						return 0;
				}
				return 0;
			case 'i':
			case 'user':
				switch ($arg2) {
					case 'auth':
					case 'authed':
					case 'authorized':
					if (!isset($_SESSION['status'])) {
						throw new Exception("Session Error - Ошибка чтения сессий", 6666);
					}
					if ($_SESSION['status'] == 'ghost') {
						return 0;
					}
					else {
						return 1;
					}
				}
			case 'auth':
			case 'authed':
			case 'authorized':
				switch ($arg2) {
					case 'i':
					case 'user':
					case 'current user':
					if (!isset($_SESSION['status'])) {
						throw new Exception("Session Error - Ошибка чтения сессий", 6666);
					}
					if ($_SESSION['status'] == 'ghost') {
						return 0;
					}
					else {
						return 1;
					}
				}
		}
	}