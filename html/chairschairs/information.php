<div id="block-left">				
	<?$asset->show("auth-module")?>
	<?$asset->show("cart-module")?>
	<?$asset->show("filters-module")?>
	<?$asset->show("social-module")?>
</div>

<div id="block-center">
	<section id="block-center-page">
	<?php
		global $db;
		$tmp = $db->call("SELECT * FROM infopages WHERE infopage_link='".$_GET['page']."'");
		$infopages = $db->fetch_array( $tmp );
		if (!empty($infopages[0])) {
			$infopage = $infopages[0];
			
			if (!empty($infopage['infopage_text'])) {
				if ($infopage['infopage_public'] == 1) {
					echo $infopage['infopage_text'];

					$db->call('UPDATE `infopages` SET infopage_views='.($infopage['infopage_views']+1).' WHERE infopage_link="'.$_GET['page'].'"');
				}
				else {
					echo 'Информационная страница в данный момент не доступна, попробуйте зайти позже, а пока можете <a href="/">вернуться на главную страницу</a>.';
				}
			}
			else {
				echo 'Информационная страница не найдена, но вы можете <a href="/">вернуться на главную страницу</a>.';
			}
		}
		else {
			echo 'Информационная страница не найдена, но вы можете <a href="/">вернуться на главную страницу</a>.';
		}
	?>
	</section>
</div>

<div id="block-right">
	<?$asset->show("module-profitable")?>
	<?$asset->show("module-news")?>
</div>