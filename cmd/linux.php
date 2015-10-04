<?
	// setlocale(LC_CTYPE, "en_US.UTF-8");

	$cmd = substr($command_vs_args, 6);
	return shell_exec($cmd);	// exec, ``
	// $return = shell_exec('ls file_not_exist 2>&1 1> /dev/null');	# , $return shell_exec можно записать просто `ls -1art`;