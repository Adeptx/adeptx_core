<?
	# можно формировать хлебные крошки исходя из адреса сайта (папка=категория)
	# for download file use syntax: www/download?file=dirname/filename.php

	# skip link need new scripts and style for pages. we can load them async with adding new tag <script>...

	// if (preg_match('!sale/.*!', $page['url'])) {
	// 	if (empty($page['path'])) $page['path'] = 'information';
	// }

# рекомендованный знак разделения слов в ЧПУ это знак дефиса "-" (http://habrahabr.ru/post/136762/)

// выход из админки
if ( $_GET['call'] == 'exit' ) {
	unset( $_SESSION['admin'] );
}
// проверка авторизован ли админ
if ( !$admin->user_autorized() ) {
	$page['from'] = $page['url'];
	$page['url'] = 'autorization';
}

// можно сделать ассоциативный массив [ $page[url] ] => array('alias'=>page[ alias ], 'path'=>page[ path ], ...
// каждый массивчик хранить в настройках страницы с json файлике для переменной page, подключается через этот роутер файл нужная страничка настроек.. сейчас уже на 80% так

$rout = array (
	'products' => array(
		'alias' => $page['url'],
		'path' => $fold['templates'] . $site['alias'] . '/' . $page['alias'] . $site['extensions'],
		'heading' => $page['url'].'-title'
	)
);

switch($page['url']) {
	case 'products':
	case 'categories':
	case 'infopages':
	case 'news':
	case 'articles':
	case 'users':
	case 'options':
		$page['title'] = $lang->give('title');
		$page['alias'] = $page['url'];
		$page['path'] = $fold['templates'] . $site['alias'] . '/' . $page['alias'] . $site['extensions'];
		$page['heading'] = $page['url'].'-title';
		$page['option']['great_seven'] = true;
		$page['js'][$site['alias']][] = $site['alias'] . '/' . $page['alias'] . '.js';
		break;
	case '':
		$page['title'] = $lang->give('title');
		$page['alias'] = 'products';
		$page['path'] = $fold['templates'] . $site['alias'] . '/' . $page['alias'] . $site['extensions'];
		$page['option']['great_seven'] = true;
		break;
	case 'autorization':
		unset($page['header'], $page['footer']);
		$page['title'] = $lang->give('title');
		$page['css'][] = 'admin/autorization.css';
		$page['alias'] = 'autorization';
		$page['path'] = $fold['templates'] . $site['alias'] . '/' . $page['alias'] . $site['extensions'];
		break;
	case 'lang':
		$page['alias'] = 'lang';
		$page['title'] = $lang->give('title');
		$page['path'] = $fold['templates'] . $site['alias'] . '/' . $page['alias'] . $site['extensions'];
		$page['heading'] = $page['url'].'-title';
		$page['option']['great_seven'] = true;
		break;
	case 'page':
		$page['alias'] = 'page';
		$page['title'] = $lang->give('title');
		$page['path'] = $fold['templates'] . $site['alias'] . '/' . $page['alias'] . $site['extensions'];
		$page['heading'] = $page['url'].'-title';	// it's key for $lang->phrase($page['heading'])
		$page['option']['great_seven'] = true;
		break;
	case 'rout':
		$page['alias'] = 'rout';
		$page['title'] = $lang->give('title');
		$page['path'] = $fold['templates'] . $site['alias'] . '/' . $page['alias'] . $site['extensions'];
		$page['heading'] = $page['url'].'-title';	// it's key for $lang->phrase($page['heading'])
		$page['option']['great_seven'] = true;
		break;
	case 'setup':
		$page['alias'] = 'setup';
		$page['title'] = $lang->give('title');
		$page['path'] = $fold['templates'] . $site['alias'] . '/' . $page['alias'] . $site['extensions'];
		$page['heading'] = $page['url'].'-title';	// it's key for $lang->phrase($page['heading'])
		$page['option']['great_seven'] = true;
		break;
	case 'font':
		$page['alias'] = 'font';
		$page['title'] = $lang->give('title');
		$page['path'] = $fold['templates'] . $site['alias'] . '/' . $page['alias'] . $site['extensions'];
		$page['heading'] = $page['url'].'-title';	// it's key for $lang->phrase($page['heading'])
		$page['option']['great_seven'] = true;
		break;
	case 'site':
		$page['alias'] = 'site';
		$page['title'] = $lang->give('title');
		$page['path'] = $fold['templates'] . $site['alias'] . '/' . $page['alias'] . $site['extensions'];
		$page['heading'] = $page['url'].'-title';	// it's key for $lang->phrase($page['heading'])
		$page['option']['great_seven'] = true;
		break;
	case 'htaccess':
		$page['alias'] = 'htaccess';
		$page['title'] = $lang->give('title');
		$page['path'] = $fold['templates'] . $site['alias'] . '/' . $page['alias'] . $site['extensions'];
		$page['heading'] = $page['url'].'-title';
		$page['option']['great_seven'] = true;
		break;
	case 'robots.txt':
		$page['alias'] = 'robots.txt';
		$page['title'] = $lang->give('title');
		$page['path'] = $fold['templates'] . $site['alias'] . '/' . $page['alias'] . $site['extensions'];
		$page['heading'] = $page['url'].'-title';
		$page['option']['great_seven'] = true;
		break;
	case 'css':
		$page['alias'] = 'css';
		$page['title'] = $lang->give('title');
		$page['path'] = $fold['templates'] . $site['alias'] . '/' . $page['alias'] . $site['extensions'];
		$page['heading'] = $page['url'].'-title';
		$page['option']['great_seven'] = true;
		break;
	case 'html':
		$page['alias'] = 'html';
		$page['title'] = $lang->give('title');
		$page['path'] = $fold['templates'] . $site['alias'] . '/' . $page['alias'] . $site['extensions'];
		$page['heading'] = $page['url'].'-title';
		$page['option']['great_seven'] = true;
		break;
	case 'conf':
		$page['alias'] = 'conf';
		$page['title'] = $lang->give('title');
		$page['path'] = $fold['templates'] . $site['alias'] . '/' . $page['alias'] . $site['extensions'];
		$page['heading'] = $page['url'].'-title';
		$page['option']['great_seven'] = true;
		$page['js'][$site['alias']][] = $site['alias'] . '/' . $page['alias'] . '.js';
		break;
	case 'elfinder':
		$page['alias'] = 'elfinder';
		$page['path'] = $fold['templates'] . 'elfinder' . '/' . $page['alias'] . $site['extensions'];
		unset($page['js']['admin'], $page['css']['admin']);
		// очень важный момент
		// ранее мы подключили аналогично настройки сайта
		// здесь же мы подключаем настройки для конкретной страницы (модуля) аналогичным методом
		include_once $fold['configurations'] . $page['alias'] . $site['extensions'];
		break;
	case 'elfinder/php/connector':
		include_once $fold['templates'] . 'elfinder/php/connector' . $site['extensions'];
		exit;
		break;
	default:
		header($header['404']);
		$page['path'] = $fold['templates'] . $fold['404']. '404' . $site['extensions'];
		# $page['url'] not changed, you can use it in the page, like: "page $page['url'] not found"
		# write to log
	}