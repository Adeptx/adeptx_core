Убрал $base, нао  вернуть /cms/ иначе не будет модулей. А с ним не грузятся файлы все
<div id="header-top">
	<div id="header-top-container">
		<?$asset->show('site-logotype')?>

		<div id="header-phone">
			<?=$site['shop_phone']?>
		</div>
		<div id="header-time">
			<?=$site['shop_mode']?>
		</div>
		<div id="header-email">
			<a href="mailto:<?=$site['shop_email']?>">
				<?=$site['shop_email']?>
			</a>
		</div>
	</div>
</div>
<div id="header-middle">
	<div id="header-middle-container">
		<?$asset->show('site-description')?>
		<?$asset->show('search')?>
	</div>
</div>
<div id="header-bottom">
	<div id="header-footer-container">
		<?$asset->show('menu')?>
	</div>
</div>