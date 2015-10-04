<?
	return who($argv, $argc);
	
	function who($argv, $argc) {
		// if ($_SESSION['status'] == 'ghost') {
		// 	throw new Exception('Эта операция доступна только авторизованным пользователям', 403);
		// }
		if (!$argc) {
			return $_SESSION['id'] . '		' . $_SESSION['nickname'] . '		' . $_SESSION['status'];
		}

		if ($argv[1] == 'am' && $argv[2] == 'i') {
			return $_SESSION['id'] . '		' . $_SESSION['nickname'] . '		' . $_SESSION['status']; /* . $datetimereg . $datetimelogin; '        2015-10-03 17:56 (:0)' */
		}
	}