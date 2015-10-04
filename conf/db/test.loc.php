<?php

# $database['driver'] = 'mysql';		# mysql/mssql/sybase.
# $database['host'] = 'localhost';
# $database['port'] = '3306';
# $database['user'] = 'root';
# $database['pass'] = '';
$database['name'] = 'adeptx_driver';	# $database['name'] = 'adeptx';
# $database['prefix'] = 'adeptx_';
# $database['socket'] = ini_get("mysqli.default_socket");













/* gcorp.esy.es */

/*
$database['host'] = 'mysql.hostinger.com.ua';
$database['user'] = 'u323912911_gcorp';
$database['pass'] = 'USAmustdie2050';
$database['name'] = 'u323912911_gcorp';
$database['prefix'] = 'adeptx_';
*/

/* chat.fenix.dp.ua */

/*
$database['host'] = 'ticher.mysql.ukraine.com.ua';
$database['user'] = 'ticher_chat';
$database['pass'] = 'vwl345nl';
$database['name'] = 'ticher_chat';
$database['prefix'] = 'adeptx_';
*/

/* localhost */



// в index.php я прописал:
// require_once 'conf/'.$_SERVER['HTTP_HOST'].'.conf.php';
// так что этот файл вообще больше не грузится

// if ( $_SERVER['DOCUMENT_ROOT'] == 'G:/server/domains/adeptx') {
// 	$database['host'] = 'adeptx';
// 	$database['user'] = 'root';
// 	$database['pass'] = '';
// 	$database['name'] = 'adeptx';
// 	$database['prefix'] = 'adeptx_';
// }