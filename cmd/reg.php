<?
	# известные недоработки:
	# - введённые данные не проверяются должным образом, даже на отсутствие SQL-иньекций, даже слеши не экранируются (хотя в самой $db-call() может хоть кавычки обрабатываются, хз)
	# - если ввести последовательно `reg test test`, `reg test test`, `unreg test test`, `unreg test test test`, `reg test test` может случиться нехилый баттхёрт
	# - директории сздаются со специфическими правами, стоит сообразить какие всё же права следует устанавливать директории пользователя при создании

	/**
	* Регистрация нового пользователя. Синтаксис: reg $email $pass [$nickname]
	* @param string $email - если указан некорректный email адрес воспринимается как никнейм (@ вырезается)
	* @param string $pass - пароль, может быть любым, но минимум 4 символа
	* @param string [$nickname] - псевдоним пользователя
	* @return string $result - результат
	*/

	if (isset($_SESSION['cd']['default'])) {
		chdir($_SESSION['cd']['default']);
	}

	return reg($arg[1], $arg[2], $arg[3]);
	
	if (isset($_SESSION['cd']['user'])) {
		chdir($_SESSION['cd']['user']);
	}

	function reg($email, $pass, $nickname) {
		global $db, $database, $ajax, $fold;

		# email filter: a4@a4.r4, a-b@a-b.a-b, ya@ya.ru
		# pass filter: 1111, aaaa, \\\\
		if (!preg_match('!....+!', $email)) {
			throw new Exception('<strong style="color:red">Первый параметр (e-mail/nickname) должен содержать хотя бы 4 символа</strong>');		# $err_auth_wrong_email = $msg['cmd']['auth']['wrong_email']
		}
		if (!preg_match('!....+!', $pass)) {
			throw new Exception('<strong style="color:red">Пароль должен содержать минимум 4 символа</strong>');
		}
		if (isset($nickname) && !preg_match('!....+!', $nickname)) {
			throw new Exception('<strong style="color:red">Указанный псевдоним содержит меньше 4 символов</strong>');	
		}

		if (!preg_match('!\w[\w\d-_\.]*[\w\d]@\w[\w\d-_\.]*[\w\d]\.\w[\w\d-_\.]*[\w\d]!', $email)) {
			$nickname = str_replace('@', '', $email);
			unset($email);
		}

		# проверка, есть ли запись с совпадающим email/nickname

		$res = $db->call('select * from `' . $database['prefix'] . 'user` where email="' . $email . '"'.(($nickname)?' OR nickname="' . $nickname . '"':'').' limit 1');
		if (!$res) {
			throw new Exception('<strong style="color:red">$err_auth_mysql4</strong>');	# sprintf('$err_auth_mysql4', $email);	// $err_auth_mysql4 = $msg['cmd']['auth']['mysql_error_4']
		}
		$res = $db->fetch_assoc($res);
		if ($res[0]['hash']) {
			throw new Exception('<strong style="color:orange">Пользователь с таким e-mail или nickname уже зарегистрирован</strong>');		# $err_auth_wrong_email = $msg['cmd']['auth']['wrong_email']
		}

		$salt = md5($email);
		$hash = md5($salt).md5($pass).md5($salt.$pass);
		$query = sprintf('INSERT INTO `%suser` (nickname, email, hash, salt) VALUES ("%s","%s","%s","%s")',
			 $database['prefix']
			,$db->escape($nickname)
			,$db->escape($email)
			,$hash
			,$salt
		);
		$status = $db->query($query);
		if (!$status) {
			throw new Exception('<strong style="color:red">$err_reg_mysql_3</strong>');		# $err_auth_wrong_email = $msg['cmd']['auth']['wrong_email']
		}

		$result['#'.$ajax['id']['cmd']['answer']] = "Добро пожаловать в Adeptx!\n";	# $msg_reg_ok = $lang['luck'].': '.$lang['sign up'].' email: ' . $email . ', '.$lang['password'].': ' . $pass;

		# после регистрации пользовател создаёт личный каталог и БД после чего его авторизует в системе
		$new_user_id = $db->last_insert_id();
		# создаём:
		# user/ID/
		# user/ID/log/
		# user/ID/log/adeptx.loc_userID_output.log.php
		mkdir($fold['users'].$new_user_id);
		mkdir($fold['users'].$new_user_id.'/'.$fold['user_log']);
		touch($GLOBALS['fold']['users'] . $new_user_id . $GLOBALS['fold']['user_log'] . $_SERVER['HTTP_HOST'] . '_' . $new_user_id . '_output.log' . $GLOBALS['site']['extensions']);
		# больше свободы! просто оставить приставку с юзерайди и пусть все базы с этой приставкой принадлежат юзеру!
		$query = sprintf("CREATE DATABASE IF NOT EXISTS `user_%s_default` CHARACTER SET utf8 COLLATE utf8_general_ci", $db->last_insert_id());
		# для использования выделенной юзеру БД он может использовать всевозможные скрипты, например, phpmyadmin: http://adeptx.tk/repo/pma/
        $cfg['Servers'][$i]['user'] = 'user_'.$_SESSION['id'];
        $cfg['Servers'][$i]['password'] = $_SESSION['dbpass'];
		$status = $db->query($query);
		# авторизация последняя в силу того, что после авторизации скрипт прекращает свою работу
		# (не отдаём результат обратно, чтобы избежать записи в журнал логов, сразу возвращаем данные пользователю)
		run('auth '.(($email)?$email:$nickname).' '.$pass);
	}