<?
	# известные недоработки:
	# - удаляет только дефолтную БД юзера но не другие созданные
	# - удаляет директорию юзера только если там лежат файлы, но не вложенные папки
	# - критерии для удаления весьма шаткие
	# - $base['path'] пуст, как результат если текущая директория отличается от дефолтной удаление папки пользователя окончится как минимум неудачей, нужно разобраться почему переменная $base['path'] пуста
	# - вообще, строго говоря, удаление производится из рук вон плохо, никуда не годится

	/**
	* Удаление профиля пользователя. Синтаксис: unreg $email $pass [$nickname]
	* @param string $email - если указан некорректный email адрес воспринимается как никнейм (@ вырезается)
	* @param string $pass - пароль, может быть любым, но минимум 4 символа
	* @param string [$nickname] - псевдоним пользователя
	* @return string $result - результат
	*/

	return unreg($arg[1], $arg[2], $arg[3]);

	function unreg($email, $pass, $nickname) {
		global $db, $database, $ajax, $base, $fold;
		if (!preg_match('!....+!', $email) || !preg_match('!....+!', $pass) || (isset($nickname) && !preg_match('!....+!', $nickname))) {
			throw new Exception('<strong style="color:red">Некорректные данные учетной записи пользователя</strong>');	
		}
		if (!preg_match('!\w[\w\d-_\.]*[\w\d]@\w[\w\d-_\.]*[\w\d]\.\w[\w\d-_\.]*[\w\d]!', $email)) {
			$nickname = str_replace('@', '', $email);
			unset($email);
		}

		# проверка, есть ли запись с совпадающим email/nickname		
		$query = sprintf('SELECT * FROM `%suser` WHERE email="%s"%s LIMIT 1', $database['prefix'], $email, (($nickname)?' OR nickname="' . $nickname . '"':''));
		$res = $db->call($query);
		if (!$res) {
			throw new Exception('<strong style="color:red">$err_auth_mysql4</strong>');	# sprintf('$err_auth_mysql4', $email);	// $err_auth_mysql4 = $msg['cmd']['auth']['mysql_error_4']
		}
		$res = $db->fetch_assoc($res);
		if (!$res[0]['hash']) {
			throw new Exception('<strong style="color:orange">Пользователь с таким e-mail или nickname не зарегистрирован</strong>');		# $err_auth_wrong_email = $msg['cmd']['auth']['wrong_email']
		}

		# во-первых, что было указано в качестве логина ($email или $nickname), то и придётся вводить при каждой авторизации и другая связка не даст себя удалить
		# во-вторых, пустые значения плохо влияют
		$salt = md5($email);
		$hash = md5($salt).md5($pass).md5($salt.$pass);
		$query = sprintf('DELETE FROM `%suser` WHERE hash="%s" AND salt="%s" AND (email="%s"%s)', $database['prefix'], $hash, $salt, $email, (($nickname)?' OR nickname="' . $nickname . '"':''));
		$status = $db->query($query);
		if (!$status) {
			throw new Exception('<strong style="color:red">$err_reg_mysql_3</strong>');		# $err_auth_wrong_email = $msg['cmd']['auth']['wrong_email']
		}

		//exec('rm -rf ' . $base['path'] . $fold['users'] . $_SESSION['id'] . '/*');
		# осторожно! если текущая директория отличается от дефолтной возникнет проблема из-за того что не считался $base['path']
		$userdir = $base['path'] . $fold['users'] . $res[0]['id'];
		remove_full_dir($userdir);
		function remove_full_dir($dir) {
			foreach (glob($dir . '*') as $file) {
				if (is_file($file)) {
					unlink($file);
				}
				elseif (is_dir($file)) {
					remove_full_dir($file);
				}
			}
			if (is_dir($dir)) {
				rmdir($dir);
			}
		}
		
		// if ($uninstall_database) {
			$db->call("DROP DATABASE IF EXISTS `user_" . $res[0]['id'] . "_default`");	# нужно просканировать сколько вообще есть БД с таким превиксом и дропнуть все
		// }

		$result['#'.$ajax['id']['cmd']['answer']] = "Учётная запись пользователя полностью удалена.\n";	# при чем если были записи с тем же email, ником и паролем, они удалены тоже, что может немало доставить, если удаление будет производится по незаполненному полю, например пустому нику... ;)

		# не отдаём результат обратно, чтобы избежать записи пароля в журнал логов, сразу возвращаем данные пользователю
		run('exit');
		exit(JSON_encode($result));
	}