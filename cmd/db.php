<?
	# Устанавливает текущую базу данных, если она принадлежит пользователю или открыта ему настройками приватнности (в общем, есл права позволяют её указать)
	# - нет реально проверки на существование БД
	# - также фактически управление БД ведётся из библиотеки $db, в которой управление осуществяется по $database['name'], и она не переключается на новую БД
	# - не реализован механизм проверки на то, является ли БД общедоступной и переключения между расшаренными БД

	return db($arg[1], ($arg[0] == 'aliases'));

	function db($new_current_db, $direct_request) {
		global $fold, $base;

		$prefix = 'user_' . $_SESSION['id'] . '_';

		if (!isset($_SESSION['db']['default'])) {
			$_SESSION['db']['default'] = $prefix . 'default';
		}
		if (empty($new_current_db) || $new_current_db == '~') {
			$new_current_db = $_SESSION['db']['default'];
		}
		
		# администратор получает привилегию переключения не только между своими БД, но и между любыми другими базами анных, для этого ему необходимо ввести имя БД начиная с символа экранирования, например: db \adeptx_driver
		# если администратор укажет просто db adeptx_driver, то как и других пользователей его будет пытаться переключить на БД user_ID_adeptx_driver
		if ($_SESSION['status'] == 'admin' && preg_match('!^\\\\!', $new_current_db)) {
			$prefix = '';
			$new_current_db = substr($new_current_db, 1);
		}

		# if (!no_exists($_SESSION['db']['user'])) { # SELECT IF('database_name' IN(SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA), 1, 0) AS found
		#	throw new Exception('<strong style="color:red">Указанной базы данных не существует</strong>');	# Warning: chdir(): No such file or directory (errno 2)
		#}

		$_SESSION['db']['user'] = $prefix . $new_current_db;
		return 'Текущей БД выбрана база данных <strong style="color:lightgreen">' . $_SESSION['db']['user'] . '</strong>, узнать текущую БД: <strong><em>pwdb</em></strong>';
	}