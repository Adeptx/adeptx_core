<?
	# Здесь будем выводить директивы построчно, с разьяснениями и возможностью манипулировать при помощи удобных html тегов, в последcтвии компоновать полученный ajax-ом файл воедино, проверять корректность и сохранять
	$htaccess = file('robots.txt', FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
	foreach ($htaccess as $directive) {
		$name = '';
		if (preg_match('!^(\s)*#!', $directive)) {
			continue;
		}
		elseif (preg_match('!^(\s)*User-agent:(\s)!', $directive)) {
			$name = 'Каких поисковых систем касается следующий блок правил';
		}
		elseif (preg_match('!^(\s)*Allow:(\s)!', $directive)) {
			$name = 'Разрешить индексировать указанные директории';
		}
		elseif (preg_match('!^(\s)*Disallow:(\s)!', $directive)) {
			$name = 'Запретить индексировать указанные директории';
		}
		elseif (preg_match('!^(\s)*Host:(\s)!', $directive)) {	// Полезно для перенаправления робота с www.site.ru на site.ru
			$name = 'Зеркало сайта';
		}
		elseif (preg_match('!^(\s)*Sitemap:(\s)!', $directive)) {	// http://mysite.ru/sitemap.xml, выдавать в формате .xml, формируется через страницу /sitemap
			$name = 'Карта сайта';
		}
		?><tr><td class="name"><?=$name?></td><td class="value"><input value="<?=htmlspecialchars($directive);?>"></td></tr><?
	}
?>
<tr><td class="add" colspan=2>Добавить новое указание</td></tr>