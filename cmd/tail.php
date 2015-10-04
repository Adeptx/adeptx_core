<?
	$tail_count = $arg[1];	# from EOF
	$fine_name  = str_replace(array('../', '//'), '', $arg[2]);		# user see|put this address of file
	$real_file  = $fold['cmd'] . $fine_name;						# but realy file exist at cmd dir
	if (is_readable($real_file)) {
		 $file = file($real_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);	# from 0!
	}
	else {
		return '$err_tail_file_not_exist'; // $err_tail_file_not_exist = $msg['cmd']['tail']['file no exist'];
	}
	$file_count = count($file);
	$line_num = $file_count - $tail_count;
	# if request try view line OUT of file, return all file lines
	if ($line_num < 0) {
		$line_num = 0;
		$tail_count = $file_count;
	}
	$tmp = '';	# this var return to cmd-answer
	# REMEMBER: last line of history in empty string (\n), those you think you must return minus 1 string.
	# BUT IT'S NOT TRUE! You needn't! (each line contain symbols \n)

			if($tail_count <= $file_count){
				
				# id request try view NO cmd hisory file, return N last line of file
				
				if ($real_file != $site['cmd_log']) {
					for ($i = 0; $i < $tail_count; $i++) {
						$tmp .= $file[$line_num + $i] . '<br>';
					}
					$result['#' . $ajax['id']['cmd']['answer']] = $lang['luck'] . ": tail $tail_count line of file $real_file:<br>$tmp";
				# id request try view cmd hisory file, return only one line
					
				} else {
					if ($_SESSION['permissions']['cmd']['tail']) {
						return $file[$line_num];
					} else {
						return sprintf('$msg_tail_success', $tail_count, $fine_name, $file[$line_num]);	// $msg_tail_success = $msg['cmd']['tail']['luck']
					}
				}
			} else {
				# if request try view line OUT of file, return special sign, then cmd.js must line=line-1;
			}