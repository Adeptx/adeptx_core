<?
	/**
	 *  Выводит запрошенную информацию об объекте, его свойстве или модификации его свойтсва
	 *	get user nickname
	 *  @param string $object - Объект, свойство которого необходимо узнать
	 *  @param string $epitet - Модификация запрошенного свойства
	 *  @param string $property - Запрашиваемое свойство объекта
	 *  @return string $result - Значение запрошенной модификации свойства объекта или результат операции (успех/неудача)
	 */
	
	return get($argv, $argc);

	function get($argv, $argc) {
		global $fold;

		$object = $argv[1];
		// $epitet = $argv[2];	# $epitet = current, new, last etc
		$property = $argv[2];

		switch ($object) {
			case 'my':
			case 'current':
			case 'user':
				if (isset($_SESSION[$property])) {
					$return .= $_SESSION[$property];
					# id, nickname, email, msg, timezone, new_mail_count, mail
				} else {
					switch ($property) {
						case 'mail':
							# run('select mail');
					}
					throw new Exception('Значение свойства не установлено. Возможно также, что такого свойства вообще нет у объекта. Возможно даже, что такого объекта вообще не существует.');
				}
				break;
			case 'bd':
			case 'db':
			case 'sql':
			case 'new':
			case 'mysql':
				switch ($property) {
					case 'dump':
						$return .= run('dump');

						customization('default');

						$dumps = glob($fold['sql'] . "*.sql", GLOB_MARK | GLOB_NOESCAPE);
						$dumps_count = count($dumps);

						if (!$dumps_count) {
							throw new Exception('Ошибка создания и открытия дампа, нет прав?');
						}
						
						$return .= file_get_contents($dumps[count($dumps) - 1]);

						customization('user');

						$return .= $fileContents;
						return $return;
						break;
				}
				break;
			case 'last':
				switch ($property) {
					case 'dump':
						customization('default');

						$dumps_list = glob($fold['sql'] . "*.sql", GLOB_MARK | GLOB_NOESCAPE);
						$last_dump = array_pop($dumps_list);

						if (!$last_dump) {
							throw new Exception('В папке хранения дампов не обнаружено ни одного дампа базы данных', 4978);
						}
						
						$return .= file_get_contents($last_dump);

						customization('user');

						$return .= $fileContents;
						return $return;
						break;
				}
				break;
			default:
				switch ($property) {
					case 'code':
						$real_path  = str_replace(['../', '..'], '', $fold['cmd'] . $object . $site['extensions']);
						if (is_readable($real_path)) {
							$file = htmlspecialchars(file_get_contents($real_path));
							$return .= "Исходный код программы $object:\n $file";
						} else {
							$return .= "RU: Программа \"$file\" не обнаружена.";
						}
				}
				break;
		}
		return $return;
	}