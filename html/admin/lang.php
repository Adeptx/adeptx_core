<?
	# Принцип работы этого модуля примерно таков:
	# Все изменения сохраняются в js переменную $dic
	# Потом отправляются на сервен в формате JSON
	# Где мы представляем их в красивом виде и сохраняем
	# Js должен также обрабатывать ключи в удобочитаемом виде
	# Не "-title" а что-то вроде "Наименование индексной страницы при прямом обращении к сайту (хлебные крошки, заголовок вкладок и т.п.)"

	# alias устанавливается для каждого проекта свой лучше всего конечно через <select> выбирать, но каждый проект должен иметь доступ только к своим настройкам, так что при установке можно выбирать на редактирование какого сайта настроена админка
	# кроме того, это же модуль, а значит имеет свой файл настроек, куда можно вписать...
	$site['alias'] = 'chairschairs'; # $provide_for или что-то в этом духе
	$json->fileToGlobal($fold['languages'] . $_SESSION['lang'] . '/' . $site['alias'] . '/' . $site['alias'] . '.json');
	// echo $json->pretty($dic);

	function put_opt($opt, $val) {
		if (is_array($val)) {
			// echo key($val);
			// echo '<tr><td>'.key($val).'</td><td></td></tr>';
			foreach ($val as $opt=>$val2) put_opt($opt, $val2);
		}
		else {
		?>
			<tr><td class="lang-key"><?=$opt?>:</td><td class="lang-value"><input value="<?=$val?>"></td></tr>
		<?
		}
	}

	foreach($dic[$site['alias']] as $phrase=>$translate) {
		put_opt($phrase, $translate);
	}
?>
<tr><td class="lang-key"><input value="Новый ключ"></td><td class="lang-value"><input value="Новое значение"></td></tr>