<?
	class cmd {
		function __call($command, $args) {
			global $global;
			foreach ($global as $var) {
				global $$var;
			}
			global $fold, $site, $path, $ajax;

			$arg = explode(' ', $command_vs_args);
			$cmd_file = $fold['cmd'] . $command . $site['extensions'];

			# если команда по прямому имени не найдена, пробуем прогрузить известные синонимы и запустить программу по алиасу
			if (!is_readable($cmd_file)) {
				$path['aliases'] = $fold['cmd'] . 'aliases' . $site['extensions'];
				$all_aliases = include_once $path['aliases'];

				foreach ($all_aliases as $true_name => $command_aliases) {
					# проверяет есть ли вхождение |АЛИАС| в строке
					if (preg_match('!\|'.$command.'\|!', '|' . $command_aliases . '|')) {
						$cmd_file = $fold['cmd'] . $true_name . $site['extensions'];
						break;
					}
				}
			}

			# запуск команды
			# проверка существования и доступности для выполнения команды
			if (is_readable($cmd_file)) {
				if(isset($_SESSION['cd'])) {
					chdir($_SESSION['cd']['user']);
					$result .= include $_SESSION['cd']['default'] . '/' . $cmd_file;
					chdir($_SESSION['cd']['default']);
				} else {
					$result .= include $cmd_file;
				}
				#:ru: запись выполненной команды в историю команд
				#:en: log to cmd.history
				if (is_readable($site['cmd_log'])) {
					$log = fopen($site['cmd_log'], 'a');
					fwrite($log, $command_vs_args . "\n");
					fclose($log);
				} else {
					$result .= "RU: Не найден лог-файл истории введённых команд, запись пропущена. EN: log file not found";
				}
			} else {
				$result .= "RU: Комманда \"$command\" не существует или её файл переименован, перемещён, недоступен, скрыт настройками приватности или повреждён. Воспользуйтесь командой help чтобы узнать список доступных команд.\nEN: Command \"$command\" not useful for this site/profile, command-package not install, rename or moved. Use command \"help\" for access commands list.";

				if (is_readable($fold['cmd'] . 'error.log' . $site['extentions'])) {
					$err_log = fopen($fold['cmd'] . 'error.log' . $site['extentions'], 'a');
					fwrite($err_log, $command_vs_args . "\n");
					fclose($err_log);
				}
			}
			return $result;
		}
	}