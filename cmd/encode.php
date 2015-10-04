<?
	/**
	 *	Кодирует в заданную систему текст, содержимое указанного файла (или нескольких файлов) или массива переданных ajax-ом файлов. Результат выводит указанным способом или возвращает return-ом
	 *
	 *  - нужно научить записывать переданные файлы или содержимое файлов с переданными именами в файлы с соответствующими именами но рядом с теми (в ту же папку с другим именем) или вместо их содержимого, если так запросит пользователь
	 */

	return encode($arg);

	function encode($arg) {
		foreach ($arg as $num => $param) {
			switch ($param) {
				case '-t':
				case '--type':
					$type = strtolower($arg[$num + 1]);
					break;
				case '-s':
				case '--source-text':
					$source_text = $arg[$num + 1];
					break;
				case '-sf':
				case '--source-file':
					$source_file = $arg[$num + 1];
					break;
				case '-o':
				case '--output':
					$output_type = $arg[$num + 1];
					break;
				case '-of':
				case '--output-file':
					$output_file = $arg[$num + 1];
					break;
			}
		}

		if (isset($source_file)) {
			$source_text = file_get_contents($source);
		}

		if ($type == 'json') {
			$result = json_encode($source_text);
		}
		if ($type == 'url') {
			$result = urlencode($source_text);
		}
		if ($type == 'base64') {
			$result = base64_encode($source_text);
		}
		if ($type == 'html') {
			$result = htmlspecialchars($source_text);
		}
		if ($type == 'bson') {
			$result = bson_encode($source_text);
		}
		if ($type == 'session') {
			$result = session_encode($source_text);
		}
		if ($type == 'utf8') {
			$result = utf8_encode($source_text);
		}
		if ($type == 'xmlrpc') {
			$result = xmlrpc_encode($source_text);
		}

		foreach($_FILES['file']['name'] as $file => $t)
		{
			if($_FILES['file']['size'][$file] > $site['upload_max_filesize']*1024*1024)
				throw new Exception("Превышен максимально допустимый для загрузки размер файла ({$site['upload_max_filesize']} Mb), файл \"{$_FILES['file']['name'][$file]}\" весит " . $_FILES['file']['size'][$file]*1024*1024 . " Mb", 4781);
			if(is_uploaded_file($_FILES['file']['tmp_name'][$file])) {
				move_uploaded_file($_FILES['file']['tmp_name'][$file], $_FILES['file']['name'][$file]);
			}
		}

		if ($output_type == 'echo') echo $result;
		if ($output_type == 'var_dump') var_dump($result);
		if ($output_type == 'print_r') print_r($result);
		if ($output_file) file_put_contents($output_file, $result);
		return $result;
	}