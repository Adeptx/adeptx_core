<?
	# Устанавливает текущую директорию, если права на директорию позволяют её указать
	# Мне кажется здравая мысль сделать проверку указываемых адресов до файлов и запретить программам влиять на файлы, которые находятся выше по уровню, чем директория, из которой запущена програма. То бишь любая прога может создать или изменить какие угодно файлы и папки с какой угодно вложенностью, но только в пределах той директории, в которой она запущена. Ну а уж запустить её админ сам решает в какой папе, выполняя команду cd

	return cd($argv, $argc);

	function cd($argv, $argc) {
		global $fold, $base;

		$newdir = $argv[1];

		if (!isset($_SESSION['cd']['default'])) {
			$_SESSION['cd']['default'] = getcwd();
		}
		if (empty($newdir)) {
			$newdir = $_SESSION['cd']['default'];
		}
		if ($newdir == '~' || $newdir == '~/') {
			$newdir = $base['path'] . $fold['users'] . $_SESSION['id'] . '/';
		}

		if (!chdir($newdir)) {
			throw new Exception('<strong style="color:red">Указанного пути не существует</strong>');	# Warning: chdir(): No such file or directory (errno 2)
		}

		$_SESSION['cd']['user'] = getcwd();
		return 'Текущий каталог изменён на <strong style="color:lightgreen">' . $_SESSION['cd']['user'] . '</strong>, узнать текущий каталог: <strong><em>pwd</em></strong>';
	}