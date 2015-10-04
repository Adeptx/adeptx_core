<?

for ($a = 0; $a < 100000; $a++){
	if( (($a >> 8) & 7 | 4) == 6) {
    	echo $a . '<br>';
	}
}

exit;


set_time_limit(0);

# здесь настраиваем все пееменные парсера, как он будет работать

$constMaxRead = 300;

# при необходимости получения информации, доступной только авторизованным пользователям, отправляем заголовки авторизованного пользователя
/* $header = preg_split('![\r\n]+!', 'Accept:text/html
Accept-Language:ru,uk;q=0.8,en-US;q=0.6,en;q=0.4
Cache-Control:max-age=0
Connection:keep-alive
Cookie:virtuemart=n2o7r88fvic4dr8v4t3alqh7l6; 2bcb939887c372b902fac972a173fcc6=iikvns9so2hp5fh2j843kdtig2; 73ba353457a9efbcf176deb336df4660=+25951+A494A+B+F591442425D455C595A+31A+D15+A53+3+A171F4D471751+3231A+25E565C4919114315+A4B+D+A+2151659451547+D4754175E44+E5C+943283752+5+0+97A6441+D4A
Host:universal-optica.ru
If-Modified-Since:Mon, 10 Mar 2014 00:03:00 GMT
Referer:http://universal-optica.ru/
User-Agent:Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.146 Safari/537.36');
*/

$goodViewedIndex = 0;
$globalStringIndex = 0;
$groupIndex = 0;
$fileNameIndex = 0;

class parser
{

	# public static $donorURL = 'http://www.holprop.ru';

	// function __construct($hz) {

	// }

	function cut() {
	}

	function parseURLs($source) {
		# паттерн вида src="(.*)" href="(.*)" url(.*) и http://www.holprop.ru/.*
		# кавычки считаются как одинарные так и двойные, без учета регистра (i), нежадный поиск (U)
		# считается и без кавычек вообще, тогда поиск заканчивается на пробеле или ) в url()
		# если понадобится поддержка нескольких доменов, можно заюзать такой код: (ru|com|co\.uk)
		# ссылки ищет как по http: так и https с и без "www."
		$links_pattern = '!(src=["\']?|href=["\']?|url\(["\']?|https?://(www\.)?holprop\.ru/)(.*)["\'\)\s]!Ui';

		preg_match_all($links_pattern, $source, $links);
		return $links[3];
	}

	function parseBGImagesLinks($source) {
		# паттерн говорит брать все вида url(.*)
		$links_pattern = '!url\(["\']?(.*)["\'\)]!U';
		preg_match_all($links_pattern, $source, $links);
		return $links[1];
	}

	function parseLinks($source) {
		# паттерн говорит брать все вида http://www.holprop.ru/.*
		$links_pattern = '!https?://(www\.)?holprop\.ru/(.*)!U';
		preg_match_all($links_pattern, $source, $links);
		return $links[1];
	}

	// caching site to our server for next parsing
	function allSiteToLocalFiles() {
		global $fold, $site;

		$donorURL = 'http://www.holprop.ru/';
		$donorAlias = 'holprop.ru';
		$cacheDir = $fold['templates'] . $site['alias'] . '/cache/' . $donorAlias . '/';
		$cacheIndex = $cacheDir . 'index.php';
		$cacheUniqueLinks = $cacheDir . 'unique_links.php';

		# Прогон осуществляем поэтапно, по уровням глубины, шаг за шагом.

		# алгоритм таков:

		# П1 (первый запуск парсера):
		# П1.1. Заходим по адресу $parser->$donorURL
		# П1.2. Сохраняем все его содержимое в файл index.php
		# П1.3. Парсим все ссылки по адресам '!http://site\.ru/.+!'
		#		Записываем спарсенные ссылки в файл links.php, переходим к [П3]

		# П2:
		# П2.1. Открываем файл index.php
		# П2.2. Парсим все ссылки по адресам '!http://site\.ru/.+!'
		#		Записываем спарсенные ссылки в файл links.php, переходим к [П3]

		# П3 (рекурсивный раунд, исполняетя при каждом последующем запуске парсера):
		# Открываем файл links.php
		# П3.1. Пробегаемся по каждой ссылке.
//# П3.2. Сохраняем каждый спарсенный файл в директорию, в которой он находится с именем файла, как он назван, повторяем рекурсивно пункты 3-5 пока не закончатся спарсенные ссылки
//# На данный момент этот пункт выполнен не корректно, файлы кидает в общий пул, а раскидывать по директориям их приходится вручную
			# П3.2. Если файл не скачан, качаем

			# П4: Если же файл уже скачан:
			# П4.1. Открываем его
			# П4.2. Парсим все ссылки с него
			#		Дописываем ссылки в файл ссылок links.php

		# Рекурсируем прогоны пока все ссылки не будут спарсены и все файлы не будут скачаны.

		# F.1. Имеем на своем сервере все файлы сайта, находим те, что нас интересуют и парсим по заданным правилам всю интересующую нас инфу вызывая функцию $parser->cut(), сохраняем в заданом формате функцией $parser->save(), картинки можно также вынести.
		# F.2. Удаляем отработанную копию сайта.

		if (!is_readable($cacheUniqueLinks)) {
			# П2
			if (is_readable($cacheIndex)) {
				# П2.1.
				$index_page = file_get_contents($cacheIndex);

				# П2.2.
				$this->linksUnique($this->parseURLs($index_page), $cacheUniqueLinks);
			}
			# П1
			else {
				# П1.1.
				$index_page = file_get_contents($donorURL);

				# П1.2.
				$f = fopen($cacheIndex, 'w');
				fwrite($f, $index_page);
				fclose($f);

				# П1.3.
				$this->linksUnique($this->parseURLs($index_page), $cacheLinks);
			}
		}
		else {
			$links = file($cacheUniqueLinks, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
			// $f = fopen($cacheLinks, 'w');
			// fwrite($f, implode("\n", array_unique($links)));
			// fclose($f);

			foreach ($links as $link) {
				// $from = strlen($donorURL) + 1; // 'http://www.holprop.ru' == 21 (+1 для учета слеша в конце)
				// $file_dir_n_name = explode('/', substr($link, $from), 2);
				$link = 'r/property_sales_ru.asp?sort=asc';
				$file_name = parse_url($link);
				$dir_name = $cacheDir . dirname($file_name['path']) . '/';
				$file_name = $cacheDir . $file_name['path'] . '?' . $file_name['query'];
				
				// $file_name = $dir_name . basename($path);
				if (!is_dir($dir_name)) {
					mkdir($dir_name, 0777, 1);
				}
				// $file_name = $cacheDir . $file_dir_n_name[count($file_dir_n_name) - 1];

				if (!preg_match('!^https?://!', $link)) {
					$link = $donorURL . $link;
				}

				# П3
				if (!is_readable($file_name)) {
					# качать все кроме (.html пока не качаем, хочу покачать картинки)
					//if (!preg_match('!\.htm$!', $link)) {
						# П3.1.
						$current_page = file_get_contents($link);

						# П3.2.
						$f = fopen($file_name, 'w');
						$cutted_page = preg_replace('!<script\s.*</script>!Usi', '', $current_page);
						fwrite($f, $cutted_page);
						fclose($f);
					//}
				}
				# П4
				else {
					# П4.1.
					$current_page = file_get_contents($file_name);

					# П4.2.
					$old_links = file($cacheUniqueLinks, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
					$new_links = $this->parseURLs($current_page);
					$this->linksUnique(array_merge($old_links, $new_links), $cacheUniqueLinks);
				}
			}
		}
	}

	function linksUnique($links, $links_file) {
		$links = array_unique($links);
		asort($links);
		$f = fopen($links_file, 'w');
		fwrite($f, implode("\n", $links));
		fclose($f);
	}

	function parseArray($from, $begin, $end){ // === parseString()
		preg_match_all('!' . $begin . '(.*)' . $end . '!U', $from, $result);
		return array_map('trim', $result[1]);
	}
	function get_url($resCurl, $url) {
		curl_setopt($resCurl, CURLOPT_URL, $url);
		$page = mb_convert_encoding(curl_exec($resCurl), "Windows-1251", "UTF-8");
	 	if(($pos = strpos($page, 'Set-Cookie: ') !== FALSE) && $pos < 2000) {
			$res = trim(substr($page, 0, strpos($page, '<!')));
			curl_setopt($resCurl, CURLOPT_HTTPHEADER, preg_split('![\r\n]+!', $res));
		}
		return $page;
	}
}

$parser = new parser();
$parser->allSiteToLocalFiles();

// global $fold, $site;

// $donorURL = 'http://www.holprop.ru';
// $donorAlias = 'holprop.ru';
// $cacheDir = $fold['templates'] . $site['alias'] . '/cache/' . $donorAlias . '/';
// $cacheIndex = $cacheDir . 'index.php';
// $cacheLinks = $cacheDir . 'links.php';
// $cacheUniqueLinks = $cacheDir . 'uniq_links.php';
// $links_pattern = '!(url\(\'|http://www\.holprop\.ru/.*)["|\']!U';


// foreach (glob($cacheDir."*") as $page) {

// 	$cutted_page = preg_replace('!<script.*</script>!', '', $page);
// 	$f = fopen($page, 'w');
// 	fwrite($f, $cutted_page);
// 	fclose($f);
// }





// // $links = file($cacheLinks, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
// // $f = fopen($cacheLinks, 'w');
// // fgets();
// // fwrite($f, implode("\n", array_unique($links)));
// // fclose($f);


// $fr = fopen($cacheLinks,'r');
// $fw = fopen($cacheUniqueLinks,'w+');
// $fs = filesize($cacheLinks);

// while (!feof($fr) && $curpos != $fs)
// { 
// 	$str = fgets($fr); 
// 	$curpos = ftell($fr);
// 	if ($curpos == $fs) {
// 		break;
// 	}
// 	fseek($fr, $curpos);
// 	if (check_string($str, $fw)) {
// 		fwrite($fw, $str);
// 	}
// } 

// fclose($fr); 
// fclose($fw); 

// function check_string($str, $fp) 
// { 
// 	while (!feof($fp))  
// 	{ 
// 		$strf = fgets($fp);
// 		if ($strf == $str) return false;
// 	} 
// 	return true; 
// }