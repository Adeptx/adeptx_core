<?
	# Здесь будем выводить директивы построчно, с разьяснениями и возможностью манипулировать при помощи удобных html тегов, в последcтвии компоновать полученный ajax-ом файл воедино, проверять корректность и сохранять
	$htaccess = file('sitemap.xml', FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
	foreach ($htaccess as $directive) {
		?><tr><td class="name"><?=$name?></td><td class="value"><input value="<?=htmlspecialchars($directive);?>"></td></tr><?
	}
?>
<tr><td class="add" colspan=2>Добавить новое указание</td></tr>