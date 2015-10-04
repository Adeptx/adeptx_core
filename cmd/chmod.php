<?
	# если указано в формате xx-x--x-- перевести в число
	# chmod $path $mode
	$path = $atr[1];
	$mode = octdec($arg[2]);
	$status = chmod($path, $mode);
	if ($status) {
		$return .= "Успешно\n";
	} else {
		$return .= "Неудача\n";
	}
	return $return;