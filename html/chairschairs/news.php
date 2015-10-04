<?
	global $db;
	if (!empty($_GET['id'])) {
		$tmp = $db->call("SELECT * FROM news WHERE news_id='".$_GET['id']."'");
		$news = $db->fetch_array( $tmp );
		if (!empty($news)) {
			$news = $news[0];
		}
	}
?>

<div id="block-left">				
	<?$asset->show("auth-module")?>
	<?$asset->show("cart-module")?>
	<?$asset->show("filters-module")?>
	<?$asset->show("social-module")?>
</div>

<div id="block-center">
<section id="block-center-page">
<?php
	if (!empty($news)) {
		
		if (!empty($news['news_text'])) {
			if ($news['news_public'] == 1) {
				echo $news['news_text'];

				$db->call('UPDATE `news` SET news_views='.($news['news_views']+1).' WHERE news_id="'.$_GET['id'].'"');
			}
			else {
				echo 'Новость в данный момент не доступна, попробуйте зайти позже, а пока можете <a href="/">вернуться на главную страницу</a>.';
			}
		}
		else {
			echo 'Новость не найдена, но вы можете <a href="/">вернуться на главную страницу</a>.';
		}
	}
	else {
		echo 'Новость не найдена, но вы можете <a href="/">вернуться на главную страницу</a>.';
	}
?>
</section>

</div>

<div id="block-right">
	<?$asset->show("module-profitable")?>
	<?$asset->show("module-news")?>
</div>