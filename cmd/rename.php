<?
	# Пытается переименовать файл или директорию $oldname в $newname, переместив в конечную директорию, если необходимо. Если $newname существует, то он будет перезаписан.
	# $oldname = $atr[1];
	# $newname = $arg[2];
	# хотелось бы увидеть также функционал мнодественного переименования, сразу массивом
	if (!rename($atr[1], $arg[2])) {
		$return .= "Не выходит переименовать файл (некорректное иля или не хватает прав?)\n";
	} else {
		$return .= "Файл успешно переименован\n";
	}
	return $return;