<?
	# можно формировать хлебные крошки исходя из адреса сайта (папка=категория)
	# for download file use syntax: www/download?file=dirname/filename.php

	/* skip link need new scripts and style for pages. we can load them async with adding new tag <script>...*/

	// if (preg_match('!sale/.*!', $page['url'])) {
	// 	if (empty($page['path'])) $page['path'] = 'information';
	// }

# рекомендованный знак разделения слов в ЧПУ это знак дефиса "-" (http://habrahabr.ru/post/136762/)

//	no, this variant have problem with safety!
//	$page['path'] = $page['url'];
// $page['url'] = substr($page['url'], strlen($page['base']['href']));

switch($page['url']) {
	case '':
	case 'home':
	case 'index':
			unset($page['footer']);
			$page['cmd'] = true;
			$page['alias'] = 'home';
			$page['path'] = $fold['templates'] . $site['alias'] . '/' . $page['alias'] . $site['extensions'];
		break;
	case 'feedback':
			$page['title'] = "Обратная связь | Grinec.tk";
			$page['css'][] = "feedback/feedback.css";

			$page['path'] = $fold['templates'] . 'feedback/feedback' . $site['extensions'];
		break;
	case 'elfinder':			
			$page['path'] = $_SESSION['permissions']['fm']['elfinder'] ? $fold['templates'] . 'elfinder/elfinder' . $site['extensions']:'403';
		break;
	case 'fm':
			exit('<iframe frameborder="0" height="768" width="100%" src="elfinder"></iframe>');
		break;
	case 'fm/php/connector':
			include $fold['templates'] . $page['url'] . $site['extensions'];
			exit;
		break;
	case 'fm.min':
			$page['dir'] = 'fm.min/';
			$page['title'] = 'Portable Mini Ajax File Manager';
			unset($page['header']);
			$page['footer']['globality'] = 'local';
		#	$page['js']['jquery'] = 'http://code.jquery.com/jquery-latest.min.js';
			
			$page['js'][] = 'fm.min.js';
			$page['css'][] = 'fm.min.css';
	
			$page['path'] = $page['dir'] . 'fm.min';
		break;
	case 'lazy':
			# header('HTTP/1.0 403 Forbidden');
# remember, that you do it early, than view permissions
# that's why 403 page view without header and footer but download some styles and scripts :)
			unset($page['header'], $page['footer']);
			$page['title'] = "Adeptx Lasy";
			$page['css'][] = 'adeptx-lazy.css';
	case 'ordinary':
	case 'indigo':
	case 'god':
			$page['dir'] = 'adeptx/';
			$page['path'] = $_SESSION['permissions']['view'][$page['url']] ? $page['dir'] . $page['url']:'403';
		break;
# break no need always
	case 'paletton':
			unset($page['header'], $page['footer']);
	case 'order':
			$page['dir'] = $page['url'].'/';
			$page['path'] = $_SESSION['permissions']['view'][$page['url']] ? $page['dir'] . $page['url']:'403';
	case 'tool':
			$page['path'] = $_SESSION['permissions']['view'][$page['url']] ? $page['dir'] . 'index' : '403';
		break;
	case 'ps':
			$page['title'] = 'Photoeditor Online';
			$page['favicon'] = 'img/16x16/ps.png';
	
			$page['path'] = $fold['templates'] . 'ps/ps' . $site['extensions'];
			exit('<iframe frameborder="0" height="768" width="100%" src="http://pixlr.com/editor/"></iframe>');
		break;
	case 'vk':
			$page['title'] = 'ВКонакте';
			$page['favicon'] = 'img/16x16/vk.png';
	
			$page['path'] = 'vk/vk';
			exit('<iframe frameborder="0" height="768" width="100%" src="http://vk.com/im"></iframe>');
		break;
	case 'am':
			$page['dir'] = 'am/';
			$page['title'] = "'Создавай.'";	# 'Algorithm Manager'; fm-title>Управление файлами: <?=(($_GET['f'])?$_GET['f']:(($_GET['show'])?$_GET['show']:($_GET['dir'])?$_GET['dir']:'просмотр главного каталога.'));
			unset($page['header']);
			$page['footer']['path'] = $page['dir'] . 'footer.php';
			$page['css'][] = 'css.css';
			$page['js'][] = 'mouse.js';
			$page['js'][] = 'am_js.js';
			
			$page['path'] = $page['dir'] . $page['url'];
		break;
	case 'amu':
			$page['dir'] = 'amu/';
			$page['path'] = $_SESSION['permissions']['view'][$page['url']] ? $page['dir'] . $page['url']:'403';
			$dir = $page['dir'] . 'assets/';
			$page['title'] = 'Mini Ajax File Upload Form';
			$page['css'][] = 'http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700';
			$page['css'][] = $dir . 'css/style.css';
		#	$page['js'][] = 'https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js';
			$page['js'][] = $dir . 'js/query.knob.js';
			$page['js'][] = $dir . 'js/jquery.ui.widget.js';
			$page['js'][] = $dir . 'js/jquery.iframe-transport.js';
			$page['js'][] = $dir . 'js/jquery.fileupload.js';
			$page['js'][] = $dir . 'js/script.js';
			
			$page['path'] = 'amu/index';
		break;
	case 'cutaway':			
			$page['path'] = $page['url'] . '/' . $page['url'];
		break;
	case 'kurs':
			$page['css'][] = 'kurs.css';
	case 'rasp':
	case 'bookmarks':
			$page['path'] = $page['url'] . '/' . $page['url'];
		break;
	case 'download':
			download($_GET['file']);
		break;
#	case 'firebible':
#			$page['path'] = 'firebible/index';
#		break; case
			
	case 'rss':
	case 'rss/dev/web/css/selectors':
	case 'rss/dev/web/jquery/select':
	case 'rss/dev/web/habr/ff':
	case 'rss/dev/web/mysql/root-password':
	case 'rss/dev/android/hard-reset':
	case 'rss/dev/android/root':
	case 'rss/dev/web/css/vertical-align':
	case 'rss/dev/web/cms/modx':
	case 'rss/dev/web/http/content-transfer-encoding':
	case 'rss/dev/web/hack/iframe-content-position':
	case 'rss/dev/all/non-stop':
	case 'rss/dev/all/dev-sleep':
	case 'rss/dev/web/css/safe-fonts':
	case 'rss/dev/all/jquery-67':
	case 'rss/dev/web/index':
			$page['path'] = 'rss/index';
		break;
	case 'firebook/probability':
			$page['title'] = 'FireBook | После прочтения сжечь';
			$page['favicon'] = 'img/16x16/firebook.ico';
	
			$page['path'] = 'rss/firebook/probability';
		break;
	case 'maxsense/index':
			$page['title'] = 'MaxSens';
#			$page['favicon'] = 'img/16x16/firebook.ico';
	
			$page['path'] = 'rss/maxsense/index';
		break;
	case 'phpinfo':
			phpinfo();
			exit;
		break;
	case 'diff':
	case 'quickdiff':
			$page['js'][] = 'diff/diff.js';
			$page['title'] = 'Quick Diff Online Tool';
			$page['favicon'] = 'img/16x16/compare.png';
			
			$page['path'] = $fold['templates'] . 'diff/diff' . $site['extensions'];
		break;
	case 'room':
			$page['path'] = $_SESSION['permissions']['view'][$page['url']]?'room/room':'403';
		break;
	case 'sitemap':
			$page['path'] = $_SESSION['permissions']['view'][$page['url']]?'sitemap/'.$page['url']:'403';
		break;
	case 'search':
			$page['path'] = 'search/search';
		break;
	case 'admin/setup':
			$page['path'] = $_SESSION['permissions']['view'][$page['url']]?$page['url']:'403';
			include 'setup/' . $site['alias'] . $site['extensions'];
		break;
	case 'admin/about':
			$page['path'] = 'admin/about';
		break;
	case 'upload':
			$page['dir'] = 'amu/';
			$page['path'] = $_SESSION['permissions']['view'][$page['url']] ? $page['dir'] . 'index' :'403';	
		break;
	case 'our-works':
	case 'our-last-works':
	case 'last-works':
	case 'portfolio':
	case 'works':
			$page['path'] = 'work/index';
			$page['css'][] = 'work.css';
		break;
	case 'js/adeptx/transfer':
			header($header['js']);
			include 'js/adeptx/transfer' . $site['extensions'];
			exit();
		break;
	default:
		# если это файлы css или js мы отдаём их как есть (предварительно установив для них соответсвующие заголовки и кеширование, что было ранее но сейчас нет!), хотя вместо sass, less мы прекрасно можем обрабатывать php любой css файл и кешировать результат
		if (preg_match('!.+\.css$!', $page['url'])) {
			header($header['css']);
			include_once($page['url']);
			exit;
		}
		elseif (preg_match('!.+\.js$!', $page['url'])) {
			header($header['js']);
			exit(file_get_contents($page['url']));
		}
		elseif (preg_match('!.+\.(eot|svg|ttf|woff|woff2)$!', $page['url'])) {
			header($header['js']);
			exit(file_get_contents($page['url']));
		}
		else {
			header($header[404]);
			$page['path'] = $fold['templates'] . '404/404'. $site['extensions'];
		}
		# $page['url'] not changed, you can use it in the page, like: "page $page['url'] not found"
		# $mysqli->query('INSERT INTO `' . $database['prefix'] . 'user` (email, hash, salt) VALUES 
	}
	
	# ajax - main controller
	# файл ajax это главный обработчик запросов, контроллер, обрабатывающий любой запрос поступивший со страницы. запросы со страниц должны поступать в том же виде, как запросы с командной строки, в виде команд, которые необходимо выполнить, ajax перенаправит любую команду или набор команд на неоьходимые исполняемые файлы.

	# amu - ajax multi uploader
	# файл amu - это страничка, на которой можно воспользоваться мультизагрузкой файлов через аякс, если необходимо залить на сервер большое количество файлов это быстро и удобно.