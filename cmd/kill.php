<?
	return kill($argv, $argc);

	function kill($argv, $argc) {
		$cloud_id = $argv[1];
		if (isset($argv['i'])) {
			$cloud_id = $argv['i'];
		}
		if (isset($argv['id'])) {
			$cloud_id = $argv['id'];
		}

		if (empty($cloud_id)) {
			throw new Exception("Укажите ID процесса, который вы хотите остановить", 3495);
		}

		echo '<div class="last-answer"></div><script>cloude_close(' . $cloud_id . '); $(".last-answer").last().text("Остановлен процесс #" + ' . $cloud_id . ');</script>';
	}