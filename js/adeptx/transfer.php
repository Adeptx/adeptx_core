$Adeptx = {};
$Adeptx.page = {};
<?#в зависимости от разрешения монитора нужно подгружать картинки побольше или поменьше?>
$Adeptx.page.backgrounds = [ ""<? foreach($page['bg-images'] as $bg) echo ',"' . $bg . '"'; ?> ];

$Adeptx.global = <?=file_get_contents($page['lang_pack'])?>;

$Adeptx.cmd = {};
$Adeptx.cmd.separator = '<?=$module['cmd']['separator']?>';

<?
/* nice php arr to js (but we need assoc to non assoc):
[
	<? for($i = 0; $i < count($page['bg-images']) - 1; $i++) { ?>
		"<?=$page['bg-images'][$i]?>",
	<? } ?>
		"<?=$page['bg-images'][count($page['bg-images'])]?>"
];
*/