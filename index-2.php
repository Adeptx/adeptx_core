<?php
	class adeptx {	

		// comment/uncomment this line for debugging mode off/on
		$conf['core']['debugging_mode'] = true;	// включает режим отладки, сообщения об ошибках вставляются в общий поток вывода
		global $mysql = array('host' => 'localhost', 'user' => 'root', 'pass' => '', 'db' => 'adeptx', 'prefix' => 'adeptx_');

		# I don't remember any place where it was be used
		# $site['path'] = dirname(realpath(__FILE__)) . '/';
		$site['base'] = 'http://' . $site['domain'] . '/';	# all this vars can be rewrite by user (read "by admin")

		public function debugging_mode_status($status) {
			if ($status) {
				if (!ini_get('display_errors')) {
					ini_set('display_errors', 1);
					error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
				}
			} else {
				ini_set('display_errors', 0);
				error_reporting(0);
			}
		}
		public function session_start() {
			if (!ini_get('session.auto_start')) {
				session_start();
			}
		}
		public function db_config($config = $mysql) {
			global $mysql = $config;
		}
		public function include_classes(){
			$fold['classes'] = 'class/';
			$site['extensions'] = '.php';

			foreach (glob($fold['classes']."*") as $class_file) {
				include_once $class_file;
				$class = preg_replace('!'.$fold['classes'].'(.*)'.$site['extensions'].'!', '$1', $class_file);
				$$class = new $class();
				$global[] = $class;
			}
		}
		public function applying_default_settings() {
			# $site['settings'];
			try {
				# надо переделать, чтобы настройки возвращали объект(-ы) с конфигурациями, в классе json достаточно убрать флаг
				$json->fileToGlobal('core/settings/default/settings.json');
			}
			catch (Exception $e) {
				$error->report($e->getMessage(), __LINE__ - 3);
			}
		}
		public function applying_custom_settings() {
			# $site['settings'];
			try {
				# надо переделать, чтобы настройки возвращали объект(-ы) с конфигурациями, в классе json достаточно убрать флаг
				$json->fileToGlobal('core/settings/custom/settings.json');
			}
			catch (Exception $e) {
				$error->report($e->getMessage(), __LINE__ - 3);
			}
			# print_r($need);
			// we can just set $var = $conf_json[key]
			// but then overwriting cleanse our var
			// this variant overwrites only the specified keys
			// is also needed recursion to the same goes for nested values
		}
		public function checking_necessary_settings() {
			foreach ($need as $opt) {
				if (!ini_get($opt) && !ini_set($opt, 'On')) {
					// $error->config($opt);
					$err = sprintf($msg['error']['config']['require'], $opt);
					exit($err);
				}
			}
		}
		public function parse_url() {
			#	parse_url($_SERVER['REQUEST_URI'], 'query');	#	вернет все после знака вопроса ?
			# OR
			#	$query = explode('?', substr($_SERVER['REQUEST_URI'], 1));
			#	$query = explode('/', $query[0], 1);
			#	$page['url'] = $query[0];
			# OR may use $_GET['page'] if slash ("/") on the end of request have no matter for site operation (becouse dir != dir/ but bit some user-agent don't know about your want from request)
			$page['url'] = $_GET['page'];
			$query = explode('/', $page['url'], 2);
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
			unset($query);
		}
		public function return_static_files() {
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

					include $page['url'];

					$memcache->close();

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
		}
		public function affixing_pathes($value='')
		{
			foreach($site['mainfiles_names'] as $i=>$mainfile_name) {
				$this->site['path'][$i] = $fold['templates'] . $site['alias'] . '/' . $mainfile_name . $site['extensions'];
			}
		}
		public function first_run_setup()
		{
			if ($site['first_run']) {
				# if need setup, install package
				# $page['path'] = $fold['setup'] . $site['alias'] . $site['extensions'];

				# it's say us, that we have firt run for this project
				if (!is_readable($fold['configurations'] . $site['alias'] . $site['extensions'])) {
					fclose(fopen($fold['configurations'] . $site['alias'] . $site['extensions'], 'x'));
					$error->report('Отсутствует файл конфигураций, автоматически будет создан файл: <strong>' . $fold['configurations'] . $site['alias'] . $site['extensions'] . '</strong>', __LINE__ - 2);
				}

				# it's say us, that we have firt run for this project
				if (!is_readable($page['lang_pack'])) {
					$f = fopen($page['lang_pack'], 'x');
					fwrite($f, '{
						"'.$site['alias'].'": {
							
						}
					}');
					fclose($f);
				}

				# it's say us, that we have firt run for this project
				if (!is_readable($fold['router'] . $site['alias'] . $site['extensions'])) {
					fclose(fopen($fold['router'] . $site['alias'] . $site['extensions'], 'x'));
				}

				if (!is_dir($fold['configurations'])) {
					mkdir($fold['configurations'], 0777, 1);
				}
				if (!is_readable($fold['configurations'] . $site['alias'] . $site['extensions'])) {
					fclose(fopen($fold['configurations'] . $site['alias'] . $site['extensions'], 'x+'));
				}
				if (!is_dir($fold['templates'] . $site['alias'])) {
					mkdir($fold['templates'] . $site['alias'], 0777, 1);
				}
				if (!is_readable($site['path']['header'])) {
					fclose(fopen($site['path']['header'], 'x+'));
				}
				if (!is_readable($site['path']['index'])) {
					fclose(fopen($site['path']['index'], 'x+'));
				}
				if (!is_readable($site['path']['footer'])) {
					fclose(fopen($site['path']['footer'], 'x+'));
				}
			}
		}
		public function applying_project_settings()
		{
			require_once $fold['configurations'] . $site['alias'] . $site['extensions'];

			// foreach ($options as $i=>$val) {
			// 	$site[$options[$i]['option_name']] = $val['option_value'];
			// }

			// примерный аналог реализации через БД:
			// $dbResult = $db->call('SELECT * FROM `options`');
			// $options = $db->fetch_array($dbResult);
		}
		public function include_languages_packages() {
			// $need_lang_packs = array('adeptx/index', 'timezone/timezone', 'chairschairs/index');
			$page['lang_pack'] = $fold['languages'] . $_SESSION['lang'] . '/' . $site['alias'] . '.json';

			try {
				$json->fileToGlobal($page['lang_pack']);
			}
			catch (Exception $e) {
				$error->report($e->getMessage(), __LINE__ - 3);
			}
		}
		public function ajax_including() {
			if (!empty($_POST)) {
				// require_once $site['mysql'];
				
				// what about "admin" ?
				// $site['alias'] = 'admin';
				if (isset($_POST['page'])) {
					$page['url'] = $_POST['page'];
				}
				require_once $fold['ajax'] . $site['alias'] . $site['extensions'];
				if (!isset($_POST['page'])) exit;	# ajax return result, router not needed, time to exit
			}
		}
		public function download_per_url() {
			# 1. we need to classes fo $file->download
			# 2. we need to configs for permissions
			# 3. all other we not need
			if (!empty($_GET['download'])) {		# oh yeah, may be you may have problem with download file with name "0" ;P (if they tractue as int, if as string no problem)
				$file->download($_GET['download']);
			}
		}
		public function routing() {
			// это дефолтные заголовки, которые перепишутся в роутере при необходимости
			header($header[200]);
			header($header['html']);
			require_once $fold['router'] . $site['alias'] . $site['extensions'];
		}
	}

	$adeptx->debugging_mode_status($adeptx->conf['core']['debugging_mode']);
	$adeptx->session_start();
	$adeptx->db_config(array(
		'host' => 'localhost',
		'user' => 'root',
		'pass' => '',
		'db' => 'adeptx',
		'prefix' => 'adeptx_'
	));
	$adeptx->include_classes();
	$adeptx->applying_default_settings();
	$adeptx->applying_custom_settings();
	$adeptx->parse_url();
	$adeptx->return_static_files();
	$adeptx->affixing_pathes();
	$adeptx->first_run_setup();
	$adeptx->applying_project_settings();

	$breadcrumbs->init();	# breadcrumbs use module $json those init after all classess includes

	# if request ?download not need to lang_pack and many other
	# this block must be after them!
	$adeptx->include_languages_packages();

	#:en:	this block must be in setup file for first run and if all confs is ok not need more
	#		but for security, if manager change some we can check options
	#:ru:	Этот блок должен быть расположен в файле setup.php, который запускается при первом запуске системы
	#		И впринципе в нём нет необходимости при повторном запуске
	#		(разве что из соображений безопасности, чтобы админ был вкурсе того, какие опции могут быть не в порядке)
	$adeptx->necessary_settings_checking();

	$adeptx->ajax_including();
	$adeptx->download_per_url();
	$adeptx->routing();

	if (is_readable($site['index'])) {
		require_once $site['index'];
	}
	else {
		$error->fatal('Не удается подключить файл индекса. Адрес: <strong>' . $fold['templates'] . $site['index'] . $site['extensions'] . '</strong>', __LINE__ - 3);
	}
