<?
	// return eval($argv, $argc);

	// function eval($argv, $argc) {
		// for ($i = 1; $i < count($argv); $i++) {
		// 	$eval .= ' ' . $argv[$i];
		// }
		$eval = preg_replace('!^' . $argv[0] . ' !', '', $command_vs_args);
		$eval = preg_replace(['!^<\?(php)?!','!\?>$!'], ['',''], trim($eval));
		$eval .= ';';

		$return .= eval($eval);

		return $return;
	// }