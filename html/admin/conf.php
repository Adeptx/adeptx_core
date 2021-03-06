<?
	# Два типа редактора
	# JSON, в котором легко и быстро настраивается сайт, но так же просто можно что-то поломать
	# Не указанные опции берутся из дефолтных настроек
	# Лишние никак не влияют на работу сайта
	# А вот поломанные могут поламать сайт
	# Хоть валидность JSON-а проверяется
	# В другом редакторе можно выбирать только из дозволенных значений переменных
	# Потому сломать что-либо некак
?>

<!--tr><td></td><td>
<textarea id="site-options"><?=$json->fileAsString('conf/default/settings.json')?></textarea></td></tr-->

<?
/*
	# Здесь будем выводить директивы построчно, с разьяснениями и возможностью манипулировать при помощи удобных html тегов, в последcтвии компоновать полученный ajax-ом файл воедино, проверять корректность и сохранять
	$htaccess = file('conf/default/settings.json', FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
	foreach ($htaccess as $directive) {
		$name = '';
		if (preg_match('!^(\s)*(#|//)!', $directive)) {
			continue;
		}
		?><tr><td class="name"><?=$name?></td><td class="value"><input value="<?=htmlspecialchars($directive);?>"></td></tr><?
	}
*/
?>



<?
	# Принцип работы этого модуля схож с модулем admin/page
	# в конце формируется conf/settings.json
	# Я предлагаю такую схему.
	# Чтоб не пергружать процессор, все изменени подхватываются на лету и отправляются ajax-ом на серве, где не перезаписывается файл каждый раз, а делается запись в ДБ о произошедших изменениях
	# Когда пользователь нажимат кнопку "сохранить" предыдущий файл пользовательских конфигурацтий и все изменения из БД группируются и перезаписывают этот файл
	# Это решает проблемы с траффиком, несохраненными изменениями, перезаписью большого количества информации
	# Но решает проблему резкого отключения интернета
	# Когда пользователь открывает эту страницу и есть непринятые изменения, его уведомляет об этом, непринятые изменения предлагается сохранить или забыть, в конфигурациях показываются последняя версия настроек, но соответствующие поля помечены и отмечается также их реальное текущее состояние.
	# Во избежание проблем с интернет-подключением есть смысл записывать изменения в web-storage браузера при невозможности ajax-отправки и отправлять при первой возможности.
	# Что касается крупных сайтов с большим количеством пользователей, я думаю, они хранят все пользовательские настройки в базах данных а не в виде JSON)
	# Поэтому мы тоже будем хранить все настроки в БД, но паралельно поддерживать интерфейс JSON файлов. Это две паралельные ветки.
	# Каждый выбравший эту систему может выбрать в каком формате он хочет хранить настройки и как их редактировать, через какой редактор, в режиме реального времени или сохранения траффика/ЦП.
	# На данном же этапе все довольно премитивно, без всяких предохранителей
	# Отправляем тупо дамп, формируем файл, переписываем и плевать на нагрузку, главное конечная цель

	# данные для вывода подгружать из файла конфигураций для соответствующей страницы
	# с учетом опции "дефолтные" или "пользовательские"
	function put_opt($opt, $val, $var) {
		if (is_bool($val)) {
			$val = (string)$val;
		}
		if (is_array($val)) {
			// echo key($opt);
			// echo '<tr><td>'.key($val).'</td><td></td></tr>';
			// $opt.'['.$opt.']'
			// $opt
			foreach ($val as $opt2=>$val2) {
				put_opt($opt.'["'.$opt2.'"]', $val2, $var);
			}
		}
		elseif (is_string($val)) {
		?>
			<tr><td class="conf-key"><?='$GLOBAL["'.$var.'"]["'.preg_replace('!^(\w*)!','$1"]',$opt)?>:</td><td class="conf-value"><input value="<?=htmlspecialchars($val)?>"></td></tr>
		<?
		}
	}

	foreach($global as $var) {
		foreach($$var as $opt=>$val) {
			put_opt($opt, $val, $var);
		}
	}
?>