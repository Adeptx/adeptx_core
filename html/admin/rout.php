<?
	# Здесь будем выводить директивы построчно, с разьяснениями и возможностью манипулировать при помощи удобных html тегов, в последcтвии компоновать полученный ajax-ом файл воедино, проверять корректность и сохранять
	$site['alias'] = 'chairschairs';
	$rout = file($fold['router'].$site['alias'].$site['extensions'], FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
	foreach ($rout as $directive) {
		$name = '';
		if (!preg_match('!^(\s)*(case|\$page|break;)!', $directive)) {
			if (preg_match('!^(\s)*default:!', $directive)) {
				break;
			}
			continue;
		}
		?><tr><td class="name"><?=$name?></td><td class="value"><input value="<?=htmlspecialchars($directive);?>"></td></tr><?
	}
?>