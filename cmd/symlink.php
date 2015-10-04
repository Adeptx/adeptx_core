<?
	return symlink($arg[1], $arg[2]);

	function symlink($file_pathname, $symlink_pathname) {
		if (symlink($file_pathname, $symlink_pathname)) {
			return 'Symlink успешно создан';
		} else {
			return 'Не удалось создать symlink';
		}
	}