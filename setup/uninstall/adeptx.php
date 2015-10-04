<?
/* Раскомментируйте следующий код, если хотите полностью удалить систему Adeptx

// onlinux:
// $baseDir = "./";
// exec("rm -f " .$baseDir . "/dir/*");

function uninstall($uninstall_database) {
	if (file_exists('/cache/'))
	foreach (glob('/cache/*') as $file)
	unlink($file);

	// также удалить 
	
	if ($uninstall_database) {
		$db->call("DROP DATABASE IF EXISTS `${mysql['db']}`");
	}
}