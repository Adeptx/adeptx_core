<?
	return pma($argv, $argc);

	function pma($argv, $argc) {
		if ($_SESSION['status'] == 'ghost') {
			throw new Exception('Эта операция доступна только авторизованным пользователям', 403);
		}
		run('open phpmyadmin');
	}