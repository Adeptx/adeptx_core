<?
	setlocale(LC_CTYPE, "en_US.UTF-8");

	# нулевой элемент - это ключевое слово shell, первый элемент - команда для выполнения, остальные - аргументы
	$cmd = $arg[1];
	for ($i = 2; $i < count($arg); $i++) {
		$cmd .= ' '.$arg[$i];	# escapeshellarg(
	}

	$return = shell_exec('ls file_not_exist 2>&1 1> /dev/null');	# , $return shell_exec можно записать просто `ls -lart`;
	# $return = exec($cmd);

	return $return;					