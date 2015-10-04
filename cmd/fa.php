<?
	$fine_name = $arg[1];
	$real_file  = $fold['cmd'] . $fine_name;
	$append_line = $arg[2] . "\n";

	if ($_SESSION['permissions']['cmd']['fa']) {
		if (is_readable($real_file)) {
			$fa = fopen($real_file, 'a');
			fwrite($fa, $append_line);
			fclose($fa);
			msg($msg['cmd']['fa']['luck']);
		}
		else {
			msg($msg['cmd']['fa']['file not exist']);
		}
	} else {
		msg($msg['cmd']['fa']['fail']);
	}