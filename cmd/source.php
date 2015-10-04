<?
	# Известные недоработки:
	# - аргумент должен содержать только название программы-файла, без пути к нему, следовательно его следует валидировать сперва, а этого не происходит

	/**
	 * Выводит исходный код исполняемого файла программы/команды/скрипта...
	 *
	 */

	if (!preg_match('!^\./!', $arg[1])){
		if (isset($_SESSION['cd']['default'])) {
			chdir($_SESSION['cd']['default']);
		}
	}

	return source($arg[1]);

	if (!preg_match('!^\./!', $arg[1])){
		if (isset($_SESSION['cd']['user'])) {
			chdir($_SESSION['cd']['user']);
		}
	}

	function source($cmdname) {
		global $site, $fold;

		$cmdname  = str_replace(['../', '..'], '', $cmdname);	# user see|put this address of file

		if (preg_match('!^\./!', $cmdname)){
			$filename  = $cmdname . $site['extensions'];	# but realy file exist at home dir
			if (!is_readable($filename)) {
				throw new Exception("RU: В текущем каталоге (см. `pwd`) не существует файла \"$filename\" или он переименован, перемещен или скрыт настройками приватности. EN: File \"$fine_name\" not exit.", 5864); # $msg['cmd']['cat']['file no exist'];
			}
			return htmlspecialchars(file_get_contents($filename));
		}
		else {
			$filename  = $fold['cmd'] . $cmdname . $site['extensions'];	# but realy file exist at home dir
			if (is_readable($filename)) {
				$file = str_replace('<=>', '⇔', $file);
				$file = str_replace('===', '≡', $file);
				$file = str_replace('>=', '⇒', $file);			# ≥
				$file = str_replace('<=', '≤', $file);			# ⇐
				$file = str_replace('=>', '⇒', $file);			# ⇒ &rArr;
				$file = str_replace('->', '►', $file);			# → &#9658; 
				$file = str_replace('::', '■', $file);			# &#9632;		♦ &diams;
				$file = str_replace('!=', '≠', $file);
				return htmlspecialchars(file_get_contents($filename));
			}
			return "RU: В корневом каталоге (см. `cd` [без параметров]) не существует файла \"$filename\" или он переименован, перемещен или скрыт настройками приватности. EN: File \"$fine_name\" not exit.";
		}
	}