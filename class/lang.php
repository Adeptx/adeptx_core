<?
class lang {
	var $loaded;
	function init(){
		if ( !isset( $_SESSION["cms"]["lang"] ) ) {
			if ( !isset($_SERVER["HTTP_ACCEPT_LANGUAGE"]) ) {
				$_SERVER["HTTP_ACCEPT_LANGUAGE"] = "ru";
			}
			$_SESSION["cms"]["lang"]["default"] = $_SESSION["cms"]["lang"]["current"] = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
		}
		$loaded = false;
	}
	function load( $way ){
		global $cms;
		if (!$this->loaded) {
			if ( $way == ADMIN_CMD ) {
				$tmp = SITE_LANG_PATH;
				if ($cms->import( DIR_SITE.ADMIN_PATH.$tmp.$_SESSION["cms"]["lang"]["current"].".php" ) ){
					$this->loaded = true;
				}
			}
			else if ( $way == SITE_CMD ) {
				$tmp = ADMIN_LANG_PATH;
				if ($cms->import( DIR_SITE.PATH_SITE.$tmp.$_SESSION["cms"]["lang"]["current"].".php" ) ){
					$this->loaded = true;
				}
			}
		}
	}
	function get(){
		return $_SESSION["cms"]["lang"]["current"];
	}
	function set( $language ){
		if ( $language == "default" ) {
			$_SESSION["cms"]["lang"]["current"] = $_SESSION["cms"]["lang"]["default"];
		}
		else if ( preg_match( "/^\w\w$/", $language ) ) {
			$_SESSION["cms"]["lang"]["current"] = $language;
		}
	}
	function give( $phrase ){
		foreach ($GLOBALS['global'] as $var) {
			global $$var;
		}

		return $dic[$site['alias']][$phrase];
	}
	function phrase( $phrase ){
		return '<span class="lang-phrase" data-en="'.$phrase.'">'.$this->give($phrase).'</span>';
	}
}