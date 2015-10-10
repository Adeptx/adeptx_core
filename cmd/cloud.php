<?
	return cloud($argv, $argc);

	function cloud($argv, $argc) {
		global $fold, $site;

		$package_name = $argv[1];
		$package_main_file = $fold['repository'] . $package_name . $site['extensions'];

		if (empty($package_name)) {
			throw new Exception("Укажите название пакета", 3164);
		}
		if (!is_file($package_main_file)) {
			throw new Exception("Пакет \"$package_main_file\" не обнаружен в репозитории", 3165);
		}
		// if (!is_readable($package_name)) {
		// 	throw new Exception("Указанный пакет не доступен для чтения", 3166);
		// }
		echo '<div class="last-answer"></div><script>new_cloud("' . $package_name . '"); $(".last-answer").last().text("Запущен процесс #" + window.focus);</script>';
		// если доступна для чтения картинка /img/32x32/white/$package_name.png то подгружаем в миниатюру окна (poudle) эту картинку, иначе дефолтную для файлов 
	}