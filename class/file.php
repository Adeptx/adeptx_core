<?
	class file {
		function download($file_name) {
			if ($_SESSION['permissions']['download']) {
				if (is_readable($file_name)) {
					# here we can controle mime-type of downloading file with header
					# header('Content-type: application/pdf');
					header($header['download'] . $file_name);
					readfile($file_name);
					exit;
				} else {
					$url['path'] = '404';
				}
			} else {
				$url['path'] = '403';
			}
		}

		# if use local files each must be validate php is_readable()
		function import($type, $import = false, $async = false) {
			global $global;
			foreach ($global as $var) {
				global $$var;
			}

			if (empty($import)) {
				$import = $page[$type];
			}

			if(is_array($import)) {
				foreach($import as $desc => $link) {
					$this->import($type, $link, $async = ($desc == 'async'));
				}
			}
			else {
				$external = preg_match('!^((http:)|(https:))?//.+!', $import);

				//if ($external || is_readable($fold[$type] . $import)) {
					echo
						$head[$type]['open']
						. ($external ? '' : $fold[$type])
						. $import
						. $head[$type]['close']
						. "\n";	# ($async)?('" async></script>'):($after)
				//}
			}
		}
	}