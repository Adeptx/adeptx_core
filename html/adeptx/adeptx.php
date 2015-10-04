<?
	$inputFile = file($_POST['input']);
	
	# разобрать строку. для начала просто определяем начало строки
	# ?		<?php *; ?
	# =		<?php echo *; ?
	
	foreach($inputFile as $inLine) {
		$inLine = trim($inLine);
		if ($inLine[0] == '?') {
			$inLine = '<?php ' . substr($inLine, 1) . '; ?>';
		} elseif ($inLine[0] == '=') {
			$inLine = '<?php echo ' . substr($inLine, 1) . '; ?>';
		}
	}
	
	$outputFile = fopen($_POST['output'], 'wx');
	foreach($adeptx as $outLine)
		write($outputFile, $outLine);
	fclose($outputFile);
	
	include 'head.php';
?>
