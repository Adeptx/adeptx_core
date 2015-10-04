<?php
   /**
	* Adeptx Core
	* ch = cd D:\Cloud\Server\home\git.loc\public_html\adeptx_core
	* lg = log --pretty=format:\"%h %ad | %s%d [%an]\" --graph --date=short
		Модель продвижения проекта
	* Полностью бесплатно, с оговоркой. Оговорка в том, что если вам нравится и у вас есть возможность, поблагодарите автора того плагина или модуля или темы, которую вы найдете на сайте или же разработчиков самого ядра. Информация об этом будет указана на самом сайте, реквизиты всегда и везде будут доступны. Модель продвижения полностью не обязывает ни за что платить, но даёт для этого все пути и всю необходимую информацию и к тому же дает об этом знать.
	* Проект является условно-бесплатным. Это значит, что лицензия на его использование есть и она стоит денег. Однако нелицензионное ПО нисколько не ограничено, вам доступны все возможности и вы вправе распорядаться системой на ваше усмотрение. Однако е
		Принцип системы
	* Принцип системы не в самой системе. Она распространяется абсолютно бесплатно, доступна всем с иходниками для скачки и установки на своём сервере, можно менять всё под чистую. Единственное что не переносится от системы к системе, от сервера к серверу - это репозиторий пакетов и база пользователей. То бишь вы ставите себе голую систему со всем необходимым и можете установить себе любые пакеты из репозитория, написать новые, залить в репозиторий пакеты, юзеры могут авторизовываться у вас "из под-коробки". Вам достаётся сама система, база же между системами создаёт единое глобальное пространство.
		Используемые сущности 
	* нужно сразу договориться о сущностях, которые используются в движке.
	* есть некая сущность "project" - это сущность, определяемая объект, который произведен каким-либо пользователем какой-либо версии сайта в каком угодно месте, которая выполняет некоторое действие. это может быть программа, запускаемая в ОС, либо команда терминала, либо скрипт, выполняющий некоторый алгоритм, либо сайт, созданный на компанию, что угодно. суть в том, что этот проект является сущностью, объектом, над которым сейчас ведётся работа. он является главным. если воспринимать этот движок как CMS (а он несомненно играет более обширную роль), то project будет являться запускаемым на ней в данный момент сайтом.
	* есть также сущность
	*/ 
	
	# uncomment this block for debugging
#	if (!ini_get('display_errors')) {
#		ini_set('display_errors', 1);
		error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
#	}

	if (!ini_get('session.auto_start')) session_start();

	// $page['base']['path'] = dirname(__FILE__) . '/';
	// if ($page['base']['path'] == '//') {
	// 	$page['base']['path'] = '/';
	// }

	$fold['db_access'] = 'conf/db/';
	$fold['classes'] = 'class/';
	$site['extensions'] = '.php';

	# Список классов из папкки $fold['classes'], которые подключены к данному проекту
	# $included_classes = glob($fold['classes']."*");
	$included_classes = [
		 'admin'
		,'asset'
#		,'breadcrumbs'
		,'cmd'
#		,'cms'
#		,'command'
#		,'db_mysqli'
		,'file'
		,'font'
#		,'img'
		,'lang'
#		,'module'
#		,'mysqldump'
		,'parse'
#		,'products'
#		,'socket'
		,'sticker'
#		,'update'
#		,'verify'
	];

	# Это значения настроек подключения к БД по умолчанию.
	$database = new ArrayObject;
	$database['driver'] = 'mysql';
	$database['host'] = 'localhost';
	# $port = ini_get("mysqli.default_port");
	$database['user'] = 'root';
	$database['pass'] = '';
	$database['name'] = 'adeptx';
	$database['prefix'] = 'adeptx_';
	# $database['socket'] = ini_get("mysqli.default_socket");


	# А это необязательные теперь уже пользовательские настройки для домена
	# Ранее подключались через require, но теперь в этом нет необходимости
	if (is_readable($fold['db_access'] . $_SERVER['HTTP_HOST'] . $site['extensions'])) {
		include_once $fold['db_access'] . $_SERVER['HTTP_HOST'] . $site['extensions'];
	} else {
		$error->report('Не подключен файл доступа для подключения к БД, будут использованы настройки по-умолчанию', __LINE__, 'Notice', 1101);
	}

	include_once $fold['classes'] . 'error' . $site['extensions'];
	include_once $fold['classes'] . 'json' . $site['extensions'];
	include_once $fold['classes'] . 'db' . $site['extensions'];		# сейчас это PDO
	include_once $fold['classes'] . 'cmd' . $site['extensions'];
	include_once $fold['classes'] . 'sticker' . $site['extensions'];
	$error	= new Adeptx\error();
	$json	= new json();
	$db		= new db();
	$cmd	= new cmd();
	$sticker	= new sticker();
	$global[]	= 'error';
	$global[]	= 'json';
	$global[]	= 'db';
	$global[]	= 'cmd';
	$global[]	= 'sticker';

	# $site['settings'];
	try {
		# надо переделать, чтобы настройки возвращали объект(-ы) с конфигурациями, в классе json достаточно убрать флаг
		$json->fileToGlobal('conf/default/settings.json');
	}
	catch (Exception $e) {
		$error->report($e->getMessage(), __LINE__, 'Configurations Error', $e->getCode());
	}

	# print_r($need);
	// we can just set $var = $conf_json[key]
	// but then overwriting cleanse our var
	// this variant overwrites only the specified keys
	// is also needed recursion to the same goes for nested values

	# сразу же при первом же запуске берём и кешируем все файлы ядра
	// try {
	// 	// opcache_compile_file($fold['db_access'] . $_SERVER['HTTP_HOST'] . $site['extensions']);
	// 	// opcache_compile_file($fold['classes'] . 'error' . $site['extensions']);
	// 	// opcache_compile_file($fold['classes'] . 'json' . $site['extensions']);
	// 	// opcache_compile_file($fold['classes'] . 'db' . $site['extensions']);
	// 	// opcache_compile_file($fold['classes'] . 'cmd' . $site['extensions']);
	// 	// opcache_compile_file($fold['classes'] . 'sticker' . $site['extensions']);
	// }
	// catch(\Exception $e) {
	// 	$error->report($e->getMessage(), __LINE__, 'Fatal Error', $e->getCode());
	// }
	// catch(\BaseException $e) {
	// 	$error->report($e->getMessage(), __LINE__, 'Fatal Error', $e->getCode());
	// }

#	parse_url($_SERVER['REQUEST_URI'], 'query');	#	вернет все после знака вопроса ?
# OR
#	$query = explode('?', substr($_SERVER['REQUEST_URI'], 1));
#	$query = explode('/', $query[0], 1);
#	$page['url'] = $query[0];
# OR may use $_GET['page'] if slash ("/") on the end of request have no matter for site operation (becouse dir != dir/ but bit some user-agent don't know about your want from request)
	$page['url'] = $_GET['page'];
	$query = explode('/', $page['url'], 2);
	# Переключаем контекст в зависимости от домена на тот или иной проект. Движок остаётся тот же, сессия та же, не меняется ничего кроме данных, представления - внешнего вида сайта, темы, наполнения и пр. Обработчики остаются те же, контроллер по сути не меняется. Максимум для однотипных данных переключаются их обработчики. Модель 100% та же, ядро не изменно.
	switch ($_SERVER['HTTP_HOST']) {
	    case 'adeptx.tk':
	    case 'adeptx.biz':
	    case 'test.loc':
	    case 'driver.loc':
	    case 'adeptx.loc':
	    case 'adeptx_py.loc':
	    case 'driver.adeptx.tk':
	    case 'driver.adeptx.biz':
	        $site['alias'] = 'adeptx';
	        break;
	    case 'navitronika.ru':
	    case 'navitronika.adeptx.tk':
	    case 'navitronika.adeptx.biz':
	        $site['alias'] = 'navitronika';
	        break;
	    default:
	        $site['alias'] = 'adeptx';
	        break;
	}
	/* вторичное переключение контекста по url, если нужно проверять паралельно два контекста на одном домене в разных папках:

	switch ($query[0]) {
		case 'admin':
			$site['alias'] = $query[0];
			$page['url'] = $query[1];
			break;
		# if need project gybrid we can use this syntax, example:
		// case 'adeptx':
		// 	$site['alias'] = $query[0];
		// 	$page['url'] = $query[1];
		// 	break;
		default:
			$site['alias'] = $site['default'];
			break;
	}
	*/
	unset($query);

	if (is_readable($page['url'])) {
		# may be have sense just give file as is, if it some file, than users can see
		# but such files alredy (must be) given with .htaccess, if not -- 404 for safe
		if (substr($page['url'], -4) == '.css') {
			header($header['css']);
			# when it's necessary change styles without stopping valid display site, we can begin previously transfer headers
			# header("Cache-Control: no-cache, must-revalidate"); # HTTP/1.1
			# header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); # Дата в прошлом

			// $css_code = file_get_contents($page['url']);

			// $memcache = new Memcache;
			// $connect_status = $memcache->connect('127.0.0.1', 11211);
			// if (!$connect_status) exit('Memcache error: Could not connect');
			// $css_cache = $memcache->get($page['url']);

			// if(empty($var_key))
			// {
			// 	ob_start();
			// 	eval($css_code);
			// 	$css_file = ob_get_contents(); // ob_get_flush();
			// 	//Объект our_var будет храниться 60 секунд и будет сжат
			// 	$memcache->set($page['url'], $css_file, true, 60);

			// 	$css_cache = $memcache->get($page['url']);
			// }
			// echo $css_cache;

	# строки из конфигов, ибо до них нынче и не доходит процесс то..
	$ajax['id']['cmd']['answer'] = 'cmd-answer';		# in one place it also was ".answer:last" (mail)
	$ajax['id']['cmd']['input'] = 'cmd-line-input';
	$ajax['id']['user']['messages']['new'] = 'user-new-messages-count';
	$ajax['id']['fm']['preread'] = 'preread';
	$ajax['id']['fm']['preview'] = 'preview';
	$ajax['id']['header']['epigraph'] = 'site_epigraph';

	# BLOCK 11 - CSS Variables

	$css['site']['width'] = 931;	# px


			include $page['url'];

#			$memcache->close();

			exit;
		}
		// elseif (substr($page['url'], -3) == '.js') {
		// 	header($header['js']);
		// 	# when it's necessary change styles without stopping valid display site, we can begin previously transfer headers
		// 	# header("Cache-Control: no-cache, must-revalidate"); # HTTP/1.1
		// 	# header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); # Дата в прошлом
		// 	include $page['url'];
		// 	exit;
		// }
	}

	# I don't remember any place where it was be used
	# $site['path'] = dirname(realpath(__FILE__)) . '/';
	$site['base'] = 'http://' . $site['domain'] . '/';	# all this vars can be rewrite by user (read "by admin")
	


	# Вот этот блок должен находиться всегда ДО первого подключаемого файла, в адресе или имени которого фигурирует $site['alias'], так как он в случае их отсутствия их создаёт.
	# было бы неплохо также отслеживать как-то не только изменения домена, но и хостинга (ну как минимум это полный адрес до скрипта)
	$first_run = !file_exists($fold['log'] . $_SERVER['HTTP_HOST'] . $site['extensions']);

	if ($first_run) {
		$installation_error = false;	# флаг успешности первого запуска нового проекта
		include_once $fold['setup'] . 'any-project-first-run' . $site['extensions'];
		include_once $fold['setup'] . 'db/' . $site['alias'] . $site['extensions'];
		if (!$installation_error) {
			touch($fold['log'] . $_SERVER['HTTP_HOST'] . $site['extensions']);
			$error->report('Проект успешно запущен в первый раз, проведены первичные настройки, если установочные файлы проекта не были как следует заполнены или не предоставлялись, вам необходимо провести ручную настройку, изменив ключевые файлы проект (файлы настроек доступа к БД, конфигураций, языковые пакеты и т.п.). Если вы видите данное сообщение при повторном запуске, значит у скрипта не хватает прав на создание файлов, пропишите chmod -R 755 для папки проекта', __LINE__, 'Information', 1102);
		}
	}

	# загружаемый языковый пакет для всего проекта и зависимости, которые он подтягивает
	// $need_lang_packs = array('adeptx/index', 'timezone/timezone', 'chairschairs/index');
	$page['lang_pack'] = $fold['languages'] . $_SESSION['lang'] . '/' . $site['alias'] . '.json';

	foreach($site['mainfiles_names'] as $k=>$v) {
		$site['path'][$k] = $fold['templates'] . $site['alias'] . '/' . $v . $site['extensions'];
	}

	require_once $fold['configurations'] . $site['alias'] . $site['extensions'];

	foreach ($included_classes as $class) {
		include_once $fold['classes'] . $class . $site['extensions'];
		$$class = new $class();
		$global[] = $class;
	}
	#$breadcrumbs->init();	# breadcrumbs use module $json those init after all classess includes

	# if request ?download not need to lang_pack and many other
	# this block must be after them!

	try { $json->fileToGlobal($page['lang_pack']); }
	catch (Exception $e) { $error->report($e->getMessage(), (__LINE__ - 1), $e->getCode()); }

	# this block must be in setup file for first run and if all confs is ok not need more
	# but for security, if manager change some we can check options
	foreach ($need as $opt) {
		if (!ini_get($opt) && !ini_set($opt, 'On')) {
			// $error->config($opt);
			$err = sprintf($msg['error']['config']['require'], $opt);
			exit($err);
		}
	}

	// $dbResult = $db->call('SELECT * FROM `options`');
	// $options = $db->fetch_array($dbResult);
	
	// foreach ($options as $i=>$val) {
	// 	$site[$options[$i]['option_name']] = $val['option_value'];
	// }

	if (!empty($_POST)) {
		// require_once $site['mysql'];
		
		// what about "admin" ?
		// $site['alias'] = 'admin';
		if (isset($_POST['page'])) {
			$page['url'] = $_POST['page'];
			if (!empty($_POST['from'])) {
				$page['from'] = $_POST['from'];
			}
			unset($site['path']['header'], $site['path']['footer'], $page['system-message'], $page['cmd']);
		}
		require_once $fold['ajax'] . $site['alias'] . $site['extensions'];
		if (!isset($_POST['page'])) exit;	# ajax return result, router not needed, time to exit
	}
	
	# 1. we need to classes fo $file->download
	# 2. we need to configs for permissions
	# 3. all other we not need
	if (!empty($_GET['download'])) {		# oh yeah, may be you may have problem with download file with name "0" ;P (if they tractue as int, if as string no problem)
		$file->download($_GET['download']);
	}

	// это дефолтные заголовки, которые перепишутся в роутере при необходимости
	header($header[200]);
	header($header['html']);

	if (!isset($_POST['page'])) {
		if ($page['base']['href'] != '/') {
			$page['url'] = substr($page['url'], strlen($page['base']['href']));
		}
	}
	require_once $fold['router'] . $site['alias'] . $site['extensions'];

	if (is_readable($GLOBALS['site']['index'] = $GLOBALS['fold']['templates'] . $GLOBALS['site']['index'] . $GLOBALS['site']['extensions'])) {
		$line =  __LINE__ + 1;
		require_once $GLOBALS['site']['index'];
	}
	else {
		$error->report('Не удается подключить файл индекса (!is_readable). Адрес: <strong>' . $GLOBALS['site']['index'] . '</strong>', $line, 'Fatal Error', 1103);
	}