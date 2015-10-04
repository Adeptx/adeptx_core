<?php

	$site['base'] = 'http://' . $site['domain'] . '/';	# all this vars can be rewrite with DB
	$site['path'] = dirname(realpath(__FILE__)) . '/';

	# BLOCK 2.2 - Pathes to the mover directories

# for easy rename but moving not reccomend
# also in css files now you can see ../img/.*
	$fold['class']		= 'class/';
  	$fold['configurations']	= 'conf/';
  	$fold['fonts']		= 'font/';
  	$fold['images']		= 'img/';
  	$fold['includes']	= 'inc/';	# mysql, router, socket, ajax
  	$fold['languages']	= 'lang/';	# en, ru
  	$fold['scripts'] = $fold['javascripts'] = $fold['js'] = 'js/';
  	$fold['styles'] = $fold['css'] = 'css/';
  	$fold['templates']	= 'html/';
  	$fold['users']		= 'user/';	# 1, 2

  	$fold['cmd']		= $fold['templates'] . 'cmd/';
	$fold['favicon']	= $fold['images'] . 'favicon/';

	$site['settings'] = $fold['configurations'] . 'settings' . '.php';
	$site['mysql']	= $fold['includes'] . 'mysql' . $site['extensions'];
	$site['router']	= $fold['includes'] . 'router' . $site['extensions'];
	$site['socket']	= $fold['includes'] . 'socket' . $site['extensions'];
	$site['ajax']	= $fold['includes'] . 'ajax' . $site['extensions'];

	$site['index']	= $fold['templates'] . 'index' . $site['extensions'];
	$site['header']	= $fold['templates'] . $site['alias'] . '/header' . $site['extensions'];
	$site['footer']	= $fold['templates'] . $site['alias'] . '/footer' . $site['extensions'];

	$site['cmd_log']= $fold['cmd'] . 'history'; # . $site['extensions'];
#	don't used anywhere
	#$site['403']	= $fold['templates'] . '403' . $site['extensions'];
	#$site['404']	= $fold['templates'] . '404' . $site['extensions'];
  	
	# BLOCK 3 - Site Admin conf
	
	$admin['email']		= 'e.grinec@gmail.com';
	$admin['name']		= 'Евгений';
	$admin['surname']	= 'Гринец';

	# BLOCK 3 - User of Site (viewer) conf
	
	# if viewer lang exist in lang/ dir, included, else English include, conf update to "en"
# if user registred look to mysql, if not isset user lang, set up it for this line
	$_SESSION['lang'] = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
	if (empty($_SESSION['lang'])) {
		$_SESSION['lang'] = 'en';
	}
	if (empty($_SESSION['timezone'])) {
		$_SESSION['timezone'] = 'Europe/Moscow';
	}

	# BLOCK 3.2 - User permissions

	if (!$_SESSION['status']) {
		$_SESSION['status'] = 'ghost';
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
	
	# BLOCK 4 - Current Page conf
# all current page configuration set up at the router.php file
	
#	parse_url($_SERVER['REQUEST_URI'], 'query');	#	вернет все после знака вопроса ?
# OR
#	$query = explode('?', substr($_SERVER['REQUEST_URI'], 1));
#	$query = explode('/', $query[0], 1);
#	$page['url'] = $query[0];
# OR may use $_GET['page'] if slash ("/") on the end of request have no matter for site operation (becouse dir != dir/ but bit some user-agent don't know about your want from request)
	$page['url'] = $_GET['page'];

	# BLOCK 5 - Default Page conf

	$page['lang'] = $_SESSION['lang'];	# need only if this page have a translate on this lang...

	# if you need tag <base> on page (or site), you can just activate this line and setup 'href' to $conf['site']['base'] (example)

	# if tag <base> not need, just comment this block
	$page['base'] = array(
		 'target' => '_self'
		,'href' => '/cms/'
	);
	# just alias
	$base = array(
		 'target' => '_self'
		,'href' => '/cms/'
	);

	# page proof
	$page['favicon'] = $site['alias'] . '.ico';	# default kept $project_name.ico

# Да будет так, что сии переменные могут иметь только сии названия или их не иметь и располагаться либо в папке всех проектов (tpl) либо же в папке сего проекта (tpl/proect). Крайний вариант - пользовательская папка, общак и т.д., но все это укажется в конфигах. Но названия пусть будут строки, как и местоположения.
# en: folder of this files can be only tpl/ or tpl/project and name must be header.php and footer.php
# you can only unset this variable if you need or replace to project unique header/footer
#	$page['header']['globality'] = 'global';
#	$page['footer']['globality'] = 'global';
	$page['header']['globality'] = 'local';
	$page['footer']['globality'] = 'local';
	$page['header']['path'] = 'header' . $site['extensions'];
	$page['footer']['path'] = 'footer' . $site['extensions'];

	$page['cmd'] = false;	# if true, you can use cmd on page, if false cmd was unavailable
	# этот параметр отвечает за то, чтобы консоль можно было открыть на запрошенной странице.

# also exist variables:
# $page['dir'] which kept folder of current project, but it need only if project in it's own dir and set at file $site['router'] file
# $page['path'] kept real path to the file and set at the $site['router'] file

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

	# BLOCK 10 - Classes including

	$site['class'] = array(
		//  'dynamic_bg'
		// ,'epigraph'
		// ,'stick'
		 'file'
		,'db'
		,'font'
		,'img'
		,'asset'
		,'cms'	#
		,'lang'	#
		,'products'	#
		,'breadcrumbs'
		,'verify'
		,'error'	###
	);