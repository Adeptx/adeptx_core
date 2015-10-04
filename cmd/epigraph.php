<?
	# известные недоработки:
	# - ввод неверного аргумента заканчивается пустым выводом
	# - данные тащаться не из БД, а из конфигов

	/**
	* Возвращает эпиграф с идентификатором $id Синтаксис: auth $login $pass
	* @param iunt $id - индекс эпиграфа
	* @return string $result - результат
	*/

	return epigraph($arg[1]);

	function epigraph($id) {
		global $page;
		
		if (isset($argv['i'])) {
			$id = $argv['id'];
		}

		if (!isset($id)) {
			$id = (int)microtime(1) % count($page['epigraph']);
		}
		# $result['#'.$ajax['id']['header']['epigraph']] = $page['epigraph'][];
		return $page['epigraph'][$id];
	}