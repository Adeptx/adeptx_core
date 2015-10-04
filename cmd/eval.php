<?
	for ($i = 1; $i < count($arg); $i++) {
		$eval .= ' '.$arg[$i];
	}
	$eval = preg_replace(['!^<\?(php)?!','!\?>$!'], ['',''], trim($eval));
	$eval .= ';';

	$return .= eval($eval);

	return $return;