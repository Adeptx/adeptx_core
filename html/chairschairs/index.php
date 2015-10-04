<? if (!empty($page['heading'])) { ?>
	<h1><?=$lang->phrase($page['heading']);
		// $page['heading'] = '404';
		// $category = $content->category_info( $_GET["page"] );
		// echo $category["category_name"];
	?></h1>
<? } ?>

<section id="content">
	<?include_once $page['path'];?>
</section><!-- /content -->