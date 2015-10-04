<?php
	# BLOCK 1 - Switch types of conf-files etc
	
	$site['lang_pack_type'] = 'json';	# Задаёт формат в котором зранятся языковые пакеты: php/json/sql/xml/ini/etc...
	
	$site['allow_outdir_files']	= false;	# Эта опция указывает на то, что сервер может сохранять файлы вне рабочей директории (то биь той, которая не доступна никому из пользователей, с целью сохранения данных при любых обстоятельствах, в первую очередь это такие файлы, которые хранят пароли от БД например)

	# BLOCK 2 - Site conf
	
  	$site['domain'] = 'adeptx.tk';	# need also some match for reg.exp.: ^(http(s)?://)?(www\.)?([a-z0-9_-]+\.)?$site['domain'](/(.)*)?$
  	$site['extensions'] = pathinfo(__FILE__, PATHINFO_EXTENSION);		# расширения файлов с кодом оперделяются автоматически и всегда считаются равными индексному файлу, какое разрешение имеет этот файл, такое будет и у все файлов системы, по умолчанию ".php", в браузере расширение файлов не играет никакой роли, поскольку адреса формируются отдельно (хотя при желании можно их обхединить)
  	if ($site['extensions'] != NULL) $site['extensions'] = '.' . $site['extensions'];

  	# Отключить сайт для внешних запросов, остаются только запросы из локальной сети
  	// only local requests 
  	$site['block'] = false;
	if ($site['block'] && $_SERVER['REMOTE_ADDR'] !== '127.0.0.1') die(header("Location: /")); 
	
	# BLOCK 2.2 - Pathes to the mover directories
	# BLOCK #x0 - Пути к директориям (и их названия) со вложенными директориями и основными файлами проектов
	# Это дефолтные имена директорий. Можно все папки перемещать и переименовывать на своё усмотрение, но следует проставить связи
	// $pattern = '%s/';
	// $bindings = array(
	// 	 'cmd'		=> 'cmd'
	// 	,'images'	=> 'img'
	// 	,'extra'	=> 'extra'
	// );
	// foreach ($bindings as $reference => $customname) {
	// 	$GLOBALS['fold'][$reference] = array();
	// 	$GLOBALS['fold'][$reference]['.'] = sprintf($pattern, $customname);
	// }

	# BLOCK #x-1 - Пути к директориям второго уровня (и их названия)
	# Это дефолтные имена директорий. Можно все папки перемещать и переименовывать на своё усмотрение, но следует проставить связи
	// $pattern = '%s%s/';
	// unset($bindings);
	// $bindings = array(
	// 	 'images'	=> array(
	// 	 	'favicon'	=> 'favicon'
	// 	)
	// 	,'extra'	=> array(
	// 		'copies'	=> 'copy'
	// 	)
	// );
	// foreach ($bindings as $parent_reference => $children_references) {
	// 	foreach ($children_references as $child_reference => $customname) {
	// 		$GLOBALS['fold'][$parent_reference][$child_reference] = sprintf(
	// 			$pattern,
	// 			$GLOBALS['fold'][$parent_reference],
	// 			$customname
	// 		);
	// 	}
	// }

	# BLOCK #x1 - Подключаемы файлы ядра
	# Это дефолтные имена подключаемых файлов ядра. Можно все файлы перемещать и переименовывать на своё усмотрение, но следует проставить связи
	$pattern = $GLOBALS['fold']['includes'] . '%s' . $GLOBALS['site']['extensions'];
	$bindings = array(
		 'mysql'	=> 'mysql'
		,'router'	=> 'router'
		,'socket'	=> 'socket'
		,'ajax'		=> 'ajax'
	);
	foreach ($bindings as $reference => $customname) {
		$GLOBALS['site'][$reference] = sprintf($pattern, $customname);
	}

	# BLOCK #x2 - Подключаемые файлы шаблона
	# Это дефолтные имена подключаемых файлов шаблона сайта. Можно все файлы перемещать и переименовывать на своё усмотрение, но следует проставить связи
	# Этот блок мне кажется здесь оставлен как обратная совместимость
	$pattern = $GLOBALS['fold']['templates'] . $GLOBALS['site']['alias'] . '/%s' . $GLOBALS['site']['extensions'];
	$bindings = array(
		 'header'	=> 'header'
		,'footer'	=> 'footer'
	);
	foreach ($bindings as $reference => $customname) {
		$GLOBALS['site'][$reference] = sprintf($pattern, $customname);
	}

	# BLOCK #x3 - Подлючаемые файлы шаблона 2
	# Это дефолтные имена подключаемых файлов шаблона сайта. Можно все файлы перемещать и переименовывать на своё усмотрение, но следует проставить связи
	$pattern = $GLOBALS['fold']['templates'] . $GLOBALS['site']['alias'] . '/'. $GLOBALS['page']['dir'] . '%s' . $GLOBALS['site']['extensions'];
	$bindings = array(
		 'header'	=> 'header'
		,'index'	=> 'index'
		,'footer'	=> 'footer'
	);
	foreach ($bindings as $reference => $customname) {
		$GLOBALS['site']['path'][$reference] = sprintf($pattern, $customname);
	}


	$GLOBALS['fold']['favicon']	= $GLOBALS['fold']['images'] . 'favicon/';		// Обратная совместимость
	$GLOBALS['site']['cmd_log']= $GLOBALS['fold']['cmd'] . 'history'; # Обратная совместимость
	$GLOBALS['path']['cmd']['log'] = $GLOBALS['fold']['cmd'] . 'history'; # . $site['extensions'];
	$GLOBALS['path']['cmd']['aliases'] = $GLOBALS['fold']['cmd'] . 'aliases' . $site['extensions'];
	#$

#	don't used anywhere
	#$site['403']	= $fold['templates'] . '403' . $site['extensions'];
	#$site['404']	= $fold['templates'] . '404' . $site['extensions'];
  	
	# BLOCK 3 - User of Site (viewer) conf
	
	# Когда читаете $_SESSION[...] считайте, что видите $USER[...], в данном случае это синонимы, так как в сессиях хранится только информация о текущем пользователе.
	# Наряду с этим, читайте $GLOBALS[...] как $CONFIGURATION[...], потому как все глобальные переменные по сути хранят именно конфиги сайта, страницы, БД etc

	# if viewer lang exist in lang/ dir, included, else English include, conf update to "en"
# if user registred look to mysql, if not isset user lang, set up it for this line
	$_SESSION['lang'] = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
	if (empty($_SESSION['lang'])) {
		$_SESSION['lang'] = 'en';
	}
	if (empty($_SESSION['timezone'])) {
		$_SESSION['timezone'] = 'Europe/Moscow';
	}
	
	# BLOCK 4 - Current Page conf
# all current page configuration set up at the router.php file

	$page['php_to_js_vars'] = '';

	$page['lang_pack'] = $fold['languages'] . $_SESSION['lang'] . '/adeptx.json';
	# $page['lang_pack'] = $fold['languages'] . $_SESSION['lang'] . '/timezone/timezone.json';

	# BLOCK 5 - Default Page conf

	$page['lang'] = $_SESSION['lang'];	# need only if this page have a translate on this lang...
	$page['title'] = 'Adeptx';
	$page['meta'] = array(
		'charset' => 'utf-8'
#		,'og:image' => 'http://jenniferdewalt.com/images/fb_icon.png'
		,'name' => array(
			 'viewport' => 'width=device-width, initial-scale=1.0' /* examples: width=1024, initial-scale=1.0, maximum-scale=1, user-scalable=no ... */
			,'description' => 'Adeptx Tool Kit for Web-developers'
			,'keywords' => 'CMS,Web,Ajax,php,MySQL,ajax'
#			,'author' => $admin['name'] . ' ' . $admin['surname']
		)
	);
	# if you need tag <base> on page (or site), you can just activate this line and setup 'href' to $conf['site']['base'] (example)

	# if tag <base> not need, just comment this block
	# не замещать на array() или [], иначе сотрётся $page['base']['path']
	$page['base']['target'] = '_self';
	$page['base']['href'] = dirname($_SERVER['PHP_SELF']) . '/';
	if ($page['base']['href'] == '//') {
		$page['base']['href'] = '/';
	}
	# just alias
	$base = $page['base'];
	# определяем в директории какого уровня вложенности находится весь движок, и в зависимости от этого подключаем файл
	// $page['directory']['level'] = substr_count($page['base']['href'], '/', 1);
	// $page['antibase']['prefix'] = '.';
	// for ($i = 0; $i<$page['directory']['level']; $i++) $page['antibase']['prefix'] .= '/..';

	# page proof
	$page['favicon'] = $site['alias'] . '.ico';	# default kept $project_name.ico

	$module['auth']['max_fail_count'] = 3;
	$module['cmd']['halve_escape_character'] = false;
	$module['cmd']['theme'] = 'xfce4-terminal';	# default
	$module['cmd']['separator'] = '<hr>';		# default value was '&gt; ', and separator was no duplicated after command strind

	$page['css'] = array(
		 'adeptx/font-face.css'
		,'adeptx/global.css'
		,'adeptx/header.css'
		,'adeptx/index.css'
		,'context/context.css'
#		,'jquery.jscrollpane.css'
		,'adeptx/footer.css'
		,'../theme/cmd/' . $module['cmd']['theme'] . '.css'
#		,'jquery-ui' => 'jquery-ui-1.10.4.css'
		#,'jquery-ui' => '//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css'
		,'google_fonts' => array(
			 'font/google/mix-1.min.css')
		,'font-awesome'	=> 'font/font-awesome/font-awesome.min.css'
		,'sky' => 'cloud/cloud.css'
//		,'jenniferdewalt' => array('analog_clock' => array('http://jenniferdewalt.com/js/analytics.js', 'http://jenniferdewalt.com/css/reset.css', 'http://jenniferdewalt.com/css/analog_clock.css'))
	);
/*
<link rel="stylesheet" href="css/main.css" type="text/css" media="screen,projection" />
<link rel="stylesheet" href="css/print.css" type="text/css" media="print" />
<link rel="stylesheet" href="css/handheld.css" type="text/css" media="handheld" />
*/
	$page['js'] = array(
		# jQuery always before all scripts. http://code.jquery.com/jquery-2.1.0.min.js, http://code.jquery.com/jquery-latest.min.js
		# jQuery UI always after jquery and before other scripts
		# https://js-hotkeys.googlecode.com/files/jquery.hotkeys-0.7.9.js
		'jquery' => array(
			 'jquery/jquery-2.1.4.min.js'
			,'ui' => 'jquery/jquery-ui-1.11.4.min.js'
#			,'ui' => 'jquery/jquery-ui-1.10.4.js'
#			,'address' => 'jquery/jquery.address-1.5.js'
			,'hotkeys' => 'jquery/jquery.hotkeys-0.7.9.js'
			,'mousewheel' => 'jquery/jquery.mousewheel.js'
			,'jscrollpane' => 'jquery/jquery.jscrollpane.min.js'
			,'insert-at-caret' => 'jquery/jquery.insert-at-caret.js'
		)
		,'sync' => array (
			 'ajax' => 'adeptx/ajax.js'
			,'transfer' => 'adeptx/transfer'
			// ,'bg' => 'adeptx/change_bg.js'
			,'note' => 'adeptx/add_note.js'
			,'context' => 'adeptx/context.js'	# need fragmentation (use change_bg.js, add_note.js etc
			,'mouse' => 'adeptx/mouse.js'
			,'sky' => 'adeptx/cloud.js'			# use mouse.js
			,'cmd' => 'adeptx/cmd.js'
			,'ready&variables' => 'adeptx/ready.js'			# use mouse.js
			,'events' => 'adeptx/events.js'			# use mouse.js
		)
		,'async' => array (
			 'loginza' => 'loginza/widget.min.js'
		)
		# yes, pack of code may use sandbox
#		,'jenniferdewalt' => array('analog_clock' => array('http://jenniferdewalt.com/js/analytics.js', 'http://jenniferdewalt.com/js/analog_clock.js', 'http://html5shiv.googlecode.com/svn/trunk/html5.js'))
	);

# Да будет так, что сии переменные могут иметь только сии названия или их не иметь и располагаться либо в папке всех проектов (tpl) либо же в папке сего проекта (tpl/proect). Крайний вариант - пользовательская папка, общак и т.д., но все это укажется в конфигах. Но названия пусть будут строки, как и местоположения.
# en: folder of this files can be only tpl/ or tpl/project and name must be header.php and footer.php
# you can only unset this variable if you need or replace to project unique header/footer
#	$page['header']['globality'] = 'global';
#	$page['footer']['globality'] = 'global';
	$page['header']['globality'] = 'local';
	$page['footer']['globality'] = 'local';
	$page['header']['path'] = 'header' . $site['extensions'];
	$page['footer']['path'] = 'footer' . $site['extensions'];

	$page['system-taskbar'] = true;
	$page['system-message'] = true;
	$page['cmd'] = false;	# if true, you can use cmd on page, if false cmd was unavailable
	# этот параметр отвечает за то, чтобы консоль можно было открыть на запрошенной странице.

# also exist variables:
# $page['dir'] which kept folder of current project, but it need only if project in it's own dir and set at file $site['router'] file
# $page['path'] kept real path to the file and set at the $site['router'] file

	# BLOCK 6 - Navigation menu

// $page['link'] = array(
// 	 'ps' => array('ps', $dic['adeptx']['router.php$page']['link']['ps'][0], $dic['adeptx']['router.php$page']['link']['ps'][1])
// 	,'quickdiff' => array('diff', $dic['adeptx']['router.php$page']['link']['quickdiff'][0], $dic['adeptx']['router.php$page']['link']['quickdiff'][1])	# merge, file compare, kompare, diff, патч, patch
// 	,'adeptx-lazy' => array('adeptx/lazy', $dic['adeptx']['router.php$page']['link']['adeptx-lazy'])
// 	,'adeptx-ordinary' => array('adeptx/ordinary', $dic['adeptx']['router.php$page']['link']['adeptx-ordinary'])
// 	,'adeptx-indigo' => array('adeptx/indigo', $dic['adeptx']['router.php$page']['link']['adeptx-indigo'])
// 	,'adeptx-god' => array('adeptx/god', $dic['adeptx']['router.php$page']['link']['adeptx-god'])
// 	,'order' => array('order', $dic['adeptx']['router.php$page']['link']['order'])
// 	,'room' => array('room', $dic['adeptx']['router.php$page']['link']['room'])
// 	,'kurs' => array('kurs', $dic['adeptx']['router.php$page']['link']['kurs'])
// 	,'rss' => array('rss', $dic['adeptx']['router.php$page']['link']['rss'])
// 	,'work' => array('last-works', $dic['adeptx']['router.php$page']['link']['work'])
// 	,'contacts' => array('cutaway', $dic['adeptx']['router.php$page']['link']['contacts'])
// 	,'bookmarks' => array('bookmarks', $dic['adeptx']['router.php$page']['link']['bookmarks'][0], $dic['adeptx']['router.php$page']['link']['bookmarks'][1], $dic['adeptx']['router.php$page']['link']['bookmarks'][2])
// 	,'fm' => array('fm', 'File Manager')
// );

$nav = array( 'main', 'ps', 'fm', 'quickdiff', 'adeptx-lazy', 'order', 'kurs', 'rss', 'work', 'bookmarks', 'paletton', 'contacts', 'admin/setup', 'exit');

#	it's not just array for main nav menu
#	if page url any time will changed you can just change it once this and all entries of it's link will be change automatically too
# syntax: static (old) link, actual (new) link, title, description
		$page['nav'] = array(
			 'main' => array('/', 'Главная', '')
			,'ps' => array('ps', $page['link']['ps'][1], '')
			,'fm' => array('fm', $page['link']['fm'][1], '')
			,'quickdiff' => array('diff', $page['link']['quickdiff'][1], '')
			,'adeptx-lazy' => array('adeptx/lazy', $page['link']['adeptx-lazy'][1], '')
			,'order' => array('order', $page['link']['order'][1], '')
			,'kurs' => array('kurs', $page['link']['kurs'][1], '')
			,'rss' => array('rss', $page['link']['rss'][1], '')
			,'bookmarks' => array('bookmarks', $page['link']['bookmarks'][1], '')
			,'paletton' => array('paletton', 'Paletton', '')
			,'work' => array('last-works', $page['link']['work'][1], '')
			,'contacts' => array('cutaway', $page['link']['contacts'][1], '')
			,'shop' => array('shop', 'Интернет магазин xNano', '')
			,'setup' => array('admin/setup', 'Панель управления', '')
			,'exit' => array("javascript:update({cmd:'exit'});alert('Вы успешно вышли');", 'Выйти', '')
		);

$bgs = array(
	 'home'
	,'ps'			# butterfly
	,'last-works'	# portfolio
	,'diff'			# compare
	,'adeptx-lazy'	# visual
	,'reminder'		# reminder
	,'kurs'
	,'rss'			# rss
	,'bookmarks'
	,'paletton'		# palette
	,'last-works'
	,'card'
	,'shop'
	,'setup'
	,'exit'
	,'fm'
);

	# BLOCK 7.1 - Head (html <head>)

	$head['favicon']['open']	= '<link rel="shortcut icon" type="image/x-icon" href="';
	$head['favicon']['close']	= '">';
	$head['css']['open']		= '<link rel="stylesheet" href="';
	$head['css']['close']		= '">';
	$head['js']['open']			= '<script src="';
	$head['js']['close']		= '"></script>';

	# BLOCK 7.2 - Headers (php header())

	$header['download'] = 'Content-Disposition: attachment; filename=';
	$header['css'] = 'Content-type: text/css; charset=' . $page['charset'];
	$header['js'] = 'Content-type: text/javascript; charset=' . $page['charset'];
	$header['html'] = 'Content-type: text/html; charset=' . $page['charset'];
	$header[200] = $_SERVER['SERVER_PROTOCOL'].' 200 Ok';
	$header[403] = $_SERVER['SERVER_PROTOCOL'].' 403 Forbiden';
	$header[404] = $_SERVER['SERVER_PROTOCOL'].' 404 Not Found';

	# BLOCK 8 - Messages to user

	# BLOCK 8.1 - MySQLi error messages
	# structure in DB such: table `message`, type=error, package=mysqli, name=init, value=...
	$msg['error']['mysqli']['init']	= 'MySQL error #0';
	$msg['error']['mysqli']['real_connect']	= 'MySQL error #1';
	$msg['error']['mysqli']['select_db']	= 'MySQL error #2';

// 	# BLOCK 8.2 - Command line messages
// 	# no, you can't, bro, couse $arg-s have value only in $site['update'] file
// 	# but may be, if you use foramtting enter, some like this: cmd_luck: %s ... %s ... %s ... think, gay
// 	# structure in DB such: table `message`, package=cmd, package=fa, name=luck, value=$dic['adeptx'][luck]: $dic['adeptx'][file]: $fold[cmd] %s $dic['adeptx'][append]: %s
// 	# or some such table `lang_message`, lang=ru, package=cmd, asset=fa, name=luck, value=$dic['adeptx']['luck'].': '.$dic['adeptx']['file'].': ' . $fold['cmd'] . $arg[1] . ' '.$dic['adeptx']['append'].': ' . $arg[2]
// 	$msg['cmd']['fa']['luck'] = $dic['adeptx']['luck'].': '.$dic['adeptx']['file'].': ' . $fold['cmd'] . $arg[1] . ' '.$dic['adeptx']['append'].': ' . $arg[2];
// 	$msg['cmd']['fa']['fail'] = $dic['adeptx']['fail'].': access denied';
// 	$msg['cmd']['fa']['file not exist'] = 'error: file not exist';

// # you must sure, that $dic['adeptx']['luck'] and $fold['cmd']variables not kept % sign, and if use -- just use duplicate %% to validate
// 	$msg['cmd']['tail']['luck'] = $dic['adeptx']['luck'].': tail %s line from EOF: ' . $fold['cmd'] . '%s: %s';	# $site['update'] file use printf($msg['cmd']['tail']['luck'], $arg[1], $arg[2], $tail[count($tail) - $arg[1] - 1])
// 	$msg['cmd']['tail']['fail'] = 'this message not exist';
// 	$msg['cmd']['tail']['file no exist'] = 'error: file not exist';

// 	$msg['cmd']['more']['file not exist'] = 'error: file not exist';
// 	$msg['cmd']['head']['file not exist'] = 'error: file not exist';

// 	$msg['cmd']['auth']['luck'] = $dic['adeptx']['luck'].': '.$dic['adeptx']['sign in'].' '.$dic['adeptx']['email'].': %s, '.$dic['adeptx']['password'].': %s';
// 	$msg['cmd']['auth']['wrong_pass'] = $dic['adeptx']['fail'].'! '.$dic['adeptx']['sign in'].': wrong password!';
// 	$msg['cmd']['auth']['wrong_email'] = $dic['adeptx']['fail'].'! '.$dic['adeptx']['sign in'].': wrong email (%s)!';
// 	$msg['cmd']['auth']['mysql_error_4'] = 'MySQL error #4: '.$dic['adeptx']['sign in'].': wrong email (%s)!';
// 	$msg['cmd']['cloud']['mysql_error_5'] = 'MySQL error #5: last open clouds can not be loaded!';

	$msg['cmd']['mail']['fail'] = '— Письмо не отправлено!';
	$msg['cmd']['mail']['luck'] = '— Письмо успешно отправлено!';
	$msg['cmd']['mail']['invalid'] = '— Заполните все необходимые поля.';

	$msg['cmd']['add_post']['luck'] = 'Пост успешно опубликован/сохранен в черновик';
	$msg['cmd']['add_post']['fail'] = 'Ошибка сохранения публикации';

	# BLOCK 8.3 - MySQLi error messages
	$msg['error']['config']['require']	= "php.ini: %s not true";

	# BLOCK 9 - Ajax settings

	# BLOCK 9.1 - Global id of the elements, that have ajax class

	$ajax['id']['cmd']['answer'] = 'cmd-answer';		# in one place it also was ".answer:last" (mail)
	$ajax['id']['cmd']['input'] = 'cmd-line-input';
	$ajax['id']['user']['messages']['new'] = 'user-new-messages-count';
	$ajax['id']['fm']['preread'] = 'preread';
	$ajax['id']['fm']['preview'] = 'preview';
	$ajax['id']['header']['epigraph'] = 'site_epigraph';

	# BLOCK 11 - CSS Variables

	$css['site']['width'] = 931;	# px




# BLOCK N - MODULES SETTINGS




# MODULE X - STICKERS (SHORTCUTs)

	// we can do it easy...
	// $page['stickers'] = array(
	// 	 'ps'
	// 	,'fm'
	// 	,'diff'
	// 	,'rss'
	// 	,'paletton'
	// 	,'cutaway'
	// 	,'setup'
	// 	,'tool'
	// 	,'order'
	// 	,'last-works'
	// 	,'sitemap'
	// 	,'cc'
	// 	,'bookmarks'
	// 	,'kurs'
	// 	,'amu'
	// 	,'am'
	// 	,'ps'
	// 	,'jquery-latest'
	// 	,'android'
	// 	,'shop'
	// 	,'lazy'
	// 	,'ordinary'
	// 	,'indigo'
	// 	,'god'
	// 	,'room'
	// 	,'vk'
	// 	,'add-shortcut'
	// );

	$ps = new sticker;
	$ps->href = 'ps';
	$ps->class = 'ps';
	$ps->text = 'Photoshop Online';

	# replace all 80x80 images to 64x64
	$page['stickers'] = array(
#		,array('/', 'home', 'Home')
		 array('fm', 'fm', 'File-manager')
#		,array('fm', 'fm', 'Файловый менеджер')
		,array('diff', 'diff', 'File Diff')
		,array('rss', 'rss', 'RSS')
		,array('paletton', 'paletton', 'Paletton')
		,array('cutaway', 'cutaway', 'Contacts/Pay')
		,array('admin/setup', 'setup', 'Settings')
		,array('tool', 'tool', 'Инструменты')
		,array('order', 'order', $dic['adeptx']['Orders'])
		,array('last-works', 'work', $dic['adeptx']['Our Works'])
#		,array($page['link']['order'][0], 'order', $dic['adeptx']['Our Works'])
		,array('sitemap', 'map', 'Карта сайта')
		,array('cc', 'cc', 'Сurl vs cookie')
		,array('bookmarks', 'link', $dic['adeptx']['Bookmarks'])
		,array($page['link']['kurs'][0], 'kurs', $page['link']['kurs'][1])
		,array('amu', 'amu', 'Ajax Multi Uploader')
		,array('am', 'am', 'Алгоритм-менеджер')
#		,array($page['link']['ps'][0], 'ps', $page['link']['ps'][2])
#		,array('ps', 'ps', 'Онлайн-фотошоп')
		,array('http://code.jquery.com/jquery.min.js', 'jquery', 'jQuery latest')
		,array('http://developer.android.com/sdk/installing/studio.html#Updatin', 'android', 'Android Studio')
		,array('shop', 'shop', 'Adeptx E-Shop')
		,array('adeptx/lazy', 'lazy', 'Adeptx Lazy')
#		,array($page['link']['adeptx-lazy'][0], 'lazy', $page['link']['adeptx-lazy'][1])
		,array($page['link']['adeptx-ordinary'][0], 'ordinary', $page['link']['adeptx-ordinary'][1])
		,array($page['link']['adeptx-indigo'][0], 'indigo', $page['link']['adeptx-indigo'][1])
		,array($page['link']['adeptx-god'][0], 'god', $page['link']['adeptx-god'][1])
		,array($page['link']['room'][0], 'room', $page['link']['room'][1])
#		,array('http://finance.liga.net/rates/nal/dyn/USD.htm', 'order', 'Лiга.Финансiв')
		,array('vk', 'vk', 'ВКонтакте')
	);

// 	if ($_SESSION['permissions']['home']['add_link']) {
// 		$stick[] = array('', 'add', 'Добавить ссылку');
// 	}



// # MODULE X - EPIGRAPH

// # при первом запуске все эпиграфы записываются в БД
// # потом простое считывание рандомного эпиграфа для отображения
// # можно также указывать индекс эпиграфа и тогда будет не рандомный
 # массив оставлен как обратная совместимость - эпиграфы уже перенесены в БД и автоматически туда записываются при первом запуске системы на новом домене
$page['epigraph'] = [
	 'Думать — самая трудная работа; вот, вероятно, почему этим занимаются столь не многие.'
	,'Я не знаю какой результат принесёт мне реклама, но даже если я заработаю доллар — я вложу его в рекламу.'
	,'Когда кажется, что весь мир настроен против тебя, помни, что самолёт взлетает против ветра.'
	,'Nothing is particularly hard if you divide it into small jobs.'
	,'Время не любит, когда его тратят впустую.'
	,'Всё можно сделать лучше, чем делалось до сих пор.'
	,'Если бы я спросил людей, чего они хотят, они бы попросили более быструю лошадь.'
	,'Если у тебя есть энтузиазм, ты можешь совершить всё, что угодно. Энтузиазм — это основа любого прогресса.'
	,'Женщина — это не только вагон удовольствий, но и три, а то и четыре тонны проблем.'
	,'Более одаренные люди ведут общество вперед, облегчая остальным условия жизни.'
	,'Успешные люди вырываются вперёд, используя то время которое остальные используют в пустую.'
	,'Гораздо больше людей сдавшихся, чем побежденных.'
	,'Мой секрет успеха заключается в умении понять точку зрения другого человека и смотреть на вещи и с его и со своей точек зрения.'
	,'Я никогда не говорю: «Мне нужно, чтоб вы это сделали». Я говорю: «Мне интересно, сумеете ли вы это сделать».'];

# MODULE X - BACKGROUNDS

$page['bg-images'] = array(
	 'hands in paint' => 'https://lh4.googleusercontent.com/-1ewm6FMn9tE/UwU6v18ChuI/AAAAAAAAAN0/_1WrAkV_IYs/s1600/81PxcCWbjGk.jpg'
	,'light blue flower' => 'https://lh4.googleusercontent.com/-gIA8xUtL75o/ThtIYGOMZvI/AAAAAAAAAT8/f9I4STLNm44/s1600-e365/65336-1152x864.jpg'
#	,'dark flower' => 'https://lh6.googleusercontent.com/-yPUrCctO-Zo/ThtGeIXeokI/AAAAAAAAAQM/18p3mcX06x8/s1600/79446-1152x864.jpg'
#	,'ocean palm beach' =>'https://lh5.googleusercontent.com/-cevSrqfDYRc/ThtBhR44POI/AAAAAAAAAFI/aUflRXE9jQw/s1600/StaticPage.jpg'
	,'wineberry' => 'https://lh4.googleusercontent.com/-Aa_t8G-0wz4/ThtGgGWwtqI/AAAAAAAAAQU/HDdOVOLOBKw/s1600/108814-1152x864.jpg'
#	,'heart-grow' => 'https://lh6.googleusercontent.com/-BDHLb6aTU7I/ThtdcjGoKGI/AAAAAAAAA6Y/BbY0kY38rhA/s1600/570754784_1152x864.jpg'
#	,'think flower semi-fond' => 'https://lh4.googleusercontent.com/-zxUNEKJZy_8/ThtGdifC9fI/AAAAAAAAAQI/ImG6Z1vjxb0/s1600/110556-1152x864.jpg'
	,'purlpe flowers' => 'https://lh5.googleusercontent.com/-kKa2o9HRj1M/ThtIZ9IqmFI/AAAAAAAAAUI/hW8FJIEJsTs/s1600/66908-1152x864.jpg'
#	,'flowers on water' => 'https://lh3.googleusercontent.com/-uZBRzPfe86k/ThtU4kM5sDI/AAAAAAAAAiw/szaYod-cm9E/s1600/103000-1152x864.jpg'
	,'best blue bg flowers' => 'https://lh5.googleusercontent.com/-QN2dSWaGJoQ/ThtU9hHr1xI/AAAAAAAAAjA/CKUw8zxqLic/s1600/58477-1152x864.jpg'
	,'best blue bg flowers' => 'https://lh5.googleusercontent.com/-QN2dSWaGJoQ/ThtU9hHr1xI/AAAAAAAAAjA/CKUw8zxqLic/s1600/58477-1152x864.jpg'
	,'best blue bg flowers' => 'https://lh5.googleusercontent.com/-QN2dSWaGJoQ/ThtU9hHr1xI/AAAAAAAAAjA/CKUw8zxqLic/s1600/58477-1152x864.jpg'
	,'some purlpe-red flowers' => 'https://lh4.googleusercontent.com/-PwbhISN14BA/ThtU3ye9YJI/AAAAAAAAAis/O5h6QAcsyJY/s1600/99586-1152x864.jpg'
	,'klenov list' => 'https://lh3.googleusercontent.com/-5b0XChNaE-Q/VGymgeNCpsI/AAAAAAABG44/IXYXgxxaKGc/s1600/19-11-2014.png'
#	,'https://lh5.googleusercontent.com/-_Pyn1ftYFqs/Uks-hj6FL0I/AAAAAAAAAG4/ZOVJZAz4_CI/s1600/Bugatti%2BVeyron%2B16.4%2BSuper%2BSport.jpg'
	,'linkedin login (big city life)' => 'https://static.licdn.com/scds/common/u/images/apps/uas/splash_signin_v3.jpg'
	,'spb purple ' => 'https://lh5.googleusercontent.com/-OVPkVuB5vAg/VG6cajRJVSI/AAAAAAAAAYs/ttI4Zoanhn8/s1600/89f37dca4045d5ee987db5b1f5a01d34.jpg'
#	,'spb white and snow' => 'https://lh3.googleusercontent.com/-MeVPG6n29T4/VG6carqTkUI/AAAAAAAAAZU/e6YmhCbvq4o/s1600/50d7fa2590aab.jpg'
	,'Yana autumn 2014' => 'https://lh4.googleusercontent.com/-8eMprsqvWjs/VG6bwOvRhSI/AAAAAAAAAhc/1rwFAItBuUM/s1600/ze2icxBQvGU.jpg'
	,'spb eifel tower' => 'https://lh3.googleusercontent.com/-g0VjnpHWU9A/VG6cb6lUHNI/AAAAAAAAAZA/42hxiD0Uv40/s1600/eiffel_1.jpg'
	,'spb cupol' => 'https://lh3.googleusercontent.com/-c5WHJUpghEI/VG6cbCg2CfI/AAAAAAAAAY4/k1LNEGxD3Kg/s1600/400274_sankt-peterburg_xram_spas-na-krovi_1680x1050_%28www.GdeFon.ru%29.jpg'
	,'spb' => 'https://lh6.googleusercontent.com/-RvhUghPfEA8/VG6cbPM8jII/AAAAAAAAAZQ/bylJ2iDAnZA/s1600/98933881_holodnaya_zima.jpg'
	,'spb snow yakor' => 'https://lh4.googleusercontent.com/-OruycEwMoyw/VG6cbZ1iEeI/AAAAAAAAAZE/3GDbqhNK5zY/s1600/ed9817d6c065.jpg'
	,'nature art' => 'https://lh5.googleusercontent.com/-vZgpVHbBjZ0/VG6esQR6cZI/AAAAAAAAAck/OHGcsYKzmuA/s1600/kruto-devushka-devushki-kraska-Favim.ru-66397.jpg'
	,'spb house' => 'https://lh3.googleusercontent.com/-IRly4U17dfI/VG6caDAQtQI/AAAAAAAAAYk/7eWeDh9pTXo/s1600/1339458128_sankt_petersb_35.jpg'
#	 ,'kraski ruki' => 'https://lh6.googleusercontent.com/-9CyNyVD-sFU/VG6esgsRVFI/AAAAAAAAAcg/uUxSFsuSkRM/s1600/tumblr_lmjpm89v0g1qemy5mo1_500_large.jpeg'
#	,'need geek' => 'https://lh3.googleusercontent.com/--F0qH5Yoxyc/VG6f_l7JcgI/AAAAAAAAAf4/nHptB2AMc1s/s1600/Hvho6Nfy-6M.jpg'
	,'sweet lags' => 'https://lh3.googleusercontent.com/-kc-4m1PSalw/VG6fklF62UI/AAAAAAAAAfc/lLi7thOYYA0/s1600/Creative_Wallpaper_Sexual_legs_in_sneakers_018874_.jpg'
	,'no future' => 'https://lh5.googleusercontent.com/-A1MWwxAjhbI/VG6eQSVRmeI/AAAAAAAAAbA/kUWjERBr3no/s1600/bp16.jpg'
	,'getry' => 'https://lh5.googleusercontent.com/-ZZDH3t7FVcE/VG6fkr_oPZI/AAAAAAAAAfY/TQYcjI1w_Mo/s1600/932368_polosatyie_getryi.jpg'
#	,'need proger' => 'https://lh4.googleusercontent.com/-pWRvpzbEZCE/VG6f_swG4AI/AAAAAAAAAfw/oNWV5KcIPEs/s1600/need1.jpg'
#	,'spb admiralteyskaya' => https://lh4.googleusercontent.com/-R444fCpKXmA/VG6gOv3hFlI/AAAAAAAAAh0/CGpZFiDI-wQ/s1600/attbig_70_1.jpg'
	,'geek' => 'https://lh3.googleusercontent.com/-2xuMkpeGPz4/VG6gPVWscOI/AAAAAAAAAgg/vqii8L_B3Cc/s1600/geek-wallpaper-1280x768.jpg'
#	,'red room' => 'https://lh4.googleusercontent.com/-DkFrloOIzd0/VG6gOmXW62I/AAAAAAAAAiE/p88nciIynHw/s1600/RedRooms.jpg'
	,'orange text php mysql' => 'https://lh6.googleusercontent.com/-ULYD7DKHz1s/VG6gP5bcK9I/AAAAAAAAAg0/Zcutc2fpS1M/s1600/iart%2B%281%29.png'
	,'cold room server' => 'https://lh5.googleusercontent.com/-LbpIRnPjCk0/VG6fFpeoQcI/AAAAAAAAAiM/BP3oxq94kFM/s1600/hq-wallpapers_ru_abstraction3d_41494_1920x1200.jpg'
#	 ,'world network' => 'https://lh5.googleusercontent.com/-5_LEBau-L_U/VG6e_UA--UI/AAAAAAAAAdk/Y-Iq1VHq0Ek/s1600/Facebook.png'
	,'blue diamond' => 'https://lh6.googleusercontent.com/-xq88onqlEic/VG6egbCJ3MI/AAAAAAAAAis/GcwvlRt-hfs/s1600/women-paint-blue-hair-fresh-hd-wallpaper.jpg'
);







	# BLOCK 3.2 - User permissions

	if (!$_SESSION['status']) {
		$_SESSION['status'] = 'ghost';
	}
	if (!$_SESSION['id']) {
		$_SESSION['id'] = $_SERVER['REMOTE_ADDR'];
	}
	if (!$_SESSION['left_wrong_login_attempts']) {
		$_SESSION['left_wrong_login_attempts'] = $module['auth']['max_fail_count'];
	}

	if ($_SESSION['status'] == 'admin') {
		$_SESSION['permissions']['home']['add_link'] = true;
		$_SESSION['permissions']['cmd']['fa'] = true;
		$_SESSION['permissions']['fm']['elfinder'] = true;
	}
	if ($_SESSION['status'] == 'staff' || $_SESSION['status'] == 'admin') {
		$_SESSION['permissions']['download'] = true;
		
		$_SESSION['permissions']['cmd']['tail'] = true;
		
		$_SESSION['permissions']['view']['tool'] = true;
		$_SESSION['permissions']['view']['order'] = true;
		$_SESSION['permissions']['view']['paletton'] = true;
		$_SESSION['permissions']['view']['adeptx/lazy'] = true;
		$_SESSION['permissions']['view']['adeptx/ordinary'] = true;
		$_SESSION['permissions']['view']['adeptx/indigo'] = true;
		$_SESSION['permissions']['view']['adeptx/god'] = true;
		$_SESSION['permissions']['view']['room'] = true;
		$_SESSION['permissions']['view']['sitemap'] = true;
		$_SESSION['permissions']['view']['admin/setup'] = true;
		$_SESSION['permissions']['view']['upload'] = true;
	}
	if ($_SESSION['status'] != 'staff' && $_SESSION['status'] != 'admin') {
		$_SESSION['permissions']['view']['tool'] = 'denied';
		$_SESSION['permissions']['view']['order'] = 'denied';
		$_SESSION['permissions']['view']['paletton'] = 'denied';
		$_SESSION['permissions']['view']['adeptx/lazy'] = 'denied';
		$_SESSION['permissions']['view']['adeptx/ordinary'] = 'denied';
		$_SESSION['permissions']['view']['adeptx/indigo'] = 'denied';
		$_SESSION['permissions']['view']['adeptx/god'] = 'denied';
		$_SESSION['permissions']['view']['room'] = 'denied';
		$_SESSION['permissions']['view']['sitemap'] = 'denied';
		$_SESSION['permissions']['view']['admin/setup'] = 'denied';
		$_SESSION['permissions']['view']['upload'] = 'denied';
	}

# all user configurations must be kept in mysql and session, not local variable
# aslo exists variable $_SESSION['status'] (stuff, admin, etc) which kept user, it's set at file update.php (after reading mysql with user conf, when user authed with ajax)