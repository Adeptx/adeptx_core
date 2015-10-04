<?
	// $handler['ls'] = [
	// 	 'name'			=> 'ls'
	// 	,'version'		=> '0.2'
	// 	,'summary'		=> 'list directory contents'
	// 	,'syntax'		=> 'ls [OPTIONS] [FILES]'
	// 	,'description'	=> 'there no manual for this script yet...'
	// 	,'author'		=> 'Written by Evgeny Grinec aka x-positive @ Adeptx, Inc.'
	// 	,'callback'		=> 'E-mail: e.grinec@gmail.com'
	// 	,'copyright'	=> 'Copyright © 2015 Adeptx, Inc. License GPLv3+: GNU GPL version 3 or later <http://gnu.org/licenses/gpl.html>. This is free software: you are free to change and redistribute it. There is NO WARRANTY, to the extent permitted by law.'
	// 	,'run'			=> function($arguments) use ($handler) {
	// 	include_once 'handler/output.php';

	/**
	* Выводит перечень директорий и файлов которые находятся по указанному адресу в алфавитном порядке
	* @param string $source - директория, содержимое которой необходимо вывести
	* @return string $return - список файлов и папок, каждый с новой строки
	*/

	$source = $argv[1];
	if (empty($source)) $source = './';
	$source = str_replace('\\', '/',  $source);
	if (substr($source, -1) != '/') {
		$source .= '/';
	}

	if (!file_exists($source)) {
		// return "<strong style=\"color:red\">Указанного пути не существует!</strong>";
		throw new Exception("<strong style=\"color:red\">Указанного пути не существует!</strong>", 1648);
	}
	if (!is_dir($source)) {
		throw new Exception("<strong style=\"color:orange\">Путь является файлом, а не директорией; вывод вложенных файлов и директорий неприменим.</strong>", 1649);
	}

	if ($source == './') {
		$return = "Содержимое текущей директории:\n\n";
	}
	else {
		$return = "Содержимое директории \"$source\":\n\n";
	}

	foreach (glob("$source*", GLOB_MARK | GLOB_NOESCAPE) as $file_name) {
		$file_name = str_replace('\\', '/',  $file_name);
		$return .= $file_name . "\n";
	}
	return $return;