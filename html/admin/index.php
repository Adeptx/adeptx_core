<?

// id you need special content for admin page you can
// create file with special name and uncomment this line:
if (is_readable($page['path']) && !$page['option']['great_seven']) {
	include_once $page['path'];
	exit;
}
?>
<? if ($page['option']['great_seven']) {
	if ($page['alias'] == 'products') {
		$admin->insert('msg-products-details');
		$admin->insert('msg-products-images');
	}
	$admin->insert('great-gatsby');
	$colspan = count($dic[$site['alias']][$page['alias'].'-column-title']);
?>
	<table id="<?=$page['alias']?>" class="admin-table" cellspacing="1" cellpadding="0">
		<thead>
			<tr>
				<td colspan="<?=$colspan?>"><?=$dic[$site['alias']]['title'][$page['alias']]
				#$lang->phrase([$page['heading']]);
				?></td>
			</tr>
			<tr class="<?=$page['alias']?>-title">
				<? foreach ($dic[$site['alias']][$page['alias'].'-column-title'] as $class=>$value)
				{
					if (is_array($value)) {
						$title = ' title="' . $value[1] . '"';
						$value = $value[0];
					}
					else {
						$title = '';
					}
								// no products, !product!
				?>
					<th class="<?=$page['alias']?>-<?=$class?>-title sort-by" data-by="<?=$class?>"<?=$title?>><?=$value?></th>
				<? } ?>
			</tr>
		</thead>
		<tbody>
		<?	
			if (is_readable($page['path'])) {
				include_once $page['path'];
			}
		?>
		</tbody>
		<tfoot>
			<tr id="loading">
				<td colspan="<?=$colspan?>">все данные ожидаются от сервера через ajax запрос <img width="32" height="8" src="<?='img/loading/loading-orange.gif'?>"></td>
			</tr>
			<tr>	<!-- products - to bottom of thead -->
				<td colspan="<?=$colspan?>">
					<? if ($lang->give($page['alias'].'-add-button')) { ?>
						<a class="<?=$page['alias']?>-add button-add"><?=$lang->phrase($page['alias'].'-add-button')?></a>
					<? } ?>
				</td>
			</tr>
		</tfoot>
	</table>

	<div class="invisible" hidden>
		<div id="msg-<?=$page['alias']?>-add-title"><?=$lang->give('msg-' . $page['alias'] . '-add-title')?></div>
		<div id="msg-<?=$page['alias']?>-add">
			<table id="<?=$page['alias']?>-add-table">
				<tbody>
					<? $admin->insert('msg-' . $page['alias'] . '-add') ?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="2">
							<input id="<?=$page['alias']?>-add-button" type="submit" value="<?=$lang->give($page['alias'] . '-add-button')?>">
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
<? } ?>