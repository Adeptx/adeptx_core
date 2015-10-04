<? # for backward compatibility

class cms {	
	var $template;
	var $url;
	var $cmd;
	var $path;
	var $file;
	function cms(){		
		$this->template = '/';
		$this->template_path = '/';
		$this->url = $this->url();
		if ( !isset( $_SESSION["cms"] ) ) {
			$_SESSION["cms"] = array();
		}
		// [where we are going]
		// returns data $cms->file & $cms->path
		// which modules can use to
		
		$this->file = $this->url->file;
		if ( $this->url->file == ADMIN_CMD ) {
			$this->cmd = ADMIN_CMD;
			$this->path = ADMIN_FILE;
		}
		else {
			$this->cmd = SITE_CMD;
			if ( $this->url->file == "" ) {
				$this->path = $this->url->path.SITE_FILE;
			}
			else {
				if ( !preg_match( "/.*\..*$/", $this->url->file ) ) {
					$this->url->path .= ".php";
				}
				$this->path = $this->url->path;
			}
		}
	}
	function prepareIN($arrOfKeys) {
		$i = 0;
		$str = '';
		foreach ( $arrOfKeys as $value ) {
			if ( $i > 0 ) $str .= ',';
			$str .= $value;
			$i++;
		}
		return $str;
	}
	function tpl(){
		echo $this->template;
	}
	function go( $short ){
		return ROOT.DIR_SITE.PATH_SITE.$short;
	}
	function link($short=false, $flag=false) {
		// if ( func_num_args() > 1) {
		// 	$flag = func_get_arg(1);
		// }
		// if ( func_num_args() > 0) {
		// 	$short = func_get_arg(0);
		// }

		if ( $flag ) {
			return $this->template.$short;
		}
		else {
			echo $this->template.$short;
			return;
		}
	}
	function src($short) {
		return $this->template.$short;
	}
	function css( $css ){
		if (preg_match('!^((http:)|(https:))?//.+!', $css)) {
			$link = $css;
		}
		else {
			$link = $this->template.$css;
		}
		echo '<link href="'.$link.'" rel="stylesheet" type="text/css">'."\n";
		return '<link href="'.$link.'" rel="stylesheet" type="text/css">'."\n";
	}
	function js( $js ){
		if (preg_match('!^((http:)|(https:))?//.+!', $js)) {
			$link = $js;
		}
		else {
			$link = $this->template.$js;
		}
		echo '<script src="'.$link.'"></script>'."\n";
		return '<script src="'.$link.'"></script>'."\n";
	}
	function console( $msg ){
		echo '<script>console.log("'.$msg.'");</script>';
	}
	function url(){
		// function get's from url (like localhost/directory/checkout.php?param=value) next data:
		// $var->dir[]	- array(0 => directory)
		// $var->path	 - directory/file.php
		// $var->params[] - array(param => value) from "?param=value"
		// $var->file	 - file.php
		$var = (object)array();
		
		# $var->params = parse_str($_SERVER["REQUEST_URI"], PHP_URL_QUERY);
		$tmp = explode( "?", $_SERVER["REQUEST_URI"] );
		if ( isset($tmp[1]) ) {
			parse_str( $tmp[1], $var->params );
		}
		
		$tmp = explode( "/", $tmp[0] );
		$var->dir = array();
		$var->path = "";
		for ($i = 1; $i < count($tmp) - 1; $i++) {
			$var->dir[] = $tmp[$i];
			$var->path .= $tmp[$i] . "/";
		}
		$var->file = $tmp[$i];
		$var->path .= $var->file;
		return $var;
	}
	function import( $file ){
		if ( is_readable( $file ) ) {
			include( $file );
			return true;
		}
		return false;
	}
	function call( $path ){
		if ( is_readable( DIR_SITE.PATH_SITE.$path ) ) {
			include( DIR_SITE.PATH_SITE.$path );
		}
		else {
			$this->error(404);
		}
	}
	function error( $num ){
		switch ( $num ) {
			case 404:
				echo '<body style="margin: 0; background:url(' . HOST.DIR_SITE.PATH_SITE.DIR_IMG . '404.png) 0 0 no-repeat, url(' . HOST.DIR_SITE.PATH_SITE.DIR_IMG . '404_2.png) 50% 160px no-repeat;">';
				// error 404 page
				// run with $this->call(  ) or something similar;
				die();
				break;
			default:
				// unknown error
				break;
		}
	}
	function trans($string, $gost=false){
		if($gost)
		{
			$replace = array("А"=>"a","а"=>"a","Б"=>"b","б"=>"b","В"=>"v","в"=>"v","Г"=>"g","г"=>"g","Д"=>"d","д"=>"d",
					"Е"=>"e","е"=>"e","Ё"=>"e","ё"=>"e","Ж"=>"zh","ж"=>"zh","З"=>"z","з"=>"z","И"=>"i","и"=>"i",
					"Й"=>"i","й"=>"i","К"=>"k","к"=>"k","Л"=>"l","л"=>"l","М"=>"m","м"=>"m","Н"=>"n","н"=>"n","О"=>"o","о"=>"o",
					"П"=>"p","п"=>"p","Р"=>"r","р"=>"r","С"=>"s","с"=>"s","Т"=>"t","т"=>"t","У"=>"u","у"=>"u","Ф"=>"f","ф"=>"f",
					"Х"=>"kh","х"=>"kh","Ц"=>"tc","ц"=>"tc","Ч"=>"ch","ч"=>"ch","Ш"=>"sh","ш"=>"sh","Щ"=>"shch","щ"=>"shch",
					"Ы"=>"y","ы"=>"y","Э"=>"e","э"=>"e","Ю"=>"iu","ю"=>"iu","Я"=>"ia","я"=>"ia","ъ"=>"","ь"=>"");
		}
		else
		{
			$arStrES = array("ае","уе","ое","ые","ие","эе","яе","юе","ёе","ее","ье","ъе","ый","ий");
			$arStrOS = array("аё","уё","оё","ыё","иё","эё","яё","юё","ёё","её","ьё","ъё","ый","ий");		
			$arStrRS = array("а$","у$","о$","ы$","и$","э$","я$","ю$","ё$","е$","ь$","ъ$","@","@");
						
			$replace = array("А"=>"a","а"=>"a","Б"=>"b","б"=>"b","В"=>"v","в"=>"v","Г"=>"g","г"=>"g","Д"=>"d","д"=>"d",
					"Е"=>"ye","е"=>"e","Ё"=>"ye","ё"=>"e","Ж"=>"zh","ж"=>"zh","З"=>"z","з"=>"z","И"=>"i","и"=>"i",
					"Й"=>"y","й"=>"y","К"=>"k","к"=>"k","Л"=>"l","л"=>"l","М"=>"m","м"=>"m","Н"=>"n","н"=>"n",
					"О"=>"o","о"=>"o","П"=>"p","п"=>"p","Р"=>"r","р"=>"r","С"=>"s","с"=>"s","Т"=>"t","т"=>"t",
					"У"=>"u","у"=>"u","Ф"=>"f","ф"=>"f","Х"=>"kh","х"=>"kh","Ц"=>"ts","ц"=>"ts","Ч"=>"ch","ч"=>"ch",
					"Ш"=>"sh","ш"=>"sh","Щ"=>"shch","щ"=>"shch","Ъ"=>"","ъ"=>"","Ы"=>"y","ы"=>"y","Ь"=>"","ь"=>"",
					"Э"=>"e","э"=>"e","Ю"=>"yu","ю"=>"yu","Я"=>"ya","я"=>"ya","@"=>"y","$"=>"ye"," " => "_");
					
			$string = str_replace($arStrES, $arStrRS, $string);
			$string = str_replace($arStrOS, $arStrRS, $string);
		}
		$result = strtr($string,$replace);
		$result = strtolower( $result );
		return iconv("UTF-8","UTF-8//IGNORE",$result);
	}
}