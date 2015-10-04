<?
	$_SESSION['lang'] = 'ru';
	$page['favicon'] = 'reid.png';
	$page['css'] = 'reid/style.css';
	$page['header']['globality'] = 'local';

	$site['path']['header'] = $fold['templates'] . $site['alias'] . '/' . 'header' . $site['extensions'];
	$site['path']['index'] = $fold['templates'] . $site['alias'] . '/index' . $site['extensions'];
	$site['path']['footer'] = $fold['templates'] . $site['alias'] . '/' . $page['dir'] . 'footer' . $site['extensions'];