<?
	/**
	 * Устанавливает указанное свойство $property объекта $object в новое значение $value
	 * set $object $property $value
	 * @return status - возращает сообщение о статусе операции
	 */

	return set($argv, $argc);

	function set($argv, $argc) {
		global $db, $database;
	
		if ($_SESSION['status'] == 'ghost') {
			throw new Exception('Эта операция доступна только авторизованным пользователям', 403);
		}
		if ($argc < 3) {
			throw new Exception('Количество переданных аргументов меньше количества обязательных', 1007);
		}
		$object = $argv[1];
		$property = $argv[2];
		$value = $argv[3];
		# каждая функция должна содержать инициализирую строку, определяющую количество обязательных параметров, количество необязательных, имена коротких паременных, имена их длинных аналогов, будет ли содержать указанный параметр значение, не будет или может содержать или не содержать и так далее

#BROKEN_CODE
		// if (isset($argv['o'])) {
		// 	$object = $argv['o'];
		// }
		// if (isset($argv['p'])) {
		// 	$property = $argv['p'];
		// }
		// if (isset($argv['v'])) {
		// 	$value = $argv['v'];
		// }
		// switch ($param) {
		// 	case '--object':
		// 		break;
		// 	case '--property':
		// 		break;
		// 	case '--value':
		// 		break;
		// }
###

		switch ($object) {
			case 'bd':
			case 'db':
			case 'sql':
			case 'mysql':
				switch ($property) {
					case 'pass':
					case 'password':
						# для текущего юзера
						$query .= "SET PASSWORD = PASSWORD('$value')";

						# для указанного юзера
						# SET PASSWORD FOR логин@localhost = PASSWORD('пароль');
						# SET PASSWORD FOR логин@"%" = PASSWORD('пароль');

						if ($db->call($query)) {
							return 'Пароль базы данных успешно изменён';
						}
						return 'Не удалось изменить пароль БД';
				}
			# если будет указан идентификатор пользователя, для которого следует сменить данные, то проверим статус пользователя, если admin, то установим если нет, укажем что не хватает прав
			case 'my':
			case 'current':
			case 'user':
				$_SESSION[$property] = $value;	# id, nickname, email, msg, timezone, new_mail_count, mail

				$query = sprintf('UPDATE `%suser` SET `%s`="%s" WHERE `id`="%s" LIMIT 1',
					$database['prefix'],
					$db->escape($property),
					$db->escape($value),
					$_SESSION['id']
				);
				$res = $db->call($query);
				if (!$res) {
					throw new Exception('Ошибка запроса к базе данных, не удалось установить данное свойство в указанное значение', 2648);
				}
				return 'Success';
				break;
			case 'date':
				$new_date = $argv[1];
				break;
		}
	}