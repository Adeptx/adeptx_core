<?

switch($page['url']) {
	case 'products':
	case 'categories':
		$page['title'] = $lang->give('title');
		$page['alias'] = $page['url'];
		$page['path'] = $fold['templates'] . $site['alias'] . '/' . $page['alias'] . $site['extensions'];
		$page['heading'] = $page['url'].'-title';
		$page['option']['great_seven'] = true;
		break;
	case '':
		$page['title'] = $lang->give('title');
		$page['alias'] = 'products';
		$page['path'] = $fold['templates'] . $site['alias'] . '/' . $page['alias'] . $site['extensions'];
		$page['option']['great_seven'] = true;
		break;
	default:
		header($header['404']);
		$page['path'] = $fold['templates'] . $fold['404']. '404' . $site['extensions'];
		# $page['url'] not changed, you can use it in the page, like: "page $page['url'] not found"
		# write to log
	}