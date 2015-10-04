<? /*
	HOW IT MUST BE:

	$conf_file = 'config.php';
	# OR
	# $site['settings'];
	# OR
	# $fold['configurations'] . $site['alias'] . $site['extensions'];

	$conf_string = file_get_contents($conf_file);
	$old_conf = json_decode($conf_string);
	
	# ...
	# some configurations manipulation (change $old_conf)
	# ...

	$pretty_new_conf = json_encode($new_conf, JSON_PRETTY_PRINT);

	$f = fopen($conf_file, 'w');
	fwrite($f, $pretty_new_conf);
	fclose($f);
*/ ?>












<?	# this file open with first start of mover
	# show ALL configs and user can set it
	# then from index.php clear link to this file (installed), user can run it from admin.php

	/* 	function display_conf($conf, $desc='', $opt='') {
		if(is_array($conf)){
			echo key($conf).'<br>';
			foreach($conf as $desc => $opt)
				display_conf($opt, $desc, $opt);
		}
		else
			echo "$desc:<br><input value='$opt'><br>";
	}

	display_conf($conf);
	*/

	function put_opt($opt, $val, $desc='') {
		echo "<tr><td>$opt:</td><td><input value='$val'></td><td>$desc</td></tr>";
	}
?>

<script>
	// $('').onchange(); // при изменении формы перезаписать файл конфигураций, предварительно создав резервную копию (версия для отката всегда остается нетронутой)
</script>

<article>
	<h1>
		Конфигурация сайта
	</h1>
	
	<section id="add_post" class="txt">
		<h2>Add new post:</h2>
		<table>
			<tr><td>Ссылка на новую статью:</td><td><input id="new_post_href" value='dev/all/new_name'></td><td>Полная ссылка будет выглядеть так: http://grinec.tk/page/<b>$your_input</b>.php</td></tr>
			<tr><td>Текст ссылки, ссылающейся на статью:</td><td><input id="new_post_text" value='e.g.: Шок! CSS не работает в Firefox!'></td><td>Это может быть заголовок статьи, его вариация или любой зазывающий к переходу текст</td></tr>
			<tr><td>Исходный текст статьи:</td><td><textarea id="new_post_code"></textarea></td><td>Весь исходный код статьи, сам текст статьи + html теги оформления</td></tr>
			<tr><td>Дата написания:</td><td><input id="new_post_date" onclick="this.value = $('header .date .dd').text() + ' ' + $('header .date .DD').text() + ' ' + $('header .date .MM').text() + ' ' + $('header .date .YY').text() + ' ' + $('header .date .hh').text() + ':' + $('header .date .mm').text() + ':' + $('header .date .ss').text();"></td><td>Дата написания стать автором или оставить текующую дату и время</td></tr>
			<tr><td>Ссылка на источник:</td><td><input id="new_post_source"></td><td>Ссылка на источник информации или оригинальную статью</td></tr>
			<tr><td><input id="publish" value="Опубликовать" class="ajax" type="button"> или </td><td><input id="draft" value="Сохранить черновик" class="ajax"  type="button"></td><td></td></tr>
		</table>
	</section>

	<section class="txt">
		<h2>Required php.ini configurations:</h2>
		<table>
			<?
				foreach($need as $opt)
					put_opt($opt, ini_get($opt));

				put_opt('session.auto_start', ini_get('session.auto_start'), '# each request will try to call session_start() if false');
				put_opt('display_errors', ini_get('display_errors'), '# each request will try to call error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED) if false');
			?>
		</table>
	</section>

	<section class="txt">
		<h2>MySQL configurations:</h2>
		<table>
			<?
				foreach($mysql as $opt=>$val)
					put_opt($opt, $val);
			?>
		</table>
	</section>

	<section class="txt">
		<h2>Site configurations:</h2>
		<table>
			<?
				put_opt('domain', $site['domain']);
				put_opt('base', $site['base']);
				put_opt('site path', $site['path']);
				put_opt('first run', $site['first_run']);
			?>
		</table>
	</section>

	<section class="txt">
		<h2>Admin:</h2>
		<table>
			<?
				foreach($admin as $opt=>$val)
					put_opt($opt, $val);
			?>
		</table>
		
		<h2>Your options:</h2>
		<table>
			<?
				put_opt('Your language', $_SESSION['lang']);
				put_opt('Timezone', $_SESSION['timezone']);
			?>
		</table>
	</section>

	<section class="txt">
		<h2>Current page configurations:</h2>
		<table>
			<?
				put_opt('URL of this page', $page['url']);
			?>
		</table>
	</section>

	<section class="txt">
		<h2>Default Page configurations:</h2>
		<table>
			<?
				put_opt('lang', $page['lang']);
				put_opt('charset', $page['charset']);
				put_opt('title', $page['title']);
				put_opt('base href', $page['base']['href']);
				put_opt('base target', $page['base']['target']);
				put_opt('favicon', $page['favicon']);
	#			put_opt('og:image', $page['og:image']);
				put_opt('header', 'header.php');
				put_opt('footer', 'footer.php');
				put_opt('$dir', 'css/');
				put_opt('css', 'array');
				put_opt('js', 'array');
			?>
		</table>
	</section>

	<section class="txt">
		<h2>robots.txt</h2>
		<table>
			<tr><td>Содержимое файла robots.txt:</td><td><textarea><?include'robots.txt'?></textarea></td><td>Здесь можно удобненько настроить все желаемые параметры отображения сайта для поисковых систем, настроить доступность разным поисковым агентам и прочее</td></tr>
		</table>
	</section>

	<section class="txt">
		<h2>.htaccess</h2>
		<table>
			<tr><td>Содержимое файла .htaccess:</td><td><textarea><?include'.htaccess'?></textarea></td><td>Здесь в удобном формате вы можете выставить все конфигурации, которые делаются для сайта через файл .htaccess (резервная копия созранится на сайте под именем .htaccess.backup и в случае падения сайта из-за неправильной настройки вы без проблем сможете все вернуть вручную зайда в админ. панель сайта). В планах создать удобненький редактор этого файла, который не даст ошибиться и валидатор созданного файла, который проверит, что вы не ошиблись, изменив его вручную.</td></tr>
		</table>
	</section>
</article>