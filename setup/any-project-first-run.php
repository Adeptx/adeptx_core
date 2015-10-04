<?
	// $project['unique_id'] = 'adeptx-driver';
	// $project['version'] = '2';
	# здесь при первом запуске проекта следует указать уникальное расположение файла конфигураций для конкретного проекта. настройки там и эта строка -- вот все необходимые настройки при установке, при том эта строка может генерироваться автоматически, например по md5_file() этого же файла, что гарантирует уникальность имени, а вот настройки внутри должен указать пользователь

	# Проверяем, если система запускается на этом домене впервые, то производим начальную установку
	# Note: если система будет перенесана в другую папку, нужно будет вручную удалить указанный файлик
	# it's say us, that we have firt run for this project (on this domain, but not look folder)


	try {
		$file = [
			 'router'			=> $fold['router'] . $site['alias'] . $site['extensions']
			,'configurations'	=> $fold['configurations'] . $site['alias'] . $site['extensions']
		];
		create_project_files_if_no_exists([
			 'dirs'	=>	[
				 $fold['configurations']
				,$fold['log']
				,$fold['templates'] . $site['alias']
			]
			,'files'	=>	[
				 $file['router']
				,$file['configurations']
#				,$site['path']['header']
				,$fold['templates'] . 'index' . $site['extensions']
#				,$site['path']['footer']
			]
		]);

		$page['lang_pack'] = $fold['languages'] . $_SESSION['lang'] . '/' . $site['alias'] . '.json';
		if (!is_readable($page['lang_pack'])) {
			$f = fopen($page['lang_pack'], 'x');
			fwrite($f, '{
	"'.$site['alias'].'": {
		
	}
	}');
			fclose($f);
		}
		# теперь в этом месте необходдимые конфигурации записываются в файлы, выполняются инструкции из файла установки
		# if need setup, install package
		# $page['path'] = $fold['setup'] . $site['alias'] . $site['extensions'];
		# затем нужно удалить установочную папку и создать файл $fold['logs'].$_SERVER['HTTP_HOST'].'.successfully.installed')
		# затем вывести приветсвенное сообщение, с уведомлением о том, какие файлы были созданы и что следует в них теперь написать.
		// $error->report('Отсутствует файл конфигураций, автоматически будет создан файл: <strong>' . $fold['configurations'] . $site['alias'] . $site['extensions'] . '</strong>', __LINE__ - 2);
	}
	catch(Exception $e) {
		$error->report($e->getMessage(), __LINE__, 'Notice', __FILE__);
	}

	function create_project_files_if_no_exists($inodes) {
		if (isset($inodes['dirs'])) {
			foreach ($inodes['dirs'] as $dir) {
				if (!is_dir($dir)) {
					if (!mkdir($dir, 0777, 1)) {
						throw new Exception("Не удалось создать папку \"$dir\", установка прервана.");
					}
				}
#				throw new Exception("Папка \"$dir\" уже существует.");
			}
		}
		if (isset($inodes['files'])) {
			foreach ($inodes['files'] as $file) {
				if (!file_exists($file)) {
					if (!fclose(fopen($file, 'x'))) {
						throw new Exception("Не удалось создать файл \"$file\", установка прервана.");
					}
				}
#				throw new Exception("Файл \"$file\" уже существует.");
			}
		}
		
	}