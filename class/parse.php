<?
class parse {
	var $expired;
	function init(){
		// теоретически $this->expired должен задаваться в другом месте, из админки
		$this->expired = 3600; // 60 * 60 sec = 1 hour
		
		if ( is_dir(ROOT.DIR_SITE.CACHE_MODULES) ) {}
		else mkdir(ROOT.DIR_SITE.CACHE_MODULES);
		$this->clear_old_cache();
	}
	function cache_encode( $path ){
		return urlencode( $path );
	}
	function cache_decode( $path ){
		return urldecode( $path );
	}
	function call( $path ){
		global $cms;
		
		// $path == 'dir/subdir/file.ext';
		// $file == 'dir/subdir/file.ext';

		if ( $cms->cmd == ADMIN_CMD ) {
			$file = ROOT.DIR_SITE.ADMIN_PATH.$path;
		}
		else if ( $cms->cmd == SITE_CMD ) {
			$file = ROOT.DIR_SITE.PATH_SITE.$path;
		}
		
		if ( file_exists( $file ) ) {
			if ( preg_match( "/.*\.php$/", $path ) ) {
				$this->file($path);
				include ROOT.DIR_SITE.CACHE_SITE.$this->cache_encode($path);
			}
			else {
				print( file_get_contents( $file ) );
			}
		}
		else {
			$cms->error(404);
		}
	}
	function file( $path ){
		global $cms;
		$cache = ROOT.DIR_SITE.CACHE_SITE.$this->cache_encode($path);
		
		if ( $cms->cmd == ADMIN_CMD ) {
			$file = ROOT.DIR_SITE.ADMIN_PATH.$path;
		}
		else if ( $cms->cmd == SITE_CMD ) {
			$file = ROOT.DIR_SITE.PATH_SITE.$path;
		}
		else return false;
		
		if ( file_exists( $file ) && preg_match( "/.*\.php$/", $file ) ) {
			if ( !file_exists( $cache ) ) {
				$this->parse_this_to($file, $cache);
			}
			else {
				if ( filemtime($file) > filemtime($cache) ) {
					$this->parse_this_to($file, $cache);
				}
			}
			return true;
		}
		else {
			return false;
		}
	}
	function parse_this_to( $file, $cache ){
		global $cms;
		if ( file_exists( $file ) ) {
			$fc = fopen($cache, "w");
			
			// здесь должен быть парсер.
			// как работать с файлами смотреть по ссылкам:
			//http://php.net/manual/ru/function.file.php
			//http://php.net/manual/ru/function.file-get-contents.php
			
			$result = "<?php\n";
			foreach ( $cms->globals as $global ) {
				$result .= "global \$" .$global. ";\n";
			}
			$result .= "?>\n";
			
			$result .= file_get_contents( $file );
			
			fwrite($fc, $result);
			
			fclose($fc);
		}
	}
	function clear_old_cache(){
		if ($handle = opendir( ROOT.DIR_SITE.CACHE_SITE )) {
			while (false !== ($file = readdir($handle))) {
				if ( preg_match( "/.*\.php$/", $file ) ) {
					if ( time() - filemtime(ROOT.DIR_SITE.CACHE_SITE.$file) > $this->expired ) {
						unlink( ROOT.DIR_SITE.CACHE_SITE.$file );
					}
				}
			}
			closedir($handle);
		}
	}
}