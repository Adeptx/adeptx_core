<?
	return hello();

	function hello() {
		if ($_SESSION['status'] != 'ghost') {
			$return .= 'Добро пожаловать в Adeptx Driver, ' . $_SESSION['nickname'] . "!\n";
		} else {
			$return .= "Добро пожаловать в Adeptx Driver! Для начала полноценной работы авторизуйтесь в системе (auth) или воспользуйтесь справкой (help).\n\nP.S.: вы можете использовать команду hello для проверки того, авторизованы вы или нет (если вы аторизованы она обратиться к вам по нику, если нет - вы увидите это сообщение) или команду get my status, сейчас ваш статус ghost.\n";
		}

		return $return;
	}