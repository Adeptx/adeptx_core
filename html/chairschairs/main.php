<div id="block-left">				
	<?$asset->show("auth-module")?>
	<?$asset->show("cart-module")?>
	<?$cart->display();?>
	<?$asset->show("filters-module")?>
	<?$asset->show("social-module")?>
</div>

<div id="block-center">
<section>
	<a href="<?=$base['href']?>hits">
		<div id="hits-banner" class="banner"></div>
	</a>
	<br>
	
	<?$asset->show("pluses-block")?>
</section>
<section id="products-list">

	<?
		if ( isset($_GET["show"]) && $_GET["show"] == "hits" ) {
			$products->show( "hits", $_GET["page"], 16);
			$products->pages( "hits", $_GET["page"], 16 );
		}
		else {
			?>
		<h2><?=$lang->phrase('heading-random-products')?></h2>
			<?
			$products->show( "random", $_GET["page"], 16);
			$products->pages( "random", $_GET["page"], 16 );
		}
	?>
	
</section>
<?
	$tmp = $db->call("SELECT * FROM `articles`");
	$articles = $db->fetch_array($tmp);
	$article = $articles[0];

	if ($article['article_public']) {
?>
	<section id="block-center-article">
		<h2><?=$article['article_title']?></h2>
		<aside>
			<?=$article['article_text']?>
		</aside>
	</section>
<?php } ?>

<br>
<a href="<?=$base['href']?>hits">
	<div id="studio-banner" class="banner"></div>
</a>
<br><br>

</div>

<div id="block-right">
	<?$asset->show("module-profitable")?>
	<?$asset->show("module-news")?>
</div>