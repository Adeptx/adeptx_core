<?
	# известные недоработки:
	# - при авторизации пароль выводится в поле, отображается на экране, ну в логи глянул, хоть в логи не пишется))
	# - введенные данные опять же не валидируются, получается, что логин и пароль можно и не указать или провести SQL-иньекцию..

	/**
	* Авторизация. Синтаксис: auth $login $pass
	* @param string $login - $email или $nickname
	* @param string $pass - пароль
	* @return string $result - результат
	*/
	
	return auth($argv, $argc);

	function auth($argv, $argc) {
		global $db, $database, $ajax, $module;

		$login = $argv[1];
		$pass = $argv[2];
		if (isset($argv['login'])) {
			$login = $argv['login'];
		}
		if (isset($argv['pass'])) {
			$login = $argv['pass'];
		}
		if (isset($argv['l'])) {
			$login = $argv['l'];
		}
		if (isset($argv['p'])) {
			$login = $argv['p'];
		}

		# $res = $db->call('SELECT * FROM `' . $database['prefix'] . 'user` WHERE ' . ((preg_match('!.+@.+!', $login))?"email=\"$login\"":"nickname=\"$login\"") . ' LIMIT 1');
		if (preg_match('!.+@.+!', $login)) {
			$email = $login;
		} else {
			$nickname = $login;
		}
		$query = sprintf('SELECT * FROM `%s` WHERE email="%s" OR nickname="%s" limit 1',
			$database['prefix'] . $database['table']['user'],
			$db->escape($email),
			$db->escape($nickname)
		);
		$res = $db->call($query);
		if (!$res) {
			throw new Exception('$err_auth_mysql4', 9844);
			# $return .= sprintf($err_auth_mysql4, $email);	// $err_auth_mysql4 = $msg['cmd']['auth']['mysql_error_4']
		}
		$res = $db->fetch_assoc($res);

		$id = $res[0]['id'];
		$nickname = $res[0]['nickname'];
		$email = $res[0]['email'];
		$hash = $res[0]['hash'];
		$salt = $res[0]['salt'];
				
		if (!$hash) {
			throw new Exception('Указанный логин не зарегистрирован', 9846);	# $err_auth_wrong_email
			# $return .= sprintf('$err_auth_wrong_email', $email);	// $err_auth_wrong_email = $msg['cmd']['auth']['wrong_email']
		}
		
		if ($hash != md5($salt).md5($pass).md5($salt.$pass)) {
			if ($_SESSION['left_wrong_login_attempts']--) {
				throw new Exception("Неверный пароль, у вас осталось {$_SESSION['left_wrong_login_attempts']} попыток до автовосстановления пароля", 9847); // $err_auth_wrong_pass = $msg['cmd']['auth']['wrong_pass'];
				# $return .= '$err_auth_wrong_pass';
			}
			# здесь отправляем email с ссылкой на восстановление пароля
			# и запрещаем авторизовываться иначе, кроме как по ссылке из письма
		}
		if (!$_SESSION['left_wrong_login_attempts']) {
			throw new Exception('Вы исчерпали лимит ввода неправильного пароля, теперь вы можете авторизоваться только восстановив пароль', 9848);
		}

		if (!session_destroy()) {	# не забыли грохнуть данные по другому юзеру перед записью данных нового
			throw new Exception('Не удаётся уничтожить данные текущего сеанса', 9849);
		}
		if (!session_start()) {		# открыли новую сессию, иначе ничего не запишется
			throw new Exception('Не удаётся начать новую сессию', 9850);
		}
		# здесь следует проверять какие поля не заполнены пользователем и предлагать ему заполнить поля специальной командой
		if (empty($id)) {
			throw new Exception('Не удалось получить идентификатор пользователя', 9851);
		}
		$_SESSION['id'] = $id;
		if (empty($id)) {
			echo 'Для вашего профиля не заполнен nickname, при необходимости вы сможете заполнить его командой set my nickname $newnickname';
		}
		$_SESSION['nickname'] = $nickname;
		$_SESSION['email'] = $email;
		$_SESSION['left_wrong_login_attempts'] = $module['auth']['max_fail_count'];
		$_SESSION['dbpass'] = 'USAmustdie2050';

		# нужно вписать в БД инфу о том, что юзер авторизовался, с какого устройства, во сколько и прочую инфу по соображениям безопасности
		if ($id < 2) {
			$_SESSION['status'] = 'admin';
		}
		else {
			$_SESSION['status'] = 'staff';
		}
		$return .= sprintf("Добро пожаловать, %s (%s)!\n", (($nickname)?$nickname:'ghost'), $email, preg_replace('!.!', '*', $pass));	// $msg_auth_success = $msg['cmd']['auth']['luck']

		# напоследок можно вывести вопрос: Хотите отобразить последний вывод (~100-1000 строк) из предыдущих сессий? И варианты ответа: Y, n. Ну и соответственно выполнить соответствующие файлы, предварительно записав в них нужные действия и очистив когда будет готово.

		# не отдаём результат обратно, чтобы не добавлять запись в лог журнал, сразу возвращаем данные пользователю
		$result['#'.$ajax['id']['cmd']['answer']] = $return;
		exit(JSON_encode($result));
	}


	/*
			$res = mysql_query('select * from `' . $database['prefix'] . 'user` where email="' . $email . '" limit 1');
			if (empty($res)) {
				$result['#' . $ajax['id']['cmd']['answer']] = $lang['fail'].'! '.$lang['sign in'].': wrong email ('.$email.')!';
				exit(JSON_encode($result));
			}
			$res = mysql_fetch_row($res);
			
			$id = $res[0];
			$hash = $res[2];
			$salt = $res[3];
			
			if (!$hash) {
				$result['#' . $ajax['id']['cmd']['answer']] = $lang['fail'].'! '.$lang['sign in'].': wrong email ('.$email.')!';
				exit(JSON_encode($result));;
			}
			
			if ($hash == md5($salt).md5($pass).md5($salt.$pass)) {
				$_SESSION['id'] = $id;
				$result['#'.$ajax['id']['cmd']['answer']] = $lang['luck'].': '.$lang['sign in'].' email: ' . $email . ', '.$lang['password'].': ' . $pass;
			}
			else
				$result['#'.$ajax['id']['cmd']['answer']] = $lang['fail'].'! '.$lang['sign in'].': wrong password!';
	*/