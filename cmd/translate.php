<?
	return translate($argv, $argc);

	function translate($argv, $argc) {
		$direction = $argv[1];	// 'ru-en':'en-ru'
		$text = $argv[2];

		if (!preg_match('!^\w\w-\w\w$!', $direction)) {
			throw new Exception("Некорректное направление перевода", 6581);
		}

		$y_key = 'trnsl.1.1.20151005T180332Z.2279c2ee293867c5.610bc60dfac381f0f37a0f4bdc3e789dea01c72b';

		$uri = 'https://translate.yandex.net/api/v1.5/tr.json/translate';
		$href = "$uri?key=$y_key&lang=$direction&text=".urlencode( $text );
		$translation = json_decode(file_get_contents($href), true);

		return $translation['text'][0];
	}