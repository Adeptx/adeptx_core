<?
	# известные недоработки:
	# - вызов aiases $alias (запрос алиасов команды по алиасу) не выдаёт алиасов, не помешало бы хотя бы указывать, что это псевдоним команды `$name` и посмотреть другие можно командой `alias $name`
	# - некорректный ввод команды, в которой используется пароль, как и запрос её по псевдониму грозит записыванием пароля в файлы логов и истории и выводом оного на экран
	# - вообще команды использующие пароль до сих пор выводят его в открытую на экран и ввод происходит с открытым отображением пароля, это нужно исправить

	/**
	 * Псевдонимы для команд терминала, файл загружается в память если команда была запрошена не по её реальному имени или если запрошены псевдонимы для команды.
	 * @param string [$command] - команда, псевдонимы которой необходимо вывести. если не указана, выведет все всевдонимы всех функций
	 * @param string [$direct_request] - флаг, определяющий была ли вызвана эта функция напрямую запросом `aliases` или это обычное включение алиасов для выполнения другой команды по псевдониму
	 * php-аналоги, линукс-аналоги, русская транскрипция, синонимы, переводы и т.п. приравниваются к названиям, которые дал я
	 *
	 * пока что крайне не рекомендуется использование алиасов при вводе команд в которых присутствует ввод пароля, иначе пароль запишется в историю ввода и может быть доступен посторонним (это происходит в javscript-е, поэтому в первую очередь тем посторонним, что буду пользоваться тем же устройством, что и вы). В крайнем случае после их использования обновляйте страницу для сброса истории в браузере.
	 */

	return aliases($arg[1], ($arg[0] == 'aliases'));

	function aliases($command, $direct_request) {
		$aliases['auth']		= 'login|дщпшт|фгер|enter|вход|d[jl';
		$aliases['reg']			= 'куп|signin|ыышптшт|регистрация|зарегистрировать|рег';
		$aliases['unreg']		= 'hfphtubcnhbhjdfnm|разрегистрировать|гткуп';

		$aliases['del']			= 'drop|вуд|вкщз|дел|дроп|удал|удалить';
		$aliases['adeptx_eval']	= 'eval|php';
		$aliases['is']			= 'isnt';
		$aliases['translate']	= 'перевести|перевод|trnslt|trans';
		$aliases['kill']		= 'stop|лшдд|ыещз|стоп|убить|остановить|закрыть|выключить';
		$aliases['add']			= 'new|фвв|туц';
		$aliases['names']		= 'тфьуы|имена|bvtyf';
		$aliases['aliases']		= 'фдшфыуы|псевдонимы|синонимы|алиасы';
		$aliases['help']		= 'about|man|info|штащ|ьфт|рудз|manual|про|о|об|?|tutorial|hotkeys|keys|reference|inquiry|enquiry|помощь|справка|руковоство|мануал|мануэль|мануил|эмануэль|исмаил|измаил|иммануил|ман|мэн|чаво|faq|факью|omg|motherofgod|godhelpme|helpme|sos|introduce';
		$aliases['logout']		= 'exit|quit|учше|signout|sign-out|выход|ds[jl';
		$aliases['cat']			= 'file_get_contents|content|file_content|file_get_content|содержимое|cjlth;bvjt|сфе|fopen|read|fread';
		$aliases['open']		= 'run';
		$aliases['fm']			= 'file-manager|файловый менеджер|фм|explorer|проводник|файлы';
		$aliases['ace']			= 'text-editor|code-editor|code|editor';
		$aliases['pma']			= 'phpmyadmin|пма|пхпмойадмин|пшп мой администратор|мой администратор php';
		$aliases['cd']			= 'chdir|св|change_dir|current_dir|путь|genm';
		$aliases['output']		= 'щгезге|усрщ|print|зкште|вывести|dsdtcnb|сказать';
		$aliases['ls']			= 'glob|dir|scandir|ысфтвшк|ды|пдщы|файлы|пути|pathes|afqks|genb';
		$aliases['message']		= 'msg|letter|дуееук|ьуыыфпу|ьып|сообщение|написать|cjj,otybt|yfgbcfnm';
		$aliases['cal']			= 'calendar|календарь|rfktylfhm|сфд|сфдутвфк';
		$aliases['calc']		= 'calculator|калькуль|калькулятор|rfkmrekznjh|rfkmrekm|rfkmr|сфдс';
		$aliases['pwd']			= 'getcwd|пуесцв|зцв';
		$aliases['copy']		= 'сщзн|cp|сз|ср|коп|копи|копия|копировать|копипаст|rjgbgfcn|цп';	# рус. ср [eser], англ. cp [sipi]
		$aliases['tree']		= 'lstree';
		$aliases['create_backup']	= 'makebackup|createbackup|backup|бекап';
	#	$aliases['cat history']		= 'history';
		$aliases['dump']		= 'bddump|dbdump|дамп|бд|вгьз|вивгьз|иввгьз';
		$aliases['remove']		= 'куьщму|unlink|гтдштл|rmdir|кьвшк|delete|вудуеу|rm';
		$aliases['check']		= 'verify|filter|validate';
		$aliases['get']			= 'see|show|view|показать|пуе|ырщц|ыуу|мшуц';
		$aliases['epigraph']	= 'узшпкфзр|prase|citation|quote|quotation|сшефешщт|цитата|цитата дня|wbnfnf|wbnfnf lyz';

		# отдаём массив всех алиасов, если не запрошены псевдонимы только для указанной функции
		if (!$direct_request) {
			return $aliases;
		}
		
		if ($direct_request && empty($command)) {
			print_r($aliases);
			return '';
		}
		
		# иначе отдаём псевдонимы только для указанной функции, если она запрошена не по псевдониму, а пореальному имени
		if (isset($aliases[$command])) {
			if ($direct_request) {
				return "Псевдонимы функции `$command`: " . $aliases[$command];
			}
			else {
				return $aliases[$command];
			}
		}

		# иначе проверяем, может запрос псевдонимов выполнен по псевдониму команды, тогда говорим об этом и выводим реальное название команды и остальные её псевдонимы
		foreach ($aliases as $real_name => $aliases_names) {
			# если запрошенной функции нет среди псевдонимов данной функции (а мы проганяем массив всех функций), то продолжаем поиск среди псевдонимов следующей
			if (strpos($aliases_names, $command) === false) {
				continue;
			}

			# если же есть, выводим их
			if ($direct_request) {
				return "Команда `$command` является псевдонимом команды `$real_name`. Результат `aliases $real_name`: $aliases_names";
			}
			else {
				return '\\' . $real_name;
			}
		}


		if ($direct_request) {
			# в противном случае запрос выполнен с ошибкой
			throw new Exception("Для команды `$command` не обнаружено псевдонимов (возможно введенная вами команда сама является псевдонимом?). Если введённое вами имя вообще соответствует реальному имени существующей команды, а не её псевдониму, это означает, что эта команда работает только по прямому имени. Вы можете создать новый псевдоним вручную добавив запись в файл {$GLOBALS['path']['cmd']['aliases']} или командой `add new alias \"\$new_alias\" for command \"\$command\"` (короткая запись: `add alias \$new_alias \$command`");
		}
		else {
			return NULL;
		}
		# возможно, стоит сказать об этом более тихо?

		# с другой стороны, всё зависит от обстоятельств
		# если запрос идёт из другого исполняемого файла, выбрасывание исключения прервёт его исполнение, что может помочь избежать ошибки, а документированность исполнения поможет отловить причину ошибки
		# пустой результат же удобен, если запрос идёт прямо из консоли, тогда пустой результат красноречиво скажет нам о том, что у функции нет алиасов и всё остальное мы поймём сами
	}