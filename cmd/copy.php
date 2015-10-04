<?
	# Копирует файл $file с именем $copyname Если $newname существует, то он будет перезаписан.
	# $file = $atr[1];
	# $copyname = $arg[2];
	if (!copy($atr[1], $arg[2])) {
		$return .= "Неудача\n";
	} else {
		$return .= "Успешно\n";
	}
	return $return;