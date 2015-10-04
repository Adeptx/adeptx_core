<?
$time = time();

$table = 'adeptx_required_configuration';
if (!$db->table_exist($table)) {
	$vars = array(
		array("id","INT","11"),
		array("name","VARCHAR","255"),
		array("value","VARCHAR","255"),
		array("project","VARCHAR","255"),
		array("rewriter","INT","11"),
		array("datetime","BIGINT","20")
	);
	$db->create_table($table, $vars);
}

$table = 'adeptx_conf';
if (!$db->table_exist($table)) {
	$vars = array(
		array("id","INT","11"),
		array("name","VARCHAR","255"),
		array("value","VARCHAR","255"),
		array("project","VARCHAR","255"),
		array("rewriter","INT","11"),
		array("datetime","BIGINT","20")
	);
	$db->create_table($table, $vars);
}

$dbResult = $db->call("SELECT * FROM `adeptx_required_configuration`");
if ($dbResult) $required_configurations = $db->fetch_array($dbResult);
if (empty($required_configurations)) {
	$db->call("INSERT INTO `adeptx_required_configuration` (name, value, project, rewriter, datetime) VALUES
		('short_open_tag','On','adeptx',1,'$time'),
		('session.auto_start','On','adeptx',1,'$time'),
		('max_execution_time','30','adeptx',1,'$time'),
		('max_input_time','60','adeptx',1,'$time'),
		('memory_limit','128M','adeptx',1,'$time')
	");
}

$dbResult = $db->call("SELECT * FROM `adeptx_conf`");
if ($dbResult) $configurations = $db->fetch_array($dbResult);
if (empty($configurations)) {
	$db->call("INSERT INTO `adeptx_conf` (name, value, project, rewriter, datetime) VALUES
		('site_alias','adeptx','adeptx',1,'$time'),
		('site_domain','adeptx.tk','adeptx',1,'$time'),
		('site_extensions','.php','adeptx',1,'$time'),
		('site_upload_max_filesize','111','adeptx',1,'$time'),
		('site_run','0','adeptx',1,'$time'),

		('fold_includes','inc/','adeptx',1,'$time'),
		('fold_templates','html/','adeptx',1,'$time'),
		('fold_languages','lang/','adeptx',1,'$time'),
		('fold_scripts','js/','adeptx',1,'$time'),
		('fold_javascripts','js/','adeptx',1,'$time'),
		('fold_js','js/','adeptx',1,'$time'),
		('fold_styles','css/','adeptx',1,'$time'),
		('fold_css','css/','adeptx',1,'$time'),
		('fold_images','img/','adeptx',1,'$time'),
		('fold_fonts','font/','adeptx',1,'$time'),
		('fold_users','user/','adeptx',1,'$time'),
		('fold_cmd','cmd/','adeptx',1,'$time'),
		('fold_class','class/','adeptx',1,'$time'),
		('fold_favicon','favicon/','adeptx',1,'$time'),

		('site_mysql','mysql','adeptx',1,'$time'),
		('site_router','router','adeptx',1,'$time'),
		('site_socket','socket','adeptx',1,'$time'),
		('site_ajax','ajax','adeptx',1,'$time'),

		('site_header','header','adeptx',1,'$time'),
		('site_index','index','adeptx',1,'$time'),
		('site_footer','footer','adeptx',1,'$time'),

		('site_cmd_log','history','adeptx',1,'$time'),

		('site_403','403','adeptx',1,'$time'),
		('site_404','404','adeptx',1,'$time'),

		('admin_email','e.grinec@gmail.com','adeptx',1,'$time'),
		('admin_name','Евгений','adeptx',1,'$time'),
		('admin_surname','Гринец','adeptx',1,'$time'),

		('site_timezone','Europe/Moscow','adeptx',1,'$time'),

		('site_charset','utf-8','adeptx',1,'$time'),
		('site_title','Adeptx Tool Kit','adeptx',1,'$time'),


		('site_charset','utf-8','chairschairs',1,'$time'),

		('site_email','chchairs@mail.ru','chairschairs',1,'$time'),
		('site_description','Магазин дизайнерских стульев и уникальных аксессуаров','chairschairs',1,'$time'),
		('site_address','Россия, Спб, адрес','chairschairs',1,'$time'),
		('site_copyright','&copy; 2014 Chairs-Chairs','chairschairs',1,'$time'),
		('site_name','Chairs-Chairs','chairschairs',1,'$time'),

		('module-auth','On','chairschairs',1,'$time'),
		('module-cart','On','chairschairs',1,'$time'),
		('module-filters','On','chairschairs',1,'$time'),
		('module-search','On','chairschairs',1,'$time'),
		('module-social','On','chairschairs',1,'$time'),
		('VKgroupID','73944214','chairschairs',1,'$time'),
		('module-discounts','On','chairschairs',1,'$time'),
		('module-reviews','On','chairschairs',1,'$time'),
		('module-buymore','On','chairschairs',1,'$time'),
		('module-pluses','On','chairschairs',1,'$time'),
		('module-characteristics','On','chairschairs',1,'$time'),
		('module-avatar','On','chairschairs',1,'$time'),
		('module-profitable','On','chairschairs',1,'$time'),
		('module-news','On','chairschairs',1,'$time')
	");
}