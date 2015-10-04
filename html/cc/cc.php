<?php

// copy brower header 1 to 1 as is in this string after your authorized request to site
// if browser header use Accept-Encoding:gzip,deflate,sdch or etc cut it & use only text/html Accept
// if it doesn't work consider how to further improve the headlines :)
$header = preg_split('![\r\n]+!', ($_POST['header'])?$_POST['header']:'Accept:text/html
Accept-Language:ru,uk;q=0.8,en-US;q=0.6,en;q=0.4
Cache-Control:max-age=0
Connection:keep-alive
Cookie:virtuemart=n2o7r88fvic4dr8v4t3alqh7l6; 2bcb939887c372b902fac972a173fcc6=iikvns9so2hp5fh2j843kdtig2; 73ba353457a9efbcf176deb336df4660=+25951+A494A+B+F591442425D455C595A+31A+D15+A53+3+A171F4D471751+3231A+25E565C4919114315+A4B+D+A+2151659451547+D4754175E44+E5C+943283752+5+0+97A6441+D4A
Host:universal-optica.ru
If-Modified-Since:Mon, 10 Mar 2014 00:03:00 GMT
Referer:http://universal-optica.ru/
User-Agent:Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.146 Safari/537.36');

$curl = curl_init();
curl_setopt($curl, CURLOPT_HEADER, 1);				// we need header
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);		// don't print page, save it to var. (see $page)
curl_setopt($curl, CURLOPT_HTTPHEADER, $header); 	// simulate browser headers vs cookie & user-agent& referer etc (just copy request header from you agent as is when you already authorized on site)

$page = get_url($curl, ($_POST['url'])?$_POST['url']:"http://www.universal-optica.ru/catalog?category_id=95");

// get some secure content from site
$productPrice = parseArray($page, ($_POST['from'])?$_POST['from']:'<span class="product_price">', ($_POST['to'])?$_POST['to']:' руб.</span>');

echo 'result of code that you see:<br>';
print_r($productPrice);

curl_close($curl);

function parseArray($from, $begin, $end){
	preg_match_all('!' . $begin . '(.*)' . $end . '!U', $from, $result);
	return array_map('trim', $result[1]);
}
function get_url($curl, $url) {
	curl_setopt($curl, CURLOPT_URL, $url);
	$page = curl_exec($curl);
	// if $url charset != parser encoding: change cp1251 to parser encoding & utf8 to site charset
	// $page = mb_convert_encoding($page, "Windows-1251", "UTF-8");
	if($pos = strpos($page, 'Set-Cookie: ') !== FALSE && $pos < 2000)
	{
		preg_match('!^(.+)[\r\n]{2}!', $page, $matched);
		curl_setopt($curl, CURLOPT_HTTPHEADER, preg_split('![\r\n]+!', $matched[1]));
	}
	return $page;
}
?>
<form method="post">
<code><pre>
&lt;?php

// copy brower header 1 to 1 as is in this string after your authorized request to site
// if browser header use Accept-Encoding:gzip,deflate,sdch or etc cut it & use only text/html Accept
// if it doesn't work consider how to further improve the headlines :)
$header = preg_split('![\r\n]+!', ($_POST['header'])?$_POST['header']:'<textarea name="header" cols="70" rows="15"><?=($_POST['header'])?$_POST['header']:'Accept:text/html
Accept-Language:ru,uk;q=0.8,en-US;q=0.6,en;q=0.4
Cache-Control:max-age=0
Connection:keep-alive
Cookie:virtuemart=n2o7r88fvic4dr8v4t3alqh7l6; 2bcb939887c372b902fac972a173fcc6=iikvns9so2hp5fh2j843kdtig2; 73ba353457a9efbcf176deb336df4660=+25951+A494A+B+F591442425D455C595A+31A+D15+A53+3+A171F4D471751+3231A+25E565C4919114315+A4B+D+A+2151659451547+D4754175E44+E5C+943283752+5+0+97A6441+D4A
Host:universal-optica.ru
If-Modified-Since:Mon, 10 Mar 2014 00:03:00 GMT
Referer:http://universal-optica.ru/
User-Agent:Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.146 Safari/537.36';?></textarea>');

$curl = curl_init();
curl_setopt($curl, CURLOPT_HEADER, 1);			// we need header
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);		// don't print page, save it to var. (see $page)
curl_setopt($curl, CURLOPT_HTTPHEADER, $header); 	// simulate browser headers vs cookie & user-agent& referer etc (just copy request header from you agent as is when you already authorized on site)

$page = get_url($curl, ($_POST['url'])?$_POST['url']:'<input name="url" size="70" value="http://universal-optica.ru/catalog?page=shop.browse&category_id=95">');

// get some secure content from site
$productPrice = parseArray($page, ($_POST['from'])?$_POST['from']:'<input name="from" size="25" value='<span class="product_price">'>', ($_POST['to'])?$_POST['to']:'<input name="to" size="25" value=' руб.</span>'>');

echo 'result of code that you see:';
print_r($productPrice); // result you see on top of this page

curl_close($curl);

function parseArray($from, $begin, $end){
	preg_match_all('!' . $begin . '(.*)' . $end . '!U', $from, $result);
	return array_map('trim', $result[1]);
}
function get_url($curl, $url) {
	curl_setopt($curl, CURLOPT_URL, $url);
	$page = curl_exec($curl);
	// if $url charset != parser encoding: change cp1251 to parser encoding & utf8 to site charset
	// $page = mb_convert_encoding($page, "Windows-1251", "UTF-8");
	if($pos = strpos($page, 'Set-Cookie: ') !== FALSE && $pos < 2000)
	{
		preg_match('!^(.+)[\r\n]{2}!', $page, $matched);
		curl_setopt($curl, CURLOPT_HTTPHEADER, preg_split('![\r\n]+!', $matched[1]));
	}
	return $page;
}
?></pre>
</code>
<input type="submit">
</form>
