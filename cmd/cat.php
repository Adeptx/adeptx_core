<?
	# Выводит содержимое всего файла
	# this function just put all file

	return cat($argv, $argc);

	function cat($argv, $argc) {
		// if ($_SESSION['status'] == 'ghost') {
		// 	throw new Exception('Эта операция доступна только авторизованным пользователям', 403);
		// }
		if ($argc < 1) {
			throw new Exception('Указано слишком мало аргументов', 1007);
		}

		$fine_name  = str_replace(['../', '..'], '', $argv[1]);	# user see|put this address of file
		$real_file  = $fine_name;	# but realy file exist at home dir

		if (!is_readable($real_file)) {
			throw new Exception("RU: В текущем каталоге (см. `pwd`) не существует файла \"$fine_name\" или он переименован, перемещен или скрыт настройками приватности.\nEN: File \"$fine_name\" not exit.", 1); # $msg['cmd']['cat']['file no exist'];
		}

		$file = file_get_contents($real_file);
		# 
		# if ($arg[0] == 'cat') ...
		# в общем если из командной строки вызов, а не из другого скрипта, то
		$file = htmlentities($file);
		// echo $file;
		return "$real_file:<br> $file";
	}