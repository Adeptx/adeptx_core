<?php
	# BLOCK 2 - Site conf
	
  	$site['domain'] = 'chairschairs.ru';	# need also some match for reg.exp.: ^(http(s)?://)?(www\.)?([a-z0-9_-]+\.)?$site['domain'](/(.)*)?$

	# BLOCK 2.2 - Pathes to the mover directories

  	$fold['cmd']		= $fold['templates'] . 'cmd/';
	$fold['favicon']	= $fold['images'] . 'favicon/';

	$site['mysql']	= $fold['includes'] . 'mysql' . $site['extensions'];
	$site['router']	= $fold['includes'] . 'router' . $site['extensions'];
	$site['socket']	= $fold['includes'] . 'socket' . $site['extensions'];
	$site['ajax']	= $fold['includes'] . 'ajax' . $site['extensions'];

	$site['header']	= $fold['templates'] . $site['alias'] . '/header' . $site['extensions'];
	$site['footer']	= $fold['templates'] . $site['alias'] . '/footer' . $site['extensions'];

	$site['cmd_log']= $fold['cmd'] . 'history'; # . $site['extensions'];

	$site['path']['header'] = $fold['templates'] . $site['alias'] . '/' . 'header' . $site['extensions'];
	$site['path']['index'] = $fold['templates'] . $site['alias'] . '/index' . $site['extensions'];
	$site['path']['footer'] = $fold['templates'] . $site['alias'] . '/' . $page['dir'] . 'footer' . $site['extensions'];
#	don't used anywhere
	#$site['403']	= $fold['templates'] . '403' . $site['extensions'];
	#$site['404']	= $fold['templates'] . '404' . $site['extensions'];
  	
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

# all user configurations must be kept in mysql and session, not local variable
# aslo exists variable $_SESSION['status'] (stuff, admin, etc) which kept user, it's set at file update.php (after reading mysql with user conf, when user authed with ajax)
	
	# BLOCK 4 - Current Page conf
# all current page configuration set up at the router.php file
	
	$need_lang_packs = array('adeptx/index', 'timezone/timezone', 'chairschairs/index');

	$page['lang_pack'] = $fold['languages'] . $_SESSION['lang'] . '/chairschairs/index' . $site['extensions'];

	# BLOCK 5 - Default Page conf
	
	$page['php_to_js_vars'] = '
	<script>
		VKgroupID = "'.$social['VKgroupID'].'";
		pagePath = "'.$page['alias'].'";
		window.fancyImgDir = "'.$fold['images'].'fancyzoom/";
	</script>';

	$page['lang'] = $_SESSION['lang'];	# need only if this page have a translate on this lang...
	$page['title'] = 'Adeptx';

	# remembrer: each page must have own <meta>, not global for site
	# see more: http://ru.wikipedia.org/wiki/Метатеги
	$page['meta'] = array(
		'charset' => 'utf-8'
#		,'og:image' => 'http://jenniferdewalt.com/images/fb_icon.png'
		,'name' => array(
			 'viewport' => 'width=device-width, initial-scale=1.0' /* examples: width=1024, initial-scale=1.0, maximum-scale=1, user-scalable=no ... */

			# this information searchers show to user near link to page of site
			,'description' => 'Магазин дизайнерских стульев и уникальных аксессуаров'

			# use only words from current page, no use another words
			# and no more than 10 words
			# words must be relevant for search request for current page
			,'keywords' => 'стулья,столы,мебель,кресла,комоды,тумбочки,аксессуары'

			,'author' => 'Алексей Гринец и Евгений Гринец'
			# if no one authir, if company has right on page, use:
			# ,'copyright' => 'Company Name'
			# tags author and copiryght has also attr lang="ru" to correctly identify lang of words in this tags (https://ru.wikipedia.org/wiki/Метатеги#.D0.9C.D0.B5.D1.82.D0.B0.D1.82.D0.B5.D0.B3_Author_.D0.B8_Copyright)

			# ,'document-state' => 'Dynamic'	# [Dynamic / Static] for regular index of searchers or no index more

			,'generator' => 'Adeptx'	# this fild for PR site generator system

			,'resource-type' => 'creation' 	# document (default), rating, version, operator, formatter, creation etc
			# searchers index only if document
			# this tag indicates page status
			
			# 'revisit' => 14		# can use for searchers reindex each 14 days, but Google and Yandex ignore this tag, use robots.txt, directive "Crawl-delay"

			,'robots' => 'all'	# all (index,follow) or noindex,nofollow (none) or variations thereof (if page necessary for index and follow links on it)

			# 'url' => 'http://adeptx.tk'	# if page must be no index and robot must go to this link for index real page (example, if this page is "mirrow" of real page)
		)
		// ,'http-equiv' => array(	# any http headers
		// 	 'refresh' => 30		# refresh each 30 second
		// 	,'content-type' => 'text/html; charset=UTF-8'
		#	,'content-language' => 'ru'

		# you can set new default value for each tags <script> and <style> on page
		#	,'Content-Script-Type' => 'text/javascript'
		#	,'Content-Style-Type' => 'text/css'

		#	,'Expires' => 'Wed, 26 Feb 2015 08:21:57 GMT'	# for manipulate browser caching, robots can no index if date expire
		#	date must be in standart RFC850

		# 'pics-label' => '...'	# for adult sites

		# 'Pragma' => 'no-cache'	# if page generated by scpipt no need to cache it

		# 'refresh' => '5; url=http://www.example.com/' 	# for script redirect to nother page after 5 seconds (you can use 0)

		# 'imagetoolbar' => 'no'	# 
		// )
	);
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
	// <link rel="shortcut icon" href="$page['favicon'].ico" />
	// <link rel="apple-touch-icon" href="$page['favicon'].png" />

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

	# BLOCK 6 - Navigation menu

// $page['link'] = array(
// 	 'ps' => array('ps', $lang['router.php$page']['link']['ps'][0], $lang['router.php$page']['link']['ps'][1])
// 	,'quickdiff' => array('diff', $lang['router.php$page']['link']['quickdiff'][0], $lang['router.php$page']['link']['quickdiff'][1])	# merge, file compare, kompare, diff, патч, patch
// 	,'adeptx-lazy' => array('adeptx/lazy', $lang['router.php$page']['link']['adeptx-lazy'])
// 	,'adeptx-ordinary' => array('adeptx/ordinary', $lang['router.php$page']['link']['adeptx-ordinary'])
// 	,'adeptx-indigo' => array('adeptx/indigo', $lang['router.php$page']['link']['adeptx-indigo'])
// 	,'adeptx-god' => array('adeptx/god', $lang['router.php$page']['link']['adeptx-god'])
// 	,'order' => array('order', $lang['router.php$page']['link']['order'])
// 	,'room' => array('room', $lang['router.php$page']['link']['room'])
// 	,'kurs' => array('kurs', $lang['router.php$page']['link']['kurs'])
// 	,'rss' => array('rss', $lang['router.php$page']['link']['rss'])
// 	,'work' => array('last-works', $lang['router.php$page']['link']['work'])
// 	,'contacts' => array('cutaway', $lang['router.php$page']['link']['contacts'])
// 	,'bookmarks' => array('bookmarks', $lang['router.php$page']['link']['bookmarks'][0], $lang['router.php$page']['link']['bookmarks'][1], $lang['router.php$page']['link']['bookmarks'][2])
// 	,'fm' => array('fm', 'File Manager')
// );


	if (empty($_GET["page"])) $_GET["page"] = 1;
	if ( !isset( $_SESSION["cart"] ) ) {
		$_SESSION["cart"] = array();
		$_SESSION["cart"]["products"] = array();
	}

			$page['title'] = "Chairs Chairs | Магазин дизайнерских стульев и уникальных аксессуаров";
#			$page['title'] = $site['site_name'] . ' | ' . $lang['index']['title'];
#			$page['header']['globality'] = $page['footer']['globality'] = 'local';
	
			$page['css'] = array(
				 'chairschairs' => array(
					 "chairschairs/font-face.css"
					,"chairschairs/chairschairs.css"
				)
#				,"http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700"
				,"http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css"
			);

			// or https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js
			$page['js'] = array(
				 'jquery' => array(
					 "jquery/jquery.js"
					,"jquery/jquery.knob.js"
					,"jquery/jquery.ui.js"
					,"jquery/jquery.ui.widget.js"
					,"jquery/jquery.iframe-transport.js"
					,"jquery/jquery.fileupload.js"
					,"jquery/jquery.fancyzoom.js"
				)
				,'chairschairs' => array(
					"chairschairs/chairschairs.js"	// chairschairs.min.js
				)
				,'social' => array(
					"//vk.com/js/api/openapi.js?116"
				)
			);


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

	# BLOCK 8.3 - MySQLi error messages
	$msg['error']['config']['require']	= "php.ini: %s not true";

	# BLOCK 9 - Ajax settings

	# BLOCK 9.1 - Global id of the elements, that have ajax class

	$ajax['id']['cmd']['answer'] = 'cmd-answer';		# in one place it also was ".answer:last" (mail)
	$ajax['id']['cmd']['input'] = 'cmd-line-input';
	$ajax['id']['fm']['preread'] = 'preread';
	$ajax['id']['fm']['preview'] = 'preview';
	$ajax['id']['header']['epigraph'] = 'site_epigraph';

	# BLOCK 11 - CSS Variables

	$css['site']['width'] = 931;	# px




# BLOCK N - MODULES SETTINGS



# MODULE X - STICKERS (PRODUCT (images))

	$product_image['no_exist']	= $fold['images'] . 'product/no-image.png';

	$product_image['dir']		=  $fold['images'] . 'product/' . $site['alias'] . '/%s/%s/';
	$product_image['original']	= 'original';
	$product_image['large']		= '400x400';
	$product_image['middle']	= '130x130';
	$product_image['small']		= '80x80';


# MODULE X - SOCIALS

	$social['VKgroupID'] = 73944214;


# MODULE X - FILTER


$filter = array(
	 'start' => 0
	,'quantity' => 16
	,'category_id' => 3
	,'min_price' => 250
	,'max_price' => 150
	,'colors' => array(3, 5, 6)
	,'search' => 'товар'
);





# MODULE X - CURRENCY COURSES

$_SESSION['course'] = 60;
// $kurs = file_get_contents(
// 	'https://query.yahooapis.com/v1/public/yql?q=select+*+from+yahoo.finance.xchange+where+pair+=+"USDRUB,EURRUB"&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback='

// 	//'https://query.yahooapis.com/v1/public/yql?q=select+*+from+yahoo.finance.xchange+where+pair+=+%22USDRUB,EURRUB%22&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback='
// 	);
// $_SESSION['course'] = preg_replace('!"Name":"USD to RUB","Rate":"(.*)"!', '$1', $kurs);