<?php

$constMaxRead = 300;
$title = "МнемонАдресТовара;ИндексСорт;Группа1НазвКатег;Группа1Мнемон;Группа2НазвПодкат;Группа2Мнемон;Название;Цена;Описание;ТоргПредл;ЦенаТоргПредл;Изображения";

$groupNames = array("Готовые очки","Очки специального назначения","Оправы","Очки солнцезащитные","Футляры","Аксессуары","Аксессуары МКЛ","Выставочное оборудование","Оборудование для мастера","Распродажа","Другие товары и услуги");
$groupMnemonics = array("ready_glasses","glasses_sn","opravy","sun_glasses","futlyary","acsessuary","acsessuary_mkl","vystavochnoe","dlya_mastera","rasprodazha","other");

$header = preg_split('![\r\n]+!', 'Accept:text/html
Accept-Language:ru,uk;q=0.8,en-US;q=0.6,en;q=0.4
Cache-Control:max-age=0
Connection:keep-alive
Cookie:virtuemart=n2o7r88fvic4dr8v4t3alqh7l6; 2bcb939887c372b902fac972a173fcc6=iikvns9so2hp5fh2j843kdtig2; 73ba353457a9efbcf176deb336df4660=+25951+A494A+B+F591442425D455C595A+31A+D15+A53+3+A171F4D471751+3231A+25E565C4919114315+A4B+D+A+2151659451547+D4754175E44+E5C+943283752+5+0+97A6441+D4A
Host:universal-optica.ru
If-Modified-Since:Mon, 10 Mar 2014 00:03:00 GMT
Referer:http://universal-optica.ru/
User-Agent:Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.146 Safari/537.36');

$goodViewedIndex = 0;
$globalStringIndex = 0;
$groupIndex = 0;
$fileNameIndex = 0;

$curl = curl_init();
curl_setopt($curl, CURLOPT_HEADER, 1);				// нам нужны заголовки
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);		// не выводим страницу, а получаем переменную
curl_setopt($curl, CURLOPT_HTTPHEADER, $header); 	// имитируем запрос браузера (копируем известный запрос с куками)

$page = get_url($curl, "http://www.universal-optica.ru/");
preg_match_all('!/catalog\?page=shop\.browse&category_id=(\d+)">!', $page, $equally);
$categoryIDs = $equally[1];
$categoryName = parseArray($page,'/catalog\?page=shop\.browse&category_id=\d+">','<span>');

$progress = count($categoryIDs);

echo "Start parsing...\n\n";
foreach($categoryIDs as $categoryIndex => $categoryID) {
	
	if (in_array((int)$categoryID, array(131,161,62,37,52,16,68,49,147,159)))
		$groupIndex++;
	
	echo "\n\nNow looking: /".$groupMnemonics[$groupIndex]." (".$groupIndex.")\n";
	
	$page = get_url($curl, "http://www.universal-optica.ru/catalog?category_id=".$categoryID."&page=shop.browse&limitstart=0&limit=400");
	$productUrl = parseArray($page, '<a class="product_link" href="', '">');
	$productName = parseArray($page, '<h3>', '</h3>');
	$productsImages = parseArray($page, 'http://universal-optica\.ru/components/com_virtuemart/shop_image/product/', '\.(jpg|png)"');
	$productPrice = parseArray($page, '<span class="product_price">', ' руб.</span>');
	
	$categoryMnemonic = strtr($categoryName[$categoryIndex],
	"АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщьыъэюяABCDEFGHIJKLMNOPQRSTUVWXYZ()-/ ,&=", "abvgdeejziyklmnoprstufhc4w6yyyeuaabvgdeejziyklmnoprstufhc4w6yyyeuaabcdefghijklmnopqrstuvwxyz________");
	
	$k = 0;
	foreach($productName as $productIndex => $t) {
		
		$page = get_url($curl, "http://www.universal-optica.ru".$productUrl[$productIndex]);
		
		$sellingProposition = parseArray($page, '<h3>', '</h3>');
		$sellingPropositionPrices = parseArray($page, '<span class="product_price">', ' руб.</span>'); // or die('Prices are empty!')
		
		if (preg_match_all('!<description>\s*(.*)\s*</description>!', $page, $result)) {
			$desc = trim($result[0][0]);
			$p1 = strpos($desc, '<description>');
			$p2 = strpos($desc, '</description>');
			$desc = trim(substr($desc, $p1 + 13, $p2 - $p1 - 14));
		} else $desc = "";
		
		$productLine  = $goodViewedIndex.";".$goodViewedIndex.";";
		$productLine .= $groupNames[$groupIndex].";".$groupMnemonics[$groupIndex].";";
		$productLine .= $categoryName[$categoryIndex].";".$categoryMnemonic.";";
		$productLine .= $productName[$productIndex].";".$productPrice[$productIndex].";".$desc.";";
		
		echo "\t".$goodViewedIndex." : /".$categoryMnemonic."\n";
				
		$flagNotResize = true;
		
		$k++;
		foreach($sellingProposition as $propos => $sellingPropositionName) {
			$prodLine = $productLine . $sellingPropositionName . ";" . $eachProductPrices[$propos + 1] . ";"; // первая цена всегда копия из productPrice
		
			if ($flagNotResize && $productsImages[$k] && strpos($productsImages[$k], 'resized') === FALSE)
				if (!in_array((int)$productsImages[$k], array(130001552, 110006319, 100060327)))
					$prodLine .= "http://universal-optica.ru/components/com_virtuemart/shop_image/product/".$productsImages[$k++].".jpg";
				else $k++;
			if (strpos($productsImages[$k], 'resized') !== FALSE)
				$flagNotResize = false;
	
			$globalResultArray[] = $prodLine;
		}
		
		if ($goodViewedIndex % $constMaxRead == 0 && $goodViewedIndex > 0) {
			$resultFile = fopen("result/parsed".$constMaxRead."_".($fileNameIndex++).".csv",'wx');
			fwrite($resultFile, $title."\n");
			echo "\nCreate file(\"result/parsed400_".($fileNameIndex)."\")\n";
			foreach ($globalResultArray as $iOutputFileLine)
				fwrite($resultFile, $iOutputFileLine."\n");
			echo "Write to file finished...\n";
			fclose($resultFile);
			unset($globalResultArray);
		}
		$goodViewedIndex++;
	}
}

$resultFile = fopen("result/parsed".$constMaxRead."_".($fileNameIndex++).".csv",'wx');
fwrite($resultFile, $title."\n");
echo "\nCreate file(\"result/parsed".$constMaxRead."_".($fileNameIndex)."\")\n";
foreach ($globalResultArray as $iOutputFileLine)
	fwrite($resultFile, $iOutputFileLine."\n");
echo "Write to file finished...\n";
fclose($resultFile);

curl_close($curl);

echo "\n\nStop parsing.\n\n";

function parseArray($from, $begin, $end){ // === parseString()
	preg_match_all('!' . $begin . '(.*)' . $end . '!U', $from, $result);
	return array_map('trim', $result[1]);
}
function get_url($resCurl, $url) {
	curl_setopt($resCurl, CURLOPT_URL, $url);
	$page = mb_convert_encoding(curl_exec($resCurl), "Windows-1251", "UTF-8");
	if($pos = strpos($page, 'Set-Cookie: ') !== FALSE && $pos < 2000)
	{
		preg_match('!^(.+)[\r\n]{2}!', $page, $matched);
		curl_setopt($resCurl, CURLOPT_HTTPHEADER, preg_split('![\r\n]+!', $matched[1]));
	}
	return $page;
}
?>

