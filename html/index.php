<!DOCTYPE html>
<html<? if(isset($page['lang'])) { ?> lang="<?=$page['lang']?>"<? } ?><? if(isset($page['direction'])) { ?> dir="<?=$page['direction']?>"<? } ?>>

	<head>
		<?
			# в теге title могут быть символы в любой кодировке, поэтому мы объявляем кодировку первее
			# title can kept any-character symbols, those charset set before
		?>
		<? if(isset($page['meta']['charset'])) { ?>
			<meta charset="<?=$page['meta']['charset']?>">
		<? } ?>
		<?
			# первое что видит посетитель сайта, ещё до того, как страница догрузится - это title, поэтому его объявляем в самом начале
		?>
		<? if(isset($page['title'])) { ?>
			<title><?=$page['title']?></title>
		<? } ?>
		<?
			# в meta тегах может содержаться редирект на другую страницу, поэтмоу прежде чем мы продолжим загружать эту страницу, мы прогружаем meta теги. к тому же это может несколько упростить работу поисковой системе.
		?>
		<? if(isset($page['meta']['name'])) {
			foreach ($page['meta']['name'] as $name=>$content) {
				echo '<meta name="'.$name.'" content="'.$content.'">';
			}
		} ?>
		<? 
			# этот тег указывает поисковикам какую страницу они должны предпочитать, /?page=2 или /blog
			# canonical link say searchers what page they must prefer, /?page=2 or /blog
			# <link rel="canonical" href="$site['url']/blog"/>
		?>
		<?
			# тег base устанавливает префикс ко всем относительным и абсолютным адресам файлов и страниц в любых ссылках на странице, как в тегах <a> так и <link>, <script>, <img> и прочих
			# в нём может быть указан домен другого сайта с протоколом или директория текущего. если будет указан файл в директории (всё что не заканчивается на слеш /), его название отбросит и будет воспринимать базовым директорию в которой находится тот файл
			# заодно тегом можно определить дефолттный target открытия ссылок, например в _blank
			# этот тег лучше указывать до того, как будут встречены адреса и ссылки, хотя браузерам всё равно, как и с прочими тегами, в каком месте будет указан тег, его влияние распространится на всю страницу, но логический порядок интерпретации примерно таков, значит это несколько упрощает дело.
		?>
		<? if (isset($page['base'])) { ?>
			<base target="<?=$page['base']['target']?>" href="<?=$page['base']['href']?>">
		<? } ?>
		<?
			# что-то вроде фавиконки наксколько я помню, могу ошибаться
		?>
		<? if(isset($page['meta']['og:image'])) { ?>
			<meta property="og:image" content="<?=$page['meta']['og:image']?>">
		<? } ?>

		<?
			# если страница имеет лицензионные ограничения, это можно указать в коде страницы, подробности по ссылке ниже
		/* # http://creativecommons.org/choose/
		<a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/"><img alt="Лицензия Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by-sa/4.0/80x15.png" /></a><br />Произведение «<span xmlns:dct="http://purl.org/dc/terms/" href="http://purl.org/dc/dcmitype/InteractiveResource" property="dct:title" rel="dct:type">Adeptx</span>» созданное автором по имени <a xmlns:cc="http://creativecommons.org/ns#" href="http://adeptx.tk/about" property="cc:attributionName" rel="cc:attributionURL">Евгений Гринец</a>, публикуется на условиях <a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/">лицензии Creative Commons «Attribution-ShareAlike» («Атрибуция — На тех же условиях») 4.0 Всемирная</a>.<br />Основано на произведении с <a xmlns:dct="http://purl.org/dc/terms/" href="http://adeptx.tk" rel="dct:source">http://adeptx.tk</a>.<br />Разрешения, выходящие за рамки данной лицензии, могут быть доступны на странице <a xmlns:cc="http://creativecommons.org/ns#" href="http://adeptx.tk/feedback" rel="cc:morePermissions">http://adeptx.tk/feedback</a>.
		*/ ?>

		<?
			# А это фирменная хитрость, позволяющая передать в javascript любые переменные php, просто объявив их в самом первом теге <script>, что происходит в этом месте. в дальнейших скриптах вы можете просто использовать объявленные здесь переменные. Не забывайте, что многострочный текст в javascript необходимо экранировать слешами перед каждым переносом строки.

			/************************************************
				All php vars transfer to js here
				Don't remember add js-slashes for strings

				this script must be before all scripts
			*************************************************/
			$page['php_to_js_vars'];

			$page_proof = array('favicon', 'css', 'js');
			foreach ($page_proof as $type) {
				if (isset($page[$type])) {
					$file->import($type);
				}
			}
		?>
		<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
		<? # <!--[if lt IE 9]><script type='text/javascript' src='https://tech-mail.ru/engine/lib/external/html5shiv.js'></script><![endif]--> ?>
	</head>

	<body data-page="<?=$page['alias']?>">
		<?
			// if ($page['header']['globality'] == 'global') {
			// 	?-><header><?
			// 	include_once $site['header'];
			// 	?-></header><?
			// }
			// elseif ($page['header']['globality'] == 'local') {
			if (isset($GLOBALS['site']['path']['header'])) {
				?><header><?include_once $GLOBALS['site']['path']['header'];?></header><?
			}
			// }
		?>
		<main id="container">
			<? include_once $GLOBALS['site']['path']['index'];?>
		</main>
		<?
			// if ($page['footer']['globality'] == 'global') {
			// 	?-><footer><?
			// 	include_once $site['footer'];
			// 	?-></footer><?
			// }
			// elseif($page['footer']['globality'] == 'local') {
			if (isset($GLOBALS['site']['path']['footer'])) {
				?><footer><?include_once $GLOBALS['site']['path']['footer'];?></footer><?
			}
			// }
		?>

		<? if (!empty($page['system-message'])) { ?>
			<div class="system-message"></div>
		<? } ?>
		<? /* if (!empty($page['cmd'])) { */ ?>
			<aside id="cmd">
				<div id="<?=$ajax['id']['cmd']['answer']?>"></div>
				<div id="cmd-line">
					<div class="ajax float-left">»</div>
					<input autofocus id="<?=$ajax['id']['cmd']['input']?>">
					<div class="float-right">&times;</div>
				</div>
			</aside>
		<? /* } */ ?>
		<? if (!empty($page['system-taskbar'])) { /* для того, чтобы панель быва всегда сверху я поместил её в конец*/ ?>
			<div id="taskbar" class="auth-service">
				<nav><? /*foreach($page['nav'] as list($href, $title, $inner)) { ?><a href="<?=$href?>" class="<?=$href?>" title="<?=$title?>"><?=$inner?></a><? }*/ ?></nav>
				<div id="user-new-messages-count" class="omen user-data fa fa-envelope-o">$new_msgs</div>
				<div id="user-new-messages" class="sweetok">
					<img src="<?=$base['href'].$fold['images'].'loading/mail.jpg'?>">
				</div>
				<div class="date">$date</div>
			</div>
		<? } ?>
	</body>
	
</html>