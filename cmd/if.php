<?
	return adeptx_if($argv, $argc);

	function adeptx_if($argv, $argc) {
		if ($argv[1]) {
			return run($argv['then']);
		}
		else {
			return run($argv['else']);
		}
	}