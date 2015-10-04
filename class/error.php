<?
# Данный класс создан специально для обработки ошибок. В отличие от встроенных оповещений PHP об ошибках, этот класс позволит манипулировать ошибками на своё усмотрение - вывести на экран, записать в log файл, вывести в консоль, попытаться исправить и так далее, выполнение скрипта в случае report() об ошибке не прерывается, поэтому вы можете манипулировать дальнейшим ходом событий.
	namespace Adeptx;
	
	class error {
		function config($require) {
			$err = sprintf($msg['error']['config']['require'], $require);
			exit($err);
		}
		function log($error_description, $code_line, $type = 'Warning', $file = null, $code) {
			$report = date('Y-m-d H:i:s') . " исполняемый файл " . (isset($file)? $file . ' вызванный файлом ': '') . $_SERVER['PHP_SELF'] . " на $code_line строке кода инициировал запись Adeptx $type [$code]: $error_description in $file on line $code_line\n";
			file_put_contents($GLOBALS['fold']['log'].$_SERVER['HTTP_HOST'].$GLOBALS['site']['extensions'], $report, FILE_APPEND);
		}
		function report($error_description, $code_line, $type = 'Warning', $file = null, $code) {
			$this->log($error_description, $code_line, $type, $file, $code);

			$file = $_SERVER['PHP_SELF'] . (isset($file)? ' ⇄ ' . $file : '');
			if (error_reporting()) {
				echo "<br>\n<strong>Adeptx $type [$code]</strong>: $error_description in <strong>$file</strong> on line <strong>$code_line</strong><br>\n";
			} else {
				echo "<br>\n<strong>Adeptx $type [$code]</strong>! Подробности в файле логов.<br>\n";
			}

			if ($type == 'Configurations Error' || $type == 'Fatal Error') {
				exit;
			}
		}
	}