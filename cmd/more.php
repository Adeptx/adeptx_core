<?
	# this function just put all file
	$fine_name  = str_replace(['../', '..'], '', $arg[1]);	# user see|put this address of file
	$real_file  = $fold['cmd'] . $fine_name;	# but realy file exist at cmd dir
	if (is_readable($real_file)) $file = file_get_contents($real_file);
else exit(',"#' . $ajax['id']['cmd']['answer'] . '":"' . $msg['cmd']['more']['file no exist'] . '"}');
	$file = str_replace("\n", '<br>', $file);

	echo ',"#'
		. $ajax['id']['cmd']['answer']
		. '":"'
		. $lang['luck']
		. ': more file ' . $real_file
		. ':<br>'
		. $file
		. '"';