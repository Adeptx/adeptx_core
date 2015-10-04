<?
	# Принцип работы этого модуля схож с модулем admin/lang
	# после чего rout/xxx.php формируется из JSON-файла (единожды после изменений)

	# данные для вывода подгружать из файла конфигураций для соответствующей страницы
	# с учетом опции "дефолтные" или "пользовательские"
	function put_opt($opt, $val) {
		if (is_bool($val)) {
			$val = (string)$val;
		}
		if (is_array($val)) {
			// echo key($opt);
			// echo '<tr><td>'.key($val).'</td><td></td></tr>';
			// $opt.'['.$opt.']'
			// $opt
			foreach ($val as $opt2=>$val2) {
				put_opt($opt.'["'.$opt2.'"]', $val2);
			}
		}
		else {
		?>
			<tr><td class="lang-key"><?='$page["'.preg_replace('!^(\w*)!','$1"]',$opt)?>:</td><td class="lang-value"><input value="<?=$val?>"></td></tr>
		<?
		}
	}

	foreach($page as $opt=>$val) {
		put_opt($opt, $val);
	}
?>