<?
	class json {
		function cutComments($json_string) {
			// { "": { "": []} }
			// 
			// preg_match_all('![\{\}\[\],:]!');
			//$json_string = preg_replace('!(\s*)/\*.*\*/(\s*)\n!s', '$1$2\n', $json_string);
			$json_string = preg_replace("!(^|\s)+//.*$!m", "$1", $json_string);
			// $json_string = preg_replace("!(\n)(\s*)#.*(\s*)\n!", '$1$2$3', $json_string);
			return $json_string;
		}

		function fileAsArray($file_name) {
			global $error;

			if (is_readable($file_name)) {
				$json_string = file_get_contents($file_name);
				if ($json_string) {
					# need option "comments" and modification comment parse
					$json_string = $this->cutComments($json_string);
					# true for assoc array instead of object
					# but in future it must be object instead for settings etc
					$json_arr = json_decode($json_string, true);
					if ($json_arr) {
						return $json_arr;
					}
					throw new Exception('Broken JSON format', 1201);
				}
				throw new Exception('Empty JSON file', 1202);
			}
			throw new Exception('<strong>'.$file_name.'</strong> not found', 1203);
		}

		function toGlobal($json) {
			foreach ($json as $global_var=>$arr) {
				foreach ($arr as $key=>$value) {
					if (empty($GLOBALS[$global_var])) $GLOBALS[$global_var] = [];
					if (is_int($key)) {
						$GLOBALS[$global_var][] = $value;
					} elseif (is_object($GLOBALS[$global_var])) {
						throw new Exception('Cannot use object as array', 1204);
					}
					else {
						$GLOBALS[$global_var][$key] = $value;
					}
				}
			}
		}

		function fileToGlobal($file_name) {
			$lang_json = $this->fileAsArray($file_name);
			if ($lang_json) {
				$this->toGlobal($lang_json);
			}
			else {
				throw new Exception('$json->fileToGlobal() can\'t use <strong>$json->fileAsArray()', 1205);
			}
		}

		# pretty formating json array
		function pretty($arr) {
			return json_encode($arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
		}

		# pretty formating json file
		function fileAsString($file_name) {
			$json_string = file_get_contents($file_name);
			// 	$conf_file = 'config.php';
			// # OR
			// # $site['settings'];
			// # OR
			// # $fold['configurations'] . $site['alias'] . $site['extensions'];

			$json_string = $this->cutComments($json_string);
			$json_arr = json_decode($json_string, true);
			return $this->pretty($json_arr);
		}

		function save($type, $import = false, $async = false) {
			// js sent to ajax $('#site-options').val()

			// $pretty_new_conf = json_encode($new_conf, JSON_PRETTY_PRINT);

			// we write new conf as conf/user/ and include it after default conf to rewrite
			// $f = fopen($conf_file, 'w');
			// fwrite($f, $pretty_new_conf);
			// fclose($f);
		}
	}