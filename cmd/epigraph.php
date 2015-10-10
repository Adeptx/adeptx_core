<?
	# известные недоработки:
	# - ввод неверного аргумента заканчивается пустым выводом
	# - данные тащаться не из БД, а из конфигов

	/**
	* Возвращает эпиграф с идентификатором $id Синтаксис: auth $login $pass
	* @param iunt $id - индекс эпиграфа
	* @return string $result - результат
	*/

	return epigraph($argv, $argc);

	function epigraph($argv, $argc) {
		global $page;
		global $db, $database, $ajax, $module;

		$id = $argv[1];
		
		if (isset($argv['i'])) {
			$id = $argv['i'];
		}
		if (isset($argv['id'])) {
			$id = $argv['id'];
		}

		if (!isset($id)) {
			$id = (int)microtime(1) % 60;		# где 60 в будущем - реальное количество эпиграфов
		}

		$query = sprintf('SELECT * FROM `%s` WHERE id="%u" limit 1',
			$database['prefix'] . $database['table']['epigraph'],
			$id
		);
		$res = $db->call($query);
		if (!$res) {
			throw new Exception('Ошибка запроса к БД', 7468);
		}
		$res = $db->fetch_assoc($res);

		$id = $res[0]['id'];
		$epigraph = $res[0]['epigraph'];
		$utter = $res[0]['utter'];
		$footnote = $res[0]['footnote'];
				
		if (!$epigraph) {
			throw new Exception('Не найдено записи с таким ID', 7469);
		}

		$_SESSION['id'] = $id;
		if (empty($id)) {
			echo 'Для вашего профиля не заполнен nickname, при необходимости вы сможете заполнить его командой set my nickname $newnickname';
		}
		$page['epigraph'][$id] = $epigraph;
		return $epigraph . ' / ' . $utter . ' /';
	}




