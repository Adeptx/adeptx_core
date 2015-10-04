<?
	# this function just copy of tail, but tail from EOF, head from head of file
	$head_count = $arg[1];	# from head of file
	$fine_name  = str_replace(['../', '..'], '', $arg[2]);	# user see|put this address of file
	$real_file  = $fold['cmd'] . $fine_name;	# but realy file exist at cmd dir
	if (is_readable($real_file)) $file = file($real_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);	# from 0!
else exit(',"#' . $ajax['id']['cmd']['answer'] . '":"' . $msg['cmd']['head']['file no exist'] . '"}');
	$file_count = count($file);
	# if request try view line OUT of file, return all file lines
	if ($head_count > $file_count) {
		$head_count = $file_count;
	}
	$result = '';	# this var return to cmd-answer
	# REMEMBER: last line of history in empty string (\n), those you must return minus 1 string you thik.
	# BUT IT'S NOT TRUE! You needn't!

	for ($i = 0; $i < $head_count; $i++)
		$result .= $file[$i] . '<br>';
	echo ',"#'
		. $ajax['id']['cmd']['answer']
		. '":"'
		. $lang['luck']
		. ': head ' . $head_count . ' line of file ' . $real_file
		. ':<br>'
		. $result
		. '"';