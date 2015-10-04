<?
	# Здесь будем выводить директивы построчно, с разьяснениями и возможностью манипулировать при помощи удобных html тегов, в последcтвии компоновать полученный ajax-ом файл воедино, проверять корректность и сохранять

	# $.jStorage.set(key, value);

	$htaccess = file('.htaccess', FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
	foreach ($htaccess as $directive) {
		$name = '';
		if (preg_match('!^(\s)*#!', $directive)) {
			continue;
		}
		elseif (preg_match('!^(\s)*RewriteEngine(\s)*O(n|ff)!', $directive)) {
			$name = 'Включить/выключить преобразование URL';
		}
		elseif (preg_match('!^(\s)*RewriteBase(\s)*!', $directive)) {
			$name = 'Базовый URL для переадресации';
		}
		elseif (preg_match('!^(\s)*RewriteCond(\s)*!', $directive)) {
			$name = 'Условие для преобразования';
		}
		elseif (preg_match('!^(\s)*RewriteRule(\s)*!', $directive)) {
			$name = 'Правило преобразования';
		}
		elseif (preg_match('!^(\s)*<IfModule mod_php5.c>(\s)*!', $directive)) {
			$name = 'Блок переменных php.ini (если модуль доступен)';
		}
		elseif (preg_match('!^(\s)*php_value(\s)*session.auto_start(\s)*(O(n|ff)|1|0)!', $directive)) {
			$name = 'Автозапуск сессий';
		}
		elseif (preg_match('!^(\s)*php_value(\s)*session.name(\s)*\w*!', $directive)) {
			$name = 'Имя сессий';
		}
		elseif (preg_match('!^(\s)*php_value(\s)*short_open_tag(\s)*\w*!', $directive)) {
			$name = 'Короткие открывающие теги PHP';
		}
		elseif (preg_match('!^(\s)*php_value(\s)*zlib.output_compression(\s)*(O(n|ff)|1|0)!', $directive)) {
			$name = 'Сжимать трафик';
		}
		elseif (preg_match('!^(\s)*php_value(\s)*zlib.output_compression(\s)*(O(n|ff)|1|0)!', $directive)) {
			$name = 'Сжимать трафик';
		}
		elseif (preg_match('!^(\s)*php_value(\s)*zlib.output_compression_level(\s)*\d*!', $directive)) {
			$name = 'Уровень сжатия';
		}
		elseif (preg_match('!^(\s)*ExpiresDefault(\s)*!', $directive)) {
			$name = 'Срок кеширования статических файлов';
		}
		?><tr><td class="name"><?=$name?></td><td class="value"><input value="<?=htmlspecialchars($directive);?>"></td></tr><?
	}
?>