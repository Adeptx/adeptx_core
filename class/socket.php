<?
	class socket {
		// $file = '/inc/ip.php'; $host = 'grinec.tk';
		function init($file, $host, $port=80, $timeout=30) {
			$fp = fsockopen($host, $port, $errno, $errstr, $timeout);
			if (!$fp) {
				echo "$errstr ($errno)<br />\n";
			} else {
				$out = "GET $file HTTP/1.1\r\n";
				$out .= "Host: $host\r\n";
				$out .= "Connection: Close\r\n\r\n";
				fwrite($fp, $out);
				while (!feof($fp)) {
					echo fgets($fp, 128);
				}
				fclose($fp);
			}
		}
	}


