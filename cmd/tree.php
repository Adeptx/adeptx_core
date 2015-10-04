<?
	$source = str_replace('\\', '/',  $arg[1]);
	if (!$source) $source = '/';

	if (file_exists($source)) {
		if (is_dir($source)) {	
			if (!preg_match('!/$!', $source)) {
				$source .= '/';
			}
			$return .= "Дерево директорий и файлов в \"$source\":\n\n";
			$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
			foreach ($files as $file) {
				$file = str_replace('\\', '/',  $file);
				if (!preg_match('!/\.{1,2}$!', $file)) {
					$source .= '/';
					$return .= str_replace($source, '', $file);
					if (is_dir($file)) {
						$return .= '/';
					}
					$return .= "\n";
				}
			}
		}
		elseif (is_file($source)) {
			$return .= "Путь является файлом, а не директорией, построение дерева вложенных путей неприменимо.\n";
		}
	} else {
		$return .= "<strong style=\"color:red\">Указанного пути не существует!</strong>\n";
	}

	return $return;