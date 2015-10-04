<?php
	#	Function: Hash checker
	function checkHash($path, $fileName) {
		if(file_exists($path.$fileName))
			return true;
		return false;
	}

	function hashFindFile($file) {
		if ($file) {
			if (file_exists('sessions/' . $file))
				return filemtime('sessions/' . $file);	# Return file creation time
			return false;
		}
		return false;
	}
	$getHash = stripslashes($_GET['access']);
	$getIP = explode("_", $getHash);
	$userIP = $_SERVER['REMOTE_ADDR'];
	# IF checkHash returns true then show elfinder
	if(1/*checkHash('sessions/', $getHash) /* && substr($userIP, 0, 6) != '46.98.'== $getIP[0]*/) {/*
		if(hashFindFile($getHash)) {
			$expires = time() - hashFindFile($getHash);
			if($expires > 3600) {
				echo 'Session has expired!';
				exit;
			}
		} else {
			echo 'Session not exists!';
			exit;
		}*/
		?><!-- elFinder initialization -->
		<script type="text/javascript">
			$().ready(function() {
				var elf = $('#elfinder').elfinder({
					url: 'tool/fm/php/connector?access=<?=$getHash?>',
					lang: 'ru',
					resizable: false,
					width: '100%',
					height: 620,
				}).elfinder('instance');
			});
		</script>
	<? } ?>

	<!-- Element where elFinder will be created (REQUIRED) -->
	<div id="elfinder"></div><!-- elFinder initialization -->
