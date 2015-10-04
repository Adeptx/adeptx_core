<?
# Создает в произвольной директории архив из заданного файла или директории, после создания архив отправляет на скачивание
# В архив не будут добавлены файлы начинающиеся с точки.
# Убедитесь, что имя создаваемого архива не содержит недопустимых символов, что все необходимые права доступа имеются и что директория куда идёт запись сущесвтует. Также могут возникнуть проблемы при попытке заархивировать папку содержащую архив и, возможно даже, файлы с кириллическими именами.

set_time_limit(0);

$source			= $arg[1];	# Файл или директория, которую необходимо заархивировать, по умолчанию текущая директория
$destination	= $arg[2];	# Директория, в которую создается архив
if (!$source) {
	$source = './';
}
if (!$destination) {
	$destination = './';
}

/*** Проверка прав на запись в указанную директорию ***/
$fname = $destination.date('Y-m-d_H-i-s').'.tmp';
$f = fopen($fname, 'w+');
if (!$f) {
	$return .= "<strong style='color:red'>RU: Ошибка прав доступа на запись в указанную директорию. EN: Permission to write error!</strong>\n";
}
else {
	$return .= "<strong style='color:lightgreen'>RU: Проверка прав доступа...ОК. EN: Permission to write success</strong>\n";
	fclose($f);
	unlink($fname);
}
/*** /проверка прав на запись в указанную директорию ***/

$archive_name = $source;
if (preg_match('!\./!', $archive_name)) {
	$archive_name = basename(realpath($source));
}
$archiveFile = $destination . str_replace('/', '_', $archive_name) . '_' . date('Y-m-d_H-i-s') . ".zip";

if(file_exists($archiveFile)) {
	unlink($archiveFile);
	$return .= '<strong style="color:orange">При создании был обнаружен и удалён архив с тем же именем</strong><br>';
}

if(Zip($source, $archiveFile)) {
	if (file_exists($archiveFile)) {
		$return .= '<strong style="color:lightgreen">$msg_zip_ok</strong><br>'; // header("Location: $archiveFile");
	} else {
		$return .= '<strong style="color:red">При создании архива не возникло ошибки, но файл созданного архива не обнаружен</strong><br>';
	}
} else {
	$return .= "Архив не создан, убедитесь что указанная директория существует и вы имеете право на запись в неё.\n";
}

function Zip($source, $destination){
	global $return;

	if (extension_loaded('zip') === true) {
		if (file_exists($source) === true) {
			$zip = new ZipArchive();

			if ($zip->open($destination, ZIPARCHIVE::CREATE) === true) {
				$source = $source;

				if (is_dir($source) === true) {					
					$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
					foreach ($files as $file) {
						if (is_dir($file)) {
							$zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
							$return .= str_replace($source . '/', '', $file . '/') . "\n";
						}
						elseif (is_file($file) && is_readable($file) ) {
							$zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
							$return .= str_replace($source . '/', '', $file) . "\n";
						}
					}
				}
				elseif (is_file($source) && is_readable($file) ) {
					$zip->addFromString(basename($source), file_get_contents($source));
				}
				return $zip->close();
			} else {
				$return .= "<strong style='color:red'>Не удалось создать временный файл</strong>\n";
			}
		} else {
			$return .= "<strong style='color:orange'>В системе отсутствует указанный путь $source</strong>\n";
		}
	} else {
		$return .= "<strong style='color:red'>Ошибка: в системе не присутствует необходимого Zip-компонента для PHP</strong>\n";
	}
	$return .= "<strong style='color:red'>\$err_zip_not_create</strong>\n";
}

return $return;