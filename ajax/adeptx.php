<?
	header('Content-Type: application/json');
	
	# я за поэтапное считывание команд, например:
	# auth [return]
	# e-mail: e.grinec@gmail.com [return]
	# pass: htrfdfybkb [return]
	# но при этом запрос на сервер чтобы происходил только один раз, после заполнения всех переменных
	# хотя вообще-то есть смысл и в поэтапном отправлении информации на сервер: remove ... what are you whant to remove? ... file ... what's name of file you want to remove?
	# можно создать переключатель режимов в настройках
	# так пробелы между параметрами нивелируются
	# можно по нажатию пробела записывать в js команду/параметр или передавать на сервер если в js нет указания что ответить клиенту

	# тогда $_POST['cmd'] ($command_vs_args) будет массивом: $_POST['cmd']['do'] == 'exit', $_POST['cmd'][0] - $command_name, и т.д.
	# в PHP мы просто собираем массив перед выполнением команды, на стороне клиента мы сперва собираем поэтапно аргументы в массив JS, когда последний обязательный аргумент задан (автоматика, епт..) отправляем команду на сервер. Можно конечно поэтапно отправлять на сервер и хранить в $_SESSION о это маразм я считаю и излишняя чрезмерная нагрузка. Ну а пароли в массив разумеется не пишем, поэтапную авторизацию/регистрацию не проводим.
# cmd
	function customization($switch) {	# можно передавать 0, false, null, off, default или ничего не передавать
		$status = 'default';
		if ($switch && $switch != 'off' && $switch != 'default') {
			$status = 'user';
		}
		if (isset($_SESSION['db'][$status])) {
			$database['name'] = $_SESSION['db'][$status];
		}
		if (isset($_SESSION['cd'][$status])) {
			chdir($_SESSION['cd'][$status]);
		}
	}
	function history_add_cmd($command_vs_args) {
		#:ru: запись выполненной команды в историю команд
		#:en: log to cmd.history
		if (is_readable($GLOBALS['path']['cmd']['log'])) {
			file_put_contents($GLOBALS['path']['cmd']['log'], $command_vs_args . "\n", FILE_APPEND);
			return '';
		} else {
			return "\nRU: Не найден лог-файл истории введённых команд, запись пропущена.\nEN: log file not found\n";
		}
	}
	# наравне с history, куда пишется вызов, весь вывод в cmd также было бы здорово записывать, получив тем самым самый отменный лог, да к тому же это даст возможность всегда вернуться к чему угодно выведенному на экран терминала.
	function cmd_log($command_vs_args, $result) {
		# впринципе мы ещё на уровне конфигов записываем IP в ID для неавторизованных, так что эту строку можно пропустить
		$uidip = (($_SESSION['id'])?$_SESSION['id']:$_SERVER['REMOTE_ADDR']);

		# user/ID/log/adeptx.loc_userIP_output.log.php
		# или, если ID неизвестен, то
		# user/IP/log/adeptx.loc_userIP_output.log.php
		$user_log_file = $GLOBALS['fold']['users'] . $uidip . '/' . $GLOBALS['fold']['user_log'] . $_SERVER['HTTP_HOST'] . '_output' . $GLOBALS['site']['extensions'];
		if (!is_dir($GLOBALS['fold']['users'] . $uidip)) {
			mkdir($GLOBALS['fold']['users'] . $uidip);
		}
		if (!is_dir($GLOBALS['fold']['users'] . $uidip . '/' . $GLOBALS['fold']['user_log'])) {
			mkdir($GLOBALS['fold']['users'] . $uidip . '/' . $GLOBALS['fold']['user_log']);
		}
		if (!file_exists($user_log_file)) {
			touch($user_log_file);
		}
		file_put_contents($user_log_file, $command_vs_args .  $GLOBALS['module']['cmd']['separator'] . "\n\n" . $result . "\n" . $GLOBALS['module']['cmd']['separator'], FILE_APPEND);
	}

	function run($command_vs_args) {
		global $global;
		foreach ($global as $var) {
			global $$var;
		}

		# для однострочных запросов с несколькими командами разделёнными точкой с запятой и пробелом после неё
		# в идеале нужно пробежаться такой же функцией как это сделано чуть ниже, str_split, чтобы учесть влияние кавычек
		// if (strpos($command_vs_args, '; ') !== false) {
		// 	$commands = explode('; ', $command_vs_args);

		// 	foreach ($commands as $command) {
		// 		run($command);
		// 	}
		// }

		# бывш.: $argv = explode(' ', $command_vs_args);
		# нужно разбивать более грамотно, с учетом также одинарных, косых кавычек и символов экранирования \
		# кроме того, косые кавычки нужно зарезервировать для исполнения команды, которая в них заключена и возврата ответа, чтобы some do `command arg1 arg2` соответствовало some do run('command arg1 arg2');
		$signs = str_split($command_vs_args);
		$cmds = [];	# двумерный массив комманд, [[команда, аргумент1, аргумент2...], [команда2, арг1, арг2...]]
		$cmdc = 0;	# номер команды	# command counter
		$argc = 0;	# номер аргумента для этой команды, где 0 аргумент - имя команды	# argument counter
		$quoted_str = 0;	# флаг, определяемый является ли обрабатываемый символ частью выражения заключенного в кавычки или нет (заодно хранит символ самих кавычек для отеделния одинарных от двойных и косых)
		$prev_sign = null;
		$escape_character = '\\';			# экранирующий символ
		$quotemarks = '\'"`';				# варианты написания кавычек
		$argument_key_identifier = '-';		# символ определяющий то, что начинающийся с него аргумент является ключом аргумента следующего за этим ключем
		# « »
		# „ “, « », “ ”, ‘ ’ 
		# ’ '
		$arguments_separator = ' ';		# символ разделяющий аргументы функции
		$executing_quotemarks = '`';	# символ подстановки результата выполненного выражения в место выражения
		$statements_separator = ';';	# символ разделяющий команды для выполнения (общепринят в линуксе символ |, а хотелось бы также обратные кавычки использовать для этого дела)
		foreach ($signs as $sign) {
			// $its_not_first_sign_of_argument_value = isset($cmds[$cmdc][$argc]);

			if (!$prev_sign || $prev_sign == $arguments_separator || $prev_sign == $statements_separator) {
				$its_first_sign_of_argument_value = true;
			} else {
				$its_first_sign_of_argument_value = false;
			}

			$its_not_first_sign_of_argument_value = !$its_first_sign_of_argument_value;

			# этот блок выполняется каждую итерацию пока не будет обнаружено выражение заключенное в кавычки
			if (!$quoted_str) {
				# если это первый символ аргумента а не где-то посередине
				if ($its_first_sign_of_argument_value /* && $prev_sign != $escape_character */) {
					# если открылись кавычки, причем кавычки не экранированы предварительно
					if ($prev_sign != $escape_character && strpbrk($sign, $quotemarks)) {
						$quoted_str = $sign;
						# do nothing, becouse all we need - switch $quoted_str to new sign
					# а если мы имеем дело с ключем аргумента, а не самим аргументом
					} elseif ($sign == $argument_key_identifier && $prev_sign != $escape_character /* && $prev_sign = $argument_key_identifier */) {
						# обрезаем оба символа дефиса, значение параметра после считывания дублируется как ключ ассоциативного массива, а следующий за ним параметр интерпретируется как значение элемента массива параметров с этим ключем
						$arg_is_its_key = true;
						# $cmds[$cmdc][$argc] = '';
						echo $sign . $quoted_str;
					} else {
						$cmds[$cmdc][$argc] .= $sign;
					}
				# a если это не первый символ аргумента
				} else {
					if ($sign == $statements_separator /* && $prev_sign != $escape_character */) {
						$cmdc++;
						$argc=0;
					} elseif ($sign == $arguments_separator /* && $prev_sign != $escape_character */) {
						if ($arg_is_its_key) {
							$arg_is_its_key = false;
							$arg_key = $cmds[$cmdc][$argc];
							$cmds[$cmdc][$argc] = null;
							# unset($cmds[$cmdc][$argc]);
						} elseif ($arg_key) {
							$arg_key = false;
							$cmds[$cmdc][ $arg_key ] = $cmds[$cmdc][$argc];
						} else {
							$argc++;
						}
					} else {
						$cmds[$cmdc][$argc] .= $sign;
					}
				}
			# а этот блок выполняется при каждой итерации пока кавычки не закроются
			} else {	# if $quoted_str (этот блок говорит как обрабатывать символы выражения заключенного в кавычки)
				# если символ кавычек соответсвует тому символу, с которого начиналась заключенная в кавычки строка, выходим из блока, при необходимости исполняем заключенную в косые кавычки строку, результат записываем в аргумент
				if ($sign == $quoted_str && $prev_sign != $escape_character) {	# теперь $prev_sign - это надёжное решение, так как только НЕЧЕТНОЕ ЧИСЛО обратных слешей перед кавычкой не даёт закрыть кавычки, четное число считается экранированием слешем самого себя и позволяется использовать в конце строки.
					$quoted_str = 0;
					if ($sign == $executing_quotemarks) {
						# run($argv, $argc);	# $command_name
						# выполняем выражение и подтавляем результат на его место
						$cmds[$cmdc][$argc] = run($cmds[$cmdc][$argc], $argc);
					}
				# а если символ соответсвует, но предварительно экранирован, не выходим из блока, а сам символ экранирования заменяем на символ кавычек (то же самое что добавить символ кавычек к строке, но мы перед этим записали символ экранирования, его надо стереть)
				} elseif ($sign == $quoted_str && $prev_sign == $escape_character) {	# определяет поведение для \" в "строке"
					$cmds[$cmdc][$argc] = preg_replace("!(.)$!", $sign, $cmds[$cmdc][$argc]);
				# а если это экранированный символ экранирования строки (\\), то дописываем его как есть, НО не записываем текущий символ предыдущим - то бишь текущий символ экранирования не будет экранировать следующий за ним символ теперь
				} elseif ($sign == $escape_character && $prev_sign == $escape_character) {	# 
					if (!$module['cmd']['halve_escape_character']) {
						$cmds[$cmdc][$argc] .= $sign;		# эта строка определяет отличия между стандартной интерпретацией обратных слешей и моей. у меня все обратные слеши останутся в строке не сьеденными, обычно же их нужно двойное количество. в моём случае это не требуется нигде, кроме конца строки, там поведение не отличается от стандартного - два слеша превращаются в один
					}
					$sign = null;
				} else {	# 
					$cmds[$cmdc][$argc] .= $sign;
				}
			}
			$prev_sign = $sign;
		}

		foreach ($cmds as $cmdc => $argv) {
			$command_name = $argv[0];
			// var_dump($cmds);

			# следует читать как "если запрошенное имя команды пусто", не путать с "если у команды нет аргументов" - первым аргументом всегда идёт имя вызываемой команды
			if (empty($argv)) continue;
			# если запрошенная команда начинается с ./ искать будем в текущей директории
			if (preg_match('!^\./!', $command_name)) {
				$commands_folder = '';
				# chdir($_SESSION['cd']['user']);
				$command_directory = $_SESSION['cd']['user'];
			}
			else {
				$command_directory = $_SESSION['cd']['default'];
				$commands_folder = $GLOBALS['fold']['cmd'];
			}

			# если расширение файла исполняемого скрипта указано, не дописываем его вторично (полезно для вызова на исполнение некоего стороннего скриптика, например ./some.py или даже ./some.js, правила для их исполннения пока не написаны, однако позже мы это исправим)
			if (preg_match('!\\.(php|py|pl|c)$!', $command_name)) {
				$command_extension = '';
			}
			else {
				$command_extension = $GLOBALS['site']['extensions'];
			}

			# Что очень важно, на локалке и на хостинге $command_directory сильно отличаются (на хостинге пусто, на локали адрес от корневой директории системы), так что нужно максимально нивелировать различия
			if ($command_directory) $command_directory .= '/';
			$cmd_file = $command_directory . $commands_folder . $command_name . $command_extension;

			# если команда по прямому имени не найдена, пробуем прогрузить все известные синонимы всех команд и найти реальное имя команы по синонимуму, чтобы позже выполнить команду по её реальному имени
			$true_name = $command_name;
			if (!is_readable($cmd_file)) {
				$all_aliases = include_once $GLOBALS['path']['cmd']['aliases'];

				foreach ($all_aliases as $true_name => $command_aliases) {
					# удаляем из имени запрошенной команды все посторонние символы, которые могут интерпретироваться как часть регулярного выражения
					$command_name = preg_replace('/`[|\'\\\\]/', '', $command_name);
				# 	с одной стороны нужно и сохнаить возможность использования символов в псевдонимах, вроде "цитата дня" или исправляющие некорректный набор из-за раскладки
				#	$command_name = preg_replace('![\^\/\|"\'\\\[\]\(\)\?\.\*\&\%\#\{\}\+\$]!', '', $command_name);
					# а вообще по хорошему следует оставить в наименованиях досутпными только цифро-буквенные знаки.. так и сделаю
				#	if (!preg_match('!^[\w\d-_]+$!', $command_name)) {
				#		$command_name = 'motherofgod';
				#	}
					# проверяет есть ли вхождение |АЛИАС| в строке
					if (preg_match('`\|'.$command_name.'\|`', '|' . $command_aliases . '|')) {
						$cmd_file = $commands_folder . $true_name . $command_extension;
						break;
					}
				}
			}
			# никаких else в этом месте, после первого выполняется изменение $cmd_file и неоходимо второй раз проверить на читабельность

			# запуск команды
			if (function_exists($true_name)) {
				try {
					customization('user');		# on
					# нужно передвать всем массивом $argv, для этого все функции нужно переписать на получения массива с неопределенным количеством переменных
					# argc - arguments counter
					$result .= $true_name($argv, $argc);
					customization('default');	# off
					$result .= history_add_cmd($command_vs_args);
					$result .= cmd_log($command_vs_args, $result);
				}
				catch(Exception $e) {
					$error->report($e->getMessage(), __LINE__, '`' . $true_name . '` Command Exception', __FILE__, $e->getCode());
				}

			} else {
				# проверка существования и доступности для выполнения файла с инициализацией функции / описанием кода для выполнения
				if (is_readable($cmd_file)) {
					try {
						customization('user');
						$result .= include $cmd_file;
						customization('default');
						$result .= history_add_cmd($command_vs_args);
						$result .= cmd_log($command_vs_args, $result);
					}
					catch(Exception $e) {
						# элементарная многоязычеость ошибок: заменяем $e->getMessage() на выборку из БД по этой фразе в текущей языковой таблице
						# как вариант ещё можно сделать двойной запрос - сначала получать значение ID для фразы на разных языках, а потом по ID найти перевод на соответствующий язык. Ну, это требует и соотв. структуры БД
						$query = sprintf('SELECT `%s` FROM `%s` WHERE noconflict_hash="adeptx.cmd.exception" AND unique_key="%s" OR ru="%s" limit 1',
							$db->escape($_SESSION['lang']),
							$database['prefix'] . 'lang',
							$db->escape($e->getCode()),
							$db->escape($e->getMessage())
						);
						$db->call($query);
						$res = $db->fetch_assoc($res);

						$msg = $res[0][ $_SESSION['lang'] ];
						if (!$msg) {
							$msg = $e->getMessage();
						}
						$error->report($msg, __LINE__, '`' . (($true_name)?$true_name:$command_name) . '` Command Exception', __FILE__, $e->getCode());
					}
				} else {
					$result .= "RU: Комманда \"$command_name\" не существует или её файл ($command_directory$cmd_file) переименован, перемещён, недоступен, скрыт настройками приватности или повреждён. Воспользуйтесь командой help чтобы узнать список доступных команд.\nEN: Command \"$command_name\" not useful for this site/profile, command-package not install, rename or moved. Use command \"help\" for access commands list.";

					// var_dump($cmds);
					// var_dump($argv);

					if (is_readable($GLOBALS['fold']['cmd'] . 'error.log' . $GLOBALS['site']['extentions'])) {
						$err_log = fopen($GLOBALS['fold']['cmd'] . 'error.log' . $GLOBALS['site']['extentions'], 'a');
						fwrite($err_log, $command_vs_args . "\n");
						fclose($err_log);
					}
				}
			}
			# no-no-no, ни за что!
			// if (substr($result, -1) != "\n") {
			// 	$result .= "\n";
			// }
		}
		return $result;
	}

	# skip link (open page)
	if (isset($_POST['page'])) {
		if (!empty($_POST['from'])) {
			$page['from'] = $_POST['from'];
		}
		//$page['url'] = $_POST['page'];
		unset($page['header'], $page['footer'], $page['system-message'], $page['cmd']);
 	// 	if ($_SESSION['permissions']['view'][$_POST['page']] == 'denied') {
		// 	$page['url'] = $fold['templates'] . '403' . $site['extensions'];
		// }
		// else {
		// 	$page['url'] = $fold['templates'] . $_POST['page'] . '/' . $_POST['page'] . $site['extensions'];
		// } 
		# I think we must use mysql rather:
		# $_SESSION['sky'][] = $_POST['page'];
	}

	if (isset($_POST['cmd'])) {
		ob_start();
		$echo['#'.$ajax['id']['cmd']['answer']] = run($_POST['cmd']);
		$echo['#'.$ajax['id']['cmd']['answer']] = ob_get_contents() . $echo['#'.$ajax['id']['cmd']['answer']];

		# только для почты, вот эту часть категорически надо переписать (не только из-за трафика, но мы ещё и при каждом запросе смотрим "а не почтой ли интересуются", а надо чтобы нам говорили "покажите почту", а до того не шевелиться)
		if ($_POST['cmd'] == 'select mail') {
			$echo['#user-new-messages'] = $echo['#'.$ajax['id']['cmd']['answer']];		# так мы посылаем одни и те же данные дважды, нагружая траффик в двойной мере! нужно предпринять что-то, чтобы не дублировать данные
		}
		ob_end_clean();
		exit(JSON_encode($echo));
	}














/*
	#	Yandex auth
	# $ya_code = parse_url($_SERVER['REQUEST_URI'],'fragment');	# code=5455678

	$curl = curl_init();
	curl_setopt_array($curl, [
		CURLOPT_URL => 'https://oauth.yandex.ru/token', # .$ya_code,	3461431
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_POST => true,
		CURLOPT_POSTFIELDS => 'grant_type=authorization_code&client_id=c55f9c35cbc54d4e8e67b60ed1d48d83&client_secret=5d1da7627fa24cde9fa3a8a3fd870429&code='.$_GET['code']	# here can be array() of request parameters
	]);
	$token = curl_exec($curl);
	curl_close($curl);
	
	# $token = json_decode($token);		# {"token_type": "bearer", "access_token": "33aba7cfa9674acfa4373b76acf90649", "expires_in": 31536000}

	$curl = curl_init();
	curl_setopt_array($curl, [
		CURLOPT_URL => 'https://login.yandex.ru/info?format=json&oauth_token'.$token, # ['access_token'], # .$ya_code,	3461431
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_POST => true
	]);

	echo $response = curl_exec($curl);
	curl_close($curl);
*/

		
	
	if (isset($_POST['cloud_close'])) unset($_SESSION['sky'][$_POST['cloud_close']-1]);
	
# add new post
	if (isset($_POST['post'])) {
#		mkdir('tpl/page/'.$_POST['post']['dir'], 0777, 1);	# cut the name of file and it's ok
		$f = fopen('tpl/page/'.$_POST['post']['dir'].$_POST['post']['file'].'.php', 'x');
		fwrite($f, '<h1>'. $_POST['post']['text'] ."</h1>\n\n<p>". str_replace("\n\n", "\n\n<p>", $_POST['post']['code']) ."\n\n<p>Дата: ". $_POST['post']['date'] ."\n\n<p>Источник: ". $_POST['post']['source'])
		or $result['#'.$ajax['id']['cmd']['answer']] = $msg['cmd']['add_post']['fail'];
		fclose($f);
		$result['#'.$ajax['id']['cmd']['answer']] = $msg['cmd']['add_post']['luck'];
# опубликовать через
#		if($_POST['post']['public']=='publish');
# router.php:	'page/dev/all/dev-sleep':						case
#		else == 'draft'
# добавить ссылку на статью в индексный файл (или индексный должен составляться автоматом через scandir. да, должен)
#		$_POST['post']['text'];
	}

# auth
	if (isset($_POST['auth'])) {
			$email = $_POST['email'];
			$pass = $_POST['pass'];
			
			$res = mysql_query('select * from `' . $database['prefix'] . 'user` where email="' . $email . '" limit 1');
			if (empty($res)) {
				$result['#' . $ajax['id']['cmd']['answer']] = $lang['fail'].'! '.$lang['sign in'].': wrong email ('.$email.')!';
				exit(JSON_encode($result));
			}
			$res = mysql_fetch_row($res);
			
			$id = $res[0];
			$hash = $res[2];
			$salt = $res[3];
			
			if (!$hash) {
				$result['#' . $ajax['id']['cmd']['answer']] = $lang['fail'].'! '.$lang['sign in'].': wrong email ('.$email.')!';
				exit(JSON_encode($result));;
			}
			
			if ($hash == md5($salt).md5($pass).md5($salt.$pass)) {
				$_SESSION['id'] = $id;
				$result['#'.$ajax['id']['cmd']['answer']] = $lang['luck'].': '.$lang['sign in'].' email: ' . $email . ', '.$lang['password'].': ' . $pass;
			}
			else
				$result['#'.$ajax['id']['cmd']['answer']] = $lang['fail'].'! '.$lang['sign in'].': wrong password!';
	}
	
# fm commands
	
	$dir = $_SESSION['fm']['dir'];
	$dir = str_replace(['../', './', '..'], '', $dir);
	if (!$dir) $dir = '.';
	$files = scandir($dir);
	if ($dir=='.') $dir = '';
	else $dir.='/';

	if (isset($_POST['fm'])) {
		if (isset($_POST['fm']['del'])) {
			unlink($_POST['fm']['del']);
			$result['#'.$ajax['id']['cmd']['answer']] = $_POST['fm']['del'] . $msg['fm']['del']['luck'];
			exit(JSON_encode($result));
		}
		if (isset($_POST['fm']['preread'])) {
			$result['#'.$ajax['id']['fm']['preread']] = str_replace(['\\', '"', "\n"], ['\\\\', '\"', "\\\n"], file_get_contents($_POST['fm']['preread']));
			exit(JSON_encode($result));
		}
		# header('Content-Type: text/plain'); || header('Content-Type: text/html');
		if (isset($_POST['fm']['open'])) {
			run('cat ' . $_POST['fm']['open']);
		}
		if (isset($_POST['fm']['rename'])) {
			run('rename ' . $_POST['fm']['rename'] . ' ' . $dir.$_POST['fm']['newname']);
		}
		if (isset($_POST['fm']['save'])) {
			mkdir($dir);
			$f = fopen($_POST['fm']['save'], 'w');
			if ($_POST['fm']['v'] != '')
				fwrite($f, $_POST['fm']['v']);
			else {
				unlink($_POST['fm']['save']);
				rmdir($dir);
			}
		}
		if (isset($_POST['fm']['open_dir'])) {
			# give list of files and dirs, in js create a table of it
			$_SESSION['fm']['dir'] = substr($_POST['fm']['open_dir'], 5);
			$result['#files'] = $_SESSION['fm']['dir'];
		}

		if(isset($_FILES['file'])) {
			$cmd = 'upload';
			include $fold['cmd'] . $cmd . $site['extensions'];
		}
		exit;
	}

# auth with loginza
	#if (isset($_REQUEST)) {
	#	var_dump($_REQUEST);
	#}
	
# update time && timezone
	if (isset($_POST['timezone'])) {
		$_SESSION['timezone'] = $_POST['timezone'];	# now need to save it to DB
		// $echo['#'.$ajax['id']['cmd']['answer']] .= run('date');
		$cmd = 'date';
		echo '{"status": "success"}';
	}
	if (isset($_POST['date'])) {
		$cmd = 'date';
		include $fold['cmd'] . $cmd . $site['extensions'];
	}

# mail && feedback
	if (isset($_POST['msg'])) {
		if (!isset($_SESSION['msg'])) $_SESSION['msg'] = '';
		$result[$_POST['msg'].'msg'] = $_SESSION['msg'];
	}

	if (isset($_POST['msg'])) {
		if (!isset($_SESSION['msg'])) $_SESSION['msg'] = '';

		$query = sprintf('SELECT COUNT(*) FROM `%suser_message` WHERE to_uid=%u AND was_read IS NOT TRUE',
			$database['prefix'],
			$_SESSION['id']
		);
		$res = $db->call($query);
		$res = $db->fetch_assoc($res);

		$_SESSION['new_mail_count'] = $res[0]['COUNT(*)'];
		$result['#'.$ajax['id']['user']['messages']['new']] = $res[0]['COUNT(*)'];
		// $query = sprintf('SELECT * FROM `%suser_message` WHERE to_uid=%u AND was_read IS NOT TRUE',
		// 	$database['prefix'],
		// 	$_SESSION['id']
		// );
		// $res = $db->call($query);
		// if (!$res) {
		// 	return sprintf($err_auth_mysql4, $email);	// $err_auth_mysql4 = $msg['cmd']['auth']['mysql_error_4']
		// }
		// $res = $db->fetch_assoc($res);

		// $from = $res[0]['reaplyto'];
		// $subject = $res[0]['subject'];
		// $message = $res[0]['message'];

		// $result['#'.$ajax['id']['cmd']['new_user_message']] = '';
	}
	
	// if (isset($_POST['mail'])) {
	// 	$cmd = 'mail';
	// 	include $fold['cmd'] . $cmd . $site['extensions'];
	// }
	
	if (isset($_POST['epigraph'])) {
		$result['#'.$ajax['id']['header']['epigraph']] = $page['epigraph'][(int)microtime(1) % count($page['epigraph'])];
	}

	if (isset($result)) echo JSON_encode($result);