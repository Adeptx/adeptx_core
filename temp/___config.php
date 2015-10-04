<?php
	# don't foget that php files viewer can't download from server, but json can
	# those why all passwords must be only in php files, not json or etc

	// $database['host'] = 'localhost';
	// $database['user'] = 'root';
	// $database['pass'] = '';
	// $database['name'] = 'adeptx';
	// $database['prefix'] = 'adeptx_';

	$database['host'] = 'localhost';
	$database['user'] = 'root';
	$database['pass'] = '';
	$database['name'] = 'gcorp';
	$database['prefix'] = 'adeptx_';

	# в этом файле хранятся только настройки MySQL, это те настройки, которые, в отичие от прочих, зависят от хостинга к хостингу, от одного компа к другому, в зависимости от того, где мы редактируем проект. таким образом, если все прочие файлы могут синхронизироваться в точности между разными людьми, работающими над одним и тем же проектом, то этот файл для каждого сайта свой. и подлючаться он должен не по общему адресу, а для каждого свой адрес, чтобы в случа синхронизации не перезаписывался