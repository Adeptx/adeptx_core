<?
	$page['stickers'] = array(
		 'ps'
		,'fm'
		,'diff'
		,'rss'
		,'paletton'
		,'cutaway'
		,'setup'
		,'tool'
		,'order'
		,'last-works'
		,'sitemap'
		,'cc'
		,'bookmarks'
		,'kurs'
		,'amu'
		,'am'
		,'ps'
		,'jquery-latest'
		,'android'
		,'shop'
		,'lazy'
		,'ordinary'
		,'indigo'
		,'god'
		,'room'
		,'vk'
		,'add-shortcut'
	);

	# replace all 80x80 images to 64x64
	$page['stickers'] = array(
		 array('ps', 'ps', 'Photoshop Online')
#		,array('/', 'home', 'Home')
		,array('fm', 'fm', 'File-manager')
#		,array('fm', 'fm', 'Файловый менеджер')
		,array('diff', 'diff', 'File Diff')
		,array('rss', 'rss', 'RSS')
		,array('paletton', 'paletton', 'Paletton')
		,array('cutaway', 'cutaway', 'Contacts/Pay')
		,array('admin/setup', 'setup', 'Settings')
		,array('tool', 'tool', 'Инструменты')
		,array('order', 'order', $lang['Orders'])
		,array('last-works', 'work', $lang['Our Works'])
#		,array($page['link']['order'][0], 'order', $lang['Our Works'])
		,array('sitemap', 'map', 'Карта сайта')
		,array('cc', 'cc', 'Сurl vs cookie')
		,array('bookmarks', 'link', $lang['Bookmarks'])
		,array($page['link']['kurs'][0], 'kurs', $page['link']['kurs'][1])
		,array('amu', 'amu', 'Ajax Multi Uploader')
		,array('am', 'am', 'Алгоритм-менеджер')
#		,array($page['link']['ps'][0], 'ps', $page['link']['ps'][2])
#		,array('ps', 'ps', 'Онлайн-фотошоп')
		,array('http://code.jquery.com/jquery.min.js', 'jquery', 'jQuery latest')
		,array('http://developer.android.com/sdk/installing/studio.html#Updatin', 'android', 'Android Studio')
		,array('shop', 'shop', 'Adeptx E-Shop')
		,array('adeptx/lazy', 'lazy', 'Adeptx Lazy')
#		,array($page['link']['adeptx-lazy'][0], 'lazy', $page['link']['adeptx-lazy'][1])
		,array($page['link']['adeptx-ordinary'][0], 'ordinary', $page['link']['adeptx-ordinary'][1])
		,array($page['link']['adeptx-indigo'][0], 'indigo', $page['link']['adeptx-indigo'][1])
		,array($page['link']['adeptx-god'][0], 'god', $page['link']['adeptx-god'][1])
		,array($page['link']['room'][0], 'room', $page['link']['room'][1])
#		,array('http://finance.liga.net/rates/nal/dyn/USD.htm', 'order', 'Лiга.Финансiв')
		,array('vk', 'vk', 'ВКонтакте')
	);

	if ($_SESSION['permissions']['home']['add_link']) {
		$stick[] = array('', 'add', 'Добавить ссылку');
	}