<?
	$dir = $_SESSION['fm']['dir'];
	$dir = str_replace(array('../', './', '..'), '', $dir);
	if (!$dir) $dir = '.';
	$files = scandir($dir);
	if ($dir=='.') $dir = '';
	else $dir.='/';
?>

<?if($_REQUEST['file']){?>
	<textarea id=keep></textarea>
	<input id=from class=replace placeholder="<?=$lang['replace from']?>">
	<input id=to class=replace placeholder="<?=$lang['replace to']?>">
	<input id=replace class=replace type=button value="<?=$lang['replace all']?>">
	<?}else{?>

		<textarea id="preread"></textarea>
		<div id="preview"></div>

		<table id=files rules=none cellspacing=0 cellpadding=0>
			<tr class=line>
				<td colspan=5>
					<a id=first_link class=link href="<?='?dir='.substr($dir,0,strrpos($dir,'/',-2));?>">
						<?=$lang['content']?>&nbsp;
						<?=str_replace( '/', ' &raquo; ',substr($dir,0,-1));?>
					</a>
				</td>
			</tr>

			<?for ($i=2; $i<count($files); $i++){?>
				<?if(is_dir($dir.$files[$i])){?>
					<tr class=line id="<?=++$id;?>">
						<td colspan=5 width=100%>
							<a class=link href="?dir=<?=$dir.$files[$i];?>">
								<div class="knops dir_ico">&nbsp;</div>&nbsp;
								<?=$files[$i];?>
							</a>
						</td>
					</tr>
					<?}?>
						<?}?>

							<?for ($i=2; $i<count($files); $i++){?>
								<?if(!is_dir($dir.$files[$i])) { $fname=$files[$i]; ?>
									<tr class=line id="<?=++$id;?>">
										<td width=5><a class=knops target=_blank href="?file=<?=$dir.$files[$i];?>">&#9997;</a>
										<td width=100%><input class=rename value="<?=$fname;?>">
										<td><a class=knops target=_blank href="<?=$dir.$files[$i];?>">&#10170;</a>
										<td><a class=knops href="?download=<?=$dir.$files[$i];?>">&dArr;</a>
										<td><a class="knops del" href="<?=$dir.$files[$i];?>">x</a>
									</tr>
								<?}?>
							<?}?>
		</table>

		<?}?>
