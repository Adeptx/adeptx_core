<?
	$return = file($site['cmd_log'], FILE_SKIP_EMPTY_LINES);
	$return = array_unique($return);
	foreach ($return as $key=>$val) {
		$return[$key] = "&gt; $val"; // str_replace("\n", '&gt; ', $val);
	}
	return $return;